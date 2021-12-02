<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Posts') }}
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

            <div class="float-right mb-6">
                <a href="post/create" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Add Post</a>
            </div>
            
            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="mb-4">
                        <a href="" class="font-bold">{{ $post->post_title }}</a> <span class="text-gray-600 text-sm"> {{ $post->created_at->diffForHumans() }}</span>
                        <div class="mb-2 post_body">{!! $post->post_body !!}</div> 
                        <span>
                            <a href="post/edit/{{ $post->id }}" class="h-10 px-5 m-2 text-blue-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-blue-700">Edit</a>
                            {{-- <a href="post/destroy/{{ $post->id }}" class="h-10 px-5 m-2 text-red-100 transition-colors duration-150 bg-red-700 rounded-lg focus:shadow-outline hover:bg-red-800 destroy">Delete</a> --}}
                            <a href="javascript:void(0)" data-id="{{ $post->id }}" class="h-10 px-5 m-2 text-red-100 transition-colors duration-150 bg-red-700 rounded-lg focus:shadow-outline hover:bg-red-800 destroy">Delete</a>
                        </span>                        
                    </div>                    
                @endforeach                
                {{ $posts->links() }}
            @else
                <p>There are no any posts.</p>
            @endif
        </div>
    </div>

    <script>
        $('.destroy').on('click',function(){
            var post_id = $(this).data('id');
            Swal.fire({
                title: 'Do you want to delete this post?',
                showCancelButton: true,
                confirmButtonText: 'Yes, please',
                denyButtonText: `No, please`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = 'post/destroy/'+post_id;
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
        });
        
    </script>
</x-admin-layout>
