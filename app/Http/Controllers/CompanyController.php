<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    public function index(){
    $company = Company::all()->toArray();
    return response()->json($company);
    }

    public function store(Request $request){
        try{
    		$company = new Company([
    			'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'user_id'=>$request->input('user_id'),
    			]);
    		$company->save();
    		return response()->json(['status'=>true, 'Empresa creada'], 200);
    	} catch (\Exception $e){
    		Log::critical("No se ha podido añadir: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
    		return response('Someting bad', 500 );
    	}
    }

    public function show($id)
    {
        try{
    		$company = Company::find($id);
    		if(!$company){
    			return response()->json(['No existe la empresa'], 404);
    		}
    		
    		return response()->json($company, 200);
    	} catch (\Exception $e){
    		Log::critical("No se ha podido encontrar la empresa: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
    		return response('Someting bad', 500 );
    	}
    }
}
