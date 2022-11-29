<?php

namespace App\Http\Controllers;

use App\Models\Coordinacion;
use App\Models\Direccion;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contador =['usuarios'=>User::count(),'direcciones'=>Direccion::count(),'coordinaciones'=>Coordinacion::count()];
        
        
       
      
        return view('menu',compact('contador'));
    }
}
