<template>
    <product-item
        v-for='(product, index) in products'
        :product="product"
        :key="index"
        :index="index"
        @onRemoveProduct="removeProduct($event)"
    ></product-item>

    <button class="font-bold text-center text-blue-500" type="button" @click.prevent="addProduct">+ Add Product</button>
</template> 

<script>
import  ProductItem  from './ProductItem.vue'

export default ({
    components: {
        ProductItem
    },
    props: {
        data: {
            type: String,
            default: () => ({})
        },
    },

    data() {
        return {
            products: this.data ? JSON.parse(this.data) : [],
        }
    },

    methods: {
        addProduct: function() {
            this.products.push({
                'id': null,
                'product_id': null,
                'name': null,
                'quantity': null,
                'price': null,
                'amount': null,
            })
        }, 

        removeProduct: function(product) {
            const index = this.products.indexOf(product);
            
            this.products.splice(index, 1);
        }
    }
})
</script>
