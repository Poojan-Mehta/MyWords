<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit poem') }}
        </h2>
    </x-slot>
    <div class="flex justify-center mt-5">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="float-right mb-5">
                <a href="{{ route('my.songs') }}" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Go to list</a>
            </div>
            <div class="mt-5">
                <form action="/song/update/{{ $song->id }}" method="POST" class="mb-4">   
                    @csrf
                    <div class="mb-4">
                        <label for="tags"><b>Hashtags:</b></label>
                        <select class="bg-gray-100 border-2 w-full p-4 rounded-lg select2" name="tags[]" multiple>
                            <?php  foreach($song['tags'] as $key => $tag){?>
                                <option value="<?php echo $tag; ?>" selected><?php echo $tag; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="song_name"><b>Poem title:</b></label>
                        <input name="song_name" id="song_name" value="{{ $song->song_name }}" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('song_name')
                        border-red-500
                    @enderror" value="{{ old('song_name') }}" placeholder="Song title.."> </textarea>
                        
                        @error('song_name')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>           
                    <div class="mb-4">
                        <label for="song_lyrics"><b>Poem Lyrics:</b></label>
                        <textarea name="song_lyrics" id="song_lyrics" cols="30" rows="4" class="ckeditor bg-gray-100 border-2 w-full p-4 rounded-lg @error('song_lyrics')
                        border-red-500
                    @enderror" value="{{ old('song_lyrics') }}"> {{ $song->song_lyrics }} </textarea>
                        
                        @error('song_lyrics')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="song_description"><b>Poem Description:</b></label>
                        <textarea name="song_description" id="song_description" cols="30" rows="4" class="ckeditor bg-gray-100 border-2 w-full p-4 rounded-lg @error('song_description')
                        border-red-500
                    @enderror" value="{{ old('song_description') }}"> {{ $song->song_description }} </textarea>
                        
                        @error('song_description')
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
    </div>
    
    <script type="text/javascript">
    $(window).on('load', function (){        
         $( '#song_description,#song_lyrics' ).ckeditor();
    });

    $(document).ready(function() {
        $('.select2').select2({
            tags: true
        });
    });

    $(".select").select2({
        tags: true,
        createTag: function (params) {
            return {
            id: params.term,
            text: params.term,
            newOption: true
            }
        }
    });
    </script> 
</x-app-layout>
