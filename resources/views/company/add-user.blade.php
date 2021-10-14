@extends('layouts.app')

@section('content')
  <a href="{{ route('company.index') }}" class="btn btn-primary">Go to Company List</a>
  <h2>Add User to '{{ $company->name }}'
  </h2>
  <form method="POST" style="width: 25rem;">
    @csrf
    @foreach($users as $user)
      <div class="form-check form-control-lg">
          <input class="form-check-input rounded-circle" type="checkbox" name="users[]"
              @if($company->checkLinkByUserId($user->id)) checked @endif
              id="chkbx-{{ $user->id }}"
              value="{{ $user->id }}">
          <label class="form-check-label" for="{{ $user->id }}">
              {{ $user->name }}
          </label>
      </div>
    @endforeach
    <button class="btn btn-success" type="submit">Save</button>
  </form>
@endsection