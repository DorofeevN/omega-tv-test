<?php

namespace App\Http\Controllers;
use App\Models\CompanyModel;
use App\Models\CustomerModel;
use App\Models\TarifModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tarifs = TarifModel::orderBy('id', 'desc')->paginate(50);
      return view('tarifs')
      ->with('tarifs', $tarifs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $companies = CompanyModel::all();
      $customers = CustomerModel::all();
      return view('create-tarif')
      ->with('customers', $customers)
      ->with('companies', $companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //retrieve data and name|tarif
        $data = $request->all();
        $company_id = $data['tarif_company'];
        $tarif_name = $data['tarif_name'];


        $already_in_company = false;
        CompanyModel::find($company_id)->tarifs()->get()->search(function ($item, $key) use (&$tarif_name, &$already_in_company) {
          if($item->name == $tarif_name){
            $already_in_company = true;
          }
        });
        if($already_in_company){
          return response()->json([
          'error' => 'Current Tarif exists in Company'], 400);
        };

        $model = new TarifModel;
        $model->name = $tarif_name;
        $model->company_id = $company_id;
        $model->save();
        $tarif_id = $model->id;

        $tarif = TarifModel::find($tarif_id);

        if(isset($data['customer'])){

        foreach ($data['customer'] as $key => $customer_id) {
          $already_in_tarif = false;
          $tarif->customers()->get()->search(function ($item, $key) use (&$customer_id, &$already_in_tarif) {
            if($item->id == $customer_id){
              $already_in_tarif = true;
            }
          });
          if($already_in_tarif){
            continue;
          }
          if($customer_id){
            $tarif->customers()->attach($customer_id, ['active' => true]);
          }
        }

      }

        return response()->json([
        'success' => 'All is Done'], 200);
      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $tarif = TarifModel::find($id);
      return view('tarif-detail')
      ->with('tarif', $tarif);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filtering(Request $request){
        //Session::put('data', $request);
         $tarifs = TarifModel::filter($request)->get();
         return $tarifs;
    }

}
