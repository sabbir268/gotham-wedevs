import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import SignUp from './components/SignUp'
import Login from './components/Login'
import ViewAllPost from './components/ViewAllPost'
import CreatePost from './components/CreatePost'
import EditPost from './components/EditPost'

const routes = [{
        path: '/',
        component: ViewAllPost
    },
    {
        path: '/sign-up',
        component: SignUp
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/all-post',
        component: ViewAllPost
    },
    {
        path: '/create-post',
        component: CreatePost,
        beforeEnter: requireAuth
    },
    {
        path: '/edit-post/:id',
        component: EditPost,
        beforeEnter: requireAuth
    },
]



const router = new VueRouter({
    routes, // short for `routes: routes`,
    hashbang: false,
    mode: 'history'
})

function requireAuth(to, from, next) {
    if (localStorage.token) {
        next();
    } else {
        window.location.href = "/login";
    }
}


export default router
