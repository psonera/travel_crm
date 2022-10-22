<template>
    <div>
    <label class="label p-1 font-semibold text-gray-700">Assign Manager <span class="text-red-500">*</span></label>
        <input hidden type="text" name="r_manager" v-model="validvalue">
        <input
                name="manager"
                type="text"
                :class="tclass"
                v-model="query"
                @keyup="autocom"
                @change="validvalue=''"
                autocomplete="off"
                required
                :placeholder="'start typing'+query"
                />
            <ul class="rounded border border-gray-300 divide-y divide-blue-200 " v-if="data.length">
                <li  v-for="manager in data" :key="manager.id" class="hover:bg-gray-200 hover:cursor-pointer p-1" @click="select(manager)">{{manager.name}}</li>
            </ul>
    </div>
</template>

<script>
import axios from 'axios';
export default {
      props:{
            manager:{
                type:String,
                default:'',
            }
        },
    data(){
        return {
            tclass:'text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow',
            query:'',
            data:[],
            validvalue:''
        }
    },

        methods:{

            autocom(){
                this.names = [];
                if(this.query.length >= 2){
                    axios.get('/settings/users/managers/'+this.query).
                        then(response => {
                            this.data = response.data;
                    });
                }
            },
            select(manager){
                this.query = manager.name;
                this.validvalue = manager.id;
                this.data = [];
            }
        },
        mounted(){
            if(this.manager!=''){
                var manager = JSON.parse(this.manager);
                this.query = manager.name;
                this.validvalue = manager.id;
            }
        }

}
</script>



















