<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Action functions used in web.php

    public function home(){
        
        return view("home"); //our view file called home.blade.php
    }

    public function contact(){

        return view("contact");
    }

    
}
