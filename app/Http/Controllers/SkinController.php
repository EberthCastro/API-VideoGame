<?php

namespace App\Http\Controllers;

use App\Models\Skin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SkinController extends Controller
{

    public function index()
    {
        $Skins = Skin::all();
        return  response($Skins, 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'tipos' => 'required',
            'precio' => 'required',
            'color' => 'required',
        ]);

        Skin::create([
            'nombre' => $request->nombre,
            'tipos' => $request->tipos,
            'precio' => $request->precio,
            'color'  => $request->color,
        ]);

        return response([
            'message' => 'Skin created successfully'
        ], 201);
    }


    public function show($id)
    {
        $Skin = Skin::findOrFail($id);

        if (!$Skin) {
            
            return response(['message' => 'Skin not found'], 404);
            
        } else {
            return response($Skin, 200);    
        } 
        
    }


    public function update(Request $request, $id)
    {
        $Skin = Skin::findOrFail($id);
        

        if ($Skin) {
            
            $Skin->update(['color' => $request->color]);            
            return response(['message' => 'Skin color updated successfully' , $Skin], 200);
            
        } else {
            return response(['message' => 'Skin not found'], 404);
        }  
        
    }


    public function destroy($id)
    {
        $Skin = Skin::findOrFail($id);          

        if ($Skin) {
            
            $Skin->delete();
    
            return response(['message' => 'Skin deleted succesfully'], 200);
        } else {
            return response(['message' => 'Skin not found'], 404);
        } 
    }

    public function getAvailableSkins()
    {
        $jsonPath = public_path('skins.json'); 

        if (!File::exists($jsonPath)) {
            return response()->json(['message' => 'Skins file not found'], 404);
        }

        $skinsData = json_decode(File::get($jsonPath), true);

        return response()->json($skinsData['skins'], 200);
    }

    public function buySkinFromJson(Request $request)
    {
        $jsonPath = public_path('skins.json');

        if (!File::exists($jsonPath)) {
            return response(['message' => 'Skins file not found'], 404);
        }

        $skinsData = json_decode(File::get($jsonPath), true);

        $skinToBuy = null;

        $requestedSkinId = $request->input('skin_id');

        if (!$requestedSkinId) {
            return response(['message' => 'Missing skin_id in the request'], 400);
        }
        
        foreach ($skinsData['skins'] as $key => $skin) {
            if ($skin['id'] == $requestedSkinId) {
                $skinToBuy = $skin;
                
                break;
            }
        }

        if ($skinToBuy) {

            Skin::create([
                'nombre' => $skinToBuy['nombre'],
                'tipos' => $skinToBuy['tipos'],
                'precio' => $skinToBuy['precio'],
                'color' => $skinToBuy['color'],
            ]);

            return response(['message' => 'Skin purchased and stored in the database successfully'], 201);
        } else {
            return response(['message' => 'Skin not found in the JSON data'], 404);
        }
    }
}
