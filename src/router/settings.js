import IndividualProfile from '../views/settings/IndividualProfile'
import Plan from '../views/settings/Plan'

export default [
  {
    path: '/settings/profile',
    name: 'IndividualProfile',
    component: IndividualProfile,
    title: 'IndividualProfile'
  },
  {
    path: '/settings/plan',
    name: 'Plan',
    component: Plan,
    title: 'Plan'
  }
]