<template>
    <div>
        <label class="label p-2 font-semibold text-gray-700">Lead Name<span class="text-red-500">*</span></label>

        <input
        name="lead"
        type="text"
        :class="tclass"
        v-model="query"
        @keyup="autocomp"
        @change="valid_value=''"
        autocomplete="off"
        />

        <ul class="rounded border border-gray-300 divide-y divide-blue-200 " v-if="data.length">
            <li
                v-for="name in data"
                :key="name.id"
                class="hover:bg-gray-200 hover:cursor-pointer p-1"
                @click="select(name)">{{name.title}}
            </li>
        </ul>
        <div class="rounded border border-gray-300 divide-y divide-blue-200 " v-if="has_data">
            No Data available
        </div>
    </div>
     <input hidden type="text" name="r_lead" v-model="valid_value">

</template>
<script>
import axios from 'axios'
    export default {
         props:{
            lead:{
                type:String,
                default:''
            },
             oldvalue:{
                type:Object,
                default:''
            }
        },
         data(){
            return {
                tclass:'text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow',
                query:'',
                valid_value:'',
                data:[],
                has_data:false,
            }
        },  mounted() {
            if(this.lead !=''){
                var lead = JSON.parse(this.lead);
                 this.query = lead.title;
                 this.valid_value = lead.id;
            }
            if(this.oldvalue!=''){
                if('lead' in this.oldvalue){
                    this.query = this.oldvalue.lead
                }
                if('r_lead' in this.oldvalue){
                    this.valid_value = this.oldvalue.r_lead
                }
                // this.query = this.oldvalue.Lead
                // if(this.oldvalue.oldvalue!=null){
                //     this.valid_value = this.oldvalue['oldlead']
                // }
            }
        },
        methods:{
            autocomp(){
                this.data = [];
                if(this.query.length>=2){
                    axios.get('/quotations/leadnames',{params: {para: this.query}}).
                        then(response => {
                            this.data = response.data;
                            if(this.data.length==0){
                                this.has_data = true;
                            }else{
                                this.has_data = false;
                            }
                    });
                }
            },
            select(name){
                this.query = name.title;
                this.valid_value = name.id;
                this.data = [];
            },

        },

    }
</script>
