@extends('backend/layout')
@section('content')
<section class="content-header">
    <h1>Company</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ $companies->page_title }}</li>
    </ol>
</section>
<!-- Main content -->
<section id="main-content" class="content"> 
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $companies->page_title }}</h3>
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

                    @if($companies->page_type == 'create' )
                        {{ Form::open(array('route' => $companies->form_action, 'method' => 'POST', 'files' => true, 'id' => 'company-form')) }}
                    @else
                        {{ Form::model($companies, ['route' => [$companies->form_action, $companies->id], 'method' => 'PATCH', 'files' => true, 'id' => 'company-form']) }}
                    @endif

                    {{ Form::hidden('id', $companies->id, ['id' => 'companies_id']) }}
                    <div id="form-name" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Name</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('name', $companies->name, ['class' => 'form-control validate[required, maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11']) }}
                        </div>
                    </div>

                    <div id="form-email" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Email</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('email', $companies->email, ['placeholder' => '', 'class' => 'form-control validate[required,custom[email], maxSize[100]]]', 'data-prompt-position' => 'bottomLeft:0,11' ]) }}
                        </div>
                    </div>

                    <div id="form-postcode" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Postcode</strong>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-3 col-lg-2 col-content">
                            {{ Form::number('postcode', $companies->postcode, ['placeholder' => '', 'id' => 'postcode','class' => 'form-control validate[required, maxSize[9]]', 'data-prompt-position' => 'bottomLeft:0,11']) }}
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 ">
                            <button type="button" class="btn btn-primary text-center" name="search" id="search">Search</button>
                        </div>
                    </div>

                    <div id="form-prefecture" class="form-group no-border">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Prefecture</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::select('prefecture_id', $companies->prefecture, old('prefecture_id'), ['placeholder' => ' ', 'id' => 'prefecture_id', 'class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11']) }}
                        </div>
                    </div>

                    <div id="form-city" class="form-group no-border">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">City</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('city', $companies->city, array('placeholder' => ' ', 'id' => 'city','class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>
                    <div id="form-local" class="form-group no-border">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Local</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('local', $companies->local, array('placeholder' => ' ', 'id' => 'local','class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>
                    <div id="form-address" class="form-group no-border">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Street Address</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('street_address', $companies->street_address, array('placeholder' => ' ', 'class' => 'form-control ', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>
                    <div id="form-business_hour" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Business Hour</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('business_hour', $companies->business_hour, array('placeholder' => ' ', 'class' => 'form-control ', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>
                    <div id="form-regular_holiday" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Regular Holiday</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('regular_holiday', $companies->regular_holiday, array('placeholder' => ' ', 'class' => 'form-control ', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>
                    <div id="form-phone" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Phone</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('phone', $companies->phone, array('placeholder' => ' ', 'class' => 'form-control validate[maxSize[20]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>
                    <div id="form-fax" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Fax</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('fax', $companies->fax, array('placeholder' => ' ', 'class' => 'form-control validate[maxSize[20]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>
                    <div id="form-url" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">URL</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('url', $companies->url, array('placeholder' => ' ', 'class' => 'form-control validate[custom[url], maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>
                    <div id="form-license_number" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">License Number</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('license_number', $companies->license_number, array('placeholder' => ' ', 'class' => 'form-control validate[maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>
                    <div id="form-images" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Image</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {!! Form::file('image', ['class' => 'validate[required]', 'data-prompt-position' => 'bottomRight:0,11', 'id' => 'image']) !!}
                        </div>
                    </div>
                    <div id="form-images_preview" class="no-border">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title"> </strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            <div class="company-image no-border">
                                <img id="company-image" style="text-align: center" src= '{{ url('/img/no-image/no-image.jpg') }}' />
                            </div>
                        </div>
                    </div>

                    <div id="form-button" class="form-group no-border">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="send" class="btn btn-primary">Submit</button>
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

@section('title', 'Add New Company | ' . env('APP_NAME',''))

@section('body-class', 'custom-select')

@section('css-scripts')

<style type="text/css">

    .company-image {
    padding: 5px;
    /* border: 1px #ddd solid; */
    /* height auto; */
    width: 200px;
    }

    .company-image img {
    max-width: 200px;
    }
</style>

@endsection

@section('js-scripts')
<script src="{{ asset('bower_components/bootstrap/js/tooltip.js') }}"></script>
<!-- validationEngine -->
<script src="{{ asset('js/3rdparty/validation-engine/jquery.validationEngine-en.js') }}"></script>
<script src="{{ asset('js/3rdparty/validation-engine/jquery.validationEngine.js') }}"></script>
<script src="{{ asset('js/3rdparty/sweet-alert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/backend/companies/form.js') }}"></script>
@endsection
