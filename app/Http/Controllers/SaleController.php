<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return Sale::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id'    => 'required|string|unique:sales,id',
            'name'  => 'required|string',
            'phone' => 'required|string',
            'email' => 'nullable|email',
        ]);

        $sale = Sale::create($request->all());
        return response()->json($sale, 200);
    }

    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        return response()->json($sale);
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $sale->update($request->all());
        return response()->json($sale);
    }

    public function destroy($id)
    {
        Sale::findOrFail($id)->delete();
        return response()->json(['message' => 'Sale deleted successfully']);
    }
}
