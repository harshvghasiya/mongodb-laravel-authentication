@extends('layouts.app')
@section('section')
<div class="container">
	<div class="card">
		<div class="card-body bg-success">
			@if(\Auth::user() != null)
			Welcome! {{\Auth::user()->first_name}}
			<a href="{{route('admin.logout')}}" class="btn btn-info mx-5">Logout</a>
			@endif
		</div>
	</div>
	<table class="table mt-3">
	  <thead>
	    <tr>
	      <th scope="col">First</th>
	      <th scope="col">Last</th>
	      <th scope="col">Handle</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@if(isset($users) && $users != null)
	  	@foreach($users as $key => $user)
	    <tr>
	      <td>{{ $user->first_name }}</td>
	      <td>{{ $user->last_name }}</td>
	      <td><button type="button" class="btn btn-danger delete_record" data-route="{{ route('admin.user.destroy',\Crypt::encryptString($user->_id)) }}">Delete</button> </td>
	    </tr>
	    @endforeach
	    @endif
	  </tbody>
	</table>
</div>
@endsection
