<template>
    <div class="" style="width: fit-content;">

        <input type="text" class="input_to" :style="{ width: changeWidthLength }" v-if="edit" v-model="valueLocal"
            @blur="save($event);" @keyup.enter="save($event);" @keyup.esc="esc($event);" @keyup="changeWidth" v-focus
             />

        <div class="click_to" v-else @click.stop="edit = true;">
            {{ valueLocal }}
        </div>
    
    </div>
</template>
  
<script>
const focus = {
    mounted: (el) => {
        el.focus();
        el.select();
    }
}

export default {

    props: {
        value: String,
    },

    data() {
        return {
            edit: false,
            valueLocal: this.value,
            oldValue: (' ' + this.value).slice(1),
            changeWidthLength: this.value.length+'ch',
        }
    },
    methods: {
        save(event) {
            if (event.target.value) {
                this.valueLocal = event.target.value;
                this.edit = false;
                this.$emit('input', this.valueLocal);
            }
        },
        esc(event) {
            this.valueLocal = this.oldValue;
            event.target.value = this.oldValue;
            this.edit = false;
            this.$emit('input', this.valueLocal);
        },
        changeWidth() {
            var numOfCharacters = this.valueLocal.length + 1;
            if (numOfCharacters > 12) {
                this.changeWidthLength = numOfCharacters + 'ch';
            } else {
                this.changeWidthLength = '12ch';

            }
        },

    },
    watch: {
        value: function () {
            this.valueLocal = this.value;
        }
    },


    emits: ['input'],

    directives: {
        focus
    }

}
</script>

<style scoped>
.click_to{
   margin-bottom: 8px;
   border-radius: 5px;

}

 .input_to{
    border: 2px solid red; 
    outline: none;
    padding: 8px 3px;
    border-radius: 5px;
 }
 .input_to:focus{
    border: 2px solid var(--c-secondary)
 }
 .click_to:hover{
    border: 2px solid var(--c-secondaryOpacity); 
 }
</style>
  