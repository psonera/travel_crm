<template>

    <div>
        <div>
            <i v-if="!isopen" class="fa fa-arrow-right m-2 hover:cursor-pointer" @click="isopen = !isopen"></i>
            <i v-if="isopen" class="fa fa-arrow-down m-2 hover:cursor-pointer" @click="isopen = !isopen"></i>
            <i class="fa fa-folder m-2"></i>
            <span>
                <input name="permission[]" type="checkbox" :value="pv.id"  v-model="parent" :checked=" is_some_selected ?parent=true:parent=false"  >  {{pv.name}}
            </span>
            <div v-show="isopen"  class="ml-14" >
                <div>
                    <div v-for="(val,index) in child_permission" :key="index">
                        <permission :permission="val" :track_length='track.length' @is_some_select="is_some_select_method" @remove="remove" ></permission>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import permission from './singlepermission.vue'
export default {
    components:{
        permission
    },
    props:{
        pv:{
            type:Object,
            default:''
        },
        dp:{
            type:Array,
            default:''
        }
    },
    data(){
            return{
                child_permission:[],
                is_some_selected:false,
                select_child:false,
                track:[],
                isopen:false,
                parent:'',
                select:false,
            }
    },watch:{
        parent(newparent,oldparent){
            if(newparent && this.track.length==0){
                this.is_some_selected = true;
                this.parent = true;
                this.child_permission.forEach(function(item){
                    item.selected = true;
                });
            }else if(!newparent && this.track.length==0){
                this.parent = false;
                this.is_some_selected = false;
                this.child_permission.forEach(function(item){
                    item.selected = false;
                });
            }else if(!newparent && this.track.length>=1){
                this.parent = false;
                this.is_some_selected = false;
                this.child_permission.forEach(function(item){
                    item.selected = false;
                })
            }
        },

    },
    methods:{
        permission(){
            var keys = Object.keys(this.pv.obj);
            keys.forEach((key, index) => {
                this.child_permission.push(this.pv.obj[key]);
            });
        },
        click_check(){

        },is_some_select_method(value){
            this.is_some_selected = value;

            this.parent_select = true;
        },remove(value){

            this.track.splice(this.track.indexOf({permission_name:value}),1);
            console.log('after remove call');
            if(this.track.length == 0){
                this.parent = false;
            }
            setTimeout(()=>{},300);
        },

    },
    mounted(){
        this.permission();
        if(this.dp!=''){
             this.dp.map(item => {
                this.child_permission.forEach(function(permission){
                    if(item.id==permission.id){
                        permission.selected = true;
                    }
                });
             });


        }
    }
}
</script>




