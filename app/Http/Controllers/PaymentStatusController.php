<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentStatus;
use Illuminate\Database\QueryException;
use App\Http\Resources\PaymentStatusResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentStatusController extends Controller
{
    public function index()
    {
        try {
            $list_payment_status = PaymentStatus::all();
            return response([
                'message' => 'Successfully retrieved the data!',
                'success' => true,
                'List Laundry Type' => PaymentStatusResource::collection($list_payment_status)
            ], 200);
        } catch (QueryException $e) {
            return response([
                'message' => 'Error occurred while processing the request.',
                'success' => false,
                'error' => 'Failed to retrieve the data'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $detail_payment_status = PaymentStatus::findOrFail($id);
            return response([
                'message' => 'Successfully retrieved the data!',
                'success' => true,
                'Detail Laundry Type' => new PaymentStatusResource($detail_payment_status)

            ], 200);
        } catch (ModelNotFoundException $e) {
            return response([
                'error' => 'The requested payment status does not exist.',
                'success' => false,
                'message' => 'Payment status not found.'
            ], 404);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage(),
                'success' => false,
                'message' => 'An error occurred while processing the request.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'payment_status_name' => 'required|unique:payment_status,payment_status_name|max:255',
            ]);

            $paymentstatus = PaymentStatus::create($validatedData);

            return response([
                'message' => 'Payment status created successfully!',
                'success' => true,
                'Add Payment Status' => new PaymentStatusResource($paymentstatus),
            ], 201);
        } catch (ValidationException $e) {
            return response([
                'message' => 'Validation error occurred.',
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response([
                'message' => 'An error occurred while processing the request.',
                'success' => false,
                'error' => 'Failed to create the payment status.',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'payment_status_name' => 'required|max:255'
            ]);



            $paymentstatus = PaymentStatus::findOrFail($id);
            $paymentstatus->update($validatedData);

            return response([
                'message' => 'Payment status updated successfully!',
                'success' => true,
                'Update Payment Status' => new PaymentStatusResource($paymentstatus),
            ], 201);
        } catch (ValidationException $e) {
            return response([
                'success' => false,
                'message' => 'Validation error occurred.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => 'An error occurred while updating the request.',
                'error' => 'Failed to update the payment status.',
            ], 500);
        }
    }

    public function delete($id)
    {
        try {

            $paymentstatus = PaymentStatus::findOrFail($id);
            $paymentstatus->delete($paymentstatus);

            return response([
                'message' => 'Payment status deleted successfully!',
                'success' => true,
                'Delete Payment Status' => new PaymentStatusResource($paymentstatus),
            ], 201);
        } catch (ModelNotFoundException $e) {
            return response([
                'success' => false,
                'message' => 'Payment status not found.',
                'errors' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => 'An error occurred while deleting the request.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
