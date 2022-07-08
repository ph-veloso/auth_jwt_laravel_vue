import { createRouter, createWebHistory } from 'vue-router'
import Cadastro from '../views/Cadastro.vue'
import LoginForm from '../views/Login.vue'
import Security from '../services/middlewareAuth'
import Logout from '../views/Logout.vue'
import EditCadastro from '../views/EditarCadastro.vue'
import Prevent from '../services/middlewarePrevent'

const routes = [
  {
    path: '/cadastro',
    name: 'cadastro',
    beforeEnter: Prevent.auth,
    component: Cadastro
  },
  {
    path: '/logout',
    name: 'LogoutPage',
    beforeEnter: Security.auth,
    component: Logout,
  },
  {
    path: '/editar_usuario',
    name: 'EditCadastro',
    beforeEnter: Security.auth,
    component: EditCadastro,
  },
  {
    path: '/login',
    name: 'Login',
    beforeEnter: Prevent.auth,
    component: LoginForm
  },
  {
    path: '/home',
    name: 'HomePage',
    beforeEnter: Security.auth,
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/HomePage.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
