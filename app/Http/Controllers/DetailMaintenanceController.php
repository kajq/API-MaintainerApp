<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DetailMaintenance;
use App\Asset;

class DetailMaintenanceController extends Controller
{
    //función que trae los registros de un detalle de mantenimiento
    public function index($maintenance_id){
        $detail = DB::table('detailmaintenances')
             ->whereIn('maintenance_id', [$maintenance_id])
             ->get();
        return response()->json($detail);
        }
    //función que guarda un detalle de mantenimiento
    public function store(Request $request){
        try{
            $detail = new DetailMaintenance([
                'maintenance_id'=>$request->input('maintenance_id'),
                'asset_id'=>$request->input('asset_id'),
                'detail'=>$request->input('detail'),
                'type'=>$request->input('type'),
                ]);
            $detail->save();
            $this->UpdateDateMaintenance($request);
            return response()->json($detail, 201);
        } catch (\Exception $e){
            echo $e;
            Log::critical("No se ha podido añadir: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Someting bad', 500 );
        }
    }

    //Función que actualiza la fecha de ultimo mantenimiento del equipo
    public function UpdateDateMaintenance(Request $request){
        try{
    		$asset = Asset::find($request->input('asset_id'));
    		if(!$asset){
    			return response()->json(['No existe...'], 404);
    		}
    		
            $asset->update($request->all());
    		return response($asset,200);
    	} catch (\Exception $e){
    		Log::critical("No se ha podido editar: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
    		return response('Someting bad', 500 );
    	}
    }
    
}
