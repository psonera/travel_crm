<template>
    <div>
        <legend class="label label-required pb-2 font-medium text-gray-700">Source<span class="text-red-500">*</span></legend>
        <select name="source" v-model="source" id="source" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg f w-full dark:text-black m-0.5 p-1.5">
            <option  :value=source.id v-for="(source,index) in social_media" :key="index" >{{source.name}}</option>
        </select>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    props:{
        selected_source:{
            type:String,
            default:'null'
        }
    },
    data(){
        return{
            social_media:[],
            source:'',
            default:'',
        }
    },
    methods:{
        getSources(){
            const self = this;
            // this.social_media = [];
            axios.get('/settings/users/getSources')
            .then(function(response){
                var flag = true;
                response.data.forEach(element => {
                    self.social_media.push(element);
                    if(self.selected_source=='' && flag){
                        self.source = element.id;
                        flag=false;
                    }

                });
            }).catch(function(error){
                alert(error.message);
            });
            if(this.selected_source!='null'){
                self.source = this.selected_source;
            }
        }
    },mounted(){
        this.getSources();

    }
}
</script>



















