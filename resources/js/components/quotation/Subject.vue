<template>
    <label class="p-2 font-semibold text-gray-700">Subject<span class="text-red-500">*</span></label>
    <input name="subject"
    type="text"
    :class="css"
    v-model="data"

    >
</template>
<script>
    export default {
        props:{
            subject:{
                type:String,
                default:''
            },
            oldvalue:{
                type:String,
                default:''
            }
        },
        data(){
           return{
                css:"text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow",
                data:''
           }
        },mounted(){
              if(this.subject!=''){
                if(this.oldvalue){
                    console.log('in');
                    this.data = this.oldvalue;
                }else{
                    this.data = this.subject;
                }
              }else{
                if(this.oldvalue){
                    this.data = this.oldvalue;
                }
              }
        },

    }
</script>




