<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Resources\CustomerResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            $list_customer = Customer::all();
            return response([
                'message' => 'Successfully retrieved the data!',
                'success' => true,
                'List Customer' => CustomerResource::collection($list_customer)
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
            $detail_customer = Customer::findOrFail($id);
            return response([
                'message' => 'Successfully retrieved the data!',
                'success' => true,
                'Detail Customer' => new CustomerResource($detail_customer)

            ], 200);
        } catch (ModelNotFoundException $e) {
            return response([
                'error' => 'The requested customer does not exist.',
                'success' => false,
                'message' => 'Customer not found.'
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
                'name' => 'required|unique:customer,name|max:255',
                'phone_number' => 'required|max:255',
            ]);

            $customer = Customer::create($validatedData);

            return response([
                'message' => 'Customer created successfully!',
                'success' => true,
                'Add Customer' => new Customer($customer),
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
                'error' => 'Failed to create the customer.',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'phone_number' => 'required|max:255',
            ]);



            $customer = Customer::findOrFail($id);
            $customer->update($validatedData);

            return response([
                'message' => 'Customer updated successfully!',
                'success' => true,
                'Update Customer' => new CustomerResource($customer),
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
                'error' => 'Failed to update the customer.',
            ], 500);
        }
    }

    public function delete($id)
    {
        try {

            $customer = Customer::findOrFail($id);
            $customer->delete($customer);

            return response([
                'message' => 'Customer deleted successfully!',
                'success' => true,
                'Delete Customer' => new CustomerResource($customer),
            ], 201);
        } catch (ModelNotFoundException $e) {
            return response([
                'success' => false,
                'message' => 'Customer not found.',
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
