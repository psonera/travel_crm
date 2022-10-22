<template>
    <label class="p-2 font-semibold text-gray-700">Participants</label>
    <input
        class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
        type="text"
        name="search"
        v-model="search_term"
        @keyup="search"
        placeholder="Start typing name..." 
    />
    <div>
        <div v-if="isshow && state == ''" class="bg-white absolute shadow border-gray-100 appearance-none block border border-gray-200 leading-normal rounded text-base text-gray-800 w-full">
            <label class="block font-bold px-4 text-lg text-black-400" for="users">Users</label>
            <ul>
                <li
                    v-for="(user, index) in searched_participants.users"
                    :key="index"
                    @click="addTag('users',user)"
                    class="py-2 px-6 cursor-pointer border-solid border-b border-gray last:border-b-0"
                >{{user.name}}</li>
            </ul>
            <label class="block font-bold px-4 text-lg text-black-400" for="lead_manager">Lead Managers</label>
            <ul>
                <li
                    v-for="(lm, index) in searched_participants.lead_managers"
                    :key="index"
                    @click="addTag('lead_managers',lm)"
                    class="py-2 px-6 cursor-pointer border-solid border-b border-gray last:border-b-0"
                >{{lm.name}}</li>
            </ul>
        </div>
        <div class="flex items-center gap-2">
            <span
                v-for="(selected_user ,index) in participants.users"
                :key="index"
                class="rounded-2xl border-2 border-blue-500 font-bold text-blue-500 p-2 my-2 text-center"
            >
            {{ selected_user.name }}
                <input type="hidden" :name="`participants[users][]`" :value="selected_user.id">
                <span @click="removeTag('users', index)" class="w-full hover:cursor-pointer">x</span>
            </span>

            <span
                v-for="(selected_lm ,index) in participants.lead_managers"
                :key="index"
                class="rounded-2xl border-2 border-orange-500 font-bold text-orange-500 p-2 my-2 text-center"
            >
            {{ selected_lm.name }}
                <input type="hidden" :name="`participants[lead_managers][]`" :value="selected_lm.id">
                <span @click="removeTag('lead_managers', index)" class="w-full hover:cursor-pointer">x</span>
            </span>
        </div>
        
    </div>

</template>


<script>
export default {
    props: {
        data: {
            type: Object,
            default: () => ({})
        },
    },
    data(){
        return{
            addeduser:[],
            searched_participants: {
                'users': [],

                'lead_managers': []
            },

            participants: {
                'users': [],

                'lead_managers': []
            },
            search_term:"",
            is_searching: false,
            isshow:false,
        }
    },
    mounted(){
        if(this.data != null){
            this.participants = Object.values(this.data);
        }
    }, 
    methods:{
        addTag(type, participant){
            this.search_term = '';

            this.searched_participants = {
                'users': [],

                'lead_managers': []
            };

            this.participants[type].push(participant);

            this.isshow = false;
        },
        removeTag(type, index){
            this.participants[type].splice(index,1);
        },
        search(){
            this.state = '';
            this.isshow = true;
            this.is_searching = true;

            if (this.search_term.length < 2) {
                this.searched_participants = {
                    'users': [],

                    'lead_managers': []
                };

                this.is_searching = false;

                return;
            }

            
            this.$http.post('/leads/find_manager',{search: this.search_term, participant: 1} )
            .then(response => {
                    var self = this;
                    ['users', 'lead_managers'].forEach(function(userType) {
                        self.participants[userType].forEach(function(addedUser) {

                            response.data[userType].forEach(function(user, index) {
                                if (user.id == addedUser.id) {
                                    response.data[userType].splice(index, 1);
                                }
                            });

                        });
                    });
                
                this.searched_participants = response.data;

                this.is_searching = false;
            })
            .catch (function (error) {
                self.is_searching = false;
            });
        }
    }

}
</script>
<style>


input::placeholder {
  color: white;
}

input:focus {
  outline: none;
}

</style>


