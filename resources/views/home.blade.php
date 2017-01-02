@extends('layouts.dashboard')

@section('content')
<div class="container">
     @if(Auth::user()->status == "unverified")
        <div class="alert alert-danger">
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
           <b> Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</b>
            <br>
            <h1 id="count-down"></h1>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="admin/img/avatar.png" alt="User profile picture">
                  <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Level</b> <b class="pull-right">{{Auth::user()->userLevel->level->name}}</b>
                    </li>
                    <li class="list-group-item">
                      <b>Total amount earned</b> <a class="pull-right">&#8358;{{number_format($total_received)}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Total donation</b> <a class="pull-right">&#8358;{{number_format($total_donated)}}</a>
                    </li>
                  </ul>
                  <a href="upgrade" class="btn btn-success btn-block"><b>Upgrade</b></a>
                  <a href="profile/{{Auth::user()->id}}/edit" class="btn btn-danger btn-block"><b>Account Setting</b></a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-body box-profile">

                  <h3 class="profile-username text-center">Your Level {{$next_level}} Upline</h3>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Name</b> <b class="pull-right">{{$upline->name}}</b>
                    </li>
                    <li class="list-group-item">
                      <b>Amount to pay</b> <b class="pull-right">&#8358;{{number_format($next_level_amt)}}</b>
                    </li>

                  </ul>
                </div>
            </div>
            <div class="small-box bg-red">
                <div class="inner">
                  <h3>@if(isset(Auth::user()->downlines)){{Auth::user()->downlines->count()}}@endif</h3>
                  <p>My Downline</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Downline Chart <i class="fa fa-pie-chart"></i>
                </a>
              </div>
        </div>
    </div>
</div>
@endsection
