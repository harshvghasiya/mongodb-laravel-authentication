@extends('layouts.app')
@section('section')
<div class="container mt-5">
      {{ Form::open([
          'id' => 'Addedituser',
          'class' => 'FromSubmit form',
          'url' => route('admin.user.postlogin'),
          'name' => 'socialMedia',
          'enctype' => 'multipart/form-data',
      ]) }}
    <div class="form-group">
      <label for="exampleInputEmail1">First Name</label>
      {{ Form::text('first_name',null,['placeholder'=>'First Name','id'=>'first_name','class'=>'form-control'])}}
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Last Name</label>
      {{ Form::text('password',null,['placeholder'=>'password','id'=>'password','class'=>'form-control'])}}

    </div>
    
    <button type="submit" class="btn btn-primary">Login</button>
  {{Form::close()}}
</div>
@endsection