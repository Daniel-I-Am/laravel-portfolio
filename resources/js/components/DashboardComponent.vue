<template>
    <div class="container-fluid">
        <h1>Studievoortgang dashboard</h1>
        <div class="mb-2">
            <h2>Studievoortgang: ({{ this.current_ec }} / {{ this.total_ec }})</h2>
            <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" :style="`width: ${getProgress()}%`" :aria-valuenow="getProgress()" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <table class="table">
            <tbody>
                <template v-for="course in courses">
                    <course :course="course" :editor-methods="this.editorMethods"></course>
                    <subject v-for="subject in course.subjects" v-bind:key="subject.id" :subject="subject" :editor-methods="this.editorMethods"></subject>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        mounted: function() {
            this.fetchCourses();
        },

        data: function() {
            return {
                courses: {},
                current_ec: 0,
                total_ec: 0,
                editing: null,
                editorMethods: {
                    edit: this.editObject,
                    close: this.closeEditor,
                },

                token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },

        methods: {
            fetchCourses: function(page_url) {
                page_url = page_url || '/api/courses';
                fetch(page_url)
                    .then(res => res.json())
                    .then(data => {
                        this.courses = data;
                        this.current_ec = data.map(e => e.credit_obtained_count).reduce((s, e) => s + e);
                        this.total_ec = data.map(e => e.credit_count).reduce((s, e) => s + e);
                    })
                    .catch(console.log);
            },
            getProgress: function() {
                return this.current_ec/this.total_ec * 100;
            },
            editObject: function() {
                this.editing.editObject();
            },
            closeEditor: function() {
                this.editing.closeEditor();
            },
        },
    }
</script>
