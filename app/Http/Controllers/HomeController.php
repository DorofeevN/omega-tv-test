<?php

namespace App\Http\Controllers;
use App\Models\CompanyModel;
use App\Models\CustomerModel;
use App\Models\TarifModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    public function index(Request $request){

      return view('index');
    }

    public function export()
    {

    }

  }
