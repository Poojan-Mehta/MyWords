<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My songs') }}
        </h2>
    </x-slot>   
    <?php //echo '<pre>'; print_r($song); exit; ?>
    <div class="flex justify-center mt-5">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @if ($message = Session::get('success'))
            <div role="alert">
                <div class="border border-t-0 border-teal-400 rounded-b bg-teal-100 px-4 py-3 text-teal-700">
                    <p>{{ $message }}</p>
                </div>
            </div>
            @endif
            
            @if ($message = Session::get('error'))
            <div role="alert">
                <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                    <p>{{ $message }}</p>
                </div>
            </div>
            @endif
            <div class="flex justify-between">
                <span class="composed_by"><b>Composer:</b> <?php echo $song['artist']['name']?></span>
                <a href="{{ url()->previous() }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to list</a>                
            </div>
            
            <div class="mt-5">
                <div class="song_name my-5">
                    <span class="my-5"><b>Song Name:</b></span><br>
                    <span class="song_name_span my-5"><?php echo $song['song_name']; ?></span>
                </div>
                <div class="song_lyrics my-5 border-t-4">
                    <span class="my-5"><b>Song lyrics:</b></span><br>
                    <span class="song_lyrics_span my-3"><?php echo $song['song_lyrics']; ?></span>
                </div>
                <div class="song_description my-5 border-t-4">
                    <span class="my-5"><b>Song description:</b></span><br>
                    <span class="song_description_span my-3"><?php echo $song['song_description']; ?></span>
                </div>
            </div>           
        </div>        
    </div>
</x-app-layout>