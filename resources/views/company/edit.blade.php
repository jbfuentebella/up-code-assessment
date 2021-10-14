@extends('layouts.app')

@section('content')
  <a href="{{ route('company.index') }}" class="btn btn-primary">Go to Company List</a>
  <h2>Company Edit</h2>
  <form method="POST" style="width: 25rem;">
    @csrf
    @include('company.fields')
    <button class="btn btn-primary" type="submit">Update</button>
  </form>
@endsection