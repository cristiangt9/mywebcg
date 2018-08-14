<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMassageRequest;

class PagesController extends Controller
{
    public function home()
    {
    	return view('home');
    }



}