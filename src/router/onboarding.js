import Register from '../views/onboarding/Register'
import Import from '../views/onboarding/Import'
import ManuallyImport from '../views/onboarding/ManuallyImport'
import ImportWait from '../views/onboarding/ImportWait'
import ImportFinish from '../views/onboarding/ImportFinish'
import Payment from '../views/onboarding/Payment'
import PaymentThanks from '../views/onboarding/PaymentThanks'
import Plan from '../views/onboarding/Plan'

export default [
  {
    path: '/register',
    name: 'Register',
    component: Register,
    title: 'Register'
  },
  {
    path: '/import',
    name: 'Import',
    component: Import,
    title: 'Import'
  },
  {
    path: '/manuallyImport',
    name: 'ManuallyImport',
    component: ManuallyImport,
    title: 'ManuallyImport'
  },
  {
    path: '/importWait',
    name: 'ImportWait',
    component: ImportWait,
    title: 'ImportWait'
  },
  {
    path: '/importFinish',
    name: 'ImportFinish',
    component: ImportFinish,
    title: 'ImportFinish'
  },
  {
    path: '/payment',
    name: 'Payment',
    component: Payment,
    title: 'Payment'
  },
  {
    path: '/paymentThanks',
    name: 'PaymentThanks',
    component: PaymentThanks,
    title: 'PaymentThanks'
  },
  {
    path: '/plan',
    name: 'Plan',
    component: Plan,
    title: 'Plan'
  }
]
