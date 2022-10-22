<template>

    <div>
        <label class="label label-required pb-2 font-medium text-gray-700">Profile Image</label>
        <div>
            <span @click="removefile()"  class="absolute bg-red-500 hover:cursor-pointer left-[90px] px-1 rounded-full text-black">X</span>
            <label for="selectimage" class="border rounded-full">
                <div  class="preview-container" >
                    <img :src="previewUrl" alt="" v-if="previewUrl" class="h-20 mx-auto userimg w-20" accept="image/*">
                    <i class="fa fa-image fa-4x p-2" v-if="previewUrl==''"></i>
                </div>
            </label>
            <input type="file" name="profile_image" ref="inputFile"   @change="getImage" hidden id="selectimage" accept=".png,.jpg">
        </div>
    </div>
</template>
<script>
export default {
    props:{
        image_url:{
            type:String,
            default:''
        },
        oldvalue:{
            type:String,default:''
        }
    },data(){
        return {
            previewUrl:'',
        }
    },
    methods:{
        getImage(event){
            var file = event.target.files[0];
            var reader = new FileReader();
            var self = this;
            reader.onload = function(onLoadEvent){
                self.previewUrl = onLoadEvent.target.result;
                if(self.image_url!=''){
                    self.previewUrl = self.image_url;
                }
            }
            reader.readAsDataURL(file);
        },
        removefile(){
           this.$refs.inputFile.value = null;
            this.$refs.inputFile.type='text';
            this.$refs.inputFile.type='file';
            this.previewUrl = '';

        }
    },
    mounted(){
        this.previewUrl = this.image_url;
    }
}
</script>








