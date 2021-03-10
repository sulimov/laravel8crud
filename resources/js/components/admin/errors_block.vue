<template>
    <ul>
        <errors-block-row v-for="(text, index) in error" :text="text" :key="index"></errors-block-row>
    </ul>
</template>

<script>
    var errorsBlockRow = Vue.component('errors-block-row', {
        props: [
            'text'
        ],
        template: '<li>{{ text }}</li>'
    })

    export default {
        name: "errors_block",

        props: [
            'error'
        ],

        mounted() {
            console.log('errors_block:');
            console.log(this.error);
        }
    }


</script>
