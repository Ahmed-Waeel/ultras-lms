@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> {{$course->title}} </h1>
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
            <div class="col-sm-12" style=" width: 100%;height: 300px;position: relative">
                <div style="position: absolute;width: 100%;height: 300px;background: #1c1d1f;">
                    <div class="col-sm-7" style="padding: 20px 0 0 20px">
                        <h2 class="text-white" style="font-weight: bolder">{{$course->title}}</h2>
                        <h5 class="text-white">{{$course->short_description}}</h5>
                    </div>
                </div>
                <div class="col-sm-3" style="margin:0; padding: 0; background: red;height: 300px;position: absolute;right: 10%;top: 15%">
                    <img src="{{asset('uploads/images/'.$course->cover)}}" alt="Course Photo" style="width: 100%; height: 300px;">
                </div>
            </div>

{{--            <input id="input-id" name="input-name" type="number" class="rating" min=1 max=5 step=0.5 data-size="lg" data-rtl="true">--}}
        </section>
    </div>
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script>
        $("#input-id").rating();
        $('.read_more').on('click',function (){
            $(this).prev().toggle()
            $(this).toggle()
            $(this).next().toggle()
        });
        $('.show_less').on('click',function (){
            $(this).prev().toggle()
            $(this).toggle()
            $(this).prev().prev().toggle()
        });
    </script>
@endsection
