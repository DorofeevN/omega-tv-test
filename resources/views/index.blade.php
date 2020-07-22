@extends('layouts.app')

<!-- @section('title', 'Добро пожаловать') -->

@section('content')
      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div> -->

          <!-- Content Row -->
          <div class="row">

            <div class="col-lg-12 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Схема</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/Scheme.png" alt="">
                  </div>
                </div>
              </div>

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">SQL запросы</h6>
                </div>
                <div class="card-body">
                  <form id="form">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input outputvars" type="radio" name="output_method" id="XML_method" value="XML" checked>
                    <label class="form-check-label" for="inlineRadio1">XML</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input outputvars" type="radio" name="output_method" id="CSV_method" value="CSV">
                    <label class="form-check-label" for="inlineRadio2">CSV</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input outputvars" type="radio" name="output_method" id="JSON_method" value="JSON">
                    <label class="form-check-label" for="inlineRadio3">JSON</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input outputvars" type="radio" name="output_method" id="Excel_method" value="Excel">
                    <label class="form-check-label" for="inlineRadio3">Excel</label>
                  </div>
                </form>

                  <div class="text-center">
                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                      <!-- Card Header - Accordion -->
                      <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample1">
                        <h6 class="m-0 font-weight-bold text-primary">Количество всех клиентов, подписанных хоть на один тариф (по компаниям)</h6>
                      </a>
                      <!-- Card Content - Collapse -->
                      <div class="collapse" id="collapseCardExample1">
                        <div class="card-body">
                          SELECT
                            c.id, c.name, COUNT(*)
FROM
    companies c
join tarifs t
on c.id = t.company_id
join customers_tarifs ct
on ct.id = t.id
GROUP BY c.name
HAVING COUNT(*)
                        </div>
                        <button class="btn btn-success btn-circle btn-lg sql-execute" id="sql1" onclick="executeQuery(this.id)"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                      <!-- Card Header - Accordion -->
                      <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample2">
                        <h6 class="m-0 font-weight-bold text-primary">Количество неактивных клиентов, подписанных на тарифы (по компаниям)</h6>
                      </a>
                      <!-- Card Content - Collapse -->
                      <div class="collapse" id="collapseCardExample2">
                        <div class="card-body">
                          SELECT
    c.id, c.name, COUNT(*)
FROM
    companies c
join tarifs t
on c.id = t.company_id
join customers_tarifs ct
on ct.id = t.id
WHERE active = 0
GROUP BY c.name
HAVING COUNT(*)
                        </div>
                        <button class="btn btn-success btn-circle btn-lg sql-execute" id="sql2" onclick="executeQuery(this.id)"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                      <!-- Card Header - Accordion -->
                      <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample3">
                        <h6 class="m-0 font-weight-bold text-primary">Список тарифов и количество активных клиентов подписанных на эти тарифы (по компаниям)</h6>
                      </a>
                      <!-- Card Content - Collapse -->
                      <div class="collapse" id="collapseCardExample3">
                        <div class="card-body">
                          SELECT t.id, t.name, COUNT(*) FROM tarifs t
join customers_tarifs ct
on t.id = ct.tarif_id
GROUP BY t.id
HAVING COUNT(*)
                        </div>
                        <button class="btn btn-success btn-circle btn-lg sql-execute" id="sql3" onclick="executeQuery(this.id)"><i class="fa fa-arrow-down" aria-hidden="true" ></i></button>
                      </div>
                    </div>
                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                      <!-- Card Header - Accordion -->
                      <a href="#collapseCardExample4" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample4">
                        <h6 class="m-0 font-weight-bold text-primary">Список активных клиентов и тарифы, на которые они подписаны</h6>
                      </a>
                      <!-- Card Content - Collapse -->
                      <div class="collapse" id="collapseCardExample4">
                        <div class="card-body">
                          SELECT cu.name,t.name,ct.active FROM customers cu
join customers_tarifs ct
on cu.id = ct.customer_id
join tarifs t
on t.id = ct.tarif_id
WHERE ct.active = 1
                        </div>
                        <button class="btn btn-success btn-circle btn-lg sql-execute" id="sql4" onclick="executeQuery(this.id)"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
      <script>
          function executeQuery(id, form){
              formdata = $("#form").serialize()+'&id='+id;
              window.location = '/query?'+formdata;
          }
      </script>
      <!-- <script>
      function executeQuery(id){
        var query_id = id;
        var url = '/query';
        form = $("#form");
        formdata = form.serialize()+'&id='+query_id;
        console.log(formdata);
            $.ajax({
                   type: "GET",
                   url: url,
                   data: formdata, // serializes the form's elements.
                   success: function(response)
                   {
                     console.log(response);
                   },
                   error: function(response){
                     console.log(response);
                   }
                 });
      }
      </script> -->
      <!-- End of Main Content -->
@endsection
