<template>
    <tr :id="`subject-${subject.id}`" :class="getSubjectClass(subject)">
        <template v-if="editing === false">
            <td class="w-50" @click="editObject()">{{ subject.name }}</td>
            <td class="w-25" @click="editObject()">{{ subject.ec_value }} EC</td>
        </template>
        <td colspan="2" v-else>
            <form @submit.prevent="saveEditor()" class="form-inline">
                <label class="sr-only" for="name_input">Name</label>
                <input class="form-control mb-2 mr-sm-2" id="name_input" type="text" v-model:value="subject.name">
                <label class="sr-only" for="ec_value_input">Name</label>
                <input class="form-control mb-2 mr-sm-2" id="ec_value_input" type="number" step=".1" v-model:value="subject.ec_value">
                <input class="btn btn-primary mb-2 mr-sm-2" type="submit" value="Aanpassen">
                <input class="btn btn-secondary mb-2 mr-sm-2" type="reset" value="Annuleren" @click="cancelEditor()">
                <input class="btn btn-danger mb-2" type="reset" value="Verwijderen" @click="deleteSubject()">
            </form>
        </td>
        <grade :grades="subject.grades" :subject_id="subject.id" @editing="(data) => {this.$emit('grade_editing', data)}" @closing="(data) => {this.$emit('grade_closing', data)}"></grade>
    </tr>
</template>

<script>
    export default {
        props: {
            'subject': {
                'id': Number,
                'name': String,
                'ec_value': Number,
                'course_id': Number,
                'grades': Array,
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
            fetchSubject: function() {
                fetch(`/api/subjects/${this.subject.id}`)
                    .then(res => res.json())
                    .then(data => {
                        this.subject.name = data.name;
                        this.subject.term = data.term;
                    })
                    .catch(console.log);
            },
            getSubjectClass: function(subject) {
                if (subject.grades.length === 0) return null;
                let grades_not_null = subject.grades.map(e => e.grade).filter(e => e != null);
                if (grades_not_null.length === 0) return null;
                let result = grades_not_null.reduce((s, e) => s + e);
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
            editObject: function() {
                this.editing = true;
                this.$emit('editing', this);
            },
            saveEditor: function() {
                console.log(`/api/subjects/${this.subject.id}`);
                fetch(`/api/subjects/${this.subject.id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        '_token': this.token,
                        'name': document.getElementById('name_input').value,
                        'ec_value': document.getElementById('ec_value_input').value,
                        'course_id': this.subject.course_id,
                    }),
                })
                    .then(res => res.json())
                    .then(data => {
                        this.$emit('update_subject', this.subject.id, data);
                        this.cancelEditor();
                    })
                    .catch(console.log);
            },
            deleteSubject: function() {
                this.cancelEditor();
                fetch(`/api/subjects/${this.subject.id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        '_token': this.token,
                    }),
                })
                    .then(res => {
                        if (res.status === 200) {
                            this.$emit('deleted_subject');
                        } else {
                            throw new Error(`Failed to assert status code 200 is ${res.status}`);
                        }
                    })
                    .catch(console.log)
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
