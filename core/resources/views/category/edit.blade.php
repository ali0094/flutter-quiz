@extends('layouts.layout')

@section('title', 'Edit Category')

@section('content')

    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Edit Category</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>All Base Category</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> All Base Category
            <small> have also a sub Category</small>
        </h1>
        <!-- END PAGE TITLE-->

        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="edit-box" style="margin-bottom: 30px">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box green margin-bottom-30">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Exam Category Edit</div>
                        </div>
                    </div>
                    <div class="portlet-body">

                        {!! Form::model($category,['route'=>['category.update',$category->id],'method'=>'PUT', 'class'=>'', 'style'=>'margin-top: 5px']) !!}

                        <div class="form-group">
                            <label for="exampleInputName2">Category Name : </label>
                            <input type="text" class="form-control" id="exampleInputName2" name="name" value="{{ $category->name }}" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Description</label>
                            <input type="text" class="form-control" id="exampleInputEmail2" name="description" value="{{ $category->description }}" placeholder="">
                        </div>
                        <div class="col-sm-6 col-sm-offset-3">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </div>


                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- END CONTENT BODY -->


@endsection