<?php

namespace App\Http\Controllers;

use App\Models\LaundryType;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Resources\LaundryTypeResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;


class LaundryTypeController extends Controller
{

    public function index()
    {
        try {
            $list_laundry_type = LaundryType::all();
            return response([
                'message' => 'Successfully retrieved the data!',
                'success' => true,
                'List Laundry Type' => LaundryTypeResource::collection($list_laundry_type)
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
            $detail_laundry_type = LaundryType::findOrFail($id);
            return response([
                'message' => 'Successfully retrieved the data!',
                'success' => true,
                'Detail Laundry Type' => new LaundryTypeResource($detail_laundry_type)

            ], 200);
        } catch (ModelNotFoundException $e) {
            return response([
                'error' => 'The requested laundry type does not exist.',
                'success' => false,
                'message' => 'Laundry type not found.'
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
                'laundry_type_name' => 'required|unique:laundry_type,laundry_type_name|max:255',
                'price_per_kg' => 'required|max:255',
                'time_to_finish' => 'required|max:255',
            ]);

            $laundryType = LaundryType::create($validatedData);

            return response([
                'message' => 'Laundry type created successfully!',
                'success' => true,
                'Add Laundry Type' => new LaundryTypeResource($laundryType),
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
                'error' => 'Failed to create the laundry type.',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'laundry_type_name' => 'required|max:255',
                'price_per_kg' => 'required|max:255',
                'time_to_finish' => 'required|max:255'
            ]);



            $laundryType = LaundryType::findOrFail($id);
            $laundryType->update($validatedData);

            return response([
                'message' => 'Laundry type updated successfully!',
                'success' => true,
                'Update Laundry Type' => new LaundryTypeResource($laundryType),
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
                'error' => 'Failed to update the laundry type.',
            ], 500);
        }
    }

    public function delete($id)
    {
        try {

            $laundryType = LaundryType::findOrFail($id);
            $laundryType->delete($laundryType);

            return response([
                'message' => 'Laundry type deleted successfully!',
                'success' => true,
                'Delete Laundry Type' => new LaundryTypeResource($laundryType),
            ], 201);
        } catch (ModelNotFoundException $e) {
            return response([
                'success' => false,
                'message' => 'Laundry type not found.',
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
