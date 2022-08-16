<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\LeadManager;
use App\Models\QuotationItem;
use Illuminate\Http\Request;


class Quotationcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations = Quotation::all();
        return view('quotation.index',['quotations'=>$quotations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quotation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quotation = new Quotation;
        $quotation->subject = $request->subject;
        $quotation->description = $request->description;
        $quotation->billing_address = $request->billing_address;

        $quotation->shipping_address = $request->billing_address;

        $quotation->shipping_address = $request->shipping_address;

        $quotation->discount_percent = $request->discount;
        $quotation->discount_amount = $request->discount;
        $quotation->tax_amount = $request->tax;
        $quotation->adjustment_amount = 0;
        $quotation->sub_total = $request->subtotal;
        $quotation->grand_total = $request->grandtotal;
        $quotation->lead_manager_id = LeadManager::where('name',$request->person)->first()->id;
        $quotation->user_id = User::inRandomOrder()->first()->id;
        $quotation->save();
        //quotation items
        $itemid = $request->itemid;
        $itemname = $request->itemname;
        $itemquntity = $request->itemquntity;
        $itemprice = $request->itemprice;
        $totalofitems = $request->total;
        $size = count($totalofitems);
        for($i=0;$i<$size;$i++){
            $quotationitem = new QuotationItem();
            $quotationitem->sku = Product::find($itemid[$i])->sku;
            $quotationitem->name = $itemname[$i];
            $quotationitem->quantity = $itemquntity[$i];
            $quotationitem->price = $itemprice[$i];
            $quotationitem->total = $totalofitems[$i];
            $quotationitem->coupon_code = "AFSD-DHFG-HSYD";
            $quotationitem->product_id = Product::find($itemid[$i])->id;
            $quotationitem->quotation()->associate($quotation);
            $quotationitem->save();
        }


        return redirect(route('quotation.index'));

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
        $quotation = Quotation::find($id);
        return view('quotation.edit',['quotation'=>$quotation]);
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
        $quotation = Quotation::find($id);
        $quotation->subject = $request->subject;
        $quotation->description = $request->description;
        $quotation->billing_address = $request->billing_address;
        $quotation->shipping_address = $request->billing_address;
        $quotation->discount_percent = $request->discount;
        $quotation->discount_amount = $request->discount;
        $quotation->tax_amount = $request->tax;
        $quotation->adjustment_amount = 0;
        $quotation->sub_total = $request->subtotal;
        $quotation->grand_total = $request->grandtotal;
        $quotation->lead_manager_id = LeadManager::where('name',$request->person)->first()->id;
        $quotation->user_id = User::inRandomOrder()->first()->id;
        $quotation->save();

        //quotation items
        $itemid = $request->itemid;
        $qid = $request->qid;

        $itemname = $request->itemname;
        $itemquntity = $request->itemquntity;
        $itemprice = $request->itemprice;
        $totalofitems = $request->total;
        $size = count($totalofitems);

            //deleting old items
            foreach($quotation->quotationItems as $item){
                    $item->delete();
            }

            //end
        for($i=0;$i<$size;$i++){
            $quotationitem =new  QuotationItem;
            $quotationitem->sku = Product::find($itemid[$i])->sku;
            $quotationitem->name = $itemname[$i];
            $quotationitem->quantity = $itemquntity[$i];
            $quotationitem->price = $itemprice[$i];
            $quotationitem->total = $totalofitems[$i];
            $quotationitem->coupon_code = "AFSD-DHFG-HSYD";
            $quotationitem->product_id = Product::find($itemid[$i])->id;
            $quotationitem->quotation()->associate($quotation);
            $quotationitem->save();
        }

        return redirect(route('quotation.index'));

    }

    /**
     * Remove the specifsied resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('delete');
    }

    public function searchproduct(Request $request){

      $value = $request->value;

      $products = Product::where('name','like',"%$value%")->get();
      $response = array();
      foreach($products as $product){
        $total = (float)$product->price * 1;
         $response[] = array("value"=>$product->id,"label"=>$product->name,'quntity'=>1,'price'=>$product->price,'total'=>$total);
      }
      echo json_encode($response);
      exit;
    }
}
