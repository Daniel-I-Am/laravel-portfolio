<template>
    <div class="container-fluid">
        <h1>Woot, my own component!</h1>
        <table class="table">
            <thead>
                <th>Naam</th>
                <th>Blok</th>
                <th>Vaknaam</th>
                <th>EC Waarde</th>
                <th>Cijfers</th>
            </thead>
            <tbody>
                <template v-for="course in courses">
                    <tr v-for="subject in course.subjects">
                        <td v-if="subject.id === course.subjects[0].id" :rowspan="course.subjects.length">{{ course.name }}</td>
                        <td v-if="subject.id === course.subjects[0].id" :rowspan="course.subjects.length">{{ course.term }}</td>
                        <td>{{ subject.name }}</td>
                        <td>{{ subject.ec_value }}</td>
                        <td v-if="subject.grades.length > 0">{{ subject.grades.map(e => e.grade).join(', ') }}</td>
                        <td v-else>Geen</td>
                    </tr>
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
                pagination: {},
            }
        },

        methods: {
            fetchCourses: function() {
                fetch('/api/courses')
                    .then(res => res.json())
                    .then(data => {
                        this.pagination.current_page = data.current_page;
                        this.pagination.last_page = data.last_page;
                        this.pagination.next_page_url = data.next_page_url;
                        this.pagination.prev_page_url = data.prev_page_url;

                        this.courses = data.data;

                        console.log(this.courses);
                    })
                    .catch(console.log);
            }
        },
    }
</script>