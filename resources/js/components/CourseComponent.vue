<template>
    <tr :id="`course-${course.id}`" class="table-info">
        <td colspan="3" class="h4">Blok {{course.term}} | {{ course.name }}</td>
    </tr>
</template>

<script>
    export default {
        props: {
            'course': {
                'id': Number,
                'name': String,
                'term': Number,
            },
            'editor-methods': {
                'edit': Function,
                'close': Function,
            }
        },

        data: function() {
            return {}
        },

        methods: {
            fetchCourse: function() {
                fetch(`/api/courses/${this.course.id}`)
                    .then(res => res.json())
                    .then(data => {
                        this.course.name = data.name;
                        this.course.term = data.term;
                    })
                    .catch(console.log);
            },
            editObject: function() {},
            closeEditor: function() {},
        },
    }
</script>
