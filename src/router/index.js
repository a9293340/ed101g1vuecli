import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Order.vue'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/shoppingcart',
    name: 'ShoppingCart',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/ShoppingCart.vue')
  },
  {
    path: '/member',
    name: 'Member',
    component: () => import(/* webpackChunkName: "about" */ '../views/Member.vue')
  },
  {
    path: '/siginin',
    name: 'Signin',
    component: () => import(/* webpackChunkName: "about" */ '../views/Signin.vue')
  }
]

const router = new VueRouter({
  mode: 'hash',
  base: process.env.BASE_URL,
  routes
})

export default router
