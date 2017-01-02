@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="alert alert-danger">
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="admin/img/avatar.png" alt="User profile picture">
                  <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Level</b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                      <b>Total amount earned</b> <a class="pull-right">15403</a>
                    </li>
                    <li class="list-group-item">
                      <b>Total donation</b> <a class="pull-right">13,287</a>
                    </li>
                  </ul>
                  <a href="#" class="btn btn-success btn-block"><b>Upgrade</b></a>
                  <a href="#" class="btn btn-danger btn-block"><b>Account Setting</b></a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-body box-profile">

                  <h3 class="profile-username text-center">Your Level 1 Upline</h3>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Name</b> <a class="pull-right">Usman Irale</a>
                    </li>
                    <li class="list-group-item">
                      <b>Amount to pay</b> <a class="pull-right">543</a>
                    </li>

                  </ul>
                </div>
            </div>
            <div class="small-box bg-red">
                <div class="inner">
                  <h3>4</h3>
                  <p>My Downline</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Downline Chart <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
        </div>
    </div>
</div>
@endsection
