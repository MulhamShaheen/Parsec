<template>
  <modal name = "create-project-modal"  resizable: true>
    <div style="position: relative; right: -95%; top: 0 ">
      <button @click="$modal.hide('create-project-modal')">
        ❌
      </button>
    </div>
    <h1>asdas</h1>
    <form :action="rout" :method="method" enctype="multipart/form-data">
      <input type="hidden" name="_token" :value="csrf">
      <div class="form-group m-10">
        <input type="text" name="title" id="target" class="form-control">
      </div>
      <div class="d-grid mx-auto">
        <button type="submit" class="btn btn-dark btn-block">Update</button>
      </div>
    </form>
  </modal>
</template>
<script>

import VModal from 'vue-js-modal'
export default {
  props:[
      'type',
      'target',
      'rout',
      'method',
  ],
  data: function () {
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      penImg: false,
      user: {}
    }
  },
  mounted() {
    console.log('Mounted modal');
  },
  methods: {
    show () {
      this.$modal.show('prof-'+this.target+'-modal');
    },
    hide () {
      this.$modal.hide('prof-'+this.target+'-modal');
    },
  }
}
</script>
