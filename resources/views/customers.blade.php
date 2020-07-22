@extends('layouts.app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Customers</h1>
<p class="mb-4">List of all Customers.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Customers</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Total Number of Tarifs</th>
            <th>Active Tarifs</th>
            <th>Details</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th align="center">ID</th>
            <th align="center">Name</th>
            <th align="center">Total Number of Tarifs</th>
            <th align="center">Active Tarifs</th>
            <th align="center">Details</th>
          </tr>
        </tfoot>
        <tbody>
        @if($customers)
        @foreach($customers as $no => $customer)
          <tr>
            <td align="center">{{ $customer->id }}</td>
            <td align="center">{{ $customer->name }}</td>
            <td align="center">{{ count($customer->tarifs) }}</td>
            <td align="center">{{ count($customer->active_tarifs) }}</td>
            <td align="center"><a href="{{ route('customer.details',['id' => $customer->id]) }}"><i class="fa fa-search" aria-hidden="true"></i></a></td>
          </tr>
        @endforeach
        @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
{{ $customers->links() }}

@endsection
