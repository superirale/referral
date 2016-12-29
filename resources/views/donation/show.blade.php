@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Donation {{ $donation->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('donation/' . $donation->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Donation"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['donation', $donation->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Donation',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $donation->id }}</td>
                                    </tr>
                                    <tr><th> Donated To </th><td> {{ $donation->donated_to }} </td></tr><tr><th> Amount </th><td> {{ $donation->amount }} </td></tr><tr><th> Payee User Id </th><td> {{ $donation->payee_user_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection