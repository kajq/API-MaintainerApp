<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Type;

class TypeController extends Controller
{
    public function index($user_id){
        $types = DB::table('types')
             ->whereIn('user_id', [$user_id])
             ->get();
        return response()->json($types);
        }
    
    public function store(Request $request){
        try{
            $types = new Type([
                'description'=>$request->input('description'),
                'state'=>$request->input('state'),
                'user_id'=>$request->input('user_id'),
                ]);
            $types->save();
            return response()->json(['status'=>true, 'Tipo creado'], 200);
        } catch (\Exception $e){
            echo $e;
            Log::critical("No se ha podido añadir: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Someting bad', 500 );
        }
    }
}
