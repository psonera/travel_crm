<template>
    <fieldset class="border border-solid border-gray-300 p-6 mb-8">
        <legend class="text-xxs pl-4 pr-4">Product {{ index + 1 }} </legend>

        <div class="mb-4 relative">
            <label class="label pb-2 font-medium text-gray-700" :for="[inputName + '[name]']">
                Item    
            </label>
            <span v-if="isRequired" class="text-red-500">*</span>
            <input 
                type="text" 
                :name="[inputName + '[name]']"
                v-model="product['name']"
                v-on:keyup="search"
                placeholder="Start typing title..." 
                class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
            />

            <input
                type="hidden"
                :name="[inputName + '[id]']"
                v-model="product.product_id"
            />
            <div v-if="state == ''">
                <ul class="bg-white absolute shadow border-gray-100 appearance-none block border border-gray-200 leading-normal rounded text-base text-gray-800 w-full z-990" v-if="products != ''">
                    <li v-for='(product, index) in products' class="p-2 cursor-pointer border-solid border-b border-gray last:border-b-0" @click="addProduct(product)" :key="index">
                        <span>{{ product.name }}</span>
                    </li>

                    <li v-if="! products.length && product['name'].length && ! is_searching">
                        <span class='text-left'>No results found!</span>
                    </li>
                </ul>
            </div>
            <!-- <p v-if="errors.has(inputName + '[product_id]')" class="text-red-600" role="alert">@{{ errors.first(inputName + '[product_id]') }}</p> -->
        </div>

        <div class="mb-4">
            <label class="label pb-2 font-medium text-gray-700" :for="[inputName + '[price]']">
                Price    
            </label>
            <input type="text" :name="[inputName + '[price]']" v-model="product.price" required autocomplete="price" class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" autofocus />
            <!-- <p v-if="errors.has(inputName + '[price]')" class="text-red-600" role="alert">@{{ errors.first(inputName + '[price]') }}</p> -->
        </div>

        <div class="mb-4">
            <label class="label pb-2 font-medium text-gray-700" :for="[inputName + '[quantity]']">
                Quantity    
            </label>
            <input type="text" :name="[inputName + '[quantity]']" v-model="product.quantity" required autocomplete="quantity" class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" autofocus />
            <!-- <p v-if="errors.has(inputName + '[quantity]')" class="text-red-600" role="alert">@{{ errors.first(inputName + '[quantity]') }}</p> -->
        </div>

        <div class="mb-4">
            <label class="label pb-2 font-medium text-gray-700" :for="[inputName + '[amount]']">
                Amount
            </label>
            <div class="flex">
                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-lg border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    <i class="fas fa-rupee-sign"></i>
                </span>
                <input type="text" :name="[inputName + '[amount]']" v-model="amount" class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-300 bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" disabled required autocomplete="amount" autofocus />
            </div>

            <input type="hidden" :name="[inputName + '[amount]']" v-model="amount" />
            <!-- <p v-if="errors.has(inputName + '[amount]')" class="text-red-600" role="alert">@{{ errors.first(inputName + '[amount]') }}</p> -->
        </div>

        <div class="float-right delete-item">
            <button type="button" @click="removeProduct" class="bg-red-500 p-2 -mt-48 rounded z-990 text-white text-xl delete-item"><i class="fa fa-trash"></i> Delete</button>
        </div>
    </fieldset>
</template>


<script>
export default {
    props: {
        index: Number,
        product: Object
    },

    data() {
        return {
            isRequired: true,

            is_searching: false,

            state: this.product['product_id'] ? 'old' : '',

            products: [],
        }
    },

    computed: {
        inputName: function () {
            if (this.product.id) {
                return "products[" + this.product.id + "]";
            }

            return "products[" + this.index + "]";
        },

        amount(){
            return this.product.price * this.product.quantity;
        }
    },

    methods: {
        search () {
            this.state = '';

            this.product['product_id'] = null;

            this.is_searching = true;

            if (this.product['name'].length < 2) {
                this.products = [];

                this.is_searching = false;

                return;
            }

            var self = this;
            
            this.$http.post("/leads/find_prd", {search: this.product['name']})
                .then (function(response) {
                    self.$parent.products.forEach(function(addedProduct) {
                        
                        response.data.forEach(function(product, index) {
                            if (product.id == addedProduct.product_id) {
                                response.data.splice(index, 1);
                            }
                        });

                    });

                    self.products = response.data;

                    self.is_searching = false;
                })
                .catch (function (error) {
                    self.is_searching = false;
                })
        },
        addProduct: function(result) {
            this.state = 'old';

            this.product.product_id = result.id;
            this.product.id = result.id;
            this.product.name = result.name;
            this.product.price = result.price;
            this.product.quantity = result.quantity;
        },

        removeProduct: function () {
            this.$emit('onRemoveProduct', this.product)
        }
    }
}
</script>