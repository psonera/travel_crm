<template>
    <div class="flex-shrink-0 rounded border-2 border-purple-300 p-2 shadow-xl" v-if="isshow">
        <div class="relative" @click.prevent="remove(index)">
            <div class="absolute top-0 right-0">
                <i class="fa fa-window-close"></i>
            </div>
        </div>
        <section v-if="!file.oldfile">
           <label :for="'attachment'+index">
                <div class="flex flex-col items-center " v-if="file.name==''">
                    <i class="fa fa-cloud-upload fa-3x text-gray-200"></i>
                    <span class="block text-gray-400 font-normal">Attach you files here</span>
                    <span class="block text-gray-400 font-normal">or</span>
                    <span class="block text-blue-400 font-normal">Browse files</span>
                </div>
                <div class="flex flex-col items-center " v-else-if="file.name!=''">
                    <i class="fa fa-file fa-9x "></i>
                   <div>
                         <span>{{file.name}}</span>
                   </div>
                </div>
                <input  type="file" name="attachment[]" :ref="'inputFile'+index" :id="'attachment'+index" @change="change('inputFile'+index)" hidden class="h-full w-full opacity-0" accept=".png,.pdf,.jpg,.txt,">
            </label>
        </section>
        <section v-if="file.oldfile">
           <label :for="'attachment'+index">

                <div class="flex flex-col items-center ">
                    <i class="fa fa-file fa-9x "></i>
                   <div>
                         <span>{{file.name}}</span>
                   </div>
                </div>

            </label>
        </section>
    </div>



</template>
<script>
export default {
    props:{
        index:{
            type:Number
        },file:{
            type:Object
        }
    },data(){
        return{
            f_index:this.index,
            isshow:true,
        }
    }
    ,methods:{
        change(fileref){
            const file = this.$refs[fileref].files[0];
            this.file.fileobj = file;
            this.file.id = this.index;
            this.file.name = file.name;
        },
        remove(){
            this.$emit('remove',this.file);
            // this.isshow=false;

        }
    },mounted(){
        this.file.name!=''?this.file.id = this.index:'';
    }
    // ,beforeUpdate(){
    //     if(this.file.name!=''){
    //         this.$refs[fileref].files[0] = this.file.fileobj;
    //          this.file.fileobj = file;
    //         this.file.id = this.index;
    //         var filename = file.name;
    //         this.filename = filename;
    //     }
    // }
}
</script>












