<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function index(Request $request)
    {
        $favorites = $request->user()->favorites()->get();

        return response()->json([
            'success' => true,
            'data' => $favorites
        ], 201);
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'user_id' => 'required',
            'idSimpson' => 'required',
            'json_simpson' => 'required'
        ]);

        $request->user()->favorites()->create($fields);

        return response()->json([
            'success' => true,
            'message' => "Se agrego correctamente a tus favoritos."
        ], 201);
    }

    public function delete(Request $request, $id)
    {
        $favorite = $request->user()->favorites()->where('idSimpson', $id)->first();

        $favorite->delete();

        return response()->json([
            'success' => true,
            'message' => "Se quito correctamente de tus favoritos."
        ], 201);
    }
}
