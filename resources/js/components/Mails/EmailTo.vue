<template>
    <div>
        <div class="mb-4">
            <label class="p-2 font-semibold text-gray-700">To</label>
            <span class="text-red-500">*</span>
            <div class="relative flex w-full flex-wrap items-stretch mb-3">
                <input type="email" v-model="to" required name="to" class="text-size-md relative focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"/>
                <span @click.prevent="ccField" class="hover:cursor-pointer z-10 h-full leading-snug font-normal absolute text-center absolute bg-transparent rounded text-base items-center justify-center w-30 right-0 pr-3 py-2">
                    Cc
                </span>
                <span @click.prevent="bccField" class="hover:cursor-pointer z-10 h-full leading-snug font-normal absolute text-center absolute bg-transparent rounded text-base items-center justify-center w-12 right-0 pr-3 py-2">
                    Bcc
                </span>
            </div>
        </div>
        <div class="mb-4" v-if="isCC">
            <label class="p-2 font-semibold text-gray-700">CC</label>
            <input type="email" name="cc" v-model="emailCC" required class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Cc">
        </div>
        <div class="mb-4" v-if="isBCC">
            <label class="p-2 font-semibold text-gray-700">BCC</label>
            <input type="email" name="bcc" v-model="emailBCC" required class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Bcc">
        </div>
    </div>
</template>
<script>
export default {
    props:{
        to:{
            type:String,
            default:''
        },
        cc:{
            type:String,
            default:''
        },
        bcc:{
            type:String,
            default:''
        }
    },
    data(){
        return{
            isCC:false,
            isBCC:false,
            emailTo:'',
            emailCC:'',
            emailBCC:''
        }
    },
    methods:{
        ccField(){
            this.isCC = !this.isCC;
        },
        bccField(){
            this.isBCC = !this.isBCC;
        }
    },
    mounted(){
        if(this.cc!=''){
            this.isCC = true;
            this.emailCC = this.cc;
        }

        if(this.bcc!=''){
            this.isBCC = true;
            this.emailBCC = this.bcc;
        }

        if(this.to!=''){
            this.emailTo = this.to;
        }
    }

}
</script>






