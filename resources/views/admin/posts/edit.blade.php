@extends('admin.layouts.app')
@section('title','Admin posts')

@section('content')
<div class="content">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    
        <div class="float-right mb-5">
            <a href="{{ route('admin.post') }}" class="btn btn-primary">Post list</a>
        </div>
        <div class="col-md-12">
            <form action="/admin/post/update/{{ $post->id }}" method="POST" class="mb-4">   
                @csrf   
                <div class="mb-4">
                    <label for="post_title" class="sr-only">Post title</label>
                    <input name="post_title" id="post_title" value="{{ $post->post_title }}" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('post_title')
                    border-red-500
                @enderror" value="{{ old('post_title') }}" placeholder="Post title.."> </textarea>
                    
                    @error('post_title')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>           
                <div class="mb-4">
                    <label for="post_body" class="sr-only">Body</label>
                    <textarea name="post_body" id="post_body" cols="30" rows="4" class="ckeditor bg-gray-100 border-2 w-full p-4 rounded-lg @error('post_body')
                    border-red-500
                @enderror" value="{{ old('post_body') }}" placeholder="Post something.."> {{ $post->post_body }} </textarea>
                    
                    @error('post_body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>                
                
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Save</button>
                </div>
            </form>
        </div>
    <script type="text/javascript">
        $(window).on('load', function (){        
             $( '#post_body' ).ckeditor();
        });
            
    </script> 
@endsection
