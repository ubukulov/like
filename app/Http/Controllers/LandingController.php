<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LandingController extends Controller
{

    # Розы в колбе
    public function rose_flask(){
        return view('landing/rose');
    }

    # Samsung S9
    public function samsung_s9(){
        return view('landing/samsung_s9');
    }
}
