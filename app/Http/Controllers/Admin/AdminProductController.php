<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            // Obtener siguiente ID en la db
            // todo: Actualizar imagen después para asegurar que el id no está duplicado
            $productId = Product::max('id') + 1;
            $imageName = $productId . '_' . $request->file('image')->getClientOriginalName() . $request->file('image')->getExtension();

            // Almacenar la imagen
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );

            // Ruta de la imagen
            $imagePath = 'storage/' . $imageName;
        }

        // Crear objeto Product
        $product = new Product;

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->image = isset($imagePath) ? $imagePath : null;
        $product->price = $request->input('price');

        // Guardar el producto
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Datos válidos y procesados correctamente');
    }
}
