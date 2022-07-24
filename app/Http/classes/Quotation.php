<?php

namespace App\Http\classes;

use App\Models\Quotation as ModelQuotation;

class Quotation{

    public function store($request){
        $quotation = new ModelQuotation();
        $quotation->subject = $request->subject;
        $quotation->description = $request->description;
    }
}
