@extends('layouts.layout')

@section('title', 'Manage Category')

@section('content')

    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Manage Category</a>
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
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Category </div>
                        <button class="btn btn-default pull-right" style="margin-top: 5px" id="add" value="add">Add New Category</button>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-responsive" id="sample_2">
                            <thead>
                            <tr>
                                <th> #ID </th>
                                <th> Category Name </th>
                                <th> Category Description </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($category as $cat)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $cat->name }}</td>
                                <td>{!!  $cat->description  !!}</td>
                                <td width="150px">
                                    <a href="{{ route('category.edit',$cat->id) }}" class="btn btn-primary"> Edit</a>

                                    {!! Form::open(['route'=>['category.destroy',$cat->id],'method'=>'DELETE']) !!}

                                    {!! Form::submit('Delete',['class'=>'btn btn-danger pull-right', 'onclick'=>'return confirm("Are You Sure..!");', 'style'=>'margin-top: -35px']) !!}

                                    {!! Form::close() !!}


                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $category->links() }}
                        </div>
                    </div>

                    {{---------------------------}}

                <!-- Modal -->
                    <div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                </div>
                                <form method="post" action="{{ route('category.store') }}" id="frmCategory">
                                    <div class="modal-body">

                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label">Category name:</label>
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Description :</label>
                                                <textarea class="form-control" id="description"  name="description"></textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="save">Save Category</button>
                                    </div>
                                {!! csrf_field() !!}
                                </form>

                            </div>
                        </div>
                    </div>


                    {{-------------------------}}

                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->


@endsection