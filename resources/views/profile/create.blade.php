@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="col-md-8 col-md-offset-2">

                <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Create New Profile</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    {!! Form::open(['url' => '/profile', 'class' => 'form-horizontal', 'files' => true]) !!}

                    @include ('profile.form')

                    {!! Form::close() !!}

                </div><!-- /.box-body -->
              </div>
{{--
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Profile</div>
                    <div class="panel-body">



                        {!! Form::open(['url' => '/profile', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('profile.form')

                        {!! Form::close() !!}

                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection