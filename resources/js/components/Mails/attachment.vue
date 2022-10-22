<template>
    <div class="flex overflow-x-auto space-x-8 border p-2">
        <attachmentfile :key="index" v-for="(file,index) in files" :index="index" :file="file" @remove="remove($event)"></attachmentfile>
        <section class="flex-shrink-0 rounded border-2 border-purple-300 p-2 shadow-xl" @click.prevent="add">
            <div class="flex flex-col item-center">
                 <i class="fa fa-plus fa-10x"></i>
            </div>
        </section>
    </div>

</template>

<script>
import attachmentfile from '../Mails/attachmentfile.vue'
import axios from 'axios'
export default {
    components:{attachmentfile},
    props:{
        data:{
            type:String,
            default:'',
        },
    },
    data(){
        return{
            files:[],
        }
    },methods:{
        add(){
            this.files.push({id:"",fileobj:null,name:'',oldfile:false});
        },
        remove(file){
            const index = this.files.indexOf(file);
            if(file.oldfile){
                console.log(file.fileobj.uuid);
                if(confirm('File Will not be able to recover after delete?')){
                     axios.get('/mails/delete/'+file.fileobj.uuid)
                        .then(resp => {
                            if(resp.data){
                                this.files.splice(index, 1);
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        })
                }

            }else{
                this.files.splice(index, 1);
            }

        }
    },mounted(){
        if(this.data!=''){
            var datafiles = JSON.parse(this.data);
           console.log(datafiles)
           for(const datafile in datafiles){
               this.files.push({
                 id:'',
                 fileobj:datafiles[datafile],
                 name:datafiles[datafile].file_name,
                 oldfile:true,

               });
           }
        }

    }
}
</script>













