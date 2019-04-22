<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Maintenance;

class MaintenanceController extends Controller
{
    //función que trae los mantenimientos de una empresa
    public function index($company_id){
        $maintenance = DB::table('maintenances')
             ->whereIn('company_id', [$company_id])
             ->get();
        return response()->json($maintenance);
        }
    //función que guarda un mantenimiento
    public function store(Request $request){
        try{
            $maintenance = new Maintenance([
                'date'=>$request->input('date'),
                'observations'=>$request->input('observations'),
                'technician_id'=>$request->input('technician_id'),
                'client'=>$request->input('client'),
                'location_id'=>$request->input('location_id'),
                'type'=>$request->input('type'),
                'company_id'=>$request->input('company_id'),
                ]);
            $maintenance->save();
            return response()->json(['status'=>true, 'Mantenimiento creado'], 201);
        } catch (\Exception $e){
            echo $e;
            Log::critical("No se ha podido añadir: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Someting bad', 500 );
        }
    }    
}
