<?php

namespace App\Http\Controllers;

use App\Exports\OutgoingExport;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Incoming;
use App\Models\Item;
use App\Models\Outgoing;
use App\Models\StockHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class OutgoingController extends Controller
{
    public function add_outgoing_item_page()
    {
        $item = Item::all();
        $outgoing = Outgoing::all();
        $brand = Brand::all();
        $customer = Customer::all();

        if ($item->isempty()) {
            $message = "no item is present, please input an item before accessing the \"outgoing\" or \"incoming\" page";
            session()->flash('no_item_outgoing', $message);

            $brand = Brand::all();
            return view('newItem', compact('brand'));
        } else {
            return view('outgoingItem', compact('outgoing', 'item', 'customer', 'brand'));
        }
    }

    public function reduceItemStock(Request $request) //OUTGOING, BARANG KELUAR
    {

        $userInfo = User::where('id', $request->userIdHidden)->first();
        $itemInfo = Item::where('id', $request->outgoingiditem)->first();

        $request->validate([
            'outgoingItemImage' => 'required|mimes:jpeg,png,jpg',
        ]);

        $newValue = $itemInfo->stocks - $request->itemReduceStock;

        Item::where('id', $request->outgoingiditem)->update([
            'stocks' => $newValue,
        ]);

        $outgoing = new Outgoing();

        $outgoing->customer_id = $itemInfo->customer_id;
        $outgoing->brand_id = $itemInfo->brand_id;
        $outgoing->item_id = $request->outgoingiditem;
        $outgoing->item_name = $itemInfo->item_name;
        $outgoing->stock_before = $itemInfo->stocks;
        $outgoing->stock_taken = $request->itemReduceStock;
        $outgoing->stock_now = $newValue;
        $outgoing->description = $request->outgoingItemDesc;

        $file = $request->file('outgoingItemImage');
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs('public/outgoingItemImage', $file, $imageName);
        $imageName = 'outgoingItemImage/' . $imageName;
        $outgoing->item_pictures = $imageName;
        $outgoing->picture_link = 'http://127.0.0.1:8000/storage/' . $imageName;
        $outgoing->save();



        $request->session()->flash('sukses_reduceStock', $itemInfo->item_name);

        $history = new StockHistory();
        $history->item_name = $itemInfo->item_name;
        $history->stock_before = $itemInfo->stocks;
        $history->stock_added = 0;
        $history->stock_taken = $request->itemReduceStock;
        $history->stock_now = $newValue;
        $history->user_who_did = $userInfo->name;

        $history->save();


        return redirect('manageItem');
    }

    public function exportOutgoingCustomer(Request $request)
    {
        $customer = Customer::find($request->customerIncoming);
        $date_from = Carbon::parse($request->startRange)->startOfDay();
        $date_to = Carbon::parse($request->endRange)->endOfDay();

        $sortCustomer = Outgoing::all()->where('customer_id', $request->customerIncoming)->whereBetween('created_at', [$date_from, $date_to]);
        $formatFileName = 'DataBarangKeluar Customer ' . $customer->customer_name . ' ' . date_format($date_from, "d-m-Y") . ' hingga ' . date_format($date_to, "d-m-Y");

        return Excel::download(new OutgoingExport($sortCustomer), $formatFileName . '.xlsx');
    }
}