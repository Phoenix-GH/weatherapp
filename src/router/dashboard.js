import Dashboard from '../views/dashboard/Dashboard'
import List from '../views/dashboard/List'
import Map from '../views/dashboard/Map'

export default [
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    title: 'Dashboard',
    children: [
      {
        path: '/dashboard/list',
        name: 'dashboard-list',
        component: List
      },
      {
        path: '/dashboard/map',
        name: '/dashboard-list',
        component: Map
      }
    ]
  }
]
