<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My poems') }}
        </h2>
    </x-slot>   
 
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

            <div class="pull-right mb-5">
                <a href="{{ route('song.add') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i class="fa fa-plus"> Compose</i></a>
            </div>
            <div class="mt-5">
                <?php if(count($songs)>0){
                    foreach ($songs['data'] as $key=> $song){ 
                        ?>                   
                        <div class="mb-4">  
                            <div class="flex justify-between">
                                <span><a href="" class="font-bold"><?php echo $key+1; echo ') '. $song['song_name']; ?></a></span>                                             
                                
                            </div>            
                            <div class="mb-2"><?php echo strlen($song['song_lyrics']) > 150 ? substr($song['song_lyrics'],0,150)."..." : $song['song_lyrics']; ?></div> 
                            <span>
                                <a href="song/view/<?php echo $song['id']; ?>" class="h-10 px-5 m-2 text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800">View</a>
                                <a href="song/edit/<?php echo $song['id']; ?>" class="h-10 px-5 m-2 text-blue-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-blue-700">Edit</a>
                                {{-- <a href="post/destroy/{{ $post->id }}" class="h-10 px-5 m-2 text-red-100 transition-colors duration-150 bg-red-700 rounded-lg focus:shadow-outline hover:bg-red-800 destroy">Delete</a> --}}
                                <a href="javascript:void(0)" data-id="<?php echo $song['id']; ?>" class="h-10 px-5 m-2 text-red-100 transition-colors duration-150 bg-red-700 rounded-lg focus:shadow-outline hover:bg-red-800 destroy">Delete</a>
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
    <script>
        $('.destroy').on('click',function(){
            var song_id = $(this).data('id');
            Swal.fire({
                title: 'Do you want to delete this song?',
                showCancelButton: true,
                confirmButtonText: 'Yes, please',
                denyButtonText: `No, please`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = 'song/destroy/'+song_id;
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
        });
        
    </script>
</x-app-layout>