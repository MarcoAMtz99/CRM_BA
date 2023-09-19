<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.campaña');
    }

    public function getCampaign(Request $request)
    {
        $employeeNumber = Auth::user()->employeeNumber->number;
        return view('admin.detalle',['id'=>$request->id,'employeeNumber'=>$employeeNumber]);
    }

}
