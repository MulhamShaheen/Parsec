<template>
  <div id="card-root" v-on:click="showCard($event)">
    <img :src="getImage()" alt="">
    <UserCard ref="card"/>
  </div>
</template>
<script>
import UserCard from './UserCard'

  export default {
    data: function (){
      return{
        message: "1212"
      }
    },
    mounted(){
      console.log('Mounted');
    },
    methods:{
      getImage(){
        return  'img/user.svg';
      },
      showCard(e){
        this.$refs.card.showSelf();
      }
    },
    components:{
      UserCard
    }
  }
</script>