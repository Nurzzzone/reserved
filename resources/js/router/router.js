import { createWebHistory, createRouter } from "vue-router";

import Main from "../components/Main";

import Profile from "../components/Profile";
import Settings from "../components/Settings";
import Payments from "../components/Payments";
import History from "../components/History";

import Favorite from "../components/Favorite";

import Top from "../components/Top";

import Home from "../components/Home";
import Restaurants from "../components/Restaurants";
import Cafe from "../components/Cafe";
import Bars from "../components/Bars";
import Organization from '../components/Organization';
import CardSuccess from '../components/Card/Success';

const routes = [
    {
        path: "/",
        name: "Main",
        component: Main,
    },
    {
        path: "/card/success",
        name: "CardSuccess",
        component: CardSuccess,
    },
    {
        path: '/home',
        name: 'Home',
        component: Home
    },
    {
        path: '/home/:id',
        name: 'Organization',
        component: Organization
    },
    {
        path: '/home/restaurants',
        name: 'Restaurants',
        component: Restaurants
    },
    {
        path: '/home/cafe',
        name: 'Cafe',
        component: Cafe
    },
    {
        path: '/home/bars',
        name: 'Bars',
        component: Bars
    },
    {
        path: '/top',
        name: 'Top',
        component: Top
    },
    {
        path: '/favorite',
        name: 'Favorite',
        component: Favorite
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
    },
    {
        path: '/profile/history',
        name: 'Profile/History',
        component: History
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
