@extends('layouts.layout')

@section('title', 'Manage Sub Category')

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
                    <a href="#">Manage Sub Category</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>All Sub Category</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> All Sub Category
            <small> have also a base Category</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success ..! </strong> {{ Session::get('success') }}
                    </div>
                @elseif(count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <h4 class="tect-center"><strong>Error ..! </strong> You have Something Error.</h4>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li><p style="color: red">{!! $error !!}</p></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-pencil-square"></i> Sub Category Edit</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($subcategory,['route'=>['subcategory.update',$subcategory->id],'method'=>'PUT', 'class'=>'', 'style'=>'margin-top: 5px','files'=>true]) !!}

                        <div class="form-group">
                            <label for="exampleInputName2">Sub Category: </label>
                            <input type="text" class="form-control" id="exampleInputName2" name="name" value="{{ $subcategory->name }}" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName2">Category: </label>
                            <select name="base_cat" id="" class="form-control">
                                @foreach($catall as $c)
                                    @if($subcategory->base_cat == $c->id)
                                        <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                    @else
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="exampleInputName2">Freatured Image : </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="img-view">
                                        <img src="{{ asset('extra-images') }}/{{ $subcategory->image }}" alt="" style="width: 250px; height: 250px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName2">Change Featured Image: </label>
                            <input type="file" name="image" id="" class="form-control">
                            <p><b>Note : </b>Image Dimensions Must be Max : 370 x 280</p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Currency :</label>
                                    <select name="currency" id="" class="form-control" required>

                                        @foreach($currency as $curr)
                                            @if($subcategory->currency   == $curr->id)
                                                <option value="{{ $curr->id }}" id="{{ $curr->id }}" class="form-control" selected>{{ $curr->name }}</option>
                                            @else
                                                <option value="{{ $curr->id }}" id="{{ $curr->id }}" class="form-control">{{ $curr->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Price :</label>
                                    <input type="number" class="form-control" id="price" name="price" required value="{{ $subcategory->price }}" placeholder="0">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName2">Time / Min: </label>
                            <input type="number" class="form-control" id="exampleInputName2" name="time" value="{{ $subcategory->time / 60 }}" placeholder="" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName2">Description: </label>
                            <input type="text" class="form-control" id="exampleInputName2" name="description" value="{{ $subcategory->description }}" placeholder="" required>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route('subcategory.index') }}" class="btn btn-success btn-block"><i class="fa fa-eye" aria-hidden="true"></i> See All Category</a>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Category</button>
                            </div>

                        </div>


                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- END CONTENT BODY -->

    <script type="text/javascript">

    </script>

@endsection