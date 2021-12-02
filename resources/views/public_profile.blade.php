<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artist Profile') }}
        </h2>
    </x-slot>
    <div class="flex justify-center mt-5">
        <div class="w-8/12 bg-white p-6 rounded-lg" style="background-image: url(/img/users/<?php echo $user['cover_photo']?>);height:200px;"> 
        
        </div>
    </div>
    <div class="flex justify-center mt-5">
        <div class="w-8/12 bg-white p-6 rounded-lg">           
            <div class="">
                <div class="flex justify-between">
                    <div class="profile_img">
                        <img class="img" src="{{ asset('img/users/') }}<?php echo '/'.$user['profile_photo']?>" width="75" height="75"/>
                    </div>
                    <div class="profile_content">
                        <div class="">
                            <span class="artist_name"><i class="fa fa-user fa-lg text-blue-900"></i> <b> Artist Name: </b><?php echo $user['name'];?></span>
                        </div>
                        <div class="">
                            <span class="artist_email"><i class="fa fa-envelope fa-lg text-red-900"></i> <b> Artist Email: </b><?php echo $user['email'];?></span>
                        </div>                       
                    </div>
                </div>
                <?php 
                    function searchForId($id, $array) {
                        foreach ($array as $key => $val) {
                            if ($val['subscribe_to'] === $id) {
                                return true;
                                break;
                            }
                        }
                        return false;
                    }
                ?>
                <div>
                    <?php if($user['id'] != auth()->id()){ ?>
                        <div class="pull-right">
                            <?php if(!empty($user['subscribed_profile'])){                                
                                if(searchForId($user['id'],$user['subscribed_profile'])){
                                    $subscribed = "yes";
                                    $subButtonClass = "h-10 px-5 m-2 text-red-100 transition-colors duration-150 bg-red-700 rounded-lg focus:shadow-outline hover:bg-red-800 subscribe";
                                }else{
                                    $subscribed = "no";
                                    $subButtonClass = "h-10 px-5 text-red-700 transition-colors duration-150 border border-red-500 rounded-lg focus:shadow-outline hover:bg-red-500 hover:text-red-100 subscribe";
                                }
                            }else{
                                $subscribed = "no";
                                $subButtonClass = "h-10 px-5 text-red-700 transition-colors duration-150 border border-red-500 rounded-lg focus:shadow-outline hover:bg-red-500 hover:text-red-100 subscribe";
                            }?>
                            <button class="<?php echo $subButtonClass; ?>" title="subscribe" data-id="<?php echo $user['id']; ?>" id="subsctibe">
                                <?php echo $subscribed == 'yes' ? 'Subscribed': 'Subscribe'; ?>
                            </button>
                        </div>
                    <?php } ?>
                    
                </div>
            </div>
           
        </div>        
    </div>
    <div class="flex justify-center mt-5">
        <div class="w-8/12 bg-white p-6 rounded-lg">  
            <h3 class="font-semibold text-xl text-gray-800 leading-tight">Latest art</h3>         
            <?php if(count($user['songs'])>0){
                $songs = array_reverse($user['songs']);
                foreach ($songs as $key => $song) { 
                    if($key <= 2){
                ?>
                    <div class="mt-3">
                        <span class="song_name"><a href="/song/view/<?php echo $song['id']; ?>" target="_blank" title="click here to view" class="font-bold"><?php echo $key+1; echo ') '.$song['song_name']; ?></a></span>                        
                    </div>
                <?php } }
            }else { ?>
                <span class="text-center"> Currently user has uploaded nothing.. </span>
            <?php }?>
           
        </div>        
    </div>
</x-app-layout>
<script type="text/javascript">

    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
            }
        })
    });

    $('.subscribe').on('click',function(){
        var userid = $(this).data('id');
        
        $.ajax({
            url: "{{ route('profile.subscribe') }}",
            method: 'POST',
            data: {'user_id':userid},
            success: function(res){
                if(res.action == 'subscribe'){
                    window.Swal.fire({
                        icon: 'success',
                        text: 'Subscribed successfully..',
                    });
                    $('.subscribe').attr('title','Subscribed');
                    $('.subscribe').html('Subscribed'); 
                    $('.subsctibe').attr('class','');
                    $('#subsctibe').attr('class', 'h-10 px-5 m-2 text-red-100 transition-colors duration-150 bg-red-700 rounded-lg focus:shadow-outline hover:bg-red-800 subscribe');

                }else{
                    window.Swal.fire({
                        icon: 'success',
                        text: 'Unsubscribe successfully..',
                    });
                    $('.subscribe').attr('title','Subscribe');
                    $('.subscribe').html('Subscribe');
                    $('.subsctibe').attr('class','');
                    $('#subsctibe').attr('class', 'h-10 px-5 text-red-700 transition-colors duration-150 border border-red-500 rounded-lg focus:shadow-outline hover:bg-red-500 hover:text-red-100 subscribe');
                }
            }
        });

    });
</script>