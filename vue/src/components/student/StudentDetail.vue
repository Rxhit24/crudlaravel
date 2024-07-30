<template>
    <div class="">
        <div >
            <h1>Student detail Page</h1>
            <p>the Id of the Student is {{ id }}</p>
        </div>
    </div>
</template>
<script>
export default {
    name: 'StudentDetail',

    data() {
        return {
            id: this.$route.params.id,
        };
    },
    props:{
        
    }
};
</script>