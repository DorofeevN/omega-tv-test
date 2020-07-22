@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Create Customer</h1>
<p class="mb-4">Create Customer.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Create Customer</h6>
  </div>
  <div class="card-body">
    <form id="new_customer" action="{{ route('customer.store') }}" method="post">
      @csrf
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <button type="button" class="btn btn-primary" onclick="addCompany()">Add Tarif</button>
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-danger" onclick='window.location = "{{ route('customers') }}"'>Discard & Leave</button>
      </div>
    <div class="form-group" id="form-group">
      <div class="form-group" id="customer_name">
          <label for="formGroupExampleInput">Customer Name</label>
          <!-- <button type="button" class="btn btn-primary" onclick="addCustomer(`+tarif_no+`)">Add Customer</button> -->
          <input type="text" name="customer_name" class="form-control" placeholder="Input Tarif Name" required>
      </div>
      <div id="company_1">
        <label class="mr-sm-2" for="inlineFormCustomSelect">Choose Company</label>
        <select class="custom-select mr-sm-2 company" id="select_company_1" required>
          <option value="" >Choose...</option>
          @foreach($companies as $no => $company)
          <option value="{{ $company->id }}">{{ $company->name }}</option>
          @endforeach
        </select>
      </div>

    </div>

  </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script>

var company_no = 2;
function addCompany(){
  let company = `<div id="company_`+company_no+`">
    <label class="mr-sm-2" for="inlineFormCustomSelect">Choose Company</label>
    <select class="custom-select mr-sm-2 company" id="select_company_`+company_no+`" required>
      <option value="">Choose...</option>
      @foreach($companies as $no => $company)
      <option value="{{ $company->id }}">{{ $company->name }}</option>
      @endforeach
    </select>
  </div>`;
  $('#form-group').after(company);
  company_no++;
};

// $('body').on('click', 'a.myclass', function() {
//     // do something
// });

$("body").on('change', 'select.custom-select.mr-sm-2.company' ,function() {

    let select_id = this.id;
    let value = this.value;
    let company_id = $(this).closest("div").prop("id");
    $( ".tarfs_"+company_id).remove();

    $.ajax({
           type: "GET",
           url: "{{ route('tarif-through-company.filtering') }}",
           data: {'company_id': value}, // serializes the form's elements.
           success: function(response)
           {
             let tarif = `<div class="tarfs_`+company_id+`"><label class="mr-sm-2" for="inlineFormCustomSelect">Choose Tarif</label>
             <select class="custom-select mr-sm-2" name="tarif_id[]" required>
             <option value="">Choose...</option>
             `;

             response.forEach(result => {
                tarif = tarif + `<option value="`+result.id+`">`+result.name+`</option>\n`;
              });
              tarif = tarif + `</select></div>`
              $('#'+company_id).append(tarif);

           },
           error: function(response){
             console.log('Ошибка');
             console.log(response);
           }
         });

});

$("#new_customer").submit(function(e) {

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
             alert('Done!');
             window.location = "{{ route('customers') }}";
           },
           error: function(response){
             alert('Customer exists!');
           }
         });


});

</script>
@endsection
