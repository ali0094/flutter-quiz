@extends('layouts.layout')

@section('title', 'Manage Sub Category')

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
        <div class="col-md-12">
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
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>Sub Category </div>
                    <button class="btn btn-default pull-right" style="margin-top: 5px" id="add" value="add"><i class="fa fa-plus"></i> Add Sub Category</button>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-responsive" id="sample_2">
                        <thead>
                        <tr>
                            <th> #ID </th>
                            <th> Sub Category Name </th>
                            <th> Base Category </th>
                            <th> Price </th>
                            <th> Time / Min</th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($subcat as $scat)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $scat->name }}</td>
                            <td>
                                @foreach($cats as $c)
                                    @if($c->id == $scat->base_cat)
                                        {{ $c->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if($scat->price == 0)
                                    <span class="label label-success">{{ "Free" }}</span>
                                @else
                                    <span class="label label-primary">
                                        @foreach($curr as $cr)
                                            @if($scat->currency  == $cr->id )
                                            {{ $cr->name }} {{ $scat->price }}
                                            @endif
                                        @endforeach
                                    </span>
                                @endif
                            </td>
                            <td>{{ $scat->time / 60 }}</td>
                            <td width="400px">
                                <a href="{{ route('subcategory.edit',$scat->id) }}" class="btn btn-primary"> Edit</a>

                                <a href="{{ route('question_subcategory',$scat->id) }}" class="btn btn-success"> Add Question</a>

                                <a href="{{ route('question_view',$scat->id) }}" class="btn btn-info" style="margin-right: 78px"> View Question</a>

                                {!! Form::open(['route'=>['subcategory.destroy',$scat->id],'method'=>'DELETE']) !!}

                                <button type="submit" class="btn btn-danger pull-right" onclick="return confirm('Are You Sure..!');" style="margin-top: -35px; margin-left:5px;">Delete</button>

                                {!! Form::close() !!}

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $subcat->links() }}
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
                            <form method="post" action="{{ route('subcategory.store') }}" id="frmCategory" enctype="multipart/form-data">
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Sub Category name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Base Category:</label>
                                        <select name="base_cat" id="" class="form-control" required>
                                            <option value="">Select One</option>
                                            @foreach($cats as $c)
                                                <option value="{{ $c->id }}" id="{{ $c->id }}" class="form-control">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Featured Image :</label>
                                        <input type="file" name="image" id="" class="form-control" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label">Currency :</label>
                                                <select name="currency" id="" class="form-control" required>
                                                    <option value="">Select One</option>
                                                    @foreach($currency as $curr)
                                                        <option value="{{ $curr->id }}" id="{{ $curr->id }}" class="form-control">{{ $curr->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label">Price :</label>
                                                <input type="number" class="form-control" id="price" name="price" required placeholder="0">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Time :</label>
                                        <input type="number" class="form-control" id="price" name="time" required placeholder="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Description :</label>
                                        <input type="text" class="form-control" id="description" name="description" required placeholder="Description">
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

<script type="text/javascript">

</script>

@endsection