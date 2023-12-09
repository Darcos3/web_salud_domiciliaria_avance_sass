<?php

namespace App\Http\Controllers;

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

        if( auth()->user()->estado == 0){
            return redirect('/update-password');
        }
        else {
            if( auth()->user()->tipo == 0 ){
                return redirect('historias');
            }
            else {
                return redirect('historias');
            }
        }
    }
}
