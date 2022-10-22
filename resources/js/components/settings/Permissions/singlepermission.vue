<template>
    <div>
        <i class="fa fa-folder m-2"></i>

        <input
            type="checkbox"
            name="permission[]"
            :value="permission.id"
            v-model="child"
            :checked="permission.selected ?child = true:child = false"
           >
        {{permission.name}} {{permission.id}}
    </div>
</template>
<script>
import { watch } from '@vue/runtime-core';
export default {
    props:{
        permission:{
            type:Object,
            default:'',
        },
        track_length:{
            type:Number,
        },

    },data(){
        return{
            child:false,
        }
    },
    watch:{
        child(newchild,oldchild){
            if(newchild){
                var permission_name = this.permission.name;
                this.$parent.track.push({permission_name:permission_name});
                var index = this.$parent.child_permission.indexOf(this.permission);
                this.$parent.child_permission[index].selected = true;
                this.$emit('is_some_select',true);
            }if(!newchild){
                var index = this.$parent.child_permission.indexOf(this.permission);
                this.$parent.child_permission[index].selected = false;
                this.$emit('remove',this.permission.name);
            }
        }
    }
    ,methods:{
        
    }
}
</script>













