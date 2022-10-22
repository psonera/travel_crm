<template>
    <div class="mb-4 relative">
        <label class="label pb-2 font-medium text-gray-700" for="lead_manager"> Name </label>
        <span class="text-red-500">*</span>
        <input type="text" id="lead_manager" v-on:keyup="search" v-model="lead_manager_name" name="lead_manager_name" class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Start typing name...">
        <div v-if="state ==''">
            <ul class="bg-white absolute shadow border-gray-100 appearance-none block border border-gray-200 leading-normal px-2 py-1 rounded text-base text-gray-800 w-full z-990" v-if="lms.length != ''">
                <li v-for='(lm, index) in lms' class="p-2 cursor-pointer border-solid border-b border-gray last:border-b-0" @click="addLeadManager(lm)" :key="index">
                    <span>{{ lm.name }}</span>
                </li>

                <li v-if="! lms.length && lead_manager_name.length && ! is_searching">
                    <span class='text-left'>No results found!</span>
                </li>
            </ul>
        </div>    
    </div>
    <div class="mb-4">
        <label class="label pb-2 font-medium text-gray-700" for="email"> Email </label>
        <span class="text-red-500">*</span>
        <input type="email" id="email" name="email" v-model="email" class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow">
    </div>
    <div class="mb-4">
        <label class="label pb-2 font-medium text-gray-700" for="phone_number"> Phone </label>
        <input type="text" id="phone_number" name="phone_number" v-model="phone_number" class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow">
    </div>
    <input type="hidden" id="lead_manager_id" name="lead_manager_id" v-model="lead_manager_id">
</template>
<script>
export default {
    props: {
        data: {
            type: String,
            default: () => ({})
        },
    },
    data() {
        return {
            is_searching: false,
            lead_manager_name: '',
            email: '',
            phone_number: '',
            lead_manager_id: '',
            state: this.lead_manager_id ? 'old' : '',
            lms: [],
            edit: []
        }
    },

    mounted(){
        if(this.data){
            this.edit = JSON.parse(this.data);
            this.email = this.edit.email;
            this.lead_manager_name = this.edit.name;
            this.phone_number = this.edit.phone_number;
            this.lead_manager_id = this.edit.id;
        }
    },

    methods: {
        search () {
            this.state = '';
            this.is_searching = true;

            if (this.lead_manager_name.length < 2) {
                this.lms = [];

                this.is_searching = false;

                return;
            }

            var self = this;
            
            this.$http.post("/leads/find_lm", {search: this.lead_manager_name})
                .then (function(response) {
                    self.lms = response.data;

                    self.is_searching = false;
                })
                .catch (function (error) {
                    self.is_searching = false;
                })
        },
        addLeadManager(result) {
            this.state = 'old';

            this.email = result.email;
            this.lead_manager_name = result.name;
            this.phone_number = result.phone_number;
            this.lead_manager_id = result.id;
        },
    }
}
</script>