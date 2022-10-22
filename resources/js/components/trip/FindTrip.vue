<template>
    <div class="mb-4 relative">
        <label class="label pb-2 font-medium text-gray-700" for="trip"> Trip Name </label>
        <span class="text-red-500">*</span>
        <input type="text" id="trip" v-on:keyup="search" v-model="trip_name" name="trip_name" class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Start typing name...">
        <div v-if="state ==''">
            <ul class="bg-white absolute shadow border-gray-100 appearance-none block border border-gray-200 leading-normal px-2 py-1 rounded text-base text-gray-800 w-full z-990" v-if="trips.length != ''">
                <li v-for='(trip, index) in trips' class="p-2 cursor-pointer border-solid border-b border-gray last:border-b-0" @click="addTrip(trip)" :key="index">
                    <span>{{ trip.title }}</span>
                </li>

                <li v-if="! trips.length && trip_name.length && ! is_searching">
                    <span class='text-left'>No results found!</span>
                </li>
            </ul>
        </div>  
        <input type="hidden" id="trip_id" name="trip_id" v-model="trip_id" />
    </div>
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
            trip_name: '',
            trip_id: '',
            state: this.trip_id ? 'old' : '',
            trips: [],
            edit: []
        }
    },

    mounted(){
        if(this.data){
            this.edit = JSON.parse(this.data);
            this.trip_name = this.edit.title;
            this.trip_id = this.edit.id;
        }
    },

    methods: {
        search () {
            this.state = '';
            this.is_searching = true;

            if (this.trip_name.length < 2) {
                this.trips = [];

                this.is_searching = false;

                return;
            }

            var self = this;
            
            this.$http.post("/leads/find_trip", {search: this.trip_name})
                .then (function(response) {
                    self.trips = response.data;

                    self.is_searching = false;
                })
                .catch (function (error) {
                    self.is_searching = false;
                })
        },
        addTrip(result) {
            this.state = 'old';
            this.trip_name = result.title;
            this.trip_id = result.id;
        },
    }
}
</script>