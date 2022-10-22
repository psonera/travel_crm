<template>
    <div>
        <label class="label p-2 font-semibold text-gray-700">{{label}}<span class="text-red-500">*</span></label>
        <input
                name="lead_manager"
                type="text"
                :class="tclass"
                v-model="query"
                @keyup="autocom"
                @change="setempty"
                autocomplete="off"
                />
                <input hidden type="text" name="r_lead_manager" v-model="valid_value">
            <ul class="rounded border border-gray-300 divide-y divide-blue-200 " v-if="data.length">
                <li  v-for="name in data" :key="name.id" class="hover:bg-gray-200 hover:cursor-pointer p-1" @click="select(name)">{{name.name}}</li>
            </ul>
             <div class="rounded border border-gray-300 divide-y divide-blue-200 " v-if="has_data">
                No Data available
        </div>
    </div>

</template>

<script>
import axios from 'axios';
export default {
        props:{
            lead_manager:{
                type:String,
                default:''
            },
             oldvalue:{
                type:Object,
                default:''
            },
            label:{
                type:String,
                default: 'Lead Manager',
            }
        },
        data(){
            return {
                tclass:'text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow',
                query:'',
                data:[],
                valid_value:'',
                has_data:false,
            }
        },

        mounted(){
            if(this.lead_manager!=''){
                 var lead_manager = JSON.parse(this.lead_manager);
                 this.query = lead_manager.name;
                 this.valid_value = lead_manager.id;
            }
            if(this.oldvalue != ''){
                  if("lead_manager" in this.oldvalue){
                        console.log(this.oldvalue.lead_manager);
                        this.query = this.oldvalue.lead_manager;
                  }
                  if("r_lead_manager" in this.oldvalue){
                       this.valid_value = this.oldvalue.r_lead_manager;
                  }
            }
        },
        methods:{
            autocom(){
                this.names = [];
                if(this.query.length >= 2){
                    axios.get('/quotations/names',{params: {query: this.query}}).
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
                this.query = name.name;
                this.valid_value = name.id;
                this.data = [];
            },
            setempty(){
                this.valid_value = '';
            }
        },
}
</script>
