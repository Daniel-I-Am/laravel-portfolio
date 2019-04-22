<template>
    <tr :id="`subject-${subject.id}`" :class="getSubjectClass(subject)">
        <template v-if="editing === false">
            <td @click="editObject()">{{ subject.name }}</td>
            <td @click="editObject()">{{ subject.ec_value }} EC</td>
        </template>
        <td colspan="2" v-else>
            <form @submit.prevent="saveEditor()">
                <label class="sr-only" for="name_input">Name</label>
                <input id="name_input" type="text" v-model:value="subject.name">
                <label class="sr-only" for="ec_value_input">Name</label>
                <input id="ec_value_input" type="number" v-model:value="subject.ec_value">
                <input type="submit" value="Aanpassen">
                <input type="reset" value="Annuleren" @click="cancelEditor()">
            </form>
        </td>
        <td v-if="subject.grades.length > 0" @click="editObject()">
            {{ subject.grades.map(e => e.grade).filter(e => e != null).join(', ') }}
            <span class="badge badge-secondary"
                  v-if="subject.grades
                          .map(e => e.grade)
                          .filter(e => e == null)
                          .length > 0"
            >
                    {{ subject.grades.map(e => e.grade).filter(e => e == null).length }} {{ subject.grades.map(e => e.grade).filter(e => e == null).length === 1 ? 'cijfer' : 'cijfers' }} te gaan.
                </span>
        </td>
        <td v-else>Geen</td>
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
            cancelEditor: function() {
                this.$emit('closing');
            },
            closeEditor: function() {
                this.editing = false;
            },
        },
    }
</script>
