<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;

class ProviderController extends Controller
{
    public function index(){
    	$providers = Provider::all();
    	return $providers;
    }

    public function store(Request $request) {
    	$provider = new Provider();
    	$provider->name = ucwords($request->name);
    	$provider->timestamps = false;
    	$provider->save();
    }
}
