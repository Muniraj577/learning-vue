import Dashboard from './components/DashboardComponent.vue';
import Profile from './components/ProfileComponent.vue';


export const routes = [
    {
        name: 'dashboard',
        path: '/admin/dashboard',
        component: Dashboard,
    },
    {
        name: 'profie',
        path: '/admin/profile',
        component: Profile,
    }
]