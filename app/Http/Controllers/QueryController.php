<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Exports\QueryExport;
use App\Exports\XMLExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;

class QueryController extends Controller
{
  public function __invoke(Request $request)
  {

    $queries = [
      'sql1' =>
      "SELECT
      c.id, c.name, COUNT(*)
      FROM
      companies c
      join tarifs t
      on c.id = t.company_id
      join customers_tarifs ct
      on ct.id = t.id
      GROUP BY c.name
      HAVING COUNT(*)",
      'sql2' =>
      "SELECT
      c.id, c.name, COUNT(*)
      FROM
      companies c
      join tarifs t
      on c.id = t.company_id
      join customers_tarifs ct
      on ct.id = t.id
      WHERE active = 0
      GROUP BY c.name
      HAVING COUNT(*)",
      'sql3' =>
      "SELECT t.id, t.name, COUNT(*) FROM tarifs t
      join customers_tarifs ct
      on t.id = ct.tarif_id
      GROUP BY t.id
      HAVING COUNT(*)",
      'sql4' =>
      "SELECT cu.name,t.name,ct.active FROM customers cu
      join customers_tarifs ct
      on cu.id = ct.customer_id
      join tarifs t
      on t.id = ct.tarif_id
      WHERE ct.active = 1"];

      $id = $request->id;
      $mode = $request->output_method;

      $time = now();
      $filename = $request->id.'_'.$time;

      if($mode == 'Excel'){
        $export = new QueryExport(\DB::select($queries[$request->id]));
        return Excel::download($export, $filename.'.xlsx');
      }

      else if($mode == 'CSV'){
        $export = new QueryExport(\DB::select($queries[$request->id]));
        return Excel::download($export, $filename.'.csv');
      }

      else if($mode == 'XML'){
        $export = \DB::select($queries[$request->id]);
        $export = json_decode(json_encode($export),true);
        $export = new XMLExport($export,$filename);
        $result = $export->xmlexport();
        //dd($result);
        file_put_contents(base_path('storage/'.$filename.'.xml'),stripslashes(json_encode($export)));
        return response()->download(base_path('storage/'.$filename.'.xml'));
      }

      else if($mode == 'JSON'){
        try {
          $export = \DB::select($queries[$request->id]);
        }
        catch (\Exception $e) {
          dd($e->getMessage());
        }

        file_put_contents(base_path('storage/'.$filename.'.json'), stripslashes(json_encode($export)));
        return response()->download(base_path('storage/'.$filename.'.json'));
      }




  }
}
