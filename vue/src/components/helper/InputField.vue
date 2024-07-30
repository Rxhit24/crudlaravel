<template>
    <div v-if="question.question_type === 'checkbox'" >
        <div v-if="!edit">
            <label class="form-label">{{ question.title }}</label>
            <div class="form-check" v-for="option, index in question.options" :key="index">
                <input class="form-check-input" :type="question.question_type" :value="option.title"
                    :id="question.id + '-' + option.id" v-model="answerCheckbox">
                <label class="form-check-label" :for="question.id + '-' + option.id">
                    {{ option.title }}
                </label>
            </div>
            <button class="btn btn-success" @click="$emit('submitAnswer', this.answerCheckbox)">Submit</button>
        </div>

        <div v-else>
            <ClickToEdit :value="question.title" @input="(valueLocal) => question.title = valueLocal" />
            <div class="form-check" v-for="option, index in question.options" :key="index">
                <input class="form-check-input" :type="question.question_type" :value="option.title"
                    :id="question.id + '-' + option.id" v-model="answerCheckbox">
                <label class="form-check-label" :for="question.id + '-' + option.id">
                    {{ option.title }}
                </label>
            </div>
            <button class="btn btn-success" @click="makeEditable">Done</button>
        </div>

    </div>

    <div v-else-if="question.question_type === 'radio'" >
        <div v-if="!edit">
            <label class="form-label">{{ question.title }}</label>
            <div class="form-check" v-for="option, index in question.options" :key="index">
                <input class="form-check-input" :value="option.title" :type="question.question_type"
                    :id="question.id + '-' + option.id" v-model="answerRadio">
                <label class="form-check-label" :for="question.id + '-' + option.id">
                    {{ option.title }}
                </label>
            </div>
            <button class="btn btn-success" @click="$emit('submitAnswer', this.answerRadio)">Submit</button>
        </div>

        <div v-else>
            <ClickToEdit :value="question.title" @input="(valueLocal) => question.title = valueLocal" />
            <div class="form-check" v-for="option, index in question.options" :key="index">
                <input class="form-check-input" :value="option.title" :type="question.question_type"
                    :id="question.id + '-' + option.id" v-model="answerRadio">
                <label class="form-check-label" :for="question.id + '-' + option.id">
                    {{ option.title }}
                </label>
            </div>
            <button class="btn btn-success" @click="makeEditable">Done</button>
        </div>

    </div>

    <div v-else-if="question.question_type" class="mb-3">
        <div v-if="!edit">
            <label class="form-label">{{ question.title }}</label>
            <input :type="question.question_type" class="form-control" :id="question.id" placeholder="Input"
                v-model="answerText">
            <button class="btn btn-success" @click="$emit('submitAnswer', this.answerText)">Submit</button>
        </div>

        <div v-else>
            <ClickToEdit :value="question.title" @input="(valueLocal) => question.title = valueLocal" />
            <input :type="question.question_type" class="form-control" :id="question.id" placeholder="Input" disabled>
            <button class="btn btn-success" @click="makeEditable">Done</button>
        </div>
    </div>
</template>
<script>
import ClickToEdit from './ClickToEdit.vue';

export default {
    data() {
        return {
            answerCheckbox: [],
            answerRadio: null,
            answerText: null,
        }
    },
    props: {
        question: Object,
        edit: Boolean
    },
    components: {
        ClickToEdit
    },
    methods: {
        makeEditable() {
            this.edit = !this.edit;
        }
    }

}
</script>