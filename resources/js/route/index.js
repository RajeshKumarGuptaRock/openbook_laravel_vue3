import { createWebHistory, createRouter } from "vue-router";
import home from '../pages/Frontend/home.vue'
import login from '../pages/Frontend/login.vue';
import register from '../pages/Frontend/register.vue';
import dashboard from '../pages/Backend/dashboard.vue';
import store from '../store/index.js';

const routes = [
    {
        path : '/',
        name : 'Home',
        component : home
    },
    {
        path : '/login',
        name : 'Login',
        component : login,
        meta:{
            requiresAuth:false
        }
    },
    {
        path : '/register',
        name : 'Register',
        component : register,
        meta:{
            requiresAuth:false
        }
    },
    {
        path : '/dashboard',
        name : 'Dashboard',
        component : dashboard,
        meta:{
            requiresAuth:true
        }
    }
];

const router = createRouter({
    history : createWebHistory(),
    routes
});

router.beforeEach((to,from) =>{
    if(to.meta.requiresAuth && store.getters.getToken == 0){
        return { name : 'Login' }
    }
    if(to.meta.requiresAuth == false && store.getters.getToken != 0){
        return { name : 'Dashboard' }
    }
})
export default router;