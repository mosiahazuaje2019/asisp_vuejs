import VueRouter from 'vue-router'

const ExampleComponent = () => import('../components/ExampleComponent');
const PatientComponent = () => import('../components/Patients/PatientComponent');

const routes = [
    { path: '/', component: ExampleComponent },
    { path: '/patients', component: PatientComponent }
]

const router = new VueRouter({
    routes,
    mode: 'hash'
})

export default router
