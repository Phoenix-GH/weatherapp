import Login from '../views/login/Login'
import Logout from '../views/login/Logout'
import ForgotPassword from '../views/login/ForgotPassword'
import ForgotThanks from '../views/login/ForgotThanks'

export default [
  {
    path: '/login',
    name: 'Login',
    component: Login,
    title: 'Login'
  },
  {
    path: '/logout',
    name: 'Logout',
    component: Logout,
    title: 'Logout'
  },
  {
    path: '/forgotpassword',
    name: 'ForgotPassword',
    component: ForgotPassword,
    title: 'ForgotPassword'
  },
  {
    path: '/forgotthanks',
    name: 'ForgotThanks',
    component: ForgotThanks,
    title: 'ForgotThanks'
  }
]
