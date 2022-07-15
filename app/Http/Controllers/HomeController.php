<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // untuk data whitelist di tagify
        $product = Product::select('title as name', 'id')->get();
        $collectProduct = collect($product);
        
        // untuk value di form input tagify
        $card = Card::first();

        // collect multiple product
        $selectedIdProduct = collect(json_decode($card['multiple_product']))->pluck('value');
        $array = $selectedIdProduct->toArray();
        $idProductOrdered = implode(',', $array);
        $listProduct = Product::whereIn('id', $selectedIdProduct ?? [])->orderByRaw("FIELD(id, $idProductOrdered)")->get();
        
        return view('product', compact('collectProduct', 'card', 'listProduct'));
    }

    public function updateCard(Request $request, $id)
    {
        Card::where('id', $id)
        ->update([
            "multiple_product" => $request->tags
        ]);

        return redirect('product');
    }
}
