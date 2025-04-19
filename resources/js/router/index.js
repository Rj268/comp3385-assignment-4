import { createRouter, createWebHistory } from 'vue-router';
import AboutView from "../Pages/AboutView.vue";
import HomeView from "../Pages/HomeView.vue";
import MoviesView from "../Pages/MoviesView.vue";
import addMovieView from "../Pages/addMovieView.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            component: HomeView
        },
        {
            path: '/about',
            component: AboutView
        },
        {
            path: '/movies',
            component: MoviesView
        },
        {
            path: '/movies/create',
            component: addMovieView
        }

    ]
})

export default router;
