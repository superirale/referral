@extends('layouts.dashboard')

@section('content')
    <div class="container">

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="row">
            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-body box-profile">
                      <img class="profile-user-img img-responsive img-circle" src="admin/img/avatar.png" alt="User profile picture">
                      <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                      <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                          <b>Bank Name</b> <a class="pull-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                          <b>Bank Account Name </b> <a class="pull-right">15403</a>
                        </li>
                        <li class="list-group-item">
                          <b>Amount</b> <a class="pull-right">13,287</a>
                        </li>
                      </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Upgrade</h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                    {!! Form::open(['url' => '/donation', 'class' => 'form-horizontal', 'files' => true]) !!}
                        {{csrf_field()}}
                        @include ('donation.form')

                        {!! Form::close() !!}
                </div><!-- /.box-body -->
              </div>


                {{-- <div class="panel panel-default">
                    <div class="panel-heading">Upgrade Donation</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/donation', 'class' => 'form-horizontal', 'files' => true]) !!}
                        {{csrf_field()}}
                        @include ('donation.form')

                        {!! Form::close() !!}

                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection