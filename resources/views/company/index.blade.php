@extends('layouts.app')

@section('content')
  <a href="{{ route('homepage') }}" class="btn btn-primary">Go to Homepage</a>
  <h2>Company List</h2>
  <a href="{{ route('company.create') }}" class="btn btn-success">Create Company</a>
  <div class="container mt-5">
    <table class="table table-bordered yajra-datatable">
      <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Actions</th>
          </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
@endsection

@push('scripts')
<script type="text/javascript">
  $(function () {    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('company.list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
  });
</script>
@endpush