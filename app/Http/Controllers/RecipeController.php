<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeHistory;
use App\Models\RecipeIngredient;

class RecipeController extends Controller
{
    public function index()
    {
        try{
            $recipes = Recipe::orderBy('id')->get();
            return $recipes;
        }catch(\Exception $error){
            return ['response'=>'error', 'details'=>$error];
        }
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'description',
            ]);
            $request['version'] = 1;
            $recipe = Recipe::create($request->all());

            $history = new RecipeHistory();
            $history->recipe_id = $recipe->id;
            $history->description = $request->description;
            $history->version = $request->version;
            $history->operation = 'Create';
            $history->save();

            return ['response'=>'sucess'];
        } catch(\Exception $error){
            return ['response'=>'error', 'details'=>$error];
        }
    }

    public function show(string $id)
    {
        try{
            return Recipe::FindOrfail($id);
        } catch(\Exception $error){
            return ['response'=>'error', 'details'=>$error];
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $recipe = Recipe::FindOrfail($id);
            $recipe->description = $request->description;
            $recipe->version = $recipe->version + 1;
            $recipe->save();

            $history = new RecipeHistory();
            $history->recipe_id = $recipe->id;
            $history->description = $request->description;
            $history->version = $recipe->version;
            $history->operation = 'Update';
            $history->save();

            return ['response' => 'sucess', 'data' => $request->all()];
        } catch (\Exception $erro) {
            return ['response' => 'erro', 'details' => $erro];
        }
    }

    public function destroy(string $id)
    {
        try{
            $recipe = Recipe::findOrFail($id);
            $recipe->delete();

            $history = new RecipeHistory();
            $history->recipe_id = $id;
            $history->description = $recipe->description;
            $history->version = $recipe->version;
            $history->operation = 'Delete';
            $history->save();

            RecipeIngredient::where('recipe_id', $id)->delete();

            return ['response'=>'sucess'];
        } catch(\Exception $error){
            return ['response'=>'error', 'details'=>$error];
        }
    }
}
