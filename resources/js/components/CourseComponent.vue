<template>
    <tr :id="`course-${course.id}`" class="table-info">
        <td colspan="3" class="h4" v-if="editing === false" @click="editObject()">Blok {{course.term}} | {{ course.name }}</td>
        <td colspan="3" v-else>
            <form id="editor_form" class="form-inline" @submit.prevent="saveEditor()">
                <label class="sr-only" for="term_input">Term</label>
                <input class="form-control mb-2 mr-sm-2" id="term_input" type="number" v-model:value="course.term">
                <label class="sr-only" for="name_input">Name</label>
                <input class="form-control mb-2 mr-sm-2" id="name_input" type="text" v-model:value="course.name">
                <input class="btn btn-primary mb-2 mr-sm-2" type="submit" value="Aanpassen">
                <input class="btn btn-danger mb-2" type="reset" value="Annuleren" @click="cancelEditor()">
            </form>
        </td>
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
            },
            'token': String,
        },

        data: function() {
            return {
                editing: false,
            }
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
            editObject: function() {
                this.editing = true;
                this.$emit('editing', this);
            },
            saveEditor: function() {
                fetch(`/api/courses/${this.course.id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        '_token': this.token,
                        'name': document.getElementById('name_input').value,
                        'term': document.getElementById('term_input').value,
                    }),
                })
                    .then(res => res.json())
                    .then(data => {
                        this.$emit('update_course', this.course.id, data);
                        this.cancelEditor();
                    })
                    .catch(console.log);
            },
            cancelEditor: function() {
                this.$emit('closing');
            },
            closeEditor: function() {
                this.editing = false;
            },
        },
    }
</script>
