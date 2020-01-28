<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recipe;

use PDF;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', ['recipes'=>$recipes]);
    }

    public function create()
    {
        return view('recipes.create');
    }

    private function pdf()
    {
        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged."
              ];
          
          $pdf = PDF::loadView('pdfs.pdf', $data);  
          return $pdf->download('medium.pdf');
    }
}
