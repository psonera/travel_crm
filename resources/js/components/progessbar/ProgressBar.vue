<template>
    <div class="w-full">
        <div class="arrow-steps clearfix">
            <div 
            v-for="(stage, index) in customStages"
            :key="index"
            class="step cursor-pointer"
            :class="
            { 'done': currentstage > stage.sort_order, 
              'current': currentstage === stage.id }
            "
            @click="changeStage(stage)"
            ><span>{{ stage.name }}</span> </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        current_lead_stage: Number,
        lead_id: Number
    },
    data() {
        return {
            nextStageCode: null,
            customStages: [],
            currentstage: '',
            showStageControl: false,
        }
    },  

    created(){
        this.getStages();
        this.currentstage = this.current_lead_stage;
    },

    computed: {
        won: function() {
            const results = this.customStages.filter(stage => stage.code == 'won');

            return results[0];
        },

        lost: function() {
            const results = this.customStages.filter(stage => stage.code == 'lost');

            return results[0];
        },
    },

    methods: {
        changeStage(stage) {
            if (this.currentstage == stage.id) {
                return;
            } else {
                this.currentstage = stage.id;
                var self = this;
                this.$http.post("/leads/change_status", {stage_id: stage.id, lead_id: this.lead_id})
                    .then (function(response) {

                        if(response.data.success)
                            notyf.success(response.data.success);
                        else
                            notyf.error(response.data.error);

                        self.getStages();
                    })
            }
        },
        getStages(){
            var self = this;
            fetch('/leads/get_stages')
                .then(response => response.json())
                .then(function(response){
                    self.customStages = response
                });
        }
    },
}
</script>