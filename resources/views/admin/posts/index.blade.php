@extends('layouts.app')

@section('content')

    <div class="container">
        <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">New Post</a>
    </div>

    <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Category</th>
                <th scope="col">Tag</th>
                <th scope="col">Publication date</th>
                <th scope="col">Creation date</th>
              </tr>
            </thead>

            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id}}</td>
                        <td>{{ $post->title}}</td>
                        <td>{{ $post->slug}}</td>
                        {{-- Devo controllare se la categoria esiste, se sì allora stampo il nome altrimenti niente --}}
                        <td>{{ $post->category ? $post->category->name : '/'}}</td> 
                        <td>
                            @foreach ($post->tags as $tag)
                                <span class="badge badge-success py-1">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $post->published_at ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->published_at)->format('d/m/Y') : '/' }}</td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d/m/Y')}}</td>
                        <td>
                            <a class="btn btn-dark" href="{{ route('admin.posts.edit', $post) }}">Edit</a> 
                            {{-- gli devo passare il parametro per specificare a quale post si riferisce, potrei anche scriverlo $post->id --}}
                        </td>
                        <td>
                            <form class="delete-form" action="{{route('admin.posts.destroy', $post)}}" method="POST">
                                @csrf {{-- il token di sicurezza va sempre messo nei form --}}
                                @method('DELETE')
                                <button class="btn btn-danger my-submit p-2 rounded" type="submit" >Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>

@endsection