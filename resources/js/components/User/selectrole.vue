<template>
    <div>
        <select name="role" id="" v-model="role"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg f w-full dark:text-black m-0.5 p-1.5">
            <option value="">Select Role</option>
            <option  v-for="(role,index) in roles" :key="index" @click="name(role.name)" :value="role.id" >{{role.name}}</option>
        </select>
        <input class="border border-black" type="text" name="rolename" v-model="role_name" hidden>
    </div>
    <div v-if="is_lead_manager">
        <div v-if="is_admin">
            <manager :manager="manager" ></manager>
            <span v-if="error!=''" class="text-red-500">Please search and select Manager</span>
            <span v-if="error2!=''" class="text-red-500">Please search and select Manager</span>
        </div>
    </div>
    <div v-if="is_lead_manager">
        <sources :selected_source="selected_source" ></sources>
    </div>

</template>
<script>
import axios from 'axios';
import sources from './sources.vue';
import manager from './manager.vue'
export default {
    components:{sources,manager},
    props:{
        selected:{
            type:String,
            default:'',
        },
        selected_source:{
            type:String,
            default:''
        },manager:{
            type:String,
            default:'',
        },error:{
            type:String,
            default:'',
        },error2:{
            type:String,
            default:'',
        },oldvalue:{
            type:String,
            default:'',
        }

    },
    data(){
        return{
            roles:[],
            role:'',
            is_lead_manager:false,
            is_admin:false,
            role_name:'',
        }
    },
    watch:{
        role(newrole,oldrole){
            var self = this;

                axios.get('/settings/users/isLeadManager/'+newrole)
                .then(function(response){
                    self.is_lead_manager = response.data;
                }).catch(function (error){
                    self.is_lead_manager = false;
                });
                 //set name
                this.roles.forEach(function(item){
                    if(item.id==newrole){
                        // console.log(item.name);
                        self.role_name = item.name;
                    }
                });
        }
    },

    methods:{
        name(name){
            this.name = name;
        },getroles(){
            var self = this;
            axios.get('/settings/roles/getroles')
            .then(function(response){
                response.data.forEach(role => {
                     self.roles.push(role);
                });
            }).catch(function (error){
                alert(error.message);
            });
        },check_id_admin(){
            // alert('in');
            var self = this;
            axios.get('/settings/users/is_super-admin').then(function(res){

               self.is_admin = res.data;
            }).catch(function(error){
                self.is_admin =  false;
            });
        }

    },mounted:function(){

        this.getroles();
        this.check_id_admin();

        //old values and edit page values
        if(this.selected!=''){
             if(this.oldvalue!="null"){
                var val = JSON.parse(this.oldvalue);
                setTimeout(()=>{},200)

                this.role = val;
            }else{
                this.role = this.selected;
            }
        }
        else if(this.selected==''){
            if(this.oldvalue!="null"){
                var val = JSON.parse(this.oldvalue);
                setTimeout(()=>{
                },200)

                this.role = val;
            }else{

            }
        }

    }
}
</script>


























