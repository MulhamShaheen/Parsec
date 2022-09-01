<template>
  <Transition>
      <div ref="root" class="user-card" v-if="show">
        <h3>{{ user.name }}</h3>
        <a href="/account">Open Profile</a>
        <a href="/logout">Logout</a>
      </div>
  </Transition>
</template>
<script>
import axios from 'axios';

export default {
  data: function () {
    return {
      show: false,
      user: {}
    }
  },
  mounted() {
    console.log('Mounted card');
    this.loadUser();
  },
  methods: {
    showSelf() {
      this.show = !this.show;
    },
    loadUser() {
      axios.get('api/user')
          .then( (response) => { this.user = response.data;})
            .catch(function (error) {
              console.log(error)
            })
    }

  }
}
</script>
