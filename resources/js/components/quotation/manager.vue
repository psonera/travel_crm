<template>
    <label class="label p-2 font-semibold text-gray-700">Manager <span class="text-red-500">*</span></label>
    <select name="owner" v-model="current_manager" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg f w-full dark:text-black m-0.5 p-1.5" required>
        <option value="0">Choose a Manager</option>
        <option v-for="(value,index) in data" :key="index" :value="value.id">{{value.name}}</option>
    </select>
</template>
<script>
import axios from 'axios';
export default {
    data(){
        return{
            data:[],
            current_manager:''
        }
    },
    props:{
        manager:{
            type:String,
            default:''
        },
        old_value:{
            type:String,
            default:''
        }
    },
    methods:{
        managers(){
           axios.get('/quotations/managers').then(response=>{
                this.data = response.data;
           });
        }
    },
     mounted(){
        this.managers()
        if(this.manager!=''){
            if(this.old_value){
                this.current_manager = this.old_value;
            }else{
                this.current_manager = this.manager;
            }
        }else{
            if(this.old_value){
                this.current_manager = this.old_value;
            }else{
                this.current_manager = 0;
            }
        }

    },
}
</script>



