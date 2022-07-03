@extends('layouts.admin')

@section('content')
    <style>
        th{
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('dist/css/jquery-confirm.min.css')}}">--}}
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Courses</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Courses</li>
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
                            <a class="btn btn-success btn-sm" href="{{route('course.create')}}"><i class="fas fa plus">&nbsp;&nbsp;Add Course</i></a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width: 15%">Course</th>
                            <th style="width: 5%">Cover</th>
                            <th style="width: 20%">Description</th>
                            <th style="width: 15%">Category</th>
                            <th style="width: 15%">Instructor</th>
                            <th style="width: 5%">Price</th>
                            <th style="width: 5%">Duration</th>
                            <th style="width: 15%">Operations</th>
                        </tr>
                        </thead>
                        <tbody id=table_body>
                        @foreach($courses as $course)
                            <tr>
                                <td><a href="{{route("course.show",$course->id)}}">{{$course->title}}</a></td>
                                <td class="text-center"><img style="width: 80px;height: 40px" src="{{asset('uploads/images/'.$course->cover)}}" ></td>
                                <td>
                                    @if(Str::length(strip_tags($course->description)) <= 50)
                                        {!!  $course->description !!}
                                    @else
                                        {!!  substr(strip_tags($course->description), 0, 50) !!}<span style="display: none" class="more_details" >{!! substr(strip_tags($course->description), 60) !!}</span>
                                        @if(strlen(strip_tags($course->description)) > 50)
                                            <a type="button" onclick="readMore(this)" class='read_more'>...Read More</a>
                                        @endif
                                            <a  type="button" onclick="showLess(this)" style="cursor: pointer;display: none" class="show_less" >&nbsp;&nbsp;show less</a>
                                    @endif
                                </td>
                                <td class="text-center">{{$course->category}}</td>
                                <td class="text-center">{{$course->instructor}}</td>
                                <td class="text-center">{{$course->price}}</td>
                                <td class="text-center">{{$course->duration}}</td>
                                <td class="text-center"><a class="btn btn-sm btn-success operations" href="{{route('course.edit', $course->id)}}"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-danger operations" onclick="return confirm('Are you sure you want to delete this Course ?')" href="{{route('course.delete', $course->id)}}"><i class="fas fa-trash"></i>&nbsp;Delete</a></td>
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
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
{{--    <script src="{{asset('dist/js/jquery-confirm.min.js')}}"></script>--}}
    <script>
        function readMore(element){
            $(element).closest('a.read_more').prev().toggle();
            $(element).closest('a.read_more').toggle();
            $(element).closest('a.read_more').next().toggle();
        }
        function showLess(element){
            $(element).closest('a.show_less').prev().toggle();
            $(element).closest('a.show_less').toggle();
            $(element).closest('a.show_less').prev().prev().toggle();
        }
        // $('a.operations').on('click', function (){
        //     $.confirm({
        //         title: 'Confirm!',
        //         content: 'Simple confirm!',
        //         buttons: {
        //             confirm: function () {
        //                 $.alert('Confirmed!');
        //             },
        //             cancel: function () {
        //                 $.alert('Canceled!');
        //             }
        //         }
        //     });
        // })
        $('[name=title_search]').on('input', function () {
            $.ajax({
                type: 'post',
                url: '{{route('courses.search')}}',
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
