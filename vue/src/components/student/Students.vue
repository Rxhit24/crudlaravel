<template>
    <div class="main-container rounded">
        <div class="head-container d-flex justify-content-between align-items-center px-5 py-2 border m-2 rounded">
            <h1 class="ps-2">Students</h1>
            <router-link to="/student/create">
                <button class="btn add-student">Add Students</button>
            </router-link>
        </div>
        <div class="m-3 list-student">
            <div class="table-responsive ">
                <table class="table table-formatting rounded">
                    <thead class="t-head">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Course</th>
                            <th scope="col">Email-ID</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="students.length > 0">
                        <tr  v-for="student in students" :key="student.id" >
                            <td >{{ student.name }}</td>
                            <td>{{ student.course }}</td>
                            <td>{{ student.email }}</td>
                            <td>{{ student.phone }}</td>
                            <td>
                                <router-link :to="{name : 'StudentEdit' , params :{id : student.id}}">
                                    <button class="btnn editBtn">Edit</button>
                                </router-link>
                                <button class="btnn delBtn" @click="deleteStudent(student.id)">Del</button>
                            </td>

                        </tr>
                        </tbody>
                        <tbody  v-else>
                            <tr>
                                NO studenet Data available
                            </tr>

                        </tbody>
                </table>

            </div>
            
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    
    name: 'Students',
    components: {

    },
    data() {
        return {
            students: [],
        };
    },
    mounted() {
        this.getStudent();
    },
    methods:{
        getStudent(){
            axios.get('http://localhost:8000/api/students')
                .then(response => {
                    this.students = response.data.students.data;
                }).catch(err => {
                    this.students = []
                })
        },
        deleteStudent(id){
            console.log('Student Delete')
            axios.delete(`http://localhost:8000/api/students/${id}/delete`)
            .then((response)=>{
                console.log(response);
                this.getStudent();
            })
        }
    }
};
</script>

<style scoped>
.main-container{
    background-color: rgb(70, 69, 69);
    width: 70vw;
    border: 2px solid rgb(159, 158, 158)
}

.head-container{
    background-color: #212529;
}
.head-container h1{
    color: antiquewhite;
}
.add-student{
    color: #212529;
    background-color:antiquewhite;
}
.list-student{
    padding: 0px 47px;
    
}
.list-student1{
    text-decoration: none;
    color: antiquewhite;
}
.table-formatting thead th{
    background-color: antiquewhite;
    color: #212529;
}
.table-formatting tbody tr td{
    color: antiquewhite;
    background-color: #212529;
    
     
    border-bottom:1px solid antiquewhite;
}
.btnn{
    color: antiquewhite;
    padding: 0px;
    border: none;
    background: none;
    padding: 2px 4px;
    border-radius: 4px;

}
.delBtn:hover{
    
    background-color: rgb(252, 39, 39);
    
}
.editBtn:hover{
    background-color: rgb(85, 14, 199);
    
}

</style>