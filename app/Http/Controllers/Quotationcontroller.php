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
    public function create(Request $request)
    {
        $this->authorize('create.quotations',Quotation::class);

        $lead = null;
        if($request->has('lead_id')){

            if(Lead::find($request->lead_id)->quotations==null){
                if(Lead::find($request->lead_id)->exists()){
                    $lead = Lead::find($request->lead_id);
                }else{
                    $lead = null;
                }
            }else{
                return redirect(route('leads.view',Lead::find($request->lead_id)))->with('error','Quotation is all Ready Exists');
            }
        }
        return view('quotation.create',['lead'=>$lead]);
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
        $quotation->created_by = auth()->user()->id;
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
        if(auth()->user()->hasRole('lead-manager')){
            $quotation->leadManager()->associate(auth()->user()->id);
        }else{
            $quotation->leadManager()->associate(LeadManager::find($request->r_lead_manager)) ;
        }
        if(auth()->user()->hasRole('manager')){
            $quotation->user_id = auth()->user()->id;
        }else{
            $quotation->user_id = $request->owner;
        }
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
        return redirect(route('quotations.index'))->with('success','Quotation Created Successfully');;

    }
    public function update_product_quantity($item_quantity,$product){
        $product_quantity = $product->quantity;
        if($product_quantity > 0){
            $remaining_quantity = $product_quantity - $item_quantity;
            if($remaining_quantity <= 0){
                $remaining_quantity = 0;
            }
            $product->quantity = $remaining_quantity;
            $product->save();
        }else if($product_quantity < 0 ){
            $remaining_quantity = $product_quantity - ($item_quantity) ;
            $product->quantity = $remaining_quantity;
            $product->save();
        }

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
    public function update(RequestsQuotation $request, $id){

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
        if(auth()->user()->hasRole('lead-manager')){
            $quotation->leadManager()->associate(auth()->user()->id);
        }else{
            $quotation->leadManager()->associate(LeadManager::find($request->r_lead_manager)) ;
        }
        if(auth()->user()->hasRole('manager')){
            $quotation->user_id = auth()->user()->id;
        }else{
            $quotation->user_id = $request->owner;
        }
        $quotation->lead_id = $request->r_lead;
        $quotation->save();

        //quotation items
        if($request->has('name')){

            $itemid = $request->id;
            $item_name = $request->name;
            $item_quantity = $request->quntity;
            $item_price = $request->price;
            $total_of_items = $request->amount;

            //deleting old items
            $quotation_items_Array = [];
            foreach($quotation->quotationItems as $item){
                if(in_array($item->product_id,$itemid)){
                    //nothing to delete
                    $item_id =$item->id;
                    array_push($quotation_items_Array,$item_id);
                }else{
                    $product = Product::find($item->product_id);
                    $current_product_quantity =$product->quantity;
                    $current_item_quantity = $item->quantity;
                    $product->quantity = $current_product_quantity + $current_item_quantity;
                    $product->save();
                    //delete quotation item
                    $item->delete();
                }
            }
            //end

            $has_quotation_item = count($quotation->quotationItems) > 0 ? true: false;
            if($has_quotation_item){
                for ($i=0; $i < count($quotation_items_Array); $i++) {
                        $item = QuotationItem::find($quotation_items_Array[$i]);
                        $product_id_for_remove = $item->product_id;
                        $search_id = array_search($product_id_for_remove, $itemid);
                        $old_quantity = $item->quantity;
                        $new_quantity = $item_quantity[$search_id];
                        $diff = $new_quantity - $old_quantity;
                        $product = Product::find($product_id_for_remove);
                        $item->sku = $product->sku;
                        $item->name = $item_name[$search_id];
                        if($diff==0){
                            //no change in quantity
                        }else{
                            $item->quantity = $item_quantity[$search_id];
                            $this->update_product_quantity($diff,$product);
                        }
                        $item->total = $total_of_items[$search_id];
                        $item->coupon_code = "AFSD-DHFG-HSYD";
                        $item->quotation()->associate($quotation);
                        $item->save();

                        unset($itemid[$search_id]);
                        unset($item_name[$search_id]);
                        unset($item_quantity[$search_id]);
                        unset($item_price[$search_id]);
                        unset($total_of_items[$search_id]);
                }
            }

            $itemid = array_values($itemid);
            $item_name = array_values($item_name);
            $item_quantity = array_values($item_quantity);
            $item_price = array_values($item_price);
            $total_of_items = array_values($total_of_items);
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

        return redirect(route('quotations.index'))->with('success','Quotation Updated Successfully');
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
        return redirect(route('quotations.index'))->with('success','Quotation Deleted Successfully');
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
        $query = $request->get('lead');

        $leads = [];
        $results =   Lead::select('id','title')
        ->where('title','like',"%$query%")
        ->where('created_by',auth()->user()->id)
        ->orWhere('user_id',auth()->user()->id)
        ->orWhere('lead_manager_id',auth()->user()->id)
        ->limit(5)
        ->get();
        if($request->has('edit')){
            $leads = $results;
        }else{
            foreach($results as $result){
                if($result->quotations==null){
                    array_push($leads,$result);
                }
            }
        }
        return response()->json($leads);
    }
    public function getManagers(Request $request){
        $managers = User::select('id','name')->where('is_manager',1)->get();
        if(auth()->user()->hasRole('lead-manager')){
            $managers = User::select('id','name')->where('is_manager',1)->where('id',auth()->user()->authorize_person)->get();
        }
        return response()->json($managers);
    }
}
