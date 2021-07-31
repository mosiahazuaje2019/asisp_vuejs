import Vue from "vue";
import VueRouter from 'vue-router'
import router from './router/index'

require('./bootstrap');

//Libraries
import PrimeVue from 'primevue/config'
import Textarea from 'primevue/textarea'
import InputText from 'primevue/inputtext'
import InputNumber from 'primevue/inputnumber'
import Button from 'primevue/button'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Dropdown from 'primevue/dropdown'
import Dialog from 'primevue/dialog'
import Card from 'primevue/card';

// import styles
import 'primevue/resources/themes/saga-blue/theme.css' //theme
import 'primevue/resources/primevue.min.css' //core css
import 'primeicons/primeicons.css' //icons
import 'primeflex/primeflex.css'; //flex

//Extern Components
Vue.component('Textarea', Textarea)
Vue.component('InputText', InputText)
Vue.component('InputNumber', InputNumber)
Vue.component('Button', Button)
Vue.component('DataTable', DataTable)
Vue.component('Column', Column)
Vue.component('Dropdown', Dropdown)
Vue.component('InputNumber', InputNumber)
Vue.component('Dialog', Dialog)
Vue.component('Card', Card)
Vue.use(VueRouter)

Vue.use(PrimeVue)

const app = new Vue({
    el: '#app',
    router,
})
