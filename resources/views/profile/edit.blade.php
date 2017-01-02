@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Profile {{Auth::user()->name}}</h3>

                </div><!-- /.box-header -->
                <div class="box-body">

                        {!! Form::model($profile, [
                            'method' => 'PATCH',
                            'url' => ['/profile', $profile->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('profile.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                </div><!-- /.box-body -->
              </div>
               {{--  <div class="panel panel-default">
                    <div class="panel-heading">Edit Profile {{ $profile->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($profile, [
                            'method' => 'PATCH',
                            'url' => ['/profile', $profile->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('profile.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection