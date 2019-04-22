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
                    <subject :token="token" v-for="subject in course.subjects" v-bind:key="subject.id" :subject="subject" @editing="obj => {editObject(obj, false)}" @closing="closeEditor()" @updated_subject="updated_subject" @grade_editing="edit_grade" @grade_closing="close_grade"></subject>
                </template>
            </tbody>
        </table>

        <div class="modal fade" id="gradeModal" tabindex="-1" role="dialog" aria-labelledby="gradeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="gradeModalLabel">Edit grades</h5>
                    </div>
                    <div class="modal-body">
                        <form class="form">
                            <div class="form-group input-group" v-for="grade in grades">
                                <label class="sr-only" :for="grade-`grade.id`">Grade</label>
                                <input type="number" step=".01" class="form-control" :id="grade-`grade.id`" placeholder="Grade, leave empty or not yet obtained" v-model:value="grade.grade" @change="e => update_grade(e, grade)">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text btn btn-danger" @click="remove_grade(grade)">X</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" @click="add_grade()">Toevoegen...</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="editing.cancelEditor()">Done</button>
                    </div>
                </div>
            </div>
        </div>
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
                grades: [],

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
                this.fetchCourses();
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
            edit_grade: function([obj, data]) {
                if (this.editing) this.closeEditor();
                this.editing = obj;
                this.grades = data;
                $('#gradeModal').modal();
            },
            close_grade: function() {
                if (this.editing == null) return;
                this.editing.closeEditor();
                this.grades = [];
                this.editing = null;
                this.fetchCourses();
            },
            add_grade: function() {
                fetch('/api/grades', {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        grade: null,
                        subject_id: this.editing.subject_id,
                        _token: this.token,
                    }),
                })
                    .then(res => res.json())
                    .then(data => {
                        this.grades.push(data);
                    })
                    .catch(() => {this.grades.pop()});
            },
            update_grade: function(e, grade) {
                let value = e.target.value === "" ? null : e.target.value;
                fetch(`/api/grades/${grade.id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        grade: value,
                        subject_id: grade.subject_id,
                        _token: this.token,
                    }),
                })
                    .catch(() => {
                        e.target.value = grade.grade;
                    });
            },
            remove_grade: function(grade) {
                fetch(`/api/grades/${grade.id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        _token: this.token,
                    }),
                })
                    .then(() => {
                        this.grades.splice(this.grades.indexOf(grade), 1);
                    })
            }
        },
    }
</script>
