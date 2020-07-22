@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Create Tarif</h1>
<p class="mb-4">Create Tarif.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Create Tarif</h6>
  </div>
  <div class="card-body">
    <form id="new_tarif" action="{{ route('tarif.store') }}" method="post">
      @csrf
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <button type="button" class="btn btn-primary" onclick="addCustomer()">Add Customer</button>
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-danger" onclick="window.location = '/'">Discard & Leave</button>
      </div>
    <div class="form-group" id="form-group">
      <div class="form-group" id="tarif_name">
          <label for="formGroupExampleInput">Tarif Name</label>
          <!-- <button type="button" class="btn btn-primary" onclick="addCustomer(`+tarif_no+`)">Add Customer</button> -->
          <input type="text" name="tarif_name" class="form-control" placeholder="Input Tarif Name" required>
      </div>
      <div id="tarif_company">
        <label class="mr-sm-2" for="inlineFormCustomSelect">Choose Company</label>
        <select class="custom-select mr-sm-2"  name="tarif_company" required>
          <option value="0" selected>Choose...</option>
          @foreach($companies as $no => $company)
          <option value="{{ $company->id }}">{{ $company->name }}</option>
          @endforeach
        </select>
      </div>

    </div>
    <!-- <div class="form-group">
      <label for="formGroupExampleInput">Tarif Name</label>
      <button type="button" class="btn btn-primary" onclick="addCustomer()">Add Tarif</button>
      <input type="text" name="name" class="form-control" id="name" placeholder="Input Tarif Name" required>
    </div> -->
  </form>
  </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>


var customer_no = 1;
function addCustomer(){
  let customer = `<div>
    <label class="mr-sm-2" for="inlineFormCustomSelect">Choose Customer</label>
    <select class="custom-select mr-sm-2" id="select_customer_`+customer_no+`" name="customer[]">
      <option value="0" selected>Choose...</option>
      @foreach($customers as $no => $customer)
      <option value="{{ $customer->id }}">{{ $customer->name }}</option>
      @endforeach
    </select>
  </div>`;
  $('#form-group div:last').after(customer);
  customer_no++;
}


$("#new_tarif").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');
    //alert(form.serialize());
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(response)
           {
             alert('Done');
             window.location = "{{ route('tarifs') }}";
           },
           error: function(response){
             //console.log(response);
             alert('Current Tarif exists in Company');
           }
         });


});

// $(window).on('beforeunload', function(){
// var c=confirm();
// if(c){
// return true;
// }
// else
// return false;
// });

</script>
@endsection
