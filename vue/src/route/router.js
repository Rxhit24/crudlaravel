import { createRouter, createWebHistory } from "vue-router";
import Students from "../components/student/Students.vue";
import HomePage from "../components/HomePage.vue";
import AboutUs from "../components/AboutUs.vue";
import Report from "../components/Reports.vue";
import StudentDetail from "../components/student/StudentDetail.vue";
import StudentCreate from "../components/student/StudentCreate.vue";
import StudentEdit from "../components/student/StudentEdit.vue";
import NotFound from "../components/NotFound.vue";
import qualificationAdd from "../components/qualification/qualificationAdd.vue";

import Profile from "../components/Profile.vue";

const routes = [
    {
        path:"/",
        name:'HomePage',
        component: HomePage
    },
    {
        path: "/students",
        name: "Students",
        component: Students,
    },
    {
        path: "/profilesurveys",
        name: "Profile",
        component: Profile,
    },
    {
        path:'/about',
        name: "AboutUs",
        component: AboutUs,
    },
    {
        path:'/report',
        name: "Report",
        component: Report,
    },
    {
        path:'/qualification',
        name: "qualificationAdd",
        component: qualificationAdd,
    },
    {
        path: '/students/:id',
        name: 'StudentDetail',
        component: StudentDetail
    },
    {
        path: '/student/create',
        name: 'StudentCreate',
        component: StudentCreate
    },
    {
        path: '/student/:id/edit',
        name: "StudentEdit",
        component: StudentEdit
    },
    {
        path: '/:catchAll(.*)',
        name: 'NotFound',
        component: NotFound
    }
    
];

const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router;
