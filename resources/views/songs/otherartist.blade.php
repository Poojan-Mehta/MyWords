<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My poems') }}
        </h2>
    </x-slot>   
 
    <div class="flex justify-center mt-5">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="mt-5">
                <?php if(count($songs)>0){
                    foreach ($songs['data'] as $key=> $song){ 
                        ?>                   
                        <div class="mb-4">  
                            <div class="flex justify-between">
                                <span><a href="" class="font-bold"><?php echo $key+1; echo ') '. $song['song_name']; ?></a></span>                                                                             
                            </div>            
                            <div class=""><?php echo strlen($song['song_lyrics']) > 150 ? substr($song['song_lyrics'],0,150)."..." : $song['song_lyrics']; ?></div> 
                            <div class="mb-1 composed_by" title="visit the profile"><span><b>Composer:</b> <a href="public_profile/<?php echo $song['artist_id'];?>"><?php echo $song['artist']['name']; ?></a></span></div>                            
                            <span>
                                <a href="song/view/<?php echo $song['id'].'?common=yes'; ?>" title="click here to view" class="h-10 px-5 m-2 text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800">View</a>                                
                            </span>                                                                 
                        </div>                    
                    <?php } ?>
                        <div class="pagination mt-2 pull-right">
                        <?php foreach ($songs['links'] as $key => $pagination) { ?>
                            <a href="<?php echo $pagination['url']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 m-1"><?php echo $pagination['label']; ?> </a>
                        <?php } ?>   
                        </div>
                    <?php }else{ ?>
                        <p>There are no any posts.</p>
                    <?php } ?>
            </div>     
        </div>        
    </div>
</x-app-layout>