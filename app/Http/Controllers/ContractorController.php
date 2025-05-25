<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    // عرض كل المقاولين
    public function index()
    {
        return response()->json(Contractor::all(), 200);
    }

    // إضافة مقاول جديد
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'nationality' => 'required|string',
            'city'        => 'nullable|string',
            'phone'       => 'required|string',
            'email'       => 'nullable|email',
        ]);

        $contractor = Contractor::create($request->all());
        return response()->json($contractor, 201);
    }

    // عرض مقاول واحد
    public function show($id)
    {
        $contractor = Contractor::findOrFail($id);
        return response()->json($contractor);
    }

    // تعديل بيانات مقاول
    public function update(Request $request, $id)
    {
        $contractor = Contractor::findOrFail($id);
        $contractor->update($request->all());
        return response()->json($contractor);
    }

    // حذف مقاول
    public function destroy($id)
    {
        $contractor = Contractor::findOrFail($id);
        $contractor->delete();
        return response()->json(['message' => 'Contractor deleted successfully']);
    }
}
