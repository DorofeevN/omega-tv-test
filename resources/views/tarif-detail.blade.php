@extends('layouts.app')

@section('content')
<div id="content">

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tarif Details. Name: <b>{{ $tarif->name }}</b>. ID: <b>{{ $tarif->id }}</b>. Belongs to company: <b>
      <a href="{{ route('company.details',['id' => $tarif->company->id]) }}">{{ $tarif->company->name }}</a>
      </b></h1>
    <p class="mb-4">Tarif Details.</p>

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
                <th>Customer Name</th>
                <th>Number of Customers</th>
                <th>Details</th>
                <th>Delete Customer</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Number of Customers</th>
                <th>Details</th>
                <th>Delete Customer</th>
              </tr>
            </tfoot>
            <tbody>
              @php $tarif_details = $tarif->customers; @endphp
              @if($tarif_details)
              @foreach($tarif_details as $no => $customer)
                <tr>
                  <td align="center">{{ $customer->id }}</td>
                  <td align="center">{{ $customer->name }}</td>
                  <td align="center">{{ count($customer->tarifs) }} ({{ count($customer->active_tarifs) }})</td>
                  <td align="center"><a href="{{ route('customer.details',['id' => $customer->id]) }}"><i class="fa fa-search" aria-hidden="true"></i></a></td>
                  <td align="center"><a href="{{ route('customer.details',['id' => $customer->id]) }}"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td>
                </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
@endsection
