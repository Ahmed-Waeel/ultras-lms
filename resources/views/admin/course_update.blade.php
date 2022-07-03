@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$course->title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('courses.show')}}">Courses</a></li>
                            <li class="breadcrumb-item active">{{$course->title}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="{{route('course.update')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type=hidden value={{$course->id}} name=id>
                <div class="card-body">
                    <div class="form-group">
                        <label for=title>Title</label>
                        <input type=text class=form-control id=title name=title placeholder="Please Enter the course title" value="{{$course->title}}">
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
                        <img src="{{asset('uploads/images/'.$course->cover)}}" style="width: 100%;height: 400px;" alt="Cover Photo For Category" class="img-fluid mb-2">
                    </div>
                    <div class="form-group">
                        <label for=description>Description</label>
                        <textarea id=description name=description>{!! $course->description !!}</textarea>
                        @error('description')
                            <p class="form-text text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for=category>Category</label>
                        <select class="form-control select2" id=category name=category data-placeholder="-- Select Category --" data-dropdown-css-class="select2-purple">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($category->id === $course->category) selected @endif>{{$category->title}}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="form-text text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                        <script>
                            $("#category").select2();
                        </script>
                    </div>
                    <div class="form-group">
                        <label for=instructor>Instructor</label>
                        <select class="form-control select2" id=instructor name=instructor data-placeholder="-- Select Instructor --" data-dropdown-css-class="select2-purple">
                            <option value="1">Muhammed Amr</option>
                        </select>
                        @error('instructor')
                            <p class="form-text text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for=price>Price</label>
                        <div class="input-group">
                            <input type=text class=form-control id=price name=price placeholder="Please Enter The Price" value="{{$course->price}}">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-dollar-sign"></i>
                                </span>
                            </div>
                        </div>
                        @error('price')
                            <p class="form-text text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for=duration>Duration</label>
                        <div class="input-group">
                            <input type=text class=form-control id=duration name=duration placeholder="Please Enter The Duration" value="{{$course->duration}}">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Hour</span>
                            </div>
                        </div>
                        @error('duration')
                        <p class="form-text text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </section>
    </div>
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
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
        $('#description').summernote();
        $("#category").select2({
            theme: 'bootstrap4'
        });
        $("#instructor").select2({
            theme: 'bootstrap4'
        });
    </script>

@endsection
