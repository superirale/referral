@extends('layouts.dashboard')

@section('content')
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Recieved Donations</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody><tr>
                      <th>Upgrade To</th>
                      <th>Status</th>
                      <th>Sender</th>
                      <th>Amount</th>
                      <th>Payment Info</th>
                    </tr>
                    @if(isset($received_donations))
                      @foreach($received_donations as $donation)

                        <tr>
                          <td>{{$donation->level->name}}</td>
                          <td>
                            <a href="/donation/approve/{{$donation->id}}" class="label label-success" onclick="confirm('are you sure you want to confirm this donation?');">approve</a>
                            <a href="/donation/reject/{{$donation->id}}" class="label label-danger">reject</a>
                          </td>
                          <td>
                            <p>{{$donation->sender->name}}</p>
                            <p>{{$donation->sender->profile->phone}}</p>
                            <p>{{$donation->sender->email}}</p>
                          </td>
                          <td> <b>NGN</b> {{number_format($donation->amount)}}</td>
                          <td>
                              <p><b>Bank</b>: {{$current_user->bankAccount->bank->name}} ({{$current_user->bankAccount->account_number}} - {{$current_user->bankAccount->account_name}})</p>
                              <p><b>Submitted</b>: {{date('Y-m-d H:i:s', strtotime($donation->created_at))}}</p>
                              <p><b>Details</b>: {{$donation->payment_details}}</p>
                              <a href="">View Slip</a>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div>
        </div>
@endsection