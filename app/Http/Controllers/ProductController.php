<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $viewData = [];
        $viewData["title"] = "Listado de productos";
        $viewData["productos"] = Product::all();

        return view("products.index")->with("viewData", $viewData);
    }

    public function productinfo(Request $request, $key) {
        $viewData = [];
        $viewData["title"] = "Producto $key";
        $viewData["producto"] = Product::find($key);

        return view("products.info")->with("viewData", $viewData);
    }
}
