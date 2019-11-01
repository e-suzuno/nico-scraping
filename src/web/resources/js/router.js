import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './components/Home/Home'
import About from './components/About/About'
import Exclusion from './components/Exclusion/Exclusion'


Vue.use(VueRouter);

const routes = [
    {path: '/', component: Home},
    {path: '/about', component: About},
    {path: '/exclusion', component: Exclusion},
];

const router = new VueRouter({
    mode: 'history',
    routes
});


/*
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (userStore.state.authenticated === false) {
            next({
                path: '/',
                query: {redirect: to.fullPath}
            })
        } else {
            next();
        }
    } else {
        next();
    }
});
*/
export default router;
