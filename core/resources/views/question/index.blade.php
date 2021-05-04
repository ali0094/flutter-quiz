@extends('layouts.layout')

@section('title', 'All Question')

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
                    <a href="#">Manage Question</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>All Question</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> All Question
            <small> Under Exam Category</small>
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
                            <i class="fa fa-globe"></i> All Question
                        </div>
                        <a href="{{ route('question.create') }}" class="btn btn-default pull-right" style="margin-top: 5px"><i class="fa fa-plus"></i> Add New Question</a>
                    </div>
                    <div class="portlet-body">

                        <table class="table table-striped table-bordered table-hover table-responsive" id="sample_2">
                            <thead>
                            <tr>
                                <th> #ID </th>
                                <th> Question </th>
                                <th> Exam Category </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($question as $qtion)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $qtion->question}}</td>
                                    <td>
                                        @foreach($catall as $cat)
                                            @if($cat->id == $qtion->question_cat_name)
                                                {{ $cat->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td width="215px">
                                        <a href="{{ route('question_show',$qtion->id) }}" class="btn btn-success"> View</a>

                                        <a href="{{ route('question_edit',$qtion->id) }}" class="btn btn-primary"> Edit</a>

                                        {!! Form::open(['route'=>['question_delete',$qtion->id],'method'=>'DELETE']) !!}

                                        {!! Form::submit('Delete',['class'=>'btn btn-danger pull-right', 'onclick'=>'return confirm("Are You Sure..!");', 'style'=>'margin-top: -35px']) !!}

                                        {!! Form::close() !!}


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $question->links() }}
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