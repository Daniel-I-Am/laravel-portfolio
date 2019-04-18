<template>
    <div class="container-fluid">
        <h1>Studievoortgang dashboard</h1>
        <div>
            <h2>Propedeuse voortgang: ({{ this.courses }})</h2>
            <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <table class="table">
            <tbody>
                <template v-for="course in courses">
                    <tr class="table-info">
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
            }
        },

        methods: {
            fetchCourses: function(page_url) {
                page_url = page_url || '/api/courses';
                fetch(page_url)
                    .then(res => res.json())
                    .then(data => {
                        this.courses = data;

                        console.log(this.courses);
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
            }
        },
    }
</script>