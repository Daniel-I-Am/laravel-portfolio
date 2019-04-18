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
                    <tr class="table-info" v-on:click="editCourse(course)">
                        <td colspan="3">{{ course.name }}</td>
                    </tr>
                    <template v-for="subject in course.subjects">
                        <tr :class="getSubjectClass(subject)">
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
            }
        },
    }
</script>