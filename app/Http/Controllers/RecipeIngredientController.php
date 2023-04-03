<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\RecipeIngredient;
use Illuminate\Support\Facades\DB;

class RecipeIngredientController extends Controller
{
    public function show(Request $request, string $id)
    {
        try{
            return DB::table('recipe_ingredients')->select('ingredients.id','ingredients.description','ingredients.quantity')
                ->join('ingredients', 'recipe_ingredients.ingredient_id', '=','ingredients.id')
                ->where('recipe_ingredients.recipe_id','=', $id)
                ->where('recipe_ingredients.version','=', $request->version)
                ->orderBy('recipe_ingredients.sequence')
                ->get();
        } catch(\Exception $error){
            return ['response'=>'error', 'details'=>$error];
        }
    }

    public function store(Request $request, int $id)
    {
        try{
            $j = 1;
            $version = 0;
            $bodyContent[] = $request->all();
            $recipeBody = $bodyContent[0]['receita'];

            if($id == 0){
                $newRecipe = new Recipe();
                $newRecipe->description = $recipeBody['description'];
                $version = 1;
                $newRecipe->version = $version;
                $newRecipe->save();
                $id = $newRecipe->id;
            }else{
                $recipe = Recipe::FindOrfail($id);
                $recipe->description = $recipeBody['description'];
                $version = $recipe->version + 1;
                $recipe->version = $version;
                $recipe->save();
            }

            foreach ($bodyContent[0]['ingredients'] as $ingredient) {
                $recipeIngredient = new RecipeIngredient();
                $recipeIngredient->recipe_id = $id;
                $recipeIngredient->ingredient_id = $ingredient['id'];
                $recipeIngredient->sequence = $j;
                $recipeIngredient->version = $version;
                $recipeIngredient->save();
                $j++;
            }

            return ['response' => 'sucess'];
        } catch(\Exception $error){
            return ['response'=>'error', 'details'=>$error];
        }
    }

    //Endpoint apenas para retornar os dados para o gráfico do Dashboard
    public function dashBoard(){
        $meses[0] = 985.25;
        $meses[1] = 999.25;
        $meses[2] = 850.00;
        $meses[3] = 920.00;
        $meses[4] = 870.00;
        $meses[5] = 800.00;
        $meses[6] = 750.00;
        $meses[7] = 720.00;
        $meses[8] = 799.26;
        $meses[9] = 842.22;
        $meses[10] = 850.22;
        $meses[11] = 799.25;

        $formatado[0]['name'] = "Faturamento";
        $formatado[0]['data'] = $meses;

        $mesesMeta[0] = 999.99;
        $mesesMeta[1] = 999.99;
        $mesesMeta[2] = 999.99;
        $mesesMeta[3] = 999.99;
        $mesesMeta[4] = 999.99;
        $mesesMeta[5] = 999.99;
        $mesesMeta[6] = 999.99;
        $mesesMeta[7] = 999.99;
        $mesesMeta[8] = 999.99;
        $mesesMeta[9] = 999.99;
        $mesesMeta[10] = 999.99;
        $mesesMeta[11] = 999.99;

        $formatado[1]['name'] = "Meta";
        $formatado[1]['data'] = $mesesMeta;

        return $formatado;
    }
}
