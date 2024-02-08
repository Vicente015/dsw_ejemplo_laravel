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

    public function edit(string $id)
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Edit";
        $viewData["product"] = Product::find($id);
        $viewData["products"] = Product::all();
        return view('admin.product.edit')->with('viewData', $viewData);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::find($request->input('id'));

        if ($request->hasFile('image')) {
            // Borra la imagen existente si hay
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imageName = $product->id . '_' . $request->file('image')->getClientOriginalName() . $request->file('image')->getExtension();

            // Almacenar la imagen
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );

            // Ruta de la imagen
            $imagePath = 'storage/' . $imageName;
        }

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->image = isset($imagePath) ? $imagePath : $product->image;
        $product->price = $request->input('price');

        // Guardar el producto
        $product->save();

        return redirect()->route('admin.product.edit', $product->id)->with('success', 'Producto editado correctamente');
    }

    public function destroy(Request $request)
    {
        $productId = $request->input('id');
        Product::destroy($productId);
        return redirect()->route('admin.product.index')->with('success', 'Producto eliminado correctamente');
    }
}
