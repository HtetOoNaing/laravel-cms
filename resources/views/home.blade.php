@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{route('category.index')}}">Categories</a></li>
                <li class="list-group-item"><a href="">Posts</a></li>
            </ul>
        </div>
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    <p>This is home page</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')

@endsection
