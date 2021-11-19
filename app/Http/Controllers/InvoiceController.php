<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
//use App\Product;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
        
    public function index()
    {
            $products = DB::select("select id,name from products");               
            return view('invoice.index',['products'=>$products]);
    }


    public function store(Request $request){     
        
        $vendor_id= $request->cmbVendor;        
        date_default_timezone_set('Asia/Dhaka');        
        $now=date("Y-m-d H:i:s");
        DB::insert("insert into purchase_invoice(vendor_id,ref,purchase_date,shipping_address,remark)values('$vendor_id','$request->txtRef','$now','$request->txtShippingAddress','$request->hidRemark')");
        
        $invoice_id=DB::getPdo()->lastInsertId();        

        //echo $invoice_id;
      
        foreach(session('cart') as $item_id=>$details){  
           $qty=$details["qty"];
           $price=$details["price"];
           DB::insert("insert into purchase_invoice_details(invoice_id,item_id,qty,price,discount)values('$invoice_id','$item_id','$qty','$price','0')");
                   
        }
        
       
        session()->forget('cart');       
        session()->flash('success','Product removed successfully');
        return redirect()->back();
     
        //return view('invoice.store');

    }

    public function addItem(Request $request)
    {
        $product_r = DB::select("select * from products where id='$request->txtId'");//Product::find($request->txtId);
        $product=$product_r[0];
        if(!$product){ 
            abort(404); 
        }
 
        $cart = session()->get('cart');
 
        // if cart is empty then this the first product
        if(!$cart) {
 
            $cart = [
                $request->txtId => [                        
                        "name"=>$product->name,
                        "qty"=>$request->txtQty,
                        "price"=>$request->txtPrice,
                        "photo"=>$product->photo
                    ]
            ];
 
            session()->put('cart', $cart); 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$request->txtId])) {
 
            $cart[$request->txtId]['qty']+=$request->txtQty; 
            session()->put('cart', $cart); 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
 
        }
 
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$request->txtId] = [
            "name" => $product->name,
            "qty" => $request->txtQty,
            "price" => $request->txtPrice,
            "photo" => $product->photo
        ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
       
    public function updateItem(Request $request)
    {
        if($request->txtId && $request->txtQty)
        {
            $cart = session()->get('cart'); 
            $cart[$request->txtId]["qty"] = $request->txtQty; 
            session()->put('cart', $cart); 
            session()->flash('success', 'Cart updated successfully');

            return redirect()->back();
        }
    }
 
    public function removeItem(Request $request)
    { 
        //echo $request->txtId;
        if($request->txtId) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->txtId])) { 
                unset($cart[$request->txtId]); 
                session()->put('cart', $cart);
            }
 
            session()->flash('success','Product removed successfully');
            return redirect()->back();
        }
    }

    //
}

/*
[20]["name"]="Apple";
[20]["qty"]=1;
[20]["uom"]="kg";
[20]["price"]=120;

[31]["name"]="Orange";
[31]["qty"]=5;
[31]["uom"]="kg";
[31]["price"]=120;

[32]["name"]="Orange";
[32]["qty"]=5;
[32]["uom"]="kg";
[32]["price"]=120;
*/