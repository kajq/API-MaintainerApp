<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class DataController extends Controller
    {        //metodos de prubeas de token JWT
            public function open() 
            {
                $data = "This data is open and can be accessed without the client being authenticated";
                return response()->json(compact('data'),200);

            }
       //metodos de prubeas de token JWT
            public function closed() 
            {
                $data = "Only authorized users can see this";
                return response()->json(compact('data'),200);
            }
    }