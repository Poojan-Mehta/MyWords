<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
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