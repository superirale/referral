<div class="form-group {{ $errors->has('bank_id') ? 'has-error' : ''}}">
    {!! Form::label('bank_id', 'Bank', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('bank_id', $banks, ['class' => 'form-control']) !!}
        {!! $errors->first('bank_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('account_name') ? 'has-error' : ''}}">
    {!! Form::label('account_name', 'Account Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('account_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('account_name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('account_number') ? 'has-error' : ''}}">
    {!! Form::label('account_number', 'Account Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('account_number', null, ['class' => 'form-control']) !!}
        {!! $errors->first('account_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('account_type_id') ? 'has-error' : ''}}">
    {!! Form::label('account_type_id', 'Account Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('account_type_id', $account_types, ['class' => 'form-control']) !!}
        {!! $errors->first('account_type_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('bank_swift_code') ? 'has-error' : ''}}">
    {!! Form::label('bank_swift_code', 'Bank Swift Code', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('bank_swift_code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('bank_swift_code', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>