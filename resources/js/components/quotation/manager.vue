<template>
    <label class="label p-2 font-semibold text-gray-700">Manager <span class="text-red-500">*</span></label>
    <addressselect geography="Manager" :selectitem="currentmanager" name="owner" :data="data"></addressselect>
</template>
<script>
import addressselect from './AddressSelect.vue';
import axios from 'axios';
export default {
    components:{addressselect},
    data(){
        return{
            data:[],
            currentmanager:''
        }
    },
    props:{
        manager:{
            type:String,
            default:''
        },
        oldvalue:{
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
            if(this.oldvalue!=''){
                this.currentmanager = this.oldvalue;
            }else{
                this.currentmanager = this.manager;
            }
        }else{
            if(this.oldvalue!=''){
                this.currentmanager = this.oldvalue;
            }else{

            }
        }

    },



}
</script>



