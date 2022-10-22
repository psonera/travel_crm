<template>
    <div class="flex justify-center">
      <div class="flex">
        <div
          v-for="column in columns.stages"
          :key="column.name"
          class="bg-150 border-4 flex flex-col flex-shrink-0 p-4 rounded-xl w-72 h-auto mr-4 last:mr-0"
        >
          <div class="flex items-center flex-shrink-0 h-10 px-2">
            <span class="block font-semibold text-lg text-black">{{ column.name }}</span>
            <span class="bg-opacity-30 flex font-semibold h-5 items-center justify-center p-4 ml-auto rounded text-lg w-5 text-blue-500 bg-blue-100">{{ column.leads.length }}</span>
          </div>
          
          <div v-if="checkCreateLead">
            <div class="flex items-center flex-shrink-0 h-10 pt-4 mb-4">
              <button type="button" class="bg-white border-2 border-blue-500 font-medium mb-2 mr-2 px-5 py-2.5 rounded-lg text-blue-500 text-center text-sm w-full"><a :href="'leads/create?stage_id=' + column.id">Create Lead</a></button>
              <delete-stage-modal @confirm="getConfirm" :stage_id="column.id"></delete-stage-modal>
            </div>
          </div>
          
          <draggable
            :list="column.leads"
            :animation="200"
            draggable=".item"
            ghost-class="ghost-card"
            :stage_id="column.id"
            group="leads"
            :key="column.id"
            v-on:end="onEnd"
          >
                       
            <task-card
              v-for="lead in column.leads"
              :key="lead.id"
              :lead="lead"
              :data-lead-id="lead.id"
              :stage_name="column.name"
              class="mt-3 cursor-move item z-1001"
            ></task-card>

            <div v-if="column.leads == ''" class="z-10 flex items-center justify-center h-[50vh] opacity-50">
              <div class="text-black-500 text-center">
                <img src="/img/no_data.svg" class="text-center h-50 w-50 ml-auto mr-auto mb-8"
                    height="150" width="150" alt="No Data" />
                <p class="text-2xl">No lead found!</p>
              </div>
            </div>

          </draggable>
        </div>
      </div>
    </div>
</template>

<script>
import { VueDraggableNext } from "vue-draggable-next";
import TaskCard from "./TaskCard.vue";
import DeleteStageModal from './DeleteStageModal.vue'
export default {
  name: "KanbanBoard",
  components: {
    TaskCard,
    draggable: VueDraggableNext,
    DeleteStageModal
  },
  data() {
    return {
      columns: [],
      lead_id: '',
      old_stage_id: '',
      new_stage_id: '',
      checkCreateLead: true,
    };
  },
  created() {
      this.getLeads();

      axios.get(`/permission/create.leads`)
            .then((response) => {
                if(response.data == 'Unauthorized Action')
                  this.checkCreateLead = false;
            })
            
      // queueMicrotask(() => {
      //     $('#search-field').on('search keyup', ({target}) => {
      //         clearTimeout(this.debounce);

      //         this.debounce = setTimeout(() => {
      //             this.search(target.value)
      //         }, 2000);
      //     });
      // });
  },

  methods: {
    getLeads(){
      var self = this;
      fetch("leads/get").then(response => response.json())
                        .then(function(response) {
                            self.columns = response;
                        })
                        .catch(error => {
                            this.$root.pageLoaded = true;
                        });
    },
    onEnd: function(event) {
      this.new_stage_id = event.to.__draggable_component__.$attrs.stage_id;
      this.old_stage_id = event.from.__draggable_component__.$attrs.stage_id;
      this.lead_id = event.item._underlying_vm_.id;
      if(this.new_stage_id != this.old_stage_id){
        this.$http.post("leads/change_status", {stage_id: this.new_stage_id, lead_id: this.lead_id})
          .then (function(response) {
              if(response.data.success)
                notyf.success(response.data.success);
              else
                notyf.error(response.data.error);
          });
        this.getLeads();
      } 
    },
    getConfirm(value){
      if(value){
        this.removeStage(value);
      }
    },
    removeStage(id){
      this.$http.post("leads/remove_stage",{stage_id: id})
        .then(function(response){
              if(response.data.success)
                notyf.success(response.data.success);
              else
                notyf.error(response.data.error);
        });
        this.getLeads();
    }
  }
};
</script>

<style scoped>
.ghost-card {
  opacity: 0.5;
}
</style>