<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use File;

class ProductController extends Controller
{
    function createProductSlug($string) {
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
        $string = preg_replace('/[\s-]+/', ' ', $string);
        $string = str_replace(' ', '-', $string);
        $string = trim($string, '-');
        return $string;
    }

    public function index(Request $request){

        if($request->has('search')){
            $searchProducts = Product::Where('name', 'LIKE', "%$request->search%")
                                ->orWhere('description', 'LIKE', "%$request->search%")
                                ->orWhere('price', 'LIKE', "%$request->search%")
                                ->orWhere('product_id', 'LIKE', "%$request->search%")->get();

            $html = view('ajaxpage', compact('searchProducts'))->render();
            return response()->json(['html' => $html]);
        }

        if($request->has('filterName') && $request->has('filterValue')){
            $searchProducts = Product::orderBy($request->filterName, $request->filterValue)->get();
            $html = view('ajaxpage', compact('searchProducts'))->render();
            return response()->json(['html' => $html]);
        }

        $products = Product::latest()->paginate(5);

        return view('index', compact('products'));
    }
    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'slug' => 'required|unique:products,product_id',
            'image' => 'required',
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ]);

        $imageName = time().rand(0,100). '.' . $request->image->extension();
        echo $imageName;

        $product = new Product;
        $product->name = $request->name;
        $product->product_id = self::createProductSlug($request->slug);
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->image = $imageName;
        $product->save();

        if($product){
            $request->image->move(public_path('images'), $imageName);
        }

        return redirect()->route('product')->with(['success' => 'Product has been created']);

    }

    public function productView($id){
        $product = Product::where('product_id', $id)->first();
        if($product){
            return view('show', compact('product'));
        }else{
            abort(404);
        }

    }

    public function deleteProduct($id){
        $product = Product::findOrFail($id);
        echo $product->image;
        if(File::exists(public_path('images/'.$product->image))){
            File::delete(public_path('images/'.$product->image));
        }
        $product->delete();
        return redirect()->route('product')->with(['success' => 'Product has been deleted']);
    }

    public function productEdit($id){
        $products = Product::findorfail($id);
        return view('edit', compact('products'));
    }

    public function productUpdate(Request $request, $id){
        $validated = $request->validate([
            'slug' => "required|unique:products,product_id, $id",
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ]);

        $product = Product::findorfail($request->id);

        if($request->has('image') && File::exists(public_path('images/'.$product->image))){
            File::delete(public_path('images/'.$product->image));
            $imageName = time().rand(0,100). '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->product_id = self::createProductSlug($request->slug);
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->save();

        return redirect()->route('product')->with(['success' => 'Product has been updated']);

    }


}
