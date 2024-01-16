<?php

namespace App\Http\Controllers;

use App\Events\neworder;
use App\Models\{order, ordercustomdetail, orderdata};
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response([
            'orders' => order::all(),
            'message' => 'Retrieved successfully',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        // return ;

        $orderData = json_decode($request->orderData);
        $number = rand(100000, 999999);
        $order = new order;
        $order->order_no = $number;
        $order->order_date = date('Y-m-d');
        $order->user_id = $orderData->user->id;
        $order->product_id = $orderData->product_id;
        $order->product_orientation_id = $orderData->productOrientation;
        $order->product_size_id = $orderData->productSize;
        $order->product_sheet_id = $orderData->productSheet;
        $order->productpapers_id = $orderData->paperType;
        $order->productcovers_id = $orderData->productcover;
        $order->cover_type = $orderData->coverType;
        $order->coversupgrades_id = $orderData->productcoveroption;
        $order->coverupgradecolors_id = $orderData->productcolor;
        $order->coverfrontimg = storeFile($request, 'coverfrontphoto', '/order/coverfront/');
        $order->boxsleeve_id = $orderData->productboxSleev;
        $order->page_qty = $orderData->page_qty;
        $order->zone_id = $orderData->zone->id;
        $order->sheetValue = $orderData->sheetValue;
        $order->paperValue = $orderData->paperValue;
        $order->coverValue = $orderData->coverValue;
        $order->boxSleeveValue = $orderData->boxSleeveValue;
        $order->productValue = $orderData->orderTotale;
        $order->shippingValue = $orderData->zone->shipingcharge;
        $order->order_total = (int)$orderData->orderTotale += (int)$orderData->zone->shipingcharge;
        $order->is_sample = $orderData->isSample;
        $order->is_album_book_copy = $orderData->isPhotoBookCopy;
        $order->album_book_copy = $orderData->photoBookCopy;
        $order->discount = $orderData->discount;

        $order->save();
        // return $order;

        $ordercustomdetail = new ordercustomdetail;
        $ordercustomdetail->order_id = $order->id;
        $ordercustomdetail->event_type = $orderData->orderDetaild->eventType;
        $ordercustomdetail->event_name = $orderData->orderDetaild->eventName;
        $ordercustomdetail->event_date = $orderData->orderDetaild->eventDate;
        $ordercustomdetail->customizeMessage = $orderData->orderDetaild->costumizeMessage;
        $ordercustomdetail->Imprinting = $orderData->orderDetaild->printing;
        $ordercustomdetail->save();

        if ($orderData->orderDetaild->sourceType == 'Zip File') {
            # code...
            $orderdata = new orderdata;
            $orderdata->order_id = $order->id;
            $orderdata->sourcetype = $orderData->orderDetaild->sourceType;
            $orderdata->source_link = storeFile($request, 'photoszip', '/order/photos/');
            $orderdata->save();
        } else {
            # code...
            $orderdata = new orderdata;
            $orderdata->order_id = $order->id;
            $orderdata->sourcetype = $orderData->orderDetaild->sourceType;
            $orderdata->source_link = $orderData->orderDetaild->url;
            $orderdata->save();
        }

        $msg = "New order received from Customer: " . $orderData->user->name . "! Order ID: " . $number . ", Amount: " . $orderData->zone->currency_sign . " " . $order->order_total . "!";

        event(new neworder($msg));

        return response([
            'order' => $order,
            'message' => 'Order created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }

    public function statusUpdate(Request $request, $id)
    {
        $order = order::find($id);
        $order->order_status = $request->status;
        $order->save();

        return response([
        'order' => $order,
            'message' => 'Order status updated successfully',
        ]);
    }

    public function PaymentstatusUpdate(Request $request, $id)
    {
        $order = order::find($id);
        $order->payment_status = $request->status;
        $order->save();

        return response([
            'order' => $order,
            'message' => 'Order payment status updated successfully',
        ]);
    }
}
