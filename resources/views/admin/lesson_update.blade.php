@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$category->title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('categories.show')}}">Categories</a></li>
                            <li class="breadcrumb-item active">{{$category->title}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="{{route('category.update')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type=hidden value={{$category->id}} name=id>
                <div class="card-body">
                    <div class="form-group">
                        <label for=title>Title</label>
                        <input type=text class=form-control id=title name=title placeholder="Please Enter the Category title" value="{{$category->title}}">
                        @error('title')
                            <p class="form-text text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Cover Photo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type=file class="custom-file-input" onchange="displayCoverImage(this)" id=cover name=cover>
                                <label class="custom-file-label" for="cover">Choose Image</label>
                            </div>
                        </div>
                        @error('cover')
                            <p class="form-text text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="filtr-item col-sm-12">
                        <img src="{{asset('uploads/images/'.$category->cover)}}" style="width: 100%;height: 400px;" alt="Cover Photo For Category" class="img-fluid mb-2">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </section>
    </div>
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script>
        function displayCoverImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.img-fluid').attr('src', e.target.result).width('100%').height(400);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
