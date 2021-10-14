@extends('layouts.app')

@section('content')
  <a href="{{ route('company.index') }}" class="btn btn-primary">Go to Company List</a>
  <h2>Company Create</h2>
  <form method="POST" style="width: 25rem;">
    @csrf
    @include('company.fields')
    <button class="btn btn-primary" type="submit">Submit</button>
  </form>
@endsection