<template>

    <div>
        <select
            :name="name"
            id="countries"
            @change="select($event)"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg f w-full dark:text-black m-0.5 p-1.5"
            required
            >
            <option value="0">Choose a {{geography}}</option>
            <option

                    :selected="item.id==selectitem"
                    :key="item.id"
                    v-for="item in data"
                    :value="item.id"

                    >{{item.name}} </option>
        </select>

             <!-- <div v-if="'b_contry' in errors">
                <span class="text text-red-700 text-lg">{{errors.b_contry[0]}}</span>
             </div>
            </div>
             <div v-if="errors!=null">
             <div v-if="'b_state' in errors">
                <span class="text text-red-700 text-lg">{{errors.b_state[0]}}</span>
             </div>
            </div>
             <div v-if="errors!=null">
             <div v-if="'b_city' in errors">
                <span class="text text-red-700 text-lg">{{errors.b_city[0]}}</span>
             </div>
            </div> -->




    </div>

</template>
<script>
export default {
    data(){
        return{
            isselect:false
        }
    },
    props:{

        selectitem:{
            type:String,
            default:""
        },
        name:'',
        geography:String,
        data:{
            type:Array,
            default:[],
        }
    },

    methods:{
        select(event){
            var geography = event.target.value;
             this.$emit('selectstatus',geography);

        }
    },
}
</script>





