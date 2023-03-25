<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all()->sortBy('name');
        $items = Item::all()->sortBy('title');
        return view('products.index')->with('categories',$categories)->with('items',$items);
    }
   
    public function edit($id) {

    }

    public function show($id) {
    // it'll transfer all the data in the shopping_cart database.
        $products = Product::all();
        return view('products.show')->with('products', $products);
    }
    
    public function create() {
    }
    public function store(Request $request) {
        // validate the data.
         $this->validate($request, [
             'item_id' => 'required|integer',
             'session_id' => 'required|string',
             'ip_address' => 'required|string',
             'quantity' => 'required|integer'
         ]);
         //we'll transfer item id, session id,, addess session and quantity to the view.
         $pcart = new Product;
         $pcart->item_id = $request->item_id;
         $pcart->session_id = $request->session_id;
         $pcart->ip_address = $request->ip_address;
         $pcart->price = $request->price;
         $pcart->quantity = $request->quantity;
         $pcart->save();
 
         //this will gather the items from the products page into our shop page.
         //it'll direct to SHOW function first and then to SHOP.
         return redirect()->route('products.shop');
 
     }
    
    public function details($item_id, $category_id) {
        //we pass a item id and category id, that's used to display the item details.
        $item = Item::find($item_id);
        $category = Category::where('id', $category_id)->first();
        //if processed correctly it'll show a page w/ the item name, id...
        return view('products.details')->with('item', $item)->with('categories', $category);
    }
    
    public function select($id)
    {
        //we'll transfer both categories and items to the view.
        $categories = Category::all()->sortBy('name');
        $items = Item::where('category_id', $id)->get();
        //this will gather the items from the category that was selected.
        return view('products.select', compact('categories', 'items'));
    }
    
}
