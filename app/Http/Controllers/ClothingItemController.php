<?php

namespace App\Http\Controllers;

use App\Models\ClothingItem;
use Illuminate\Http\Request;

class ClothingItemController extends Controller
{
    public function index(Request $request)
    {
        $query = ClothingItem::query();
    
        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }
    
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->input('search') . '%');
        }
    
        return $query->with('category')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $clothingItem = ClothingItem::create($request->all());
        return response()->json($clothingItem, 201);
    }

    public function show($id)
    {
        return ClothingItem::with('category')->find($id);
    }

    public function update(Request $request, $id)
    {
        $clothingItem = ClothingItem::find($id);
        if (!$clothingItem) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required',
            'description' => 'sometimes|required',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        $clothingItem->update($request->all());
        return response()->json($clothingItem);
    }

    public function destroy($id)
    {
        $clothingItem = ClothingItem::find($id);
        if (!$clothingItem) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $clothingItem->delete();
        return response()->json(['message' => 'Deleted Successfully']);
    }
}

