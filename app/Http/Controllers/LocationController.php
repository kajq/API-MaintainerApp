<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Location;

class LocationController extends Controller
{
    public function index($company_id){
        $companies = DB::table('locations')
             ->whereIn('company_id', [$company_id])
             ->get();
        return response()->json($companies);
        }
    
    public function store(Request $request){
        try{
            $location = new Location([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'company_id'=>$request->input('company_id'),
                ]);
            $location->save();
            return response()->json(['status'=>true, 'Empresa creada'], 200);
        } catch (\Exception $e){
            echo $e;
            Log::critical("No se ha podido añadir: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Someting bad', 500 );
        }
    }
    
    public function show($id)
    {
        try{
    		$location = Location::find($id);
    		if(!$location){
    			return response()->json(['No existe la ubicación'], 404);
    		}
    		
    		return response()->json($location, 200);
    	} catch (\Exception $e){
    		Log::critical("No se ha podido encontrar la ubicación: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
    		return response('Someting bad', 500 );
    	}
    }
}
