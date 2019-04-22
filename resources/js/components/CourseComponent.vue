<template>
    <tr :id="`course-${course.id}`" class="table-info">
        <td colspan="3" class="h4" v-if="editing === false" @click="editObject()">Blok {{course.term}} | {{ course.name }}</td>
        <td colspan="3" v-else>
            <form @submit.prevent="saveEditor()">
                <input type="number" :value="this.course.term">
                <input type="text" :value="this.course.name">
                <input type="submit" value="Aanpassen">
                <input type="reset" value="Annuleren" @click="saveEditor()">
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
            }
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
                this.cancelEditor();
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
