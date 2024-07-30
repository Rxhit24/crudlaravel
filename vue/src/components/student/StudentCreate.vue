<template>
    <div class="main-container rounded px-5 m-2" style="width: 60%">
        <div v-if="errorList" class="container bg-danger text-white rounded px-3 pt-2 pb-1">
            <ul>
                <li v-for="(error, index) in errorList " :key='index'>
                    {{ error[0] }}
                </li>
            </ul>
        </div>
        <form @submit.prevent="storeStudent()" class="input-text py-2">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input v-model="student.name" type="text" class="form-control" name="name" aria-describedby="emailHelpId"
                    placeholder="Name">
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input v-model="student.course" type="text" class="form-control" name="course"
                    aria-describedby="emailHelpId" placeholder="Course">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input v-model="student.email" type="email" class="form-control" name="email" aria-describedby="emailHelpId"
                    placeholder="abc@mail.com">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input v-model="student.phone" type="number" class="form-control" name="phone"
                    aria-describedby="emailHelpId" placeholder="Eg-9876543210">
            </div>


            <button type="submit" class="btn " :class="[alertInfo.loading ? 'button-color-block' : 'button-color']">
                Submit
            </button>
        </form>
        <div v-if="alertInfo.show" class="position-fixed alertResponse"
            :style="[alertInfo.response === 200 ? 'background-color: rgb(44, 239, 132);' : 'background-color: rgb(247, 65, 45);']">
            <h1>{{ alertInfo.message }}</h1>
        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'StudentCreate',
    data() {
        return {
            student: {
                'name': '',
                'course': '',
                'email': '',
                'phone': '',
            },
            alertInfo: {
                loading: false,
                show: false,
                message: '',
            },
            errorList: {}
        }
    },
    methods: {
        storeStudent() {
            // console.log(this.student);

            this.alertInfo.loading = true;
            axios.post('http://localhost:8000/api/students', this.student)
                .then(response => {
                    this.alertResponseBlock(response)
                    console.log(response);
                    this.errorList = {};
                })
                .catch(err => {
                    this.alertResponseBlock(err.response);
                    console.log(err);
                });

        },
        alertResponseBlock(data) {
            if (data.data.status === 200) {
                this.alertInfo.response = data.data.status;
                this.alertInfo.show = true;
                this.alertInfo.message = data.data.message;
            } else if (data.data.status == 422) {
                this.errorList = data.data.errors;
            } else {

            }
            setTimeout(() => {
                this.alertInfo = {
                    loading: false,
                    response: '',
                    show: false,
                    message: '',
                };
                this.student = {
                    'name': '',
                    'course': '',
                    'email': '',
                    'phone': '',
                };

            }, 3000)
        }
    },
}
</script>

<style scoped >
.main-container{
    background-color: rgb(70, 69, 69);
    width: 70vw;
    border: 2px solid rgb(159, 158, 158)
}

.input-text {
    color: antiquewhite;
}

.input-text input {
    background-color: #212529;
    color: antiquewhite
}

.button-color {
    background-color: antiquewhite;
    color: #212529;
}

.button-color-block {
    background-color: rgb(153, 151, 148);
    color: #f4f8fc;
}

.alertResponse {
    top: 80%;
    left: 50%;
    width: 400px;
    height: 100px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #f4f8fc;
}
</style>