<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index()
    {
        return response()->json(
            ['recipes' => Recipe::all()]
        );
    }

    public function show(int $id)
    {
        try {
            return response()->json(
                [
                    'message' => 'Recipe details by id',
                    'recipe' => [Recipe::select(
                        [
                            'title', 'making_time', 'serves', 'ingredients', 'instructions', 'cost'
                        ]
                    )->findOrFail($id)]
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                ['error' => 'Recipe not found'],
                404
            );
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:100',
                'making_time' => 'required|max:100',
                'serves' => 'required|max:100',
                'ingredients' => 'required|max:300',
                'cost' => 'required|integer',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Recipe creation failed!',
                    'requied' => 'title, making_time, serves, ingredients, cost'
                ], 200);
            }
            $recipe = Recipe::create($request->all());
            return response()->json([
                'message' => 'Recipe successfully created!',
                'recipe' => [$recipe]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Recipe creation failed!',
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $recipe = Recipe::findorFail($id);
            $recipe->title = $request->title;
            $recipe->making_time = $request->making_time;
            $recipe->serves = $request->serves;
            $recipe->ingredients = $request->ingredients;
            $recipe->cost = $request->cost;
            $recipe->save();

            return response()->json([
                'message' => 'Recipe successfully updated!',
                'recipe' => [$recipe]
            ]);
        } catch (\Exception $e) {
            logger()->error($e);
            return response()->json([
                'message' => 'Recipe update failed!',
            ], 404);
        }
    }

    public function destroy(int $id)
    {
        try {
            $recipe = Recipe::findOrFail($id);
            $recipe->delete();
            return response()->json([
                'message' => 'Recipe successfully removed!',
            ]);
        } catch (\Exception $e) {
            logger()->error($e);
            return response()->json([
                'message' => 'No recipe found',
            ], 404);
        }
    }
}
