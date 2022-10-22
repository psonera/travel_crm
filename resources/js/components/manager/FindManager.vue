<template>
    <div class="mb-4 relative">
        <label class="label pb-2 font-medium text-gray-700" for="manager"> Manager </label>
        <span class="text-red-500">*</span>
        <input type="text" id="manager" v-on:keyup="search" v-model="manager_name" name="manager_name" class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Start typing name...">
        <div v-if="state ==''">
            <ul class="bg-white absolute shadow border-gray-100 appearance-none block border border-gray-200 leading-normal px-2 py-1 rounded text-base text-gray-800 w-full z-990" v-if="managers.length != ''">
                <li v-for='(manager, index) in managers' class="p-2 cursor-pointer border-solid border-b border-gray last:border-b-0" @click="addLeadManager(manager)" :key="index">
                    <span>{{ manager.name }}</span>
                </li>

                <li v-if="! managers.length && manager_name.length && ! is_searching">
                    <span class='text-left'>No results found!</span>
                </li>
            </ul>
        </div>    
    </div>
    <input type="hidden" id="user_id" name="user_id" v-model="user_id">
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
            manager_name: '',
            user_id: '',
            state: this.user_id ? 'old' : '',
            managers: [],
            edit: []
        }
    },

    mounted(){
        if(this.data){
            this.edit = JSON.parse(this.data);
            this.manager_name = this.edit.name;
            this.user_id = this.edit.id;
        }
    },

    methods: {
        search () {
            this.state = '';
            this.is_searching = true;

            if (this.manager_name.length < 2) {
                this.managers = [];

                this.is_searching = false;

                return;
            }

            var self = this;
            
            this.$http.post("/leads/find_manager", {search: this.manager_name})
                .then (function(response) {
                    self.managers = response.data;

                    self.is_searching = false;
                })
                .catch (function (error) {
                    self.is_searching = false;
                })
        },
        addLeadManager(result) {
            this.state = 'old';
            this.manager_name = result.name;
            this.user_id = result.id;
        },
    }
}
</script>