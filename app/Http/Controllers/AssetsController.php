<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;

class AssetsController extends Controller
{
    public function index(){
        $asset = Asset::all()->toArray();
        return response()->json($asset);
    }

    public function store(Request $request){
        try{
    		$asset = new Asset([
                'plaque'=>$request->input('plaque'),
                'model'=>$request->input('model'),
                'description'=>$request->input('description'),
                'last_change'=>$request->input('last_change'),
                'install_date'=>$request->input('install_date'),
                'type_id'=>$request->input('type_id'),
                'location_id'=>$request->input('location_id'),
                'company_id'=>$request->input('company_id'),
                'state'=>$request->input('state'),

                ]);
    		$asset->save();
    		return response()->json(['status'=>true, 'Equipo creado'], 200);
    	} catch (\Exception $e){
    		echo $e;
            Log::critical("No se ha podido añadir: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Someting bad', 500 );
    	}
    }

    public function show($id)
    {
        try{
    		$asset = Asset::find($id);
    		if(!$asset){
    			return response()->json(['El equipo no existe'], 404);
    		}
    		
    		return response()->json($company, 200);
    	} catch (\Exception $e){
    		Log::critical("No se ha podido encontrar el equipo: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
    		return response('Someting bad', 500 );
    	}
    }
}
