<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Operation;

class OperationController extends Controller
{
    public function index()
    {
        return Operation::all();
    }

    public function show($id)
    {
        return Operation::find($id);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'type_id' => 'required|integer|exists:types,id',
                'file_name' => 'required|string',
                'file_size' => 'required|integer|min:0'
            ]);
    
            return Operation::create($validatedData);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $model = Operation::findOrFail($id);
    
            $validatedData = $request->validate([
                'type_id' => 'required|integer|exists:types,id',
                'file_name' => 'required|string',
                'file_size' => 'required|integer|min:0',
            ]);
    
            $model->update($validatedData);
    
            return $model;
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function delete($id)
    {
        try {
            $model = Operation::findOrFail($id);
            $model->delete();
    
            return response()->json(['message' => 'Record archived successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
