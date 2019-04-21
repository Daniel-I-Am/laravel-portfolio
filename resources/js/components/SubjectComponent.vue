<template>
    <tr :id="`subject-${subject.id}`" :class="getSubjectClass(subject)" v-on:click="editSubject(subject)">
        <td>{{ subject.name }}</td>
        <td>{{ subject.ec_value }} EC</td>
        <td v-if="subject.grades.length > 0">
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
            }
        },

        data: function() {
            return {}
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
            editObject: function() {},
            closeEditor: function() {},
        },
    }
</script>
