<template>
    <div class="">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
            <div class="container-fluid">
                <a class="navbar-brand ps-5" style="color: antiquewhite;" href="#">CRUD</a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav mx-auto mt-lg-0 ">
                        <li class="nav-item">
                            <router-link class="link " to="/">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="link" to="/about">About us</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="link" to="/report">Report</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="link" to="/qualification">Qualification</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="link" to="/students">Student</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="link" to="/profilesurveys">Profile Surveys</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid d-flex justify-content-center ps-3 m-3">
            <router-view></router-view>
        </div>


    </div>
</template>
<script>
import Students from './student/Students.vue';

export default {
    name: 'HeaderNav',
    components: {
        Students,

    }

}
</script>
<style scoped>
.link {
    padding: 5px 20px;
    text-decoration: none;
    color: antiquewhite;
    border-radius: 5px;
}


.router-link-exact-active {
    background-color: antiquewhite;
    color: rgb(15, 15, 15);
}
</style>