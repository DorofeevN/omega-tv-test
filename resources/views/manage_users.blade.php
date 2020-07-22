@extends('layouts.app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Customers</h1>
<p class="mb-4">Company Details. Name: <b>{{ $company->name }}</b>. ID: <b>{{ $company->id }}</b></p>

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
            <th>Customer ID</th>
            <th>Tarif ID</th>
            <th>Name</th>
            <th>Active Tarifs</th>
            <th>Details</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Customer ID</th>
            <th>Tarif ID</th>
            <th align="center">Name</th>
            <th align="center">Active Tarifs</th>
            <th align="center">Details</th>
          </tr>
        </tfoot>
        <tbody>
        @if($customers)
        @foreach($customers as $no => $customer)
          <tr>
            <td align="center">{{ $no }}</td>
            <td align="center">{{ $customer->id }}</td>
            <td align="center">{{ $customer->name }}</td>
            <td align="center">
              <div class="deactivate">
                @if($customer->active)
              <a href="{{ route('customer.deactivate',['id' => $customer->id, 'tarif_id' => $customer->tarif_id]) }}">
                Disable<i class="fas fa-ban"></i></a>
              </div>
              @else
              <div class="deactivate">
              <a href="{{ route('customer.activate',['id' => $customer->id, 'tarif_id' => $customer->tarif_id]) }}">
                Enable<i class="fa fa-check" aria-hidden="true"></i>
              </a>
              </div>
              @endif
            </td>
            <td align="center"><a href="{{ route('customer.details',['id' => $customer->id]) }}"><i class="fa fa-search" aria-hidden="true"></i></a></td>
          </tr>
        @endforeach
        @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
