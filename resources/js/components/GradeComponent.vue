<template>
    <td v-if="grades.length > 0" class="w-25" @click="editObject()">
        {{ grades.map(e => e.grade).filter(e => e != null).join(', ') }}
        <span class="badge badge-secondary"
              v-if="grades
                          .map(e => e.grade)
                          .filter(e => e == null)
                          .length > 0"
        >
                    {{ grades.map(e => e.grade).filter(e => e == null).length }}
                    {{ grades.map(e => e.grade).filter(e => e == null).length === 1 ? 'cijfer' : 'cijfers' }} te gaan.
            </span>
    </td>
    <td v-else @click="editObject()">Geen</td>
</template>

<script>
    export default {
        props: {
            subject_id: Number,
            grades: Array,
        },
        data: function() {
            return {
                editing: false,
            }
        },
        methods: {
            editObject() {
                this.$emit('editing', [this, this.grades]);
                this.editing = true;
            },
            cancelEditor() {
                if (!this.editing) return;
                this.$emit('closing');
            },
            closeEditor() {
                this.editing = false;
            }
        }
    }
</script>
