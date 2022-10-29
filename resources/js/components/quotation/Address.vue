<template>
      <div class="flex ">
          <div class="flex-1">
            <label for="message" class="label p-2 font-semibold text-gray-700">{{title}} <span class="text-red-500">*</span></label>
            <div class="flex gap-2">
                 <div class="basis-1/2">
                        <addressselect
                            :selectitem="currentcontry"
                            :name="contryname"
                            :data="contry"
                            geography="contry"
                            @selectstatus="states"
                        ></addressselect>
                        <div>
                            <div v-if="contryname=='b_contry'">
                                <div v-if="errors!=null">
                                    <div v-if="'b_contry' in errors">
                                        <span class="text text-red-700 text-lg">{{errors.b_contry[0]}}</span>
                                    </div>
                                </div>
                            </div>
                            <div v-if="contryname=='s_contry'">
                                <div v-if="errors!=null">
                                    <div v-if="'s_contry' in errors">
                                        <span class="text text-red-700 text-lg">{{errors.s_contry[0]}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <addressselect
                            :selectitem="currentstate"
                            :name="statename"
                            :data="state"
                            geography="state"
                            @selectstatus="cities"

                        ></addressselect>
                        <div>
                            <div v-if="statename=='b_state'">
                                <div v-if="errors!=null">
                                    <div v-if="'b_state' in errors">
                                        <span class="text text-red-700 text-lg">{{errors.b_state[0]}}</span>
                                    </div>
                                </div>
                            </div>
                            <div v-if="statename=='s_state'">
                                <div v-if="errors!=null">
                                    <div v-if="'s_state' in errors">
                                        <span class="text text-red-700 text-lg">{{errors.s_state[0]}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <addressselect
                            :selectitem="currentcity"
                            :name="cityname"
                            :data='city'
                            geography="city"

                        ></addressselect>
                        <div>
                            <div v-if="cityname=='b_city'">
                                <div v-if="errors!=null">
                                    <div v-if="'b_city' in errors">
                                        <span class="text text-red-700 text-lg">{{errors.b_city[0]}}</span>
                                    </div>
                                </div>
                            </div>
                            <div v-if="cityname=='s_city'">
                                <div v-if="errors!=null">
                                    <div v-if="'s_city' in errors">
                                        <span class="text text-red-700 text-lg">{{errors.s_city[0]}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="basis-1/2 " max-width="100% ">
                    <addresslocal
                        :tclass="tclass"
                        :txname="addressname"
                        :pinname="pinname"
                        :localaddress="Object(address)"
                        :oldvalue="oldvalue"
                        :errors="errors"
                    >
                    </addresslocal>
                </div>
            </div>
        </div>
      </div>
</template>
<script>
import addressselect from './AddressSelect.vue';
import addresslocal from './Addresslocal.vue'
 import axios from 'axios';
export default {
    components:{addressselect,addresslocal},
     props:{
        address:{
            type:Object,
            default:null
        },
        title:String,
        addressname:String,
        pinname:String,
        contryname:String,
        statename:String,
        cityname:String,
        oldvalue:{
            type:Object,
            default:null
        },
        errors:{
            type:Object,
            default:''
        }

    },

    created(){


    },
    data(){
        return{
            localoldvalue:Object,
            currentcontry:'',
            currentstate:'',
            currentcity:'',
            contry:[],
            state:[],
            city:[],

            tclass:'text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow',
        }
    },

     methods:{
        contries(){
           axios.get('/quotations/country').then(response=>{
                this.contry = response.data;

            });
        },
        states(id){

            axios.get('/quotations/state',{params: {c_id: Number(id)}}).then(response=>{
                this.state = response.data;
            });
        },

        cities(id){

            axios.get('/quotations/cities',{params: {c_id: id}}).then(response=>{
                this.city = response.data;
            });
        },

    },
     mounted(){
        this.contries()
        if(this.address)
        {
            if(this.oldvalue==''){

                this.states(this.address.country)
                this.cities(this.address.state)
                this.currentcontry = this.address.country
                this.currentstate = this.address.state
                this.currentcity = this.address.city

            }else{


                var keys = [];
                for(var key in this.oldvalue){
                    keys.push(key);
                }

                if(this.statename=="b_state"){
                    if(keys.includes('b_city')){
                        this.currentcontry = this.oldvalue.b_contry;
                        this.currentstate = this.oldvalue.b_state;
                        this.currentcity = this.oldvalue.b_city;
                        this.states(this.oldvalue.b_contry)
                        this.cities(this.oldvalue.b_state)
                    }
                }
                if(this.statename=="s_state"){
                    if(keys.includes('s_city')){
                        this.currentcontry = this.oldvalue.s_contry;
                        this.currentstate = this.oldvalue.s_state;
                        this.currentcity = this.oldvalue.s_city;
                        this.states(this.oldvalue.s_contry)
                        this.cities(this.oldvalue.s_state)
                    }
                }


            }
        }else{
            if(this.oldvalue.length > 0){

                this.currentcontry = '0'
                this.currentstate = '0'
                this.currentcity = '0'
            }else{

                var keys = [];
                for(var key in this.oldvalue){
                    keys.push(key);
                }
                if(this.statename=="b_state"){
                    if(keys.includes('b_city')){
                        this.currentcontry = this.oldvalue.b_contry;
                        this.currentstate = this.oldvalue.b_state;
                        this.currentcity = this.oldvalue.b_city;
                        this.states(this.oldvalue.b_contry)
                        this.cities(this.oldvalue.b_state)
                    }
                }
                if(this.statename=="s_state"){
                    if(keys.includes('s_city')){
                        this.currentcontry = this.oldvalue.s_contry;
                        this.currentstate = this.oldvalue.s_state;
                        this.currentcity = this.oldvalue.s_city;
                        this.states(this.oldvalue.s_contry)
                        this.cities(this.oldvalue.s_state)
                    }
                }


            }
        }


    },

}
</script>


