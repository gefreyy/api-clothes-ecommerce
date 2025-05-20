<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listProducts(Request $request) {
        $query = Product::with(['gender', 'category', 'brand', 'tags', 'sizes', 'colors']); // El with permite traer relaciones aparte de la consulta, esto está en el modelo Product.
        $allowedFilters = ['page', 'category', 'brand', 'gender', 'size', 'color', 'tag'];
        $requestFilters = array_keys($request->query()); // Array con los filtros que vienen en la url luego del "?"
        // Verificar si hay al menos un filtro válido
        if(!empty($requestFilters)) {
            $validFilters = array_intersect($allowedFilters, $requestFilters);
            if(empty($validFilters)) {
                return response()->json(['error' => 'No se encontraron filtros válidos']);
            }
        }

        if($request->has('category')) { // Aca va lo que se pone en la url, si tiene la palabra "category"
            $categories = (array) $request->category;
            $query->whereHas('category', function ($q) use ($categories) { // Category viene de mi clase Category.php
                $q->whereIn('name', $categories); // Aca va el nombre del campo de la tabla categories. whereIn permite que se traiga un array de categorias para filtrar multiples categorias.
            });
        }

        if($request->has('brand')) {
            $brands = (array) $request->brand;
            $query->whereHas('brand', function ($q) use ($brands) {
                $q->whereIn('id', $brands);
            });
        }

        if($request->has('gender')) {
            $genders = (array) $request->gender;
            $query->whereHas('gender', function ($q) use ($genders) {
                $q->whereIn('name', $genders);
            });
        }

        if($request->has('size')) {
            $sizes = (array) explode(',', $request->size);
            $query->whereHas('sizes', function ($q) use ($sizes) {
                $q->whereIn('name', $sizes);
            });
        }

        if($request->has('color')) {
            $colors = (array) explode(',', $request->color);
            $query->whereHas('colors', function ($q) use ($colors) {
                $q->whereIn('name', $colors);
            });
        }
        
        return response()->json($query->paginate(10));
    }

    public function listAllProducts(Request $request) {
        $query = Product::with(['gender', 'category', 'brand', 'tags', 'sizes', 'colors']); // El with permite traer relaciones aparte de la consulta, esto está en el modelo Product.
        $allowedFilters = ['page', 'category', 'brand', 'gender', 'size', 'color', 'tag'];
        $requestFilters = array_keys($request->query()); // Array con los filtros que vienen en la url luego del "?"
        // Verificar si hay al menos un filtro válido
        if(!empty($requestFilters)) {
            $validFilters = array_intersect($allowedFilters, $requestFilters);
            if(empty($validFilters)) {
                return response()->json(['error' => 'No se encontraron filtros válidos']);
            }
        }

        if($request->has('category')) { // Aca va lo que se pone en la url, si tiene la palabra "category"
            $categories = (array) $request->category;
            $query->whereHas('category', function ($q) use ($categories) { // Category viene de mi clase Category.php
                $q->whereIn('name', $categories); // Aca va el nombre del campo de la tabla categories. whereIn permite que se traiga un array de categorias para filtrar multiples categorias.
            });
        }

        if($request->has('brand')) {
            $brands = (array) $request->brand;
            $query->whereHas('brand', function ($q) use ($brands) {
                $q->whereIn('id', $brands);
            });
        }

        if($request->has('gender')) {
            $genders = (array) $request->gender;
            $query->whereHas('gender', function ($q) use ($genders) {
                $q->whereIn('name', $genders);
            });
        }

        if($request->has('size')) {
            $sizes = (array) explode(',', $request->size);
            $query->whereHas('sizes', function ($q) use ($sizes) {
                $q->whereIn('name', $sizes);
            });
        }

        if($request->has('color')) {
            $colors = (array) explode(',', $request->color);
            $query->whereHas('colors', function ($q) use ($colors) {
                $q->whereIn('name', $colors);
            });
        }
        
        return response()->json($query->get());
    }

    public function listProductsById($id) {
        $product = Product::with(['gender', 'category', 'brand', 'tags', 'sizes', 'colors'])->find($id);
        // var_dump($product);
        return response()->json($product);
    }
}
