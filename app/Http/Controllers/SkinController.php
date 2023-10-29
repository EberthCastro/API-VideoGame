<?php

namespace App\Http\Controllers;

use App\Models\Skin;
use Illuminate\Http\Request;

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
            'nombre' => $request->content,
            'tipos' => $request->value,
            'precio' => $request->type,
            'color'  => $request->type,
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
}
