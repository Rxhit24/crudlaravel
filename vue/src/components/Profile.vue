<template>
    <div class="w-100 bg-light">
        <div class="cntainer text-light bg-dark p-2 w-25">

            <div>
                <h3>Profile Survey Add - Admin</h3>
            </div>
            <form @submit.prevent="submitQuestionSet()" class="input-text py-2">
                <div class="mb-3">
                    <label for="name" class="form-label">Title</label>
                    <input v-model="title" type="text" class="form-control" name="name" placeholder="Title">
                </div>
                <div class="mb-3">
                    <label for="course" class="form-label">Icon</label>
                    <input v-model="icon" type="text" class="form-control" name="course" placeholder="Icon">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Reward</label>
                    <input v-model="reward" type="text" class="form-control" name="reward" placeholder="Reward">
                </div>


                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </form>

        </div>
        <div class="mt-5">
            <div class="main-container rounded">
                <div class="head-container px-5 py-2 border m-2 rounded">
                    <h1 class="ps-2">Question Set - Admin</h1>
                </div>
                <div class="m-3 p-4">

                    <div class="d-flex justify-content-between px-3 align-items-center">
                        <h5 class="text-light">Question Set</h5>
                        <button class="btn btn-primary" @click="submitQuestionSet">Add</button>
                    </div>
                    <div class="d-flex">
                        <div class="d-flex flex-column border border-1 my-3 mx-3 p-3 rounded-2 text-light text-center"
                            v-for="question in questionSets" :key="question.id">
                            <span class="fs-4"><i :class="question.icon"></i></span>
                            <span>{{ question.title }}</span>
                            <span>Reward : {{ question.reward }}</span>
                            <button class="btn btn-primary mt-2"
                                @click="getQuestionsOfQuestionSet(question.id)">Edit</button>
                        </div>

                    </div>

                </div>
            </div>



        </div>
        <div class="mt-5">
            <div class="main-container rounded">
                <div class="head-container px-5 py-2 border m-2 rounded">
                    <h1 class="ps-2">Questions - Admin</h1>
                </div>
                <div class="m-3 p-4 border border-2 border-light position-relative">
                    <div class="d-flex justify-content-between px-3 align-items-center">
                        <h5 class="text-light">Questions</h5>
                        <button class="btn btn-primary" @click="addQuestionInQuestionSets">Add</button>
                    </div>
                    <div class="d-flex flex-column border border-1 my-3 mx-3 p-3 rounded-2 text-light"
                        v-for="question in questions" :key="question.id">
                        <InputField :question="question" :edit="isEditing" @submit-answer="submitAnswer" />
                    </div>


                    <pre>
                        {{ questions }}
                    </pre>
                    <div class="d-flex flex-column position-absolute top-0 end-100">
                        <button class="btn btn-danger  " @click="removeQuestionInQuestionSet">Remove</button>
                        <button class="btn btn-primary ms-2 " @click="makeEditable">Edit</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
