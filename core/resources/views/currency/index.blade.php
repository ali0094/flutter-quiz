@extends('layouts.layout')

@section('title', 'All Currency')

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
                    <a href="#">Manage Currency</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>All Currency</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> 
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
                @if(Session::has('success'))
                    <div class="alert alert-info">
                        <strong>Success : </strong>{{ Session::get('success') }}
                    </div>
            @endif
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-desktop"></i> All Currency
                        </div>
                        <a href="{{ route('currency.create') }}" class="btn btn-default pull-right" style="margin-top: 5px"><i class="fa fa-plus"></i> Add New Currency</a>
                    </div>
                    <div class="portlet-body">

                        <table class="table table-striped table-bordered table-hover table-responsive" id="sample_2">
                            <thead>
                            <tr>
                                <th> SL# </th>
                                <th> Currency </th>
                                <th> Rate </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($currency as $curr)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $curr->name}}</td>
                                    <td>{{ $curr->rate}} {{ $curr->name}} = 1 USD</td>
                                    <td width="150px">
                                        <a href="{{ route('currency.edit',$curr->id) }}" class="btn btn-primary"> Edit</a>

                                        {!! Form::open(['route'=>['currency.destroy',$curr->id],'method'=>'DELETE']) !!}

                                        {!! Form::submit('Delete',['class'=>'btn btn-danger pull-right', 'onclick'=>'return confirm("Are You Sure..!");', 'style'=>'margin-top: -35px']) !!}

                                        {!! Form::close() !!}


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $currency->links() }}
                        </div>
                    </div>

                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->

    <script type="text/javascript">

    </script>

@endsection