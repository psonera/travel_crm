<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\User;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\LeadManager;
use Illuminate\Http\Request;
use App\Models\QuotationItem;
use App\Http\Requests\quotation as RequestsQuotation;
use App\Models\City;
use App\Models\Country;
use App\Models\State;

class Quotationcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('quotations',Quotation::class);
        return view('quotation.index',["para"=>$request->subject]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create.quotations',Quotation::class);
        return view('quotation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsQuotation $request)
    {
        $this->authorize('store.quotations',Quotation::class);
        $quotation = new Quotation;
        $quotation->subject = $request->subject;
        $quotation->description = $request->description;
        $b_address = $request->billing_address;
        $b_postcod = $request->b_postcode;
        $b_contry = Country::find($request->b_contry)->name;
        $b_state = State::find($request->b_state)->name;
        $b_city= City::find($request->b_city)->name;
        $billing_address = json_encode(array("address"=>$b_address,"postcode"=>$b_postcod,
        "country"=>$request->b_contry,"country_name"=>$b_contry,
        "state"=>$request->b_state,"state_name"=>$b_state,
        'city'=>$request->b_city,'city_name'=>$b_city));
        $quotation->billing_address = $billing_address;
        $s_address = $request->shipping_address;
        $s_postcod = $request->s_postcode;
        $s_contry = Country::find($request->s_contry)->name;
        $s_state = State::find($request->s_state)->name;
        $s_city= City::find($request->s_city)->name;
        $shipping_address = json_encode(array("address"=>$s_address,"postcode"=>$s_postcod,
        "country_name"=>$s_contry,"country"=>$request->s_contry,
        "state_name"=>$s_state,"state"=>$request->s_state,
        'city_name'=>$s_city,"city"=>$request->s_city));
        $quotation->shipping_address = $shipping_address;
        $quotation->discount_percent = $request->discount;
        $quotation->discount_amount = $request->discount;
        $quotation->tax_amount = $request->tax;
        $quotation->sub_total = $request->subtotal;
        $quotation->grand_total = $request->grandtotal;
        $quotation->leadManager()->associate(LeadManager::find($request->r_lead_manager)) ;
        $quotation->user_id = $request->owner;
        $quotation->lead_id = $request->r_lead;
         $quotation->save();
        //quotation items
        if($request->has('name')){
            $itemid = $request->id;
            $item_name = $request->name;
            $item_quantity = $request->quntity;
            $item_price = $request->price;
            $total_of_items = $request->amount;
            $size = count($total_of_items);
            for($i=0;$i<$size;$i++){
                $quotationitem = new QuotationItem();
                $product = Product::find((integer)$itemid[$i]);
                $quotationitem->sku = $product->sku;
                $quotationitem->name = $item_name[$i];
                $quotationitem->quantity = $item_quantity[$i];
                $this->update_product_quantity($item_quantity[$i],$product);
                $quotationitem->price = $item_price[$i];
                $quotationitem->total = $total_of_items[$i];
                $quotationitem->coupon_code = "AFSD-DHFG-HSYD";
                $quotationitem->product_id = Product::find($itemid[$i])->id;
                $quotationitem->quotation()->associate($quotation);
                $quotationitem->save();
            }
        }
        return redirect(route('quotations.index'));

    }
    public function update_product_quantity($item_quantity,$product){
        $product_quantity = $product->quantity;
        $remaining_quantity = $product_quantity - $item_quantity;
        if($remaining_quantity <= 0){
            $remaining_quantity = 0;
        }
        $product->quantity = $remaining_quantity;
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view.quotations',Quotation::class);
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
        $this->authorize('update.quotations',Quotation::class);
        $quotation = Quotation::find($id);
        $items = $quotation->quotationItems;
        $billingaddress = $quotation->billing_address;
        return view('quotation.edit',['quotation'=>$quotation,'items'=>$items,'billingaddress'=>$billingaddress]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsQuotation $request, $id)
    {

        $quotation = Quotation::find($id);
        $quotation->subject = $request->subject;
        $quotation->description = $request->description;
        $b_address = $request->billing_address;
        $b_postcod = $request->b_postcode;
        $b_contry = Country::find($request->b_contry)->name;
        $b_state = State::find($request->b_state)->name;
        $b_city= City::find($request->b_city)->name;
        $billing_address =
        json_encode(array("address"=>$b_address,"postcode"=>$b_postcod,
        "country"=>$request->b_contry,"country_name"=>$b_contry,
        "state"=>$request->b_state,"state_name"=>$b_state,
        'city'=>$request->b_city,'city_name'=>$b_city));
        $quotation->billing_address = $billing_address;
        $s_address = $request->shipping_address;
        $s_postcod = $request->s_postcode;
        $s_contry = Country::find($request->s_contry)->name;
        $s_state = State::find($request->s_state)->name;
        $s_city= City::find($request->s_city)->name;
        $shipping_address = json_encode(array("address"=>$s_address,"postcode"=>$s_postcod,
        "country_name"=>$s_contry,"country"=>$request->s_contry,
        "state_name"=>$s_state,"state"=>$request->s_state,
        'city_name'=>$s_city,"city"=>$request->s_city));
        $quotation->shipping_address = $shipping_address;
        $quotation->discount_percent = $request->discount;
        $quotation->discount_amount = $request->discount;
        $quotation->tax_amount = $request->tax;
        $quotation->sub_total = $request->subtotal;
        $quotation->grand_total = $request->grandtotal;
        $quotation->lead_manager_id = $request->r_lead_manager;
        $quotation->user_id = $request->owner;
        $quotation->lead_id = $request->r_lead;
        $quotation->save();

        //quotation items
        if($request->has('name')){
            $itemid = $request->id;
            $item_name = $request->name;
            $item_quantity = $request->quntity;
            $item_price = $request->price;
            $total_of_items = $request->amount;
            $size = count($total_of_items);

                //deleting old items
                foreach($quotation->quotationItems as $item){
                        $item->delete();
                }
                // dd(["id"=>$request->id,"name"=>$request->name,"qunity"=>$request->quntity,"price"=>$request->price,"amount"=>$request->amount]);

                //end
                for($i=0;$i<$size;$i++){
                    $quotationitem = new QuotationItem();
                    $product = Product::find((integer)$itemid[$i]);
                    $quotationitem->sku = $product->sku;
                    $quotationitem->name = $item_name[$i];
                    $quotationitem->quantity = $item_quantity[$i];
                    $this->update_product_quantity($item_quantity[$i],$product);
                    $quotationitem->price = $item_price[$i];
                    $quotationitem->total = $total_of_items[$i];
                    $quotationitem->coupon_code = "AFSD-DHFG-HSYD";
                    $quotationitem->product_id = Product::find($itemid[$i])->id;
                    $quotationitem->quotation()->associate($quotation);
                    $quotationitem->save();
                }

        }

        return redirect(route('quotations.index'));

    }

    /**
     * Remove the specifsied resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        $this->authorize('delete.quotations',Quotation::class);

        $quotation = Quotation::find($id);
        $q_items = $quotation->quotationItems;
        foreach($q_items as $q_item){
            $q_item->delete();
        }
        $quotation->delete();
         return  true;
    }

    //api
    public function totalquntity(Request $request){
        $id = $request->get('id');
        $product = Product::find($id);
        return response()->json(["quantity"=>$product->quantity]);
    }

    public function searchproduct(Request $request){

      $value = $request->get('query');
      $products = Product::where('name','like',"%$value%")->where('quantity','>',0)->get();
      $response = array();
      foreach($products as $product){
        $total = (float)$product->price * 1;
         $response[] = array("value"=>$product->id,"label"=>$product->name,'quantity'=>1,'price'=>$product->price,'total'=>$total);
      }
      echo json_encode($response);
      exit;
    }

    public function getNames(Request $request){
        $query = $request->get('query');
        $leadmanagers =  LeadManager::select('id','name')->where('is_lead_manager','1')->where('name','like',"%$query%")->take(5)->get('name');
        return response()->json($leadmanagers);
    }
    public function getLeadNames(Request $request){
        $query = $request->get('para');
        $leads =   Lead::select('id','title')->where('title','like',"%$query%")->limit(5)->get();
        return response()->json($leads);
    }
    public function getManagers(Request $request){
        $managers = User::select('id','name')->role('Manager')->get();
        return response()->json($managers);
    }
}
