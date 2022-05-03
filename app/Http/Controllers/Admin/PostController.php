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

        //genero lo slug partendo dal titolo, quindi all'helper Str::slug passo il titolo e non c`è bisogno di passargli il trattino come altro parametro perchè lo aggiunge di default
        $slug = Str::slug( $data['title'] ); 
        $slug_base = $slug;

        $counter = 1; //mi creo un contatore

        // Prendo il primo post che trova con lo stesso slug del post che sto creando
        $post_present = Post::where('slug',$slug)->first();

        // se lo trova allora nel while, finchè non genera uno slug che sia unico, ne crea uno nuovo concatenando lo slug già presente al contatore che incrementa ad ogni giro, poi ricontrolla nuovamente se ne trova uno con lo stesso nome.
        while( $post_present ) {

            $slug = $slug_base . '-' . $counter;
            $counter++;

            $post_present = Post::where('slug',$slug)->first();
        }

        $post = new Post; //Dopo aver fatto il controllo sullo slug posso creare il nuovo post
        $post->fill($data); //popolo la nuova istanza del Model con i dati ricevuti, e per usare il fill devo creare nel model un array protected con i campi da popolare
        $post->slug = $slug; //salvo lo slug controllato dentro allo slug dell’istanza del Post.

        $post->save();

        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
