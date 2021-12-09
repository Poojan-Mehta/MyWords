<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Poems') }}
        </h2>
    </x-slot>   
 
    <div class="flex justify-center my-10">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="float-right flex">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="searchText" value="<?php echo $search; ?>" type="text" placeholder="ex. songs">
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full ml-4" href="#" onclick="Search()"><i class="fa fa-search">&nbsp;Search</i></a>
            </div>
            <div class="my-10">
                @if($songs->count() > 0)
                    @foreach ($songs as $song)
                        <div class="mb-4">  
                            <div class="flex justify-between">
                                <span><a href="" class="font-bold">{{ $song->song_name }}</a></span>                                                                             
                            </div>            
                            <div class="">{!! $song->song_description !!}</div> 
                            <div class="mb-1 composed_by" title="visit the profile"><span><b>Composer:</b> <a href="public_profile/{{ $song->artist_id }}">{{ $song->artist->name }}</a></span></div>                            
                            <span>
                                <a href="song/view/{{ $song->id }}.'?common=yes'; ?>" title="click here to view" class="h-10 px-5 m-2 text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800">View</a>                                
                            </span>                                                                 
                        </div>      
                    @endforeach
                    <div class="pagination mt-2 pull-right">
                        {{ $songs->withQueryString()->links() }}   
                    </div>
                @else
                    <p>There are no any records.</p>
                @endauth       
                    
            </div>                
        </div>        
    </div>
</x-app-layout>
<script type="text/javascript">
    function Search(){
        var searchText = $('#searchText').val();
        window.location.href = "<?php echo url()->current().'?search=';?>"+searchText;
        
    }
</script>