<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>
    <div class="flex justify-center mt-5">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="float-right mb-5">
                <a href="/admin/post" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post list</a>
            </div>
            
            <form action="{{ route('admin.post') }}" method="POST" class="mb-4">   
                @csrf   
                <div class="mb-4">
                    <label for="post_title" class="sr-only">Post title</label>
                    <input name="post_title" id="post_title" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('post_title')
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
                @enderror" value="{{ old('post_body') }}" placeholder="Post something.."> </textarea>
                    
                    @error('body')
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
    </div>
    
    <script type="text/javascript">
    $(window).on('load', function (){        
         $( '#post_body' ).ckeditor();
    });
        
    </script> 
</x-admin-layout>
