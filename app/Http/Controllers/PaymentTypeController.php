<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Models\PaymentStatus;
use Illuminate\Database\QueryException;
use App\Http\Resources\PaymentTypeResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentTypeController extends Controller
{
    public function index()
    {
        try {
            $list_payment_type = PaymentType::all();
            return response([
                'message' => 'Successfully retrieved the data!',
                'success' => true,
                'List Payment Type' => PaymentTypeResource::collection($list_payment_type)
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
            $detail_payment_type = PaymentType::findOrFail($id);
            return response([
                'message' => 'Successfully retrieved the data!',
                'success' => true,
                'Detail Payment Type' => new PaymentTypeResource($detail_payment_type)

            ], 200);
        } catch (ModelNotFoundException $e) {
            return response([
                'error' => 'The requested payment type does not exist.',
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
                'payment_type_name' => 'required|unique:payment_type,payment_type_name|max:255',
            ]);

            $paymenttype = PaymentType::create($validatedData);

            return response([
                'message' => 'Payment type created successfully!',
                'success' => true,
                'Add Payment Type' => new PaymentTypeResource($paymenttype),
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
                'error' => 'Failed to create the payment type.',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'payment_type_name' => 'required|max:255'
            ]);



            $paymenttype = PaymentType::findOrFail($id);
            $paymenttype->update($validatedData);

            return response([
                'message' => 'Payment type updated successfully!',
                'success' => true,
                'Update Payment Type' => new PaymentTypeResource($paymenttype),
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
                'error' => 'Failed to update the payment type.',
            ], 500);
        }
    }

    public function delete($id)
    {
        try {

            $paymenttype = PaymentType::findOrFail($id);
            $paymenttype->delete($paymenttype);

            return response([
                'message' => 'Payment type deleted successfully!',
                'success' => true,
                'Delete Payment Type' => new PaymentTypeResource($paymenttype),
            ], 201);
        } catch (ModelNotFoundException $e) {
            return response([
                'success' => false,
                'message' => 'Payment type not found.',
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
