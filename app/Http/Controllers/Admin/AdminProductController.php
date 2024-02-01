<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }

    public function post(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            //'image' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        // Crear objeto Product
        $product = new Product;

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->image = ""; //$request->input('image');
        $product->price = $request->input('price');

        // Guardar el producto
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Datos válidos y procesados correctamente');
    }
}
