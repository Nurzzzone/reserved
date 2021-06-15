import { createWebHistory, createRouter } from "vue-router";

import Home from "../components/Home";
import Profile from "../components/Profile";
import Settings from "../components/Settings";
import Payments from "../components/Payments";

const routes = [
    {
        path: "/welcome",
        name: "Home",
        component: Home,
    },
    {
        path: '/profile',
        name: 'Profile',
        component: Profile
    },
    {
        path: '/profile/settings',
        name: 'Profile/Settings',
        component: Settings
    },
    {
        path: '/profile/payments',
        name: 'Profile/Payments',
        component: Payments
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
