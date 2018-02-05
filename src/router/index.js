import Vue from 'vue'
import VueRouter from 'vue-router'
import Search from '../views/common/Search'
import Address from '../views/common/Address'
import Terms from '../views/common/Terms'
import dashboardRoutes from './dashboard'
import loginRoutes from './login'
import onboardingRoutes from './onboarding'
import propertyRoutes from './property'
import notfound from './notfound'

Vue.use(VueRouter)

const baseRoutes = [
  {
    path: '',
    component: Search
  },
  {
    path: '/address',
    name: 'Address',
    component: Address,
    title: 'Address'
  },
  {
    path: '/terms',
    name: 'Terms',
    component: Terms,
    title: 'Terms'
  }
]

const routes = baseRoutes.concat(
  dashboardRoutes,
  loginRoutes,
  onboardingRoutes,
  propertyRoutes,
  notfound
)

export default new VueRouter({
  routes,
  mode: 'history'
})
