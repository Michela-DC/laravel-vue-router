@extends('layouts.app')

@section('content')
    
    <div class="container">
        <form action="">

            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Enter Title">
            
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Title</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" placeholder="Enter content" cols="30" rows="10">{{ old('content') }}</textarea>
              
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="published_at">Publication date</label>
                <input type="date" class="form-control @error('puclished_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at') }}" placeholder="Enter Title">
              
                @error('puclished_at')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
  
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>

@endsection