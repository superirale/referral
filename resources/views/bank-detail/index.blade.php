@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Bankdetail</div>
                    <div class="panel-body">

                        <a href="{{ url('/bank-detail/create') }}" class="btn btn-primary btn-xs" title="Add New BankDetail"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Bank Id </th><th> Account Name </th><th> Account Number </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($bankdetail as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->bank_id }}</td><td>{{ $item->account_name }}</td><td>{{ $item->account_number }}</td>
                                        <td>
                                            <a href="{{ url('/bank-detail/' . $item->id) }}" class="btn btn-success btn-xs" title="View BankDetail"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/bank-detail/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit BankDetail"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/bank-detail', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete BankDetail" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete BankDetail',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $bankdetail->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection