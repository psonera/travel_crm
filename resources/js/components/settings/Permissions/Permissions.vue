<template>
    <div>

        <label for="" class="label p-2 font-semibold text-gray-700">Permission type</label>
        <select v-model="selected" :name="name_attribute" v-if="selected==0 ? name_attribute='all':name_attribute='custom'" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg f w-full dark:text-black m-0.5 p-1.5">
            <option value="0" >All</option>
            <option selected value="1" >Custom</option>
        </select>
        <div v-if="selected==1" class="mt-3" >
             <list :dp="dp" :pv="value" v-for="(value,index) in allPermissions" :key="index"></list>
        </div>
    </div>
</template>
<script>
import list from './permissionlist.vue'
export default {
    components:{list},
    props:{
        permissions:{
            type:String,
            default:''
        },
        dp:{
            type:Array,
            default:''
        },
        old_value:{
            type:String,
            default:null
        }

    },
    data(){
        return{
            selected:'1',
            allPermissions:[],
            indexPermissions:[],
            name_attribute:'custom'
        }
    },

    methods:{
        parent(){
            var self = this;
            var permissions = JSON.parse(this.permissions);
            permissions.map(function(title){
                if(!title.name.includes('.')){
                    self.indexPermissions.push({title:title.name,id:title.id});
                }
           });
        },
        children(){
            var self = this;
                for (let index = 0; index < this.indexPermissions.length; index++) {
                    var value = self.indexPermissions[index];
                    var valuetitle = value.title;
                    var permi = new Object();
                    var childpermi = new Object();
                    permi.name = value.title;
                    permi.id = value.id;
                     var permissions = JSON.parse(this.permissions);
                    permissions.map(function(title){
                        if(title.name.includes("."+valuetitle)){
                            var name = title.name;
                            childpermi[name.split(".")[0]] = {name:name.split(".")[0],id:title.id,selected:false};
                        }
                    });
                    permi.obj = childpermi;
                    self.allPermissions.push(permi);
                }
        },
        // toggle(){
        //     this.isopen = !this.isopen;
        // }

    },
    mounted() {
        this.parent()
        this.children()
        if(this.dp!=''){
             if(this.old_value!='null'){
                var self = this;
                JSON.parse(this.old_value).map(function(item){
                    self.dp.push({id:item});
                })
            }
        }else{
            if(this.old_value!='null'){
                var self = this;
                JSON.parse(this.old_value).map(function(item){
                    self.dp.push({id:item});
                })
            }
        }
    },
}
</script>
