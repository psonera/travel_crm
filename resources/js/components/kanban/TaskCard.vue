<template>
  <div class="border-2 items-start p-4 mt-3 bg-white rounded-lg cursor-pointer bg-opacity-90 group hover:bg-opacity-100">
    <div class="flex relative justify-between mb-2">
      <p class="text-gray-700 font-semibold font-sans tracking-wide text-base">{{lead.title}}</p>
      <div class="absolute top-0 right-0 group-hover:block hidden">
        <a :href="'leads/view/' + lead.id"><i class="fa fa-eye cursor-pointer"></i></a>
        <i class="fa fa-arrows ml-2"></i>
      </div>
    </div>
    <div class="my-2">
      <a :href="'/lead_managers?id='+lead.lead_manager.id" class="text-blue-500">
        <p class="font-semibold font-sans tracking-wide text-sm"><i class="fa fa-user fa-xs text-gray-700"></i>  {{lead.lead_manager.name}}</p>
      </a>
    </div>
    <div>
      <p class="text-gray-700 font-semibold font-sans tracking-wide text-sm"><i class="fas fa-rupee-sign fa-1x"></i>  {{lead.lead_value}}</p>
    </div>
    <!-- <div class="flex mt-4 justify-between items-center">
      <span class="text-sm text-gray-600">{{lead.date}}</span>
      <badge v-if="lead.lead_pipeline_stage_id">{{ stage_name }}</badge>
    </div> -->
  </div>
</template>
<script>
import Badge from "./Badge.vue";
export default {
  components: {
    Badge
  },
  props: {
    stage_name: String,
    lead: {
      type: Object,
      default: () => ({})
    }
  }
};
</script>
