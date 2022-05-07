<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        // -> https://laravel.com/docs/7.x/eloquent-relationships#eager-loading
        // invece di far fare la query nel frontend per chiedere di recuperare la category di ogni post, uso il method with per far la query solo una volta quando recupero i post, 
        // passandogli il nome della funzione della relazione che ho nel model Post. In  questo modo il frontend avrà già l'informazione e non dovrà fare la query ad ogni stampa
        $posts = Post::with('category','tags')->orderBy('created_at', 'desc')->limit(20)->get(); //ordino i post per ordine di creazione e prendo solo 20 post
        // category e tags sono i nomi delle funzioni che creano la relazione con post

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
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
            'published_at' => 'nullable|date|before_or_equal:today',
            'category_id' => 'nullable|exists:categories,id', //con nullable acceta se l'id non viene inserito, quindi non viene scelta nessuna categoria
            //ma se viene scelta allora controlla con exists che sia esistente nella tabella categories, nella colonna id, https://laravel.com/docs/7.x/validation#rule-exists
            'tags.*' => 'exists:tags,id', // aggiungendo .* a tags, va a fare la validazione sui singoli elementi invece di farli su tutto l'array 
        ]);

        $data = $request->all();

        $slug = Post::getUniqueSlug($data['title']); //uso un metodo statico che creo io e la cui logica è nel model
        // dd($slug);

        $post = new Post; //Dopo aver fatto il controllo sullo slug posso creare il nuovo post
        $post->fill($data); //popolo la nuova istanza del Model con i dati ricevuti, e per usare il fill devo creare nel model un array protected con i campi da popolare
        $post->slug = $slug; //salvo lo slug controllato dentro allo slug dell’istanza del Post.

        $post->save();

        //il controllo di tags lo devo mettere dopo che il post è stato creato e salvato altrimenti non trova $post
        if( array_key_exists('tags', $data) ){

            $post->tags()->sync( $data['tags'] ); 

        }else{
            $post->tags()->sync([]); 
        }
        
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
        $categories = Category::orderBy('name')->get();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
            'published_at' => 'nullable|date|before_or_equal:today',
            'category_id' => 'nullable|exists:categories,id',
            'tags.*' => 'exists:tags,id',
        ]);

        $data = $request->all();
        // dd($data);

        // Se il titolo originale è diverso da quello che viene passato dall'edit devo generare il nuovo slug in base al nuovo titolo inserito
        if( $post->title != $data['title']){

            $slug = Post::getUniqueSlug($data['title']);

            $data['slug'] = $slug; // $data è un array associativo quindi posso passare così il nuovo slug al database
            //Bisogna anche aggiungere lo slug all'array fillable nel model perchè altrimenti non lo aggiorna   
        }

        /* da tags dovrebbe arrivare un array di tags però se non viene selezionato nessun tag allora la voce tags non sarà presente, 
        quindi devo fare un controllo in cui se tags è presente allora lo passo a sync, altrimenti gli passo un array vuoto */
        if( array_key_exists('tags', $data) ){

            $post->tags()->sync( $data['tags'] ); //veranno aggiunti nella tabella pivot i tags selezionati

        }else{

            $post->tags()->sync([]); //in questo modo il post non avrà tags collegati, quindi entra in azione il onDelete('cascade') e il collegamento iniziale nella tabella pivot, tra il post e i tag, viene eliminato
            // oppure avrei potuto non passare niente con il parametro detach che rimuove le relazione esistenti
            //$post->tags()->detach();
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
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
