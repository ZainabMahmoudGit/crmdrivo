<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class TripController extends Controller
{
    public function index()
    {
        return Trip::all();
    }

  public function store(Request $request)
{
    $validated = $request->validate([
        'client_id'       => 'required|exists:clients,id',
        'sales_id'        => 'required|exists:sales,id',
        'status'          => 'required|string',
        'total_amount'    => 'nullable|numeric',
        'payment_status'  => 'nullable|string',
        'payment_method'  => 'nullable|string',
        'transfer_image'  => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        'canceled_by'     => 'nullable|string',
        'cancel_reason'   => 'nullable|string',
        'cancel_date'     => 'nullable|date',
    ]);

    // رفع صورة التحويل البنكي
    if ($request->hasFile('transfer_image')) {
        $image = $request->file('transfer_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = storage_path('app/assets/transfers');

        if (!file_exists($imagePath)) {
            mkdir($imagePath, 0777, true);
        }

        $image->move($imagePath, $imageName);
        $transferImageUrl = url("storage/app/assets/transfers/" . $imageName);
    } else {
        $transferImageUrl = null;
    }

    // حفظ الرحلة
    $trip = Trip::create([
        'client_id'       => $validated['client_id'],
        'sales_id'        => $validated['sales_id'],
        'status'          => $validated['status'],
        'total_amount'    => $validated['total_amount'] ?? null,
        'payment_status'  => $validated['payment_status'] ?? null,
        'payment_method'  => $validated['payment_method'] ?? null,
        'transfer_image'  => $transferImageUrl,
        'canceled_by'     => $validated['canceled_by'] ?? null,
        'cancel_reason'   => $validated['cancel_reason'] ?? null,
        'cancel_date'     => $validated['cancel_date'] ?? null,
    ]);

    return response()->json([
        'message' => 'Trip created successfully',
        'trip' => $trip
    ], 201);
}


    public function show($id)
    {
        return Trip::findOrFail($id);
    }
public function update(Request $request, $id)
{
    Log::info('🛠️ Incoming Trip Update Request', $request->all());
    Log::info('📥 Raw Request Data:', $request->all());

    return DB::transaction(function () use ($request, $id) {
        $trip = Trip::where('id', $id)->lockForUpdate()->first();

        if (!$trip) {
            return response()->json(['error' => 'Trip not found'], 404);
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'client_id'       => 'nullable|exists:clients,id',
            'sales_id'        => 'nullable|exists:sales,id',
            'status'          => 'nullable|string',
            'total_amount'    => 'nullable|numeric',
            'payment_status'  => 'nullable|string',
            'payment_method'  => 'nullable|string',
            'transfer_image'  => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'canceled_by'     => 'nullable|string',
            'cancel_reason'   => 'nullable|string',
            'cancel_date'     => 'nullable|date',
        ]);

        if ($validator->fails()) {
            Log::error('❌ Validation failed', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        // لو مفيش بيانات تتحدث
        if (empty($validated)) {
            Log::info('⚠️ No fields to update.');
            return response()->json(['message' => 'No fields were updated.'], 200);
        }

        // معالجة صورة التحويل البنكي لو موجودة
        if ($request->hasFile('transfer_image')) {
            $image = $request->file('transfer_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = storage_path('app/assets/transfers');

            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            $image->move($imagePath, $imageName);
            $validated['transfer_image'] = url("storage/app/assets/transfers/" . $imageName);
        }

        Log::info('🔁 Before update - trip current values:', $trip->toArray());
        Log::info('🔧 Validated values to update:', $validated);

        $trip->update($validated);

        return response()->json([
            'message' => 'Trip updated successfully',
            'trip' => $trip
        ]);
    });
}


    public function destroy($id)
    {
        Trip::destroy($id);
        return response()->json(['message' => 'Trip deleted successfully']);
    }
}

