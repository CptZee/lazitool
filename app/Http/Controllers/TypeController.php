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
    
            $type = Type::create($validatedData);
    
            // Check if the creation was successful
            if ($type) {
                return response()->json(['message' => 'Successfully executed the operation']);
            } else {
                return response()->json(['message' => 'Failed to create the Type'], 422);
            }
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
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
    
            return response()->json(['message' => 'Successfully updated the Type']);
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
