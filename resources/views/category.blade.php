@extends('layouts.app')

@section('content')

    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{route('category.store')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" id="deleteCategoryForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Are you sure you want to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No, Go back</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete it</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="deleteTitle">Title</label>
                            <input type="text" name="title" id="deleteTitle" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach($errors->all() as $error)
                            <p class="mb-0"><strong>{{$error}}</strong></p>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif


                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Categories</div>

                    <div class="card-body">
                        <div class="float-right mb-3">
                            <button class="btn btn-success" onclick="addCategory()">Add Category</button>
                        </div>
                        <table class="table">
                            @if(count($categories->toArray()) > 0)
                                <thead>
                                <tr>
                                    <th style="font-weight: bolder;">Title</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->title}}</td>
                                        <td class="text-right">
                                            <a href="#" onclick="editCategory({{$category}})" class="btn btn-info btn-sm">Edit</a>
                                            <a href="#" onclick="deleteCategory({{$category->id}})" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>

        function addCategory() {
            $('#addCategoryModal').modal('show');
        }

        function deleteCategory(id) {

            var form = document.getElementById('deleteCategoryForm');
            form.action = 'category/'+id;
            $('#deleteCategoryModal').modal('show');

        }

        function editCategory(category) {
            $('#deleteTitle').val(category.title);
            var form = document.getElementById('editCategoryForm');
            form.action = 'category/'+category.id;
            $('#editCategoryModal').modal('show');

        }

    </script>

@endsection
