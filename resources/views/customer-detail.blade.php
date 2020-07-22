@extends('layouts.app')

@section('content')
<div id="content">

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Customer Details. Name: {{ $customer->name }}. ID: {{ $customer->id }}.</h1>
    <p class="mb-4">Customer Details.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tarifs of customer</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Tarif ID</th>
                <th>Tarif Name</th>
                <th>Active</th>
                <th>Details</th>
                <th>Delete Tarif</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Tarif ID</th>
                <th>Tarif Name</th>
                <th>Active</th>
                <th>Details</th>
                <th>Delete Tarif</th>
              </tr>
            </tfoot>
            <tbody>
              @php $customer_details = $customer->tarifs; @endphp
              @if($customer_details)
              @foreach($customer_details as $no => $tarif)
                <tr>
                  <td align="center">{{ $tarif->id }}</td>
                  <td align="center">{{ $tarif->name }}</td>
                  <td align="center">@if($tarif->isactive())Active @else Not Active @endif</td>
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
