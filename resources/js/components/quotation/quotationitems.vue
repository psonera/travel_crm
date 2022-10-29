<template>
<div >

         <label class="label p-2 font-semibold text-gray-700">Quotation Item</label>
       <div>
         <div class="flex">
            <table class="border-separate border-spacing-2  border-slate-500 flex-1">
            <thead>
                <tr>
                    <th class="inline-flex justify-center px-4 py-2 bg-red-600  text-white text-sm font-medium rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg></th>
                    <th class="border border-slate-600  bg-gray-500 text-white  rounded">Product</th>
                    <th class="border border-slate-600 rounded bg-gray-500 text-white rounded">Quntity</th>
                    <th class="border border-slate-600 rounded bg-gray-500 text-white rounded">Price</th>
                    <th class="border border-slate-600 rounded bg-gray-500 text-white rounded">total</th>
                </tr>
            </thead>
            <tbody>
             <quotationitemrow
                v-for='(product, index) in products'
                :product="product"
                :key=index
                :index=index
                @onRemoveProduct="removeProduct($event)"
                :errors="errors"
            >
             </quotationitemrow>

            </tbody>
                <button @click.prevent="addRow" class="inline-flex items-center justify-center w-10 h-10 mr-2 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800 border m-1">
                  <svg class="w-5 h-4 mx-2 fill-current" viewBox="0 0 20 20"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                </button>
            <tfoot>
            </tfoot>
        </table>
        </div>
        <div style=" ;
        display: flex;
        flex-direction: row-reverse">
            <table class="flex-row-revers">
                <tr>
                    <td class="text-gray-500 font-bold">SubTotal</td>
                    <td class="text-gray-500 font-bold">-</td>
                    <td>
                        <div class="form-group">
                            <input  class="border border-slate-700 w-full rounded p-1"  type="number" name="subtotal"
                            :value="subTotal" readonly >
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="text-gray-500 font-bold">Discount Amount (%)</td>
                    <td class="text-gray-500 font-bold">-</td>
                    <td>
                        <div class="form-group">
                            <input  class="border border-slate-700 w-full rounded p-1" type="number" step=any name="discount"
                            v-model="discountAmount" >
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="text-gray-500 font-bold">Tax Amount(%)</td>
                    <td class="text-gray-500 font-bold">-</td>
                    <td>
                        <div class="form-group">
                            <input class="border border-slate-700 w-full rounded p-1"  type="number" name="tax"  step=any  v-model="taxAmount" >
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="text-gray-500 font-bold">Grand Total</td>
                    <td class="text-gray-500 font-bold">-</td>
                    <td>
                        <div class="form-group">
                            <input type="number" class="border border-slate-700 w-full rounded p-1"  name="grandtotal"  :value="grandTotal" readonly >
                        </div>
                    </td>
                </tr>
            </table>
        </div>
       </div>
</div>

</template>

<script>
import quotationitemrow from './quotationitemrow.vue'
export default {
    components:{quotationitemrow},
     props:{
        items:{
            type:Array,
            default:[]
        },
        discount:{
            type:String,
            default:''
        },
        tax:{
            type:String,
            default:''
        },
        oldvalue:{
            type:Object,
            default:''
        },errors:{
            type:Object,default:''
        }

    },
    created(){
        if(this.oldvalue!=''){
            if("id" in this.oldvalue){
                if(this.oldvalue.id.length > 0){
                    var length = this.oldvalue.id.length;
                    var self = this
                    for (let index = 0; index < length; index++) {
                        this.products.push({
                            'id': self.oldvalue.id[index],
                            'product_id': self.oldvalue.id[index],
                            'name': self.oldvalue.name[index],
                            'oldname': self.oldvalue.oldname[index],
                            'quantity': self.oldvalue.quntity[index],
                            'price': self.oldvalue.price[index],
                        })

                    }
                }
            }

            this.discountAmount = this.oldvalue.discount;
            this.taxAmount = this.oldvalue.tax;

        }
    },
    data(){
        return{
            discountAmount: 0,
            taxAmount:0,
            products: [],
            itemoldvalue:[],
            itemerrors:[]
        }
    },
      computed: {
                subTotal:  function() {
                    var total = 0;

                    this.products.forEach(product => {
                        total += parseFloat(product.price * product.quantity);
                    });

                    return total;
                },

                grandTotal: function() {
                    var total = 0;

                    this.products.forEach(product => {
                        total += parseFloat(product.price * product.quantity) ;
                    });
                    var discount = total - (total * parseFloat((this.discountAmount)/100));
                    total = discount + (discount *  parseFloat((this.taxAmount)/100));
                    return total;
                }
            },
    methods:{

        addRow() {
            this.products.push({
                'id': null,
                'product_id': null,
                'name': '',
                'oldname':'',
                'quantity': 0,
                'available':0,
                'price': 0,

            })

        },
       removeProduct: function(product) {
            const index = this.products.indexOf(product);
            this.products.splice(index, 1);
        },
         totalQuantity(id){
          axios.get('/quotations/totalquntity',{params: {id: id}}).
            then(response => {
                this.totalquantity = response.data.quantity;
        })
    }


    },mounted(){

      if(this.items.length > 0){

            if(this.oldvalue!=''){

               if("id" in this.oldvalue){
                    var length = this.oldvalue.id.length;
                    var self = this
                    this.products = [];
                    for (let index = 0; index < length; index++) {
                        this.products.push({
                            'id': self.oldvalue.id[index],
                            'product_id': self.oldvalue.id[index],
                            'name': self.oldvalue.name[index],
                            'oldname':self.oldvalue.oldname[index],
                            'quantity': self.oldvalue.quntity[index],
                            'price': self.oldvalue.price[index],
                        })
                    }
                    this.discountAmount = this.oldvalue.discount;
                    this.taxAmount = this.oldvalue.tax;
               }
            }else{
                var self = this;
                for(var i=0;i<this.items.length;i++){
                    this.products.push({
                        'id': self.items[i].product_id,
                        'product_id': self.items[i].product_id,
                        'name': self.items[i].name,
                        'oldname':1,
                        'quantity': self.items[i].quantity,
                        'price': self.items[i].price,
                    })
                }


                this.discountAmount = this.discount;
                this.taxAmount = this.tax;
            }
      }else{

        if(this.oldvalue !=''){
            if("id" in this.oldvalue){
                var length = this.oldvalue.id.length;
                var self = this
                this.products = []
                for (let index = 0; index < length; index++) {
                    this.products.push({
                        'id': self.oldvalue.id[index],
                        'product_id': self.oldvalue.id[index],
                        'name': self.oldvalue.name[index],
                        'oldname':self.oldvalue.oldname[index],
                        'quantity': self.oldvalue.quntity[index],
                        'price': self.oldvalue.price[index],
                    })

                }
                this.discountAmount = this.oldvalue.discount;
                this.taxAmount = this.oldvalue.tax;
            }
        }else{

        }
      }

      //For item errors
       if(this.errors!=''){
         this.itemerrors = Object.keys(this.errors);
       }
    },


}
</script>

<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>




