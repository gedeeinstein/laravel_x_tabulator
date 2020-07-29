@extends('backend/layout')
@section('content')
<section class="content-header">
    <h1>User</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {{-- show success message --}}
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    {{-- show error message --}}
                    @if ($message = Session::get('error'))
                    <div class="alert alert-error">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    {{-- used for pager calculation in js --}}
                    {{ Form::hidden('total-data', '', array('id'=>'total-data')) }}
                    <div id="datalist-header" class="pull-right invisible"><span id="datalist-total-data"></span>件中 <span id="datalist-min-data"></span>〜<span id="datalist-max-data"></span>件を表示</div>
                    <div id="datalist"></div>
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

@section('css-scripts')
<!-- Tabulator css -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/tabulator/3.3.3/css/tabulator.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/tabulator/3.3.3/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
@endsection

@section('js-scripts')
<!-- Jquery UI -->
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Tabulator js -->
<script type="text/javascript" src="{{ asset('js/3rdparty/tabulator.min.js') }}"></script>
<script src="{{ asset('js/backend/users/index.js') }}"></script>
@endsection
