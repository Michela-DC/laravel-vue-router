@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-10">
                <h1>Edit post: {{ $post->title }}</h1>
            </div>
            <div class="col-2">
                <form id="delete-form" class="text-right" action="{{route('admin.posts.destroy', $post)}}" method="POST">
                    @csrf {{-- il token di sicurezza va sempre messo nei form --}}
                    @method('DELETE')
                    <button for="delete-form" class="btn btn-danger" type="submit" >Delete</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="container">
        <form id="edit" action="{{ route('admin.posts.update', $post) }}" method="POST"> 
        {{-- gli passo anche il parametro $post perché deve sapere quale post andare a modificare --}}
            @csrf 
            @method('PUT')

            {{-- title --}}
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title)}}" placeholder="Enter Title">
            
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- categories --}}
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value=""> -- none -- </option> 
                    {{-- ci devo mettere il value vuoto così lo considera come nullo, se non ce lo metto non funge --}}
                    @foreach ($categories as $category)
                        <option {{ old('category_id', optional($post->category)->id ) == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>  
                        {{-- Con optional if the given object is null, properties and methods will return null instead of causing an error --}}
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
                            {{-- Per selezionare una checkbox devo dare l'attributo checked. I tag che devono essere già selezionati sono quelli che sono già collegati al post,
                            quindi, per mostrarli già selezionati, devo controllare se il $tag del loop è incluso nel tag del post a cui accedo con $post->tags che mi restituisce una collection dei tag del post. 
                            Posso poi usare il metodo contains() per controllare se è contenuto --}}
                            <input class="form-check-input" {{ $post->tags->contains($tag) ? 'checked' : '' }} type="checkbox" value="{{ $tag->id }}" name="tags[{{$index}}]" id="tags-{{ $tag->id }}"> 
                            {{-- Con tags-{{ $tag->id }} creo un id univoco per ogni tag.
                            Aggiungo il value che sarà il dato che mi arriva nel metodo update quando quella data input viene selezionata .
                            Con name="tags[{{$index}}]" gli indici dell'array tags nel controller corrisponderanno ai valori delle checkbox --}}
                            <label class="form-check-label" for="tags-{{ $tag->id }}">
                                {{ $tag->name }}
                            </label>

                            @error('tags.{{$index}}') 
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div> 
            </div>

            {{-- content --}}
            <div class="form-group">
                <label for="content">Title</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" placeholder="Enter content" cols="30" rows="10">{{ old('content', $post->content) }}</textarea>
              
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- pubblication date --}}
            <div class="form-group">
                <label for="published_at">Publication date</label>
                <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at') ? : Str::substr($post->published_at, 0, 10)  }}" placeholder="Enter Title">
                {{-- The Str::substr method returns the portion of string specified by the start and length parameters: --}}
              
                @error('published_at')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- button save --}}
            <button for="edit" type="submit" class="btn btn-primary">Save changes</button>
            {{-- con for=edit specifico che questo bottone si riferisce al form cin id=edit --}}
          </form>
    </div>

@endsection