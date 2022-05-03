<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->limit(20)->get(); //ordino i post per ordine di creazione e prendo solo 20 post

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|string',
            'published_at' => 'nullable|date|before_or_equal:today'
        ]);

        $data = $request->all();

        $slug = Post::getUniqueSlug($data['title']); //uso un metodo statico che creo io e la cui logica è nel model
        // dd($slug);

        $post = new Post; //Dopo aver fatto il controllo sullo slug posso creare il nuovo post
        $post->fill($data); //popolo la nuova istanza del Model con i dati ricevuti, e per usare il fill devo creare nel model un array protected con i campi da popolare
        $post->slug = $slug; //salvo lo slug controllato dentro allo slug dell’istanza del Post.

        $post->save();

        return redirect()->route('admin.posts.index');

    }

    // in questo caso non creo lo show perché in wordpress lo show sarebbe l'anteprima del post che possono vedere tutti gli utenti

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|string',
            'published_at' => 'nullable|date|before_or_equal:today'
        ]);

        $data = $request->all();

        // Se il titolo originale è diverso da quello che viene passato dall'edit devo generare il nuovo slug in base al nuovo titolo inserito
        if( $post->title != $data['title']){

            $slug = Post::getUniqueSlug($data['title']);

            $data['slug'] = $slug; // $data è un array associativo quindi posso passare così il nuovo slug al database
            //Bisogna anche aggiungere lo slug all'array fillable nel model perchè altrimenti non lo aggiorna   
        }

        $post->update($data);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
