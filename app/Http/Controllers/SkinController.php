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
        return  response($Skins, 201);
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
        return response($Skin, 201);
    }


    public function update(Request $request, $id)
    {
        $skin = Skin::findOrFail($id);

        $attribute = [
            'color' => $request->color,
        ];

        $skin->update($attribute);


        return response([
            'message' => 'Skin-Color updated successfully'
        ], 201);
    }


    public function destroy($id)
    {
        $skin = Skin::findOrFail($id);

        $skin->delete();

        return response()->json(['message' => 'Skin deleted successfully'], 204);
    }

    public function getAvailableSkins()
    {
        $jsonPath = public_path('skins.json'); // Replace with the path to your JSON file

        if (!File::exists($jsonPath)) {
            return response()->json(['message' => 'Skins file not found'], 404);
        }

        $skinsData = json_decode(File::get($jsonPath), true);

        return response()->json($skinsData['skins'], 200);
    }
}
