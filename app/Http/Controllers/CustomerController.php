<?php

namespace App\Http\Controllers;
use App\Models\CompanyModel;
use App\Models\CustomerModel;
use App\Models\TarifModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $customers = CustomerModel::orderBy('id', 'desc')->paginate(50);
      //dd($customers);
      return view('customers')
      ->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $companies = CompanyModel::all();
      $tarifs = TarifModel::all();
      return view('create-customer')
      ->with('tarifs', $tarifs)
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
      $data = $request->all();

      if(CustomerModel::where('name', $data['customer_name'])->get()->isNotEmpty()){
        return response()->json([
        'error' => 'Current Customer exists in Company'], 400);
      }
      $customer_name = $data['customer_name'];
      $model = new CustomerModel;
      $model->name = $customer_name;
      $model->save();
      $customer_id = $model->id;

      $tarifs = array_unique($data['tarif_id']);
      foreach ($tarifs as $key => $tarif_id) {
        $tarif = TarifModel::find($tarif_id);
        $tarif->customers()->attach($customer_id, ['active' => true]);
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
      $customer = CustomerModel::find($id);
      //dd($customer->tarifs[0]->active_customers);
      return view('customer-detail')
      ->with('customer', $customer);
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



}
