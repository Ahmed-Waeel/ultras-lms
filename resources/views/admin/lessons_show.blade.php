@extends('layouts.admin')

@section('content')
    <style>
        th{
            text-align: center;
        }
        td:not(:first-child){
            text-align: center;
            vertical-align: middle;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 200px;z-index: 100">
                            <input type="text" name="title_search" class="form-control float-right" placeholder="Search By Course Name">
                            @csrf
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="position: absolute;left: 10px">
                            <a class="btn btn-success btn-sm" href="{{route('category.create')}}"><i class="fas fa plus">&nbsp;&nbsp;Add Category</i></a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width: 30%">Title</th>
                            <th style="width: 30%">Cover</th>
                            <th style="width: 20%">Number of Courses</th>
                            <th style="width: 20%">Operations</th>
                        </tr>
                        </thead>
                        <tbody id=table_body>
                        @foreach($categories as $category)
                            <tr>
                                <td class="align-middle"><a href="{{route("category.show",$category->id)}}">{{$category->title}}</a></td>
                                <td><img style="width: 150px;height: 80px" src="{{asset('uploads/images/'.$category->cover)}}"alt="Category Cover Image"></td>
                                <td>@coursesCount($category->id)</td>
                                <td><a class="btn btn-sm btn-success operations" href="{{route('category.edit', $category->id)}}"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-danger operations" onclick="return confirm('Are you sure you want to delete this Category ?')" href="{{route('category.delete', $category->id)}}"><i class="fas fa-trash"></i>&nbsp;Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
    </div>
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script>
        $('[name=title_search]').on('input', function () {
            $.ajax({
                type: 'post',
                url: '{{route('categories.search')}}',
                data:{
                    "title":$(this).val(),
                    "_token": "{{ csrf_token() }}"
                },
                success: function (page)
                {
                    $('#table_body').html($(`${page}`).find('tr:not(:first)'));
                }
            });
        });
    </script>
@endsection
