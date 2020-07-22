@extends('layouts.app')

@section('content')

<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Reports</h1>
  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div> -->

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Companies</h1>
<p class="mb-4">List of all Companies.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Companies</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Company</th>
            <th>Total Number of Tarifs</th>
            <th>Manage Users</th>
            <th>Details</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Company</th>
            <th>Total Number of Tarifs</th>
            <th>Manage Users</th>
            <th>Details</th>
          </tr>
        </tfoot>
        <tbody>
          @if($companies)
          @foreach($companies as $no => $company)
            <tr>
              <td align="center">{{ $company->id }}</td>
              <td align="center">{{ $company->name }}</td>
              <td align="center">{{ count($company->tarifs) }}</td>
              <td align="center"><a href="{{ route('company.manage-users',['id' => $company->id]) }}"><i class="fa fa-wrench" aria-hidden="true"></i></a></td>
              <td align="center"><a href="{{ route('company.details',['id' => $company->id]) }}"><i class="fa fa-search" aria-hidden="true"></i></a></td>
            </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
{{ $companies->links() }}

@endsection
