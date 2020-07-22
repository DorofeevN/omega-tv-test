@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Create Company</h1>
<p class="mb-4">Create Company.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Create Company</h6>
  </div>
  <div class="card-body">
  <form id="new_company" action="{{ route('company.store') }}">
    @csrf
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <button type="button" class="btn btn-primary" onclick="addTarif()">Add Tarif</button>
      <button type="submit" class="btn btn-success">Save</button>
      <button type="button" class="btn btn-danger" onclick="window.location = '/'">Discard & Leave</button>
    </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Company Name</label>
    <input type="text" name="name" class="form-control" id="company_name" placeholder="Input Name" required>
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

var tarif_no = 1;
function addTarif(){
  let tarif = `<div class="form-group" id="tarif_`+tarif_no+`">
      <label for="formGroupExampleInput">Tarif Name</label>
      <button type="button" class="btn btn-primary" onclick="addCustomer(`+tarif_no+`)">Add Customer</button>
      <input type="text" name="tarif_`+tarif_no+`[name]" class="form-control" placeholder="Input Tarif Name" required></div>`;
  $('#new_company div:last').after(tarif);
  tarif_no++;
}

var customer_no = 1;
function addCustomer(tarif){
  let customer = `<div>
    <label class="mr-sm-2" for="inlineFormCustomSelect">Choose Customer</label>
    <select class="custom-select mr-sm-2" id="select_`+customer_no+`" name="tarif_`+tarif+`[customers][]">
      <option value="0" selected>Choose...</option>
      @foreach($customers as $no => $customer)
      <option value="{{ $customer->id }}">{{ $customer->name }}</option>
      @endforeach
    </select>
  </div>`;
  $('#tarif_'+tarif+' input:last').after(customer);
  customer_no++;
}


$("#new_company").submit(function(e) {

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
             console.log(response);
               alert(response); // show response from the php script.
                window.location = "{{ route('companies') }}";
           },
           error: function(response){
             console.log(response);
             //alert(response); // show response from the php script.
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
