<template >


        <textarea :name="txname"  v-model="address" id="message" class="max-h-full" :class="tclass" placeholder="Your Billing Address..."  ></textarea>
       <div>
            <div v-if="txname=='billing_address'">
                <div v-if="errors!=null">
                    <div v-if="'billing_address' in errors">
                        <span class="text text-red-700 text-lg">{{errors.billing_address[0]}}</span>
                    </div>
                </div>
            </div>
            <div v-if="txname=='shipping_address'">
                <div v-if="errors!=null">
                    <div v-if="'shipping_address' in errors">
                        <span class="text text-red-700 text-lg">{{errors.shipping_address[0]}}</span>
                    </div>
                </div>
            </div>
       </div>
        <div>
            <input :name="pinname" v-model="pincode" type="number" :class="tclass" class="mt-2" placeholder="Pin code" @input="change_number">
             <div>
                <div v-if="pinname=='b_postcode'">
                    <div v-if="errors!=null">
                        <div v-if="'b_postcode' in errors">
                            <span class="text text-red-700 text-lg">{{errors.b_postcode[0]}}</span>
                        </div>
                    </div>
                </div>
                <div v-if="pinname=='s_postcode'">
                    <div v-if="errors!=null">
                        <div v-if="'s_postcode' in errors">
                            <span class="text text-red-700 text-lg">{{errors.s_postcode[0]}}</span>
                        </div>
                    </div>
                </div>
                <div v-if="pincode_limit">
                     <span class="text text-red-700 text-lg">Required <strong>Only Six Digit</strong></span>
                </div>
             </div>
        </div>
</template>
<script>
export default {
props:{
        localaddress:{
            type:Object,
            default:null
        },
        oldvalue:{
            type:Object,
            default:''
        },
        tclass:String,
        txname:String,
        pinname:String,
        errors:Object
    },
    data(){
        return{
            address:'',
            pincode:'',
            pincode_limit:false,
        }
    },
  methods:{
        change_number(){
             if(this.pincode.toString().length > 6){
                this.pincode_limit = true;
            }else{
                this.pincode_limit = false;
            }
        }
    },

    mounted(){
        if(this.localaddress!=null){

            if(this.oldvalue == ''){
                this.address = this.localaddress.address;
                this.pincode = this.localaddress.postcode;
            }else{
                var keys = [];
                for(var key in this.oldvalue){
                    keys.push(key);
                }
                if(this.oldvalue!=null){
                    if(this.pinname=='b_postcode'){
                        if(keys.includes('b_city')){
                            this.address = this.oldvalue.billing_address;
                            this.pincode = this.oldvalue.b_postcode;
                        }
                    }
                    if(this.pinname=='s_postcode'){
                        if(keys.includes('s_city')){
                            this.address = this.oldvalue.shipping_address;
                            this.pincode = this.oldvalue.s_postcode;
                        }
                    }
                }
            }
        }else{
            if(this.oldvalue==''){

            }else{
                if(this.pinname=='b_postcode'){
                    if(keys.includes('b_city')){
                        this.address = this.oldvalue.billing_address;
                        this.pincode = this.oldvalue.b_postcode;
                    }
                }
                if(this.pinname=='s_postcode'){
                    if(keys.includes('s_city')){
                        this.address = this.oldvalue.shipping_address;
                        this.pincode = this.oldvalue.s_postcode;
                    }
                }
            }
        }


    }
}
</script>

