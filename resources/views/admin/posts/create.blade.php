@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Create new post</h1>
    </div>
    
    <div class="container">
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf 

            {{-- title --}}
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Enter Title">
            
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- category --}}
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                  <option value=""> -- none --</option>
                  @foreach ($categories as $category)
                    <option  {{ old('category_id') == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>  
                  @endforeach
                </select>

                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- tags --}}
            <div class="form-group">
                <h5 class="py-1" style="font-size: 0.9rem">Tags</h5>
                <div class="d-flex" style="gap: 1.2rem;">
                    @foreach ($tags as $index => $tag)
                        <div class="form-check">
                            {{-- a differenza dell'edit, qui non metto dei tags con già il checked perchè sto creando un nuovo post --}}
                            <input class="form-check-input @error('content') is-invalid @enderror" type="checkbox" value="{{ $tag->id }}" name="tags[{{$index}}]" id="tags-{{ $tag->id }}"> 
                            <label class="form-check-label" for="tags-{{ $tag->id }}">
                                {{ $tag->name }}
                            </label>
                        </div>

                        @error('tags.{{$index}}') 
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    @endforeach
                </div>
            </div>

            {{-- content --}}
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" placeholder="Enter content" cols="30" rows="10">{{ old('content') }}</textarea>
              
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Publication date --}}
            <div class="form-group">
                <label for="published_at">Publication date</label>
                <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at') }}" placeholder="Enter Title">
              
                @error('published_at')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- create button --}}
            <button type="submit" class="btn btn-primary">Create</button>
          </form>
    </div>

@endsection