<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\StoreDepartment;
use App\Models\StoreInventory;
use App\Models\StoreInvoice;
use App\Models\StoreItemLot;
use App\Models\StoreItemType;
use App\Models\StoreMaterialRequest;
use App\Models\StoreProduct;
use App\Models\StoreReturnLog;
use App\Models\StoreVendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StoreController extends Controller
{
    public function dashboard(Request $request)
    {
        $data['departments'] = Department::all();
        $data['store_departments'] = StoreDepartment::all();
        $data['item_types'] = StoreItemType::all();
        //        requests
        $data['requests'] = StoreMaterialRequest::with('product.inventory')->where('status', '=', 'pending')->get();
        if ($request->item_type) {
            $data['products'] = StoreProduct::with('inventory')->where('item_type_id', $request->item_type)->get();
        } elseif ($request->department) {
            $data['products'] = StoreProduct::with('inventory')->where('department_id', $request->department)->get();
            //            dd($data['products']);
        }
        //        for each product in store product, compare if low_inventory is larger than store_inventories.quantity
        $lowInventory = StoreProduct::with('inventory')->get();
        $data['lowInventory'] = [];
        foreach ($lowInventory as $item) {
            if ($item->low_inventory > $item->inventory->quantity) {
                $data['lowInventory'][] = $item;
            }
        }


        return view('store.dashboard', $data);
    }

    public function inventory(Request $request)
    {
        $data['store_departments'] = StoreDepartment::all();
        $data['item_types'] = StoreItemType::all();
        if ($request->id) {
            $data['products'] = StoreProduct::with('inventory', 'vendor')->where('id', $request->id)->get();
        } elseif ($request->name) {
            $data['products'] = StoreProduct::with('inventory', 'vendor')->where('name', 'like', '%' . $request->name . '%')->get();
        }
        $data['vendors'] = StoreVendor::all();

        return view('store.inventory', $data);
    }

    public function addNewProduct(Request $request)
    {
        //        dd($request->all());
        $request->validate([
            'department_id' => 'required',
            'item_type_id' => 'required',
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        if ($request->quantity < 0) {
            Alert::toast('Quantity cannot be negative', 'error')->width('345px');
            return redirect()->back()->with('error', 'Quantity cannot be negative');
        }
        if ($request->price < 0) {
            Alert::toast('Price cannot be negative', 'error')->width('345px');
            return redirect()->back()->with('error', 'Price cannot be negative');
        }

        try {
            DB::beginTransaction();
            $newProduct = StoreProduct::create([
                'department_id' => $request->department_id,
                'item_type_id' => $request->item_type_id,
                'name' => $request->name,
                'price' => $request->price,
                'vendor_id' => $request->vendor_id,

            ]);
            StoreInventory::create([
                'product_id' => $newProduct->id,
                'quantity' => $request->quantity,
            ]);
            DB::commit();
            Alert::toast('Product added successfully', 'success')->width('345px');
            return redirect()->back()->with('success', 'Product added successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('345px');
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function updateProduct(Request $request)
    {
        //        dd($request->all());


        if ($request->quantity < 0) {
            Alert::toast('Quantity cannot be negative', 'error')->width('345px');
            return redirect()->back()->with('error', 'Quantity cannot be negative');
        }

        try {
            $productData = StoreProduct::where('id', $request->id)->first();
            DB::beginTransaction();

            $updateInventory = StoreInventory::where('product_id', $request->id)->first();
            $updateInventory->quantity += $request->quantity;
            $updateInventory->save();

            $addLot = new StoreItemLot();
            $addLot->store_product_id = $request->id;
            $addLot->quantity = $request->quantity;
            $addLot->lot_number = $productData->product_id;
            if ($request->expire_date) {
                $addLot->expiry_date = $request->expire_date;
                $addLot->has_expiry_date = 1;
            }
            $addLot->price = $request->price;
            $addLot->save();
            $addLot->lot_number = $productData->product_id . '-' . $addLot->id;
            $addLot->save();


            DB::commit();
            Alert::toast('Product updated successfully', 'success')->width('345px');
            return redirect()->back()->with('success', 'Product updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('345px');
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function department()
    {
        $data['departments'] = StoreDepartment::all();
        $data['item_types'] = StoreItemType::with('department')->get();
        return view('store.department', $data);
    }

    public function summary()
    {

        return view('store.summary');
    }

    public function getItemType($id)
    {
        //        dd($id);
        $item_types = StoreItemType::where('department_id', $id)->get();
        return response()->json($item_types);
    }

    public function getItem($id)
    {
        $products = StoreProduct::where('item_type_id', $id)->get();
        return response()->json($products);
    }

    public function addRequestItem(Request $request)
    {
        //    dd($request->all());
        $request->validate([
            'requested_from' => 'required',
            'department' => 'required',
            'item_type' => 'required',
            'item' => 'required',
            'quantity' => 'required',
        ]);

        try {
            StoreMaterialRequest::create([
                'product_id' => $request->item,
                'quantity' => $request->quantity,
                'requested_from' => $request->requested_from,
                'updated_by' => auth()->user()->id,
            ]);
            Alert::toast('Item added successfully', 'success')->width('345px');
            return redirect()->back()->with('success', 'Item added successfully');

        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('345px');
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function purchasedProducts()
    {
        return view('store.purchased-products');
    }

    public function purchasedInvoice(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();

            foreach ($request->products as $item) {
                $product = StoreInventory::where('product_id', $item['primary_id'])->first();
                $product->update([
                    'quantity' => $product->quantity - $item['quantity'],
                ]);

            }
            //            store invoices
            $createInvoice = new StoreInvoice();
            $createInvoice->invoice_no = 'INV' . Carbon::now()->format('YmdHis');
            $createInvoice->name = $request->customer['name'];
            $createInvoice->phone = $request->customer['phone'];
            $createInvoice->address = $request->customer['address'];
            $createInvoice->products = json_encode($request->products);
            $createInvoice->created_by = auth()->user()->id;
            $createInvoice->total_bill = $request->total;
            $createInvoice->save();
            //
            $products = $request->input('products', []);

            $customer = $request->customer;
            // dd($customer);
            $totalPrice = 0;
            foreach ($products as $product) {
                $name = $product['name'];
                $productId = $product['id'];
                $quantity = $product['quantity'];
                $price = $product['price'];
                $total = $product['total'];
                $totalPrice = $totalPrice + $total;
            }
            $data['products'] = collect($products);
            $data['totalPrice'] = $totalPrice;
            $data['customer'] = $customer;


            $pdfFileName = 'product-invoice-' . Carbon::now()->format('YmdHis') . '.pdf';
            $pdf = PDF::loadView('store.product-invoicePDF', $data)->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);
            DB::commit();

            Alert::toast('Invoice created successfully', 'success')->width('345px');
            return $pdf->stream($pdfFileName);
        } catch (\Exception $e) {
            DB::rollBack();
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('345px');
            return redirect()->back()->with('error', 'Something went wrong');
        }
        //
    }

    public function responseToRequest(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'status' => 'required',
        ]);

        try {
            StoreMaterialRequest::findOrFail($request->id)->update([
                'status' => $request->status,
                'updated_by' => auth()->user()->id,
            ]);

            Alert::toast('Response sent successfully', 'success')->width('345px');
            return redirect()->back()->with('success', 'Response sent successfully');

        } catch (\Exception $e) {
            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('345px');
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function addDepartment(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            StoreDepartment::create([
                'name' => $request->name,
            ]);
            Alert::toast('Department added successfully', 'success')->width('345px');
            return redirect()->back()->with('success', 'Department added successfully');

        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('345px');
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    public function updateDepartment(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        try {
            StoreDepartment::findOrFail($request->id)->update([
                'name' => $request->name,
            ]);
            Alert::toast('Department updated successfully', 'success')->width('345px');
            return redirect()->back()->with('success', 'Department updated successfully');

        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('345px');
            return redirect()->back()->with('error', 'Something went wrong');

        }
    }

    public function deleteDepartment(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        try {
            StoreDepartment::findOrFail($request->id)->delete();
            Alert::toast('Department deleted successfully', 'success')->width('345px');
            return redirect()->back()->with('success', 'Department deleted successfully');

        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('345px');
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function addItemType(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'name' => 'required',
        ]);

        try {
            StoreItemType::create([
                'department_id' => $request->department_id,
                'name' => $request->name,
            ]);
            Alert::toast('Item type added successfully', 'success')->width('345px');
            return redirect()->back()->with('success', 'Item type added successfully');

        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('345px');
            return redirect()->back()->with('error', 'Something went wrong');

        }
    }

    public function updateItemType(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'department_id' => 'required',
        ]);

        try {
            StoreItemType::findOrFail($request->id)->update([
                'name' => $request->name,
                'department_id' => $request->department_id,
            ]);
            Alert::toast('Item type updated successfully', 'success')->width('345px');
            return redirect()->back()->with('success', 'Item type updated successfully');

        } catch (\Exception $e) {
            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('345px');
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function deleteItemType(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        try {
            StoreItemType::findOrFail($request->id)->delete();
            Alert::toast('Item type deleted successfully', 'success')->width('345px');
            return redirect()->back()->with('success', 'Item type deleted successfully');

        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('345px');
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function searchProduct(Request $request)
    {
        $query = $request->input('query');
        $results = StoreProduct::where('name', 'LIKE', "%{$query}%")
            ->orWhere('product_id', 'LIKE', "%{$query}%")
            ->get();
        return response()->json($results);
    }

    public function getProductData($id)
    {
        $product = StoreProduct::with('inventory')->where('id', $id)->first();
        return response()->json($product);
    }

    public function returnProductView()
    {
        $data['returnedProducts'] = StoreReturnLog::with('department')->get();
        $data['departments'] = Department::all();
        return view('store.return-product', $data);
    }

    public function returnProduct(Request $request)
    {
        try {
            DB::beginTransaction();
            $returnProduct = new StoreReturnLog();
            $returnProduct->product_id = $request->product_id;
            $returnProduct->quantity = $request->quantity;
            $returnProduct->department_id = $request->department_id;
            $returnProduct->reason = $request->reason;
            $returnProduct->return_date = Carbon::now();
            $returnProduct->save();
            DB::commit();
            Alert::toast('Product returned successfully', 'success')->width('345px');
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('345px');
            return redirect()->back();
        }
    }

    public function indentView()
    {
        $data['products'] = StoreProduct::all();
        return view('store.indent', $data);
    }

    public function indentStore(Request $request)
    {
//        dd($request->all());

        $data['date'] = $request->date;

        $productIds = collect($request->products)->pluck('name');

        $products = StoreProduct::whereIn('id', $productIds)->get();

        $dataToSave = [];

        foreach ($request->products as $item) {
            $product = $products->where('id', $item['name'])->first();

            if ($product) {
                $dataToSave[] = [
                    'name' => $product->name,
                    'quantity' => $item['quantity'],
                ];
            }
        }
        $data['products'] = $dataToSave;
        $data['generatedBy'] = auth()->user()->name;
//        dd($data);

        $pdfFileName = 'quotation-' . Carbon::now()->format('YmdHis') . '.pdf';
        $pdf = PDF::loadView('store.store-indent-list-pdf', $data)->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream($pdfFileName);
    }

    public function indentListView()
    {
        return view('store.indent-list-view');
    }


}
