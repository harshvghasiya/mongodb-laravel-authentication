@extends('layouts.app')
@section('section')
<div class="container">
  @if (isset($user))
      {{ Form::model($user, [
          'id' => 'Addedituser',
          'class' => 'FromSubmit form ',
          'url' => route('admin.user.update', $encryptedId),
          'method' => 'PUT',
          'enctype' => 'multipart/form-data',
      ]) }}
      <input type="hidden" name="id" value="{{ $encryptedId }}">
     
  @else
      {{ Form::open([
          'id' => 'Addedituser',
          'class' => 'FromSubmit form',
          'url' => route('admin.user.store'),
          'name' => 'socialMedia',
          'enctype' => 'multipart/form-data',
      ]) }}
  @endif
    <div class="form-group">
      <label for="exampleInputEmail1">First Name</label>
      {{ Form::text('first_name',null,['placeholder'=>'First Name','id'=>'first_name','class'=>'form-control'])}}
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Last Name</label>
      {{ Form::text('password',null,['placeholder'=>'password','id'=>'password','class'=>'form-control'])}}

    </div>
    
    <button type="submit" class="btn btn-primary">Register</button>
  {{Form::close()}}
</div>
@endsection