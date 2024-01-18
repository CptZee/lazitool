<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        return Type::all();
    }

    public function show($id)
    {
        return Type::find($id);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);
    
            return Type::create($validatedData);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $model = Type::findOrFail($id);
    
            $validatedData = $request->validate([
                'name' => 'required|string',
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
            $model = Type::findOrFail($id);
            $model->delete();
    
            return response()->json(['message' => 'Record archived successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
