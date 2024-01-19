<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public static $products = array(
        0 => [
            'nombre' => 'iPhone 15',
            'descripcion' => 'el mejor iphone',
            'imagen' => 'safe.png',
            'precio' => 15
        ],
        1 => [
            'nombre' => 'TV',
            'descripcion' => 'television grande',
            'imagen' => 'game.png',
            'precio' => 500
        ],
        2 => [
            'nombre' => 'Chromecast',
            'descripcion' => 'chrome chrome chrome cast',
            'imagen' => 'submarine.png',
            'precio' => 59
        ],
        3 => [
            'nombre' => 'Portatil gaming',
            'descripcion' => 'gamingk',
            'imagen' => 'game.png',
            'precio' => 500
        ]
    );

    public function index() {
        $viewData = [];
        $viewData["title"] = "Listado de productos";
        $viewData["productos"] = self::$products;

        return view("products.index")->with("viewData", $viewData);
    }

    public function show($id) {
        $viewData = [];
        $viewData["title"] = "Producto $id";

        return view("home.about")->with("viewData", $viewData);
    }
}
