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
                    <tr :id="`course-${course.id}`" class="table-info" v-on:click="editCourse(course)">
                        <td colspan="3">{{ course.name }}</td>
                    </tr>
                    <template v-for="subject in course.subjects">
                        <tr :id="`subject-${subject.id}`" :class="getSubjectClass(subject)" v-on:click="editSubject(subject)">
                            <td>{{ subject.name }}</td>
                            <td>{{ subject.ec_value }} EC</td>
                            <td v-if="subject.grades.length > 0">
                                {{ subject.grades.map(e => e.grade).filter(e => e != null).join(', ') }}
                                <span class="badge badge-secondary"
                                      v-if="subject.grades
                                      .map(e => e.grade)
                                      .filter(e => e == null)
                                      .length > 0">
                                    {{ subject.grades.map(e => e.grade).filter(e => e == null).length }} {{ subject.grades.map(e => e.grade).filter(e => e == null).length === 1 ? 'cijfer' : 'cijfers' }} te gaan.
                                </span>
                            </td>
                            <td v-else>Geen</td>
                        </tr>
                    </template>
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
                editing: {
                    isSubject: false,
                    object: null,
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
            getSubjectClass: function(subject) {
                if (subject.grades.length === 0) return null;
                let result = subject.grades.map(e => e.grade).filter(e => e != null).reduce((s, e) => s + e);
                if (subject.grades.filter(e => e.grade == null).length > 0) {
                    if (result / subject.grades.filter(e => e.grade != null).length < 5.5) {
                        return 'table-warning';
                    }
                    return null;
                }
                if (result/subject.grades.length >= 5.5) {
                    return 'table-success';
                }
                return 'table-danger';
            },
            getProgress: function() {
                return this.current_ec/this.total_ec * 100;
            },
            editCourse: function(course) {
                if (this.editing.object != null && this.editing.object.id === course.id && this.editing.isSubject === false) {
                    return;
                } else {
                    this.closeEditor();
                }
                this.editing.isSubject = false;
                this.editing.object = course;

                let td = document.getElementById(`course-${course.id}`).firstChild;
                let input = document.createElement('input');
                input.type = 'text';
                input.value = td.innerText;
                let submit = document.createElement('input');
                submit.type = 'submit';
                submit.value = "Aanpassen";
                submit.addEventListener('click', (e) => {
                    this.updateCourse(e.target.previousElementSibling.value);
                });
                td.removeChild(td.firstChild);
                td.appendChild(input);
                td.appendChild(submit);
            },
            updateCourse: function(updateText) {
                fetch(`/api/courses/${this.editing.object.id}/`, {
                    method: 'PATCH',
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        'name': updateText,
                        'term': this.editing.object.term,
                        '_token': this.token,
                    }),
                })
                    .then((res) => {
                        if (res.status !== 200) {
                            throw new Error(res.statusText);
                        }
                        this.editing.object.name = updateText;
                        this.fetchCourses();
                        this.closeEditor();
                    })
                    .catch(console.log);
            },
            editSubject: function(subject) {
                if (this.editing.object != null && this.editing.object.id === subject.id && this.editing.isSubject === true) {
                    return;
                } else {
                    this.closeEditor();
                }
                this.editing.isSubject = true;
                this.editing.object = subject;

                let td = document.getElementById(`subject-${subject.id}`).firstChild;
                let inputs = [];
                let input = document.createElement('input');
                input.type = 'text';
                input.value = td.innerText;
                td.appendChild(input);
                input = document.createElement('input');
                input.type = 'text';
                input.value = td.nextElementSibling.innerText;
                td.appendChild(input);
                input = document.createElement('input');
                input.type = 'text';
                input.value = td.nextElementSibling.nextElementSibling.innerText;
                td.appendChild(input);
                let submit = document.createElement('input');
                submit.type = 'submit';
                submit.value = "Aanpassen";
                submit.addEventListener('click', (e) => {
                    this.updateSubject(e.parentNode);
                });
                td.removeChild(td.firstChild);
                td.nextElementSibling.hidden = true;
                td.nextElementSibling.nextElementSibling.hidden = true;
                td.colSpan = '3';
                td.appendChild(submit);
            },
            updateSubject: function(updateText) {
                fetch(`/api/courses/${this.editing.object.id}/`, {
                    method: 'PATCH',
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        'name': updateText,
                        'term': this.editing.object.term,
                        '_token': this.token,
                    }),
                })
                    .then((res) => {
                        if (res.status !== 200) {
                            throw new Error(res.statusText);
                        }
                        this.editing.object.name = updateText;
                        this.fetchCourses();
                        this.closeEditor();
                    })
                    .catch(console.log);
            },
            closeEditor: function() {
                if (this.editing.object == null) return;
                if (this.editing.isSubject) {
                    let td = document.getElementById(`subject-${this.editing.object.id}`).firstChild;

                    td.innerText = this.editing.object.name;
                    td.colSpan = '1';
                    td.nextElementSibling.hidden = false;
                    td.nextElementSibling.nextElementSibling.hidden = false;
                } else {
                    let td = document.getElementById(`course-${this.editing.object.id}`).firstChild;

                    td.innerText = this.editing.object.name;
                }
                this.editing.object = null;
            },
        },
    }
</script>