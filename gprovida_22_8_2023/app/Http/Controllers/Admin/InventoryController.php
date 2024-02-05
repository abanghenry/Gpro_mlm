<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductPurchase;
use App\Models\ProductSupplier;
use App\Models\ProductInventory;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{


    public function purchase()
    {
        $products = Product::with(['category'])->get();
        $suppliers = ProductSupplier::get();
        $stores = Store::where('main', '=', 1)->get(); // Main store only

        $purchases = ProductPurchase::withTrashed()->with(['product','supplier','store'])->get();
        return view('admin.inventory.purchase')->with([
            'pageTitle' => "purchases",
            'purchases' => $purchases,
            'products'=>$products,
            'suppliers'=>$suppliers,
            'stores'=>$stores,
        ]);
    }

    public function purchaseStore(Request $request)
    {
        $rules = [
        'product_id'    => 'required',
        'supplier_id'    => 'required',
        'store_id'    => 'required',
        'number_received'    => 'required',
        'purchase_date'    => 'required|date',
        ];
        $this->validate($request, $rules);

        $productPurchase                  = new ProductPurchase;
        $productPurchase->product_id      = $request->product_id;
        $productPurchase->supplier_id     = $request->supplier_id;
        $productPurchase->store_id        = $request->store_id;
        $productPurchase->number_received = $request->number_received;
        $productPurchase->purchase_date   = $request->purchase_date;
        $productPurchase->save();

        // update inventory
        $inventory = ProductInventory::firstOrNew([
            'product_id' => $request->product_id,
            'store_id' => $request->store_id,
        ]);

        if($inventory->isClean()){
            // Existing model
            $inventory->inventory_received += $request->number_received;
            $inventory->quantity += $request->number_received;
            $inventory->save();
        }else{
             //New
             $inventory->quantity            = $request->number_received;
             $inventory->starting_inventory  = 0;
             $inventory->inventory_received  = $request->number_received;
             $inventory->inventory_shipped   = 0;
             $inventory->minimum_required    = 0;
             $inventory->save();
        }
        return redirect('admin/inventory/purchase')->with(['status'=>'Purchase Added successfully' ]);

    }



    public function supplier()
    {
        $suppliers = ProductSupplier::get();
        return view('admin.inventory.supplier')->with([
            'pageTitle' => "Suppliers",
            'suppliers' => $suppliers,
        ]);

    }

    public function supplierStore(Request $request)
    {
        $rules = [
            'name'    => 'required|max:255|unique:product_suppliers',
            ];
        $this->validate($request, $rules);

        $supplier          = new ProductSupplier;
        $supplier->name    = $request->name;
        $supplier->desc    = $request->description;
        $supplier->save();
        return redirect('admin/inventory/supplier')->with(['status'=>'Supplier Added successfully' ]);
    }

    public function supplierEdit($id)
    {
        $supplier = ProductSupplier::find($id);
        return view('admin.inventory.supplier_edit')->with([
            'pageTitle' => "Suppliers",
            'supplier' => $supplier,
        ]);
    }

    public function supplierUpdate(Request $request, $id)
    {
       $rules = [
        'name'    => 'required|max:255|unique:product_suppliers,name,' . $id,
        ];
        $this->validate($request, $rules);

        $supplier = ProductSupplier::find($id);
        $supplier->name    = $request->name;
        $supplier->desc    = $request->description;
        $supplier->save();
        return redirect('admin/inventory/supplier')->with(['status'=>'Supplier Updated successfully' ]);
    }

    public function supplierDestroy($id)
    {
        $supplier = ProductSupplier::find($id);
        $supplier->delete();
        return redirect('admin/inventory/supplier')->with(['status'=>'Supplier Deleted successfully' ]);
    }




    public function transfer()
    {
        # code...
    }


}
