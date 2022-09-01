<template>
  <Transition>
    <div ref="root" id="profile-card" class="profile-card">
      <div class="p-3 d-flex flex-column justify-content-center">

        <div class="prof-picture d-flex justify-content-center">
          <ProfileModal ref="pictureModal" method="post" rout="/updateProfPicture" target="prof_picture" type="file"/>
          <div v-on:mouseenter="toggleImgPen()" v-on:mouseleave="toggleImgPen()"
               style="display:block; max-height:100px;overflow:hidden;">
            <img :src="loadImg()" alt="" width="100px" height="100px">
            <div class="prof-picture-pen" v-if="penImg">
              <img v-on:click="profPictureEdit()" src="/img/pencil.png" alt="" width="25px" height="25px">
            </div>
          </div>
        </div>

        <div class="prof-title d-flex justify-content-center">
          <ProfileModal ref="nameModal" method="post" rout="/updateProfName" target="name" type="text"/>
          <div v-on:mouseenter="toggleNamePen()" v-on:mouseleave="toggleNamePen()"
               style="display: block; max-height: 100px; overflow: hidden;min-width: 100%;text-align: center;">
            <h3>{{ user.name }}</h3>
            <div class="prof-name-pen" v-if="penName">
              <img v-on:click="profNameEdit()" src="/img/pencil.png" alt="" width="25px" height="25px">
            </div>
          </div>
        </div>
        <div class="prof-info d-flex justify-content-center">
<!--          <h3>{{ user }}</h3>-->
          <div class="row">
            <div class="col">
              <b>Email</b>
            </div>
            <div class="col">
              {{user.email}}
            </div>
          </div>
<!--          <div class="row">-->
<!--            <div class="col">-->
<!--              <b>Email</b>-->
<!--            </div>-->
<!--            <div class="col">-->
<!--              {{user.email}}-->
<!--            </div>-->
<!--          </div>-->
        </div>


        <div class="prof-logout d-flex justify-content-center">
          <a href="/logout">Logout</a>
        </div>

      </div>
    </div>
  </Transition>
</template>
<script>
import axios from 'axios';
import ProfileModal from './ProfileModal'

export default {
  data: function () {
    return {
      penName: false,
      penImg: false,
      user: {}
    }
  },
  mounted() {
    console.log('Mounted card');
    this.loadUser();
  },

  methods: {
    loadUser() {
      axios.get('api/user')
          .then((response) => {
            this.user = response.data;
            console.log(this.user);
          })
          .catch(function (error) {
            console.log(error)
          })
    },
    loadImg() {
      return ("/uploads/profiles/" + this.user.prof_picture);
    },
    toggleImgPen() {
      this.penImg = !this.penImg
    },
    toggleNamePen() {
      this.penName = !this.penName
    },
    profPictureEdit() {
      this.$refs.pictureModal.show();
    },
    profNameEdit() {
      this.$refs.nameModal.show();
    }
  },
  components: {
    ProfileModal
  },
}
</script>
