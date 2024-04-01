<?php

namespace App\Http\Controllers\Backend\Seller\Ingredients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{


    public function ingredientsIndex()
    {


        $data = [
            'pageTitle' => 'Liste aller Zutaten',
             // Weitere Daten hier hinzufügen, falls erforderlich
        ];
        return view('backend.pages.seller.ingredients.ingredients-index', $data);
    }

}
