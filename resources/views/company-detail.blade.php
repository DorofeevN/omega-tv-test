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
    <h1 class="h3 mb-2 text-gray-800">Company Details. Name: <b>{{ $company->name }}</b>. ID: <b>{{ $company->id }}</b></h1>
    <p class="mb-4">Company Details.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tarifs</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th text-align="center">Tarif ID</th>
                <th>Tarif Name</th>
                <th>Customers (Active)</th>
                <th>Details</th>
                <th>Delete Tarif</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th text-align="center">Tarif ID</th>
                <th>Tarif Name</th>
                <th>Customers (Active)</th>
                <th>Details</th>
                <th>Delete Tarif</th>
              </tr>
            </tfoot>
            <tbody>
              @php $company_details = $company->tarifs; @endphp
              @if($company_details)
              @foreach($company_details as $no => $tarif)
                <tr>
                  <td align="center">{{ $tarif->id }}</td>
                  <td align="center">{{ $tarif->name }}</td>
                  <td align="center">{{ count($tarif->customers) }} ({{ count($tarif->active_customers) }})</td>
                  <td align="center"><a href="{{ route('tarif.details',['id' => $tarif->id]) }}"><i class="fa fa-search" aria-hidden="true"></i></a></td>
                  <td align="center"><a href="{{ route('tarif.details',['id' => $tarif->id]) }}"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td>
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
