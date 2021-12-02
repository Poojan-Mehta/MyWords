<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    
<?php 
function user($n, $post_id){
    $return = 'no';
    foreach($n as $pivot){
        if($pivot['pivot']['user_id'] == auth()->id() && $pivot['pivot']['post_id'] == $post_id){
            $return =  'yes';
            break;
        }else{
            $return =  'no';
        }
    }    
    return $return;
}
?>  
    <div class="flex justify-center mt-5">
        <div class="w-8/12 bg-white p-6 rounded-lg">
           <?php if(count($posts)>0){
                foreach ($posts['data'] as $post){ 
                    ?>                   
                    <div class="mb-4">  
                        <div class="flex justify-between">
                            <span><a href="" class="font-bold"><?php echo $post['post_title']; ?></a></span>
                            <?php if(count($post['bookmarks'])>0){ ?>                                 
                                <?php $hasbookmarked='no'; foreach ($post['bookmarks'] as $bookmarks){
                                    $user = user($post['bookmarks'],$post['id']);
                                    if($user== 'yes' && $hasbookmarked=='no'){ $hasbookmarked='yes'; ?>
                                        <i class="fa fa-star favorite" data-id="<?php echo $post['id']; ?>" style="font-size:24px; cursor: pointer;" data-save="true"></i>  
                                    <?php }elseif($user== 'yes' && $hasbookmarked=='yes') { ?>
                                        
                                    <?php }elseif($user== 'no' && $hasbookmarked=='no') { $hasbookmarked='yes';?>                                       
                                        <i class="fa fa-star-o favorite" data-id="<?php echo $post['id']; ?>" style="font-size:24px; cursor: pointer;" data-save="true"></i>                                                                                                                                                            
                                <?php } } ?>
                            <?php }else{ ?>
                                <i class="fa fa-star-o favorite" data-id="<?php echo $post['id']; ?>" style="font-size:24px; cursor: pointer;" data-save="true"></i> 
                            <?php } ?>                           
                            
                        </div>            
                        <div class="mb-2"><?php echo $post['post_body']; ?></div>                                                                  
                    </div>                    
                <?php } ?>
                    <div class="pagination mt-2 pull-right">
                    <?php foreach ($posts['links'] as $key => $pagination) { ?>
                        <a href="<?php echo $pagination['url']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 m-1"><?php echo $pagination['label']; ?> </a>
                    <?php } ?>   
                    </div>
                <?php }else{ ?>
                    <p>There are no any posts.</p>
                <?php } ?>
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

    $('.favorite').on('click',function(){
        var postid = $(this).data('id');
        
        $.ajax({
            url: 'posts/bookmark',
            method: 'POST',
            data: {'post_id':postid},
            success: function(res){
                if(res.action == 'bookmark'){
                    window.Swal.fire({
                        icon: 'success',
                        text: 'Bookmark successfully..',
                    });
                    $('.favorite[data-id=' + postid + ']').removeClass('fa fa-star-o');
                    $('.favorite[data-id=' + postid + ']').addClass('fa fa-star');
                }else{
                    window.Swal.fire({
                        icon: 'success',
                        text: 'UnBookmark successfully..',
                    });
                    $('.favorite[data-id=' + postid + ']').removeClass('fa fa-star');
                    $('.favorite[data-id=' + postid + ']').addClass('fa fa-star-o');
                }
            }
        });

    });
</script>