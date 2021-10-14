@extends('layouts.app')

@section('content')
  <a href="{{ route('user.index') }}" class="btn btn-primary">Go to User List</a>
  <h2>User Edit</h2>
  <form method="POST" style="width: 25rem;">
    @csrf
    @include('user.fields')
    <button class="btn btn-success" type="submit">Update</button>
  </form>
@endsection