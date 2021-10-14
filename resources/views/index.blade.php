@extends('layouts.app')

@section('content')
  <h2>Welcome</h2>
  <a href="{{ route('user.index') }}" class="btn btn-primary">Go to User List</a>
  <a href="{{ route('company.index') }}" class="btn btn-primary">Go to Company List</a>
@endsection