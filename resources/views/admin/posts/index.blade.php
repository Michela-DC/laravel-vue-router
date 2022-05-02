@extends('layouts.app')

@section('content')
    
    <ul>
        @foreach ($posts as $post)
            <li>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->slug }}</p>
            </li>
        @endforeach
    </ul>

@endsection