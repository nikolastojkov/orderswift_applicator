import Vue from 'vue'
import '../css/tailwind.css'

//Main pages
import App from './views/app.vue'


const app = new Vue({
    el: '#app',
    components: { App }
});
