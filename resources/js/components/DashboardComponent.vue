<template>
    <div class="container-fluid">
        <h1>Studievoortgang dashboard</h1>
        <div class="mb-2">
            <h2>Studievoortgang: ({{ this.current_ec }}&nbsp;/&nbsp;{{ this.total_ec }})</h2>
            <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" :style="`width: ${getProgress()}%`" :aria-valuenow="getProgress()" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <table class="table">
            <tbody>
                <template v-for="(course, index) in courses">
                    <course :token="token" :course="course" @editing="obj => {editObject(obj, true)}" @closing="closeEditor()" @updated_course="updated_course"></course>
                    <subject :token="token" v-for="subject in course.subjects" v-bind:key="subject.id" :subject="subject" @editing="obj => {editObject(obj, false)}" @closing="closeEditor()" @updated_subject="updated_subject"></subject>
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
                editingCourse: true,
                editing: null,

                token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },

        methods: {
            fetchCourses: function(page_url) {
                page_url = page_url || '/api/courses';
                fetch(page_url)
                    .then(res => res.json())
                    .then(data => {
                        Vue.set(this, 'courses', data);
                        this.current_ec = data.map(e => e.credit_obtained_count).reduce((s, e) => s + e);
                        this.total_ec = data.map(e => e.credit_count).reduce((s, e) => s + e);
                    })
                    .catch(console.log);
            },
            getProgress: function() {
                return this.current_ec/this.total_ec * 100;
            },
            editObject: function(object, editingCourse) {
                if (editingCourse === undefined) editingCourse = true;
                this.editingCourse = editingCourse;
                this.closeEditor();
                this.editing = object;
            },
            closeEditor: function() {
                if (this.editing == null) return;
                this.editing.closeEditor();
                this.editing = null;
            },
            updated_course: function(id, data) {
                let index = 0;
                for (let i = 0; i < this.courses.length; i++) {
                    if (this.courses[i].id != id) return;
                    index = i;
                    break;
                }
                Vue.set(this.courses, index, {
                    name: data.name,
                    term: data.term,
                });
            },
            updated_subject: function(id, data) {
                this.course.subjects.filter(e => e.id === id)[0] = data;
            },
        },
    }
</script>
