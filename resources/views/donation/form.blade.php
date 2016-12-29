<div class="form-group {{ $errors->has('donated_to') ? 'has-error' : ''}}">
    {!! Form::label('donated_to', 'Donated To', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('donated_to', ['Bank Account'], null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('donated_to', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    {!! Form::label('amount', 'Amount', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('amount', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<input type="hidden" name="payee_user_id" value="">
<div class="form-group {{ $errors->has('payment_details') ? 'has-error' : ''}}">
    {!! Form::label('payment_details', 'Payment Details', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('payment_details', null, ['class' => 'form-control']) !!}
        {!! $errors->first('payment_details', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('payment_receipt') ? 'has-error' : ''}}">
    {!! Form::label('payment_receipt', 'Payment Receipt', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('payment_receipt', null, ['class' => 'form-control']) !!}
        {!! $errors->first('payment_receipt', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>