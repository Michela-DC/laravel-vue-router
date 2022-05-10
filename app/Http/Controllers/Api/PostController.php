<?php

namespace App\Http\Controllers\Api;
use App\Post;

use App\Http\Controllers\Controller;
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
        $posts = Post::with(['category','tags'])
            ->where('published_at', '!=', null) //prende i post dove published_at non è nullo
            ->orderBy('published_at', 'desc')
            ->paginate(12); //fa impaginazione automatica, quindi come gli ho specificato mi mette 12 post per pagina

        //chiamata api
        return response()->json([
            'posts' => $posts,
            'success' => true, //non è obbligatoria
        ]); //dalla chiamata API mi ritornerà un file json, ovvero l'array associativo trasformato in file json
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::with(['category','tags'])->where('slug', $slug)->first();

        //se trova il post
        if( $post ) {
            return response()->json([
                'post' => $post,
                'success' => true, 
            ]);
        }
        
        // se non trovo il post allora devo restituire una risposta di errore
        return response()->json([
            'posts' => 'post not found',
            'success' => false, 
        ], 404); //specifico così di mandare una risposta pagina 404 di errore
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
