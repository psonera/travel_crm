<template>
        <div>
            <label class="p-2 font-semibold text-gray-700">Description<span class="text-red-500">*</span></label>
            <textarea
            name="description"
            rows="6"
            :class="css"
            v-model="data"
            autofocus>
            </textarea>
        </div>
</template>

<script>
    export default {
        props:{
            description:{
                type:String,
                default:''
            },
            old_value:{
                type:String,
                default:''
            }
        },
        data(){
            return{
                css:"text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow",
                data:''
            }
        },
        mounted(){
            if(this.description!=''){
                if(this.old_value){
                    this.data = this.old_value;
                }else{
                    this.data = this.description;
                }
            }else{
                if(this.old_value){
                    this.data = this.old_value;
                }
            }
        },
    }
</script>





