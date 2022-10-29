<template>
    <tr>
        <td class="align-top"  @click.prevent="removeProduct">
            <button class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </td>
        <td>
            <input
                type="text"
                name="name[]"
                v-model="product['name']"
                v-on:keyup="search"
                @input="namechnage"
                class="border border-slate-700 w-full rounded p-1 placeholder:text-gray-500 mb-0.5 mt-0.5"
                :readonly="item.length > 0"
                placeholder="Search Product"
            />
             <div class="rounded border border-gray-300 divide-y divide-blue-200 " v-if="has_product">
                No Data available
            </div>
            <input hidden  type="text" name="oldname[]" v-model="product['oldname']">
            <div v-if="state==''&& product">
                <ul  class="rounded border border-gray-300 divide-y divide-blue-200" v-if="products.length">
                        <li
                        v-for="(product,index) in products "
                        :key="index"
                        class="hover:bg-gray-200 hover:cursor-pointer p-1 "
                        @click="addProduct(product)" >
                        <span>{{product.label}}</span>
                    </li>
                </ul>

                <div v-if="this.errors!=null">
                    <div v-if="Object.keys(this.errors).some(key => key === 'oldname.'+index)">
                        <span class="text text-red-300 text-lg">You Might Have done One Of This</span> <br/>
                        <span class="text text-red-700 text-lg"><strong>Item Must selected from suggestions</strong></span> <br/>
                        <span class="text text-red-700 text-lg"><strong>You May Have Enter Wrong Quantity</strong></span> <br/>

                    </div>
                </div>
            </div>

        </td>
            <input
            type="hidden"
            name="id[]"
            v-model="product.id"
        />
        <td class="align-top">
            <div class="border border-slate-700 flex rounded">
                <input
                    type="number"
                    name="quntity[]"
                    @input="quntitychange"
                    v-model="product.quantity"
                    class=" w-full rounded p-1" />
                    <span class="bg-gray-500 text-white  font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-0.5 mt-0.5 ease-linear transition-all duration-150" type="button">
                        {{totalQuantity-product.quantity <= 0 ? 0 : totalQuantity}}
                        </span>
            </div>
                    <div v-if="upper_limit">
                        <span class="text text-red-700 text-lg">Product Not Available</span>
                    </div>
                    <div v-if="lower_limit">
                        <span class="text text-red-700 text-lg">Product <strong>Quantity Must  > 0</strong></span>
                    </div>
        </td>
        <td class="align-top">
            <input
                type="number"
                name="price[]"
                v-model="product.price"
                class="border border-slate-700 w-full rounded p-1 mb-0.5 mt-0.5"   readonly/>
        </td>

        <td class="align-top">
            <input
                type="number"
                name="amount[]"
                v-model="amount"
                class="border border-slate-700 w-full rounded p-1 mb-0.5 mt-0.5"   readonly/>
        </td>
                <!-- <input type="hidden" name="amount[]" v-model="amount" /> -->

    </tr>
</template>
<script>
import axios from 'axios';
export default {
data(){
    return{
        state:'',
        products: [],
        validvalue:'',
        total:0,
        min:0,
        is_quantity_change:false,
        is_name_change:false,
        upper_limit:false,
        lower_limit:false,
        has_product:false,

    }

},
props:{
    item:{
        type:Array,
        default:[]
    },
    index:Number,
    product: {type:Object,default:''},
    errors:{
        type:Object,
        default:''
    }
},
computed: {
        amount(){
            return this.product.price * this.product.quantity;
        },
        totalQuantity(){

           if(this.product.id!=null){
            axios.get('/quotations/totalquntity',{params: {id: this.product.id}}).
                then(response => {
                 this.total = response.data.quantity;
            })
            return this.total;
           }
        }
    },
methods:{
    search(){
        this.state = '';
        var self = this;
       if(this.product['name'].length >=2){
        axios.get('/quotations/search',{params: {query: this.product['name']}}).
            then(response => {
                 self.$parent.products.forEach(function(addProduct){
                    response.data.forEach(function(product,index){
                        if (product.value == addProduct.product_id) {
                            response.data.splice(index, 1);
                        }
                    });
                 });
                self.products = response.data;
                if(self.products.length==0){
                    self.has_product = true;
                }else{
                    self.has_product = false;
                }
        })
       }
    },
    addProduct(result){
        this.state = 'old'
        this.lower_limit = false;
        this.product.product_id = result.value;
        this.product.id = result.value;
        this.product.name = result.label;
        if(this.is_quantity_change){
            this.product.oldname = '';
        }else{
            this.product.oldname = 1;
        }
        this.product.oldname = 1;
        this.product.price = result.price;
        this.product.quantity = result.quantity;
        this.is_name_change = false
        this.is_quantity_change = false;


    }
    ,
    removeProduct(){
        // alert(index);
        this.$emit('onRemoveProduct', this.product);
    },
    quntitychange(){

        if(this.product.quantity > this.totalQuantity){
            setTimeout(()=>{
                this.product.oldname = '';
                this.upper_limit = true;
                this.lower_limit = false;
            },100);
        }
        if(this.product.quantity < this.totalQuantity && this.is_name_change){
            setTimeout(()=>{
                this.product.oldname = '';
                this.upper_limit = true;
                this.lower_limit = false;
            },100);
        }
         if(this.product.quantity < this.totalQuantity){
             this.product.oldname = 1;
             this.upper_limit = false;
             this.lower_limit = false;
        }
        if(this.product.quantity <=0){
            this.product.quantity = 0;
            this.product.oldname = '';
            this.upper_limit = false;
            this.lower_limit = true;
        }
        if(this.totalQuantity-this.product.quantity<=0){
            this.product.quantity = 1;
             this.product.oldname = '';
            this.upper_limit = true;
            this.lower_limit = false;
        }
        this.is_quantity_change = true;

    } ,
    namechnage(){

        this.$parent.products[this.index].product_id = '';
        this.product.product_id='';
        this.product.oldname=''
        this.is_name_change = true;
    }
},
mounted(){

    if(this.item.length > 0){
        this.state = 'old'
        this.product.product_id = this.item[0].id;
        this.product.id = this.item[0].id;
        this.product.name = this.item[0].name;
        this.product.price = this.item[0].price;
        this.product.quantity = this.item.quantity;
    }

    },

}
</script>

