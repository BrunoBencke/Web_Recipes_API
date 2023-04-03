<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\IngredientHistory;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    public function index()
    {
        try{
            return $ingredients = DB::select('select id, description, REPLACE(FORMAT(quantity,3), ".", ",") quantity
                                                      from ingredients
                                                     order by id');
        }catch(\Exception $error){
            return ['response'=>'error', 'details'=>$error];
        }
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'description',
                'quantity',
            ]);
            $request["quantity"] = str_replace(',', '.', $request["quantity"]);

            $ingredient = Ingredient::create($request->all());

            $history = new IngredientHistory();
            $history->ingredient_id = $ingredient->id;
            $history->description = $request->description;
            $history->quantity = $request->quantity;
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
            $ingredient = DB::select('select id, description, REPLACE(FORMAT(quantity,3), ".", ",") quantity
                                              from ingredients
                                             where id = '. $id);
            return $ingredient[0];
        } catch(\Exception $error){
            return ['response'=>'error', 'details'=>$error];
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request["quantity"] = str_replace(',', '.', $request["quantity"]);
            $ingredient = Ingredient::FindOrfail($id);
            $ingredient->description = $request->description;
            $ingredient->quantity = $request->quantity;
            $ingredient->save();

            $history = new IngredientHistory();
            $history->ingredient_id = $ingredient->id;
            $history->description = $request->description;
            $history->quantity = $request->quantity;
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
            $ingredient = Ingredient::findOrFail($id);
            $ingredient->delete();

            $history = new IngredientHistory();
            $history->ingredient_id = $id;
            $history->description = $ingredient->description;
            $history->quantity = $ingredient->quantity;
            $history->operation = 'Delete';
            $history->save();

            return ['response'=>'sucess'];
        } catch(\Exception $error){
            return ['response'=>'error', 'details'=>$error];
        }
    }
}
