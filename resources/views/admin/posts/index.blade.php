@extends('admin.layouts.app')
@section('title','Admin posts')

@section('content')
    <div class="container">
        <div class="col-md-12">      
        
            <div class="d-flex justify-content-between m-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Admin Posts') }}
                </h2>
                <div class="mt-1">
                    <a href="{{ route('admin.post.create') }}" class="btn btn-primary">Add post</a>
                </div>                
            </div>
            
            @if ($message = Session::get('success'))
            <p class="alert alert-success">{{ $message }}</p>
            @endif
            
            @if ($message = Session::get('error'))
            <p class="alert alert-danger">{{ $message }}</p>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="table table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th>Sr no.</th>
                                <th>Post Title</th>
                                <th>Post Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($posts->count())
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->post_title }}</td>
                                    <td>{!! $post->post_body !!}</td>
                                    <td>
                                        {{-- <a href="post/edit/{{ $post->id }}" class="h-10 px-5 m-2 text-blue-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-blue-700">Edit</a> --}}
                                        <a href="admin/post/edit/{{ $post->id }}" class="btn btn-info btn-sm mr-2"><i class="fas fa-pencil-alt"> Edit</i></a>
                                        <a href="javascript:void(0)" data-id="{{ $post->id }}" class="btn btn-danger btn-sm" onclick="destroy(this)"><i class="fas fa-trash"> Delete</i></a>
                                        {{-- <a href="javascript:void(0)" data-id="{{ $post->id }}" class="fas fa-trash destroy"></a> --}}
                                    </td>
                                </tr>
                            @endforeach                                               
                            @else
                                <p>There are no any posts.</p>
                            @endif
                            </tbody>
                        </table>                    
                    </div>
                    <div>
                        {{ $posts->links() }}    
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function destroy(thisdata){
            var post_id = $(thisdata).data('id');
            Swal.fire({
                title: 'Do you want to delete this post?',
                showCancelButton: true,
                confirmButtonText: 'Yes, please',
                denyButtonText: `No, please`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = 'admin/post/destroy/'+post_id;
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
        }
        
    </script>
@endsection
    
