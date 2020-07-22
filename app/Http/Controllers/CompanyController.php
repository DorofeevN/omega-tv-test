<?php

namespace App\Http\Controllers;
use App\Models\CompanyModel;
use App\Models\CustomerModel;
use App\Models\TarifModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $companies = CompanyModel::orderBy('id', 'desc')->paginate(20);
      return view('companies')
      ->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = CustomerModel::all();
        return view('create-company')
        ->with('customers', $customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //$name = $request->input('Name'););
      $data = $request->all();
      //Компания существует
      if(CompanyModel::where('name', '=', $data['name'])->get()->isNotEmpty()){
        return response()->json([
        'error' => 'Company with that name exists!'], 400);
      }
      //Создание новой компании
      $model = new CompanyModel;
      $model->name = $data['name'];
      $model->save();
      $company_id = $model->id;


      unset($data['_token']);
      unset($data['name']);

      //Для каждого тарифа
          foreach ($data as $no => $tarif) {

              //Создать новый триф
              $model = new TarifModel;
              $model->name = $tarif['name'];
              $model->company_id = $company_id;
              $model->save();
              $tarif_id = $model->id;

              //Если есть пользователи - добавить
              if(isset($tarif['customers'])){
                foreach ($tarif['customers'] as $no => $customer) {
                  if($customer){
                    $already_in_tarif  = false;
                    // $current_tarif = TarifModel::find($customer);

                    //проверка на наличие пользователя в тарифе
                    $model->customers()->get()->search(function ($item, $key) use (&$customer, &$already_in_tarif) {
                      if($item->id == $customer){
                        $already_in_tarif = true;
                      }
                    });
                    if($already_in_tarif){
                      continue;
                    }

                    //
                    $model->customers()->attach($customer, ['active' => true]);
                  }
                }
              }

            }

          return 'Success!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = CompanyModel::find($id);
        return view('company-detail')
        ->with('company', $company);
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

    public function manage_users($id)
    {

      $company = CompanyModel::find($id);

      $tarifs = TarifModel::where('company_id',$id)->get();
      foreach ($tarifs as $key => $tarif)
      {
        $customers = $tarif->customers()->get();
        foreach ($customers as $key => $customer) {
          $customer->tarif_id = $tarif->id;
          $customer->active = false;
        }

        $active_customers = $tarif->active_customers()->get();
        foreach ($active_customers as $key => $active_customer) {
          $active_customer->tarif_id = $tarif->id;
          $active_customer->active = true;
        }

        $merged = $customers->concat($active_customers);
        foreach ($merged as $key => $customer) {
            $merged_keyed[$customer->id] = $customer;
        }
      }
      if(!isset($merged_keyed)){
        $merged_keyed = [];
      }
      //dd($merged_keyed);
      return view('manage_users')
      ->with('customers', $merged_keyed)
      ->with('company', $company);

    }

    public function activateuser(Request $request){
      $customer_id = $request->id;
      $tarif_id = $request->tarif_id;
      $affected = \DB::table('customers_tarifs')
              ->where([['customer_id', $customer_id],['tarif_id', $tarif_id]])
              ->update(['active' => 1]);
      return back();
    }

    public function deactivateuser(Request $request){
      $customer_id = $request->id;
      $tarif_id = $request->tarif_id;
      $affected = \DB::table('customers_tarifs')
              ->where([['customer_id', $customer_id],['tarif_id', $tarif_id]])
              ->update(['active' => 0]);
      return back();
    }


}
