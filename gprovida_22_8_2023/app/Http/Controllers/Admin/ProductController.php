<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Currency;
use App\Models\ProductImage;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductInventory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category','price.currency'])->get();
        return view('admin.product.index')->with([
            'pageTitle' => "Products",
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        $currencies = Currency::all();
        return view('admin.product.create')->with([
             'pageTitle' => "Add Products",
             'categories' => $categories,
             'currencies' => $currencies
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|max:255|unique:products',
            'pv' => 'required|max:255|numeric',
            'featured_image' => 'required|image|mimes:png,jpg,jpeg,gif,webp|max:2048',
            'image_gallery'=>'required'
          ];

        $this->validate($request, $rules);

        //store image
        $original_name = trim($request->featured_image->getClientOriginalName());
        $original_name = str_replace(".".$request->featured_image->extension(), "", $original_name);
        $imageName = time()."_".$original_name.'.'.$request->featured_image->extension();
        $request->featured_image->move(public_path('images/products'), $imageName);

        $product = new Product;
        $product->name        = $request->name;
        $product->desc        = $request->description;
        $product->category_id = $request->category;
        $product->type        = $request->type;
        $product->pv          = $request->pv;
        $product->active      = $request->active;
        $product->image_url   = "/images/products/".$imageName;
        $product->sku         = $request->sku;
        $product->save();

        //create price
        $currencies = Currency::all();
        foreach ($currencies as $currency) {
            $productPrice = new ProductPrice;
            $code =$currency->code;
            $amount = $request->$code;
            $productPrice->product_id  = $product->id;
            $productPrice->currency_id = $currency->id;
            $productPrice->price       = $amount ;
            $productPrice->save();
        }

        //create product gallery
        $user_id = Auth::id();
        $count=0;
        if($request->image_gallery){
            foreach ($request->image_gallery as $galleryPic) {
                $count++;
                $imageName2 = $user_id."_".$count."_".time().'.'.$galleryPic->extension();
                $galleryPic->move(public_path('images/products'), $imageName2);
                $productImage = new ProductImage;
                $productImage->product_id = $product->id;
                $productImage->url = "/images/products/".$imageName2;
                $productImage->save();
            }
        }


        // create inventory
        $productInventory = new ProductInventory;
        $productInventory->product_id = $product->id;
        $productInventory->store_id = 1;
        $productInventory->quantity = intval($request->starting_inventory);
        $productInventory->starting_inventory = intval($request->starting_inventory);
        $productInventory->inventory_received =0;
        $productInventory->inventory_shipped =0;
        $productInventory->minimum_required =  intval($request->minimum_required);
        $productInventory->save();

        return redirect('admin/product')->with(['status'=>'Product Added successfully' ]);




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //discount
        $product = Product::with('price.currency','images','inventory', 'category')->find($id);
        $categories = ProductCategory::all();
        $currencies = Currency::all();
        return view('admin.product.edit')->with([
            'pageTitle' => "Edit Products",
            'product' => $product,
            'categories' => $categories,
            'currencies' => $currencies
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:255',
            'pv' => 'required|max:255|numeric',
        ];
        $this->validate($request, $rules);

        $product = Product::find($id);
        $product->name        = $request->name;
        $product->desc        = $request->description;
        $product->category_id = $request->category;
        $product->type        = $request->type;
        $product->pv          = $request->pv;
        $product->active      = $request->active;
        $product->sku         = $request->sku;

        //update image
        if($request->featured_image){
            $original_name = trim($request->featured_image->getClientOriginalName());
            $original_name = str_replace(".".$request->featured_image->extension(), "", $original_name);
            $imageName = time()."_".$original_name.'.'.$request->featured_image->extension();
            $request->featured_image->move(public_path('images/products'), $imageName);
            $product->image_url   = "/images/products/".$imageName;
        }
        $product->save();

        //update price
        $currencies = Currency::all();
        foreach ($currencies as $currency) {
            $code =$currency->code;
            $amount = $request->$code;
            $productPrice = ProductPrice::where('product_id',$product->id)->where('currency_id',$currency->id)->first();
            if ($productPrice === null) {
                $productPrice = new ProductPrice(['product_id' => $product->id ]);
                $productPrice->currency_id = $currency->id;
            }
            $productPrice->price       = $amount ;
            $productPrice->save();
        }

        //create product gallery
        $user_id = Auth::id();
        $count=0;
        if($request->image_gallery){
            foreach ($request->image_gallery as $galleryPic) {
                $count++;
                $imageName2 = $user_id."_".$count."_".time().'.'.$galleryPic->extension();
                $galleryPic->move(public_path('images/products'), $imageName2);
                $productImage = new ProductImage;
                $productImage->product_id = $product->id;
                $productImage->url = "/images/products/".$imageName2;
                $productImage->save();
            }
        }

        return redirect('admin/product')->with(['status'=>'Product Updated  successfully' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message="";
        $product = Product::find($id);
        if($product){
            $product->delete();
            $message="product deleted successfully";
        }
        return redirect('admin/product')->with(['status'=>$message]);
    }
}
