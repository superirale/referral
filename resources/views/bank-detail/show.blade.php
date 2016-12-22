@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">BankDetail {{ $bankdetail->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('bank-detail/' . $bankdetail->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit BankDetail"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['bankdetail', $bankdetail->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete BankDetail',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $bankdetail->id }}</td>
                                    </tr>
                                    <tr><th> Bank Id </th><td> {{ $bankdetail->bank_id }} </td></tr><tr><th> Account Name </th><td> {{ $bankdetail->account_name }} </td></tr><tr><th> Account Number </th><td> {{ $bankdetail->account_number }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection