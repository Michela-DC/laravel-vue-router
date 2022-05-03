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
                        <td>{{ $post->published_at}}</td>
                        <td>{{ $post->creeated_at}}</td>
                        <td>
                            <a class="btn btn-outline-success" href="{{ route('admin.posts.edit', $post) }}">Edit</a> 
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