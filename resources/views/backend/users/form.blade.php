@extends('backend/layout')
@section('content')
<section class="content-header">
    <h1>User</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ $user->page_title }}</li>
    </ol>
</section>
<!-- Main content -->
<section id="main-content" class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $user->page_title }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {{ Form::open(array('route' => $user->form_action, 'method' => 'POST', 'files' => true, 'id' => 'user-form')) }}
                    {{ Form::hidden('id', $user->id, array('id' => 'user_id')) }}
                    <div id="form-username" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Username</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            @if($user->page_type == 'create')
                            {{ Form::text('username', $user->username, array('class' => 'form-control validate[required, regex[/^[\w-]*$/], alpha_num, maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                            @else
                            {{ Form::text('username', $user->username, array('readonly' => 'readonly', 'class' => 'form-control validate[required, regex[/^[\w-]*$/], alpha_num, maxSize[255]]')) }}
                            @endif
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group {{ $user->page_type == 'edit'?'hide':'' }}">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Name</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('display_name', $user->display_name, array('placeholder' => '', 'class' => 'form-control validate[required, maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    @if($user->page_type == 'create')
                    <div id="form-password" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Password</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::password('password', array('placeholder' => ' ', 'class' => 'form-control validate[required, minSize[6], maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>
                    @else
                    <div id="form-password-confirm" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <i class="fa fa-question-circle tooltip-img" data-toggle="tooltip" data-placement="right" title="Please input only when changing the password."></i>
                            <strong class="field-title">Password</strong>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1 col-content">
                            <button type="button" name="reset" id="reset-button" class="btn btn-primary">Change</button>
                        </div>
                        <div id="reset-field" class="col-xs-10 col-sm-10 col-md-8 col-lg-9 col-content hide">
                            {{ Form::password('password', array('id' => 'password', 'placeholder' => 'Please input only when changing password', 'class' => 'form-control validate[minSize[6], maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11', 'style' => 'margin-top:5px')) }}
                            <label for="show-password"><input id="show-password" type="checkbox" name="show-password" value="1"> Show Password</label>
                        </div>
                    </div>
                    @endif

                    <div id="form-button" class="form-group no-border">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 20px;">
                            <button type="submit" name="submit" id="send" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection

@section('title', 'User | ' . env('APP_NAME',''))

@section('body-class', 'custom-select')

@section('css-scripts')
@endsection

@section('js-scripts')
<script src="{{ asset('bower_components/bootstrap/js/tooltip.js') }}"></script>
<!-- validationEngine -->
<script src="{{ asset('js/3rdparty/validation-engine/jquery.validationEngine-en.js') }}"></script>
<script src="{{ asset('js/3rdparty/validation-engine/jquery.validationEngine.js') }}"></script>
<script src="{{ asset('js/backend/users/form.js') }}"></script>
@endsection
