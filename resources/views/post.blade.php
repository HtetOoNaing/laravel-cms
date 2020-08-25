@extends('layouts.app')

@section('css')
    <style>
        .card-img-custom {
            max-width: 100px;
            height: 100px;
        }
    </style>
@endsection

@section('content')

    <div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="addPostForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Are you sure you want to delete ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">No, Go back</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete it</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="editPostForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editTitle">Title</label>
                            <input type="text" name="title" id="editTitle" class="form-control @error('title') border-danger @enderror">
                            @error('title')
                            <p class="text-danger">{{$errors->first('title')}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editBody">Body</label>
                            <textarea name="body" id="editBody" cols="5" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editImage">Image</label>
                            <input type="file" name="image" id="editImage" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="addPostModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="addPostForm" action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') border-danger @enderror">
                            @error('title')
                                <p class="text-danger">{{$errors->first('title')}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" cols="5" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <button type="submit" onclick="onsubmit()" class="btn btn-success">Add Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Posts</div>
                    <div class="card-body">
                        <div class="text-right mb-3">
                            <button class="btn btn-success" onclick="addPost()">Add Post</button>
                        </div>
                        <div class="card-columns">
                            @foreach($posts as $post)
                                <div class="card">
                                    <div class="card-header">{{$post->title}}
                                        <div class="float-right">
                                            <div class="dropdown d-inline-block">
                                                <i style="cursor: pointer" class="material-icons" id="dropdownMenuButton" data-toggle="dropdown">more_vert</i>
                                                <div class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton" style="min-width: 7rem;top:.7rem; left: -3rem;">
                                                    <a class="dropdown-item px-0 text-info" href="#" style="text-align: center" onclick="editPostFun({{$post}})">Edit</a>
                                                    <a class="dropdown-item px-0 text-danger" href="#" style="text-align: center">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="storage/{{$post->image}}" class="card-img-top card-img-custom" alt="img">
                                    <div class="card-body">{{$post->body}}</div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function addPost() {
            $('#addPostModal').modal('show');
        }
        function editPostFun(post) {
            $('#editTitle').val(post.title);
            $('#editBody').val(post.body);
            //$('#editImage').val(post.image);
            var form = document.getElementById('editPostForm');
            form.action = 'post/'+post.id;
            $('#editPostModal').modal('show');
        }

    </script>
@endsection
