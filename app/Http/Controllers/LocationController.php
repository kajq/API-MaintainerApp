<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    public function index(){
        $locations = Location::all()->toArray();
        return response()->json($locations);
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
}
