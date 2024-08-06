<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Resources\TransactionResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransactionController extends Controller
{

    public function index()
    {
        try {
            $list_transaction = Transaction::with('transaction_customer', 'transaction_laundrytype', 'transaction_paymentstatus', 'transaction_paymenttype')->get();
            return response([
                'message' => 'Successfully retrieved the data!',
                'success' => true,
                'List Transaction' => TransactionResource::collection($list_transaction)
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
            $detail_transaction = Transaction::findOrFail($id);
            return response([
                'message' => 'Successfully retrieved the data!',
                'success' => true,
                'Detail Laundry Type' => new TransactionResource($detail_transaction)

            ], 200);
        } catch (ModelNotFoundException $e) {
            return response([
                'error' => 'The requested transaction does not exist.',
                'success' => false,
                'message' => 'Transaction not found.'
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
                'customer_id' => 'required',
                'laundry_type_id' => 'required',
                'payment_status_id' => 'required',
                'payment_type_id' => 'required',
                'transaction_date' => 'required',
                'finish_date' => 'required',
                'kilograms' => 'required',
                'total_price' => 'required'
            ]);
            $transaction = Transaction::create($request->all());
            return response([
                'message' => 'Transaction created successfully!',
                'success' => true,
                'Add Transaction' => new TransactionResource($transaction),
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
                'error' => 'Failed to create the transaction.',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'customer_id' => 'required',
                'laundry_type_id' => 'required',
                'payment_status_id' => 'required',
                'payment_type_id' => 'required',
                'transaction_date' => 'required',
                'finish_date' => 'required',
                'kilograms' => 'required',
                'total_price' => 'required'
            ]);

            $transaction = Transaction::findOrFail($id);
            $transaction->update($request->all());

            return response([
                'message' => 'Transaction updated successfully!',
                'success' => true,
                'Update Transaction' => new TransactionResource($transaction),
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
                'error' => 'Failed to update the transaction.',
            ], 500);
        }
    }

    public function delete($id)
    {
        try {

            $transaction = Transaction::findOrFail($id);
            $transaction->delete($transaction);

            return response([
                'message' => 'Transaction deleted successfully!',
                'success' => true,
                'Delete Laundry Type' => new TransactionResource($transaction),
            ], 201);
        } catch (ModelNotFoundException $e) {
            return response([
                'success' => false,
                'message' => 'Transaction not found.',
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
