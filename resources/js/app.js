// require('./bootstrap');
import VModal from 'vue-js-modal/dist/index.nocss.js'
import 'vue-js-modal/dist/styles.css'

window.Vue = require('vue').default;
Vue.use(VModal);

Vue.component('user-icon',require('./components/User.vue').default);
Vue.component('user-card',require('./components/UserCard.vue').default);
Vue.component('profile-card',require('./components/ProfileCard.vue').default);
Vue.component('profile-modal',require('./components/ProfileModal.vue').default);
Vue.component('tags-table',require('./components/Resume/TagsTable.vue').default);

const app = new Vue({
    el: '#body'
});

var userCard = new Vue({
    el: '#user',
    data: {
        message: 'My first VueJS Task'
    },
    mounted(){
        console.log(123 );
    },

    methods: {

    },
});

var profileCard = new Vue({
    el: '#profile',
    data: {
        message: 'My first VueJS Task'
    },
    mounted(){
        console.log(123 );
    },

    methods: {

    },
});




let adminImage = document.getElementsByClassName('admin-panel-image');
adminImage.addEventListener("click",(e)=>{
    this.next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
});