import InputField from './helper/InputField.vue';
import axios from 'axios';
export default {
    data() {
        return {
            title: null,
            icon: null,
            reward: null,
            isEditing: false,
            questionSets: [],
            questions: []
        }
    },
    components: {
        InputField,
    },
    methods: {
        submitQuestionSet() {
            const data = {
                title: this.title,
                icon: this.icon,
                reward: this.reward
            }
            axios.post('http://localhost:8000/api/questionset', data).then((result) => {
                console.log(result.data);
            }).catch((err) => {
                console.log(err.data);
            });

        },
        getQuestionSet() {
            this.questionSets = [
                    {
                        "id": 3,
                        "title": "Airplane",
                        "icon": "bi bi-airplane",
                        "reward": 50,
                        "created_at": "2024-07-29T05:22:49.000000Z",
                        "updated_at": "2024-07-29T05:22:49.000000Z"
                    },
                    {
                        "id": 4,
                        "title": "Zero",
                        "icon": "bi bi-0-square",
                        "reward": 10,
                        "created_at": "2024-07-29T05:26:04.000000Z",
                        "updated_at": "2024-07-29T05:26:04.000000Z"
                    },
                    {
                        "id": 5,
                        "title": "AMD",
                        "icon": "bi bi-amd",
                        "reward": 100,
                        "created_at": "2024-07-29T05:26:32.000000Z",
                        "updated_at": "2024-07-29T05:26:32.000000Z"
                    },
                    {
                        "id": 6,
                        "title": "Backpack",
                        "icon": "bi bi-backpack",
                        "reward": 150,
                        "created_at": "2024-07-30T05:53:23.000000Z",
                        "updated_at": "2024-07-30T05:53:23.000000Z"
                    }
                ]
            // axios.get('http://localhost:8000/api/questionset').then((result) => {
            //     console.log(result.data);

            // }).catch((err) => {
            //     console.log(err.data);
            // });
        },
        getQuestionsOfQuestionSet(id) {
            console.log(id);
            this.questions = [
                {
                    "question_type": "checkbox",
                    'id': 1,
                    "options": [
                        {
                            'id': 1,
                            "title": "Lower Elementary School"
                        },
                        {
                            'id': 2,
                            "title": "Upper Elementary School"
                        },
                        {
                            'id': 3,
                            "title": "Secondary School"
                        },
                        {
                            'id': 4,
                            "title": "Technical Education"
                        }
                    ],
                    "display_option": "normal",
                    "is_optional": true,
                    "onAnswerChangeInvokeFilteredAnswers": false,
                    "is_readonly": false,
                    "title": "Education level:",
                    "questionSetId": null,
                    "description": "",
                }, {
                    "question_type": "radio",
                    'id': 2,
                    "options": [
                        {
                            'id': 1,
                            "title": "Realme",
                            "multimedia": null
                        },
                        {
                            'id': 2,
                            "title": "Oppo",
                            "multimedia": null
                        },
                        {
                            'id': 3,
                            "title": "LG",
                            "multimedia": null
                        },
                        {
                            'id': 4,
                            "title": "Xiaomi",
                            "multimedia": null
                        }
                    ],
                    "display_option": "normal",
                    "is_optional": true,
                    "onAnswerChangeInvokeFilteredAnswers": false,
                    "is_readonly": false,
                    "title": "Prefered Smartphone brand?",
                    "questionSetId": null,
                    "description": "",
                }, {
                    'id': 3,
                    "question_type": "text",
                    "options": [],
                    "display_option": "normal",
                    "is_optional": true,
                    "onAnswerChangeInvokeFilteredAnswers": false,
                    "is_readonly": false,
                    "title": "What do you think of Smartphones?",
                    "questionSetId": null,
                    "description": "",
                },
                {
                    'id': 4,
                    "question_type": "text",
                    "options": [],
                    "display_option": "normal",
                    "is_optional": true,
                    "onAnswerChangeInvokeFilteredAnswers": false,
                    "is_readonly": false,
                    "title": "What do you think of Laptops?",
                    "questionSetId": null,
                    "description": "",
                },
            ]
        },
        submitAnswer(answer) {
            console.log(answer);
        },
        makeEditable() {
            this.isEditing = !this.isEditing;
        },
        addQuestionInQuestionSets() {
            this.questions.push(
                {
                    "question_type": "text",
                    "options": [],
                    "display_option": "normal",
                    "is_optional": true,
                    "onAnswerChangeInvokeFilteredAnswers": false,
                    "is_readonly": false,
                    "title": "What do you think of Amazon?",
                    "description": "",
                }
            )
        }
    },
    beforeMount() {
        this.getQuestionSet();
    }
}
</script>
<style scoped>
.main-container {
    background-color: rgb(70, 69, 69);
    width: 70vw;
    border: 2px solid rgb(159, 158, 158)
}

.head-container {
    background-color: #212529;
}

.head-container h1 {
    color: antiquewhite;
}

.add-student {
    color: #212529;
    background-color: antiquewhite;
}


.list-student1 {
    text-decoration: none;
    color: antiquewhite;
}

.table-formatting thead th {
    background-color: antiquewhite;
    color: #212529;
}

.table-formatting tbody tr td {
    color: antiquewhite;
    background-color: #212529;


    border-bottom: 1px solid antiquewhite;
}

.btnn {
    color: antiquewhite;
    padding: 0px;
    border: none;
    background: none;
    padding: 2px 4px;
    border-radius: 4px;

}

.delBtn:hover {

    background-color: rgb(252, 39, 39);

}

.editBtn:hover {
    background-color: rgb(85, 14, 199);

}
</style>