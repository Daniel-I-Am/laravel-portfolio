<template>
    <div class="form-group">
        <label :for="this.id">{{ this.label }}</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend" v-if="this.iconClass">
                <div class="input-group-text">
                    <i :class="this.iconClass"></i>
                </div>
            </div>
            <input
                :class="`form-control ${this.validationClass}`"
                :id="this.id"
                :name="this.name"
                :type="this.type"

                :placeholder="this.placeholder != null ? this.placeholder : null"
                :value="this.currentValue"
            >
            <div class="invalid-feedback" v-if="this.error_message">{{ this.error_message }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                validationClass: '',
                currentValue: null,
                error_message: null,
            }
        },
        props: {
            type: {
                type: String,
                default: "text",
            },
            placeholder: {
                type: String,
                default: null,
            },
            id: String,
            name: String,
            label: {
                type: String,
                default: null,
            },
            iconClass: {
                type: String,
                default: null
            },
            value: {
                type: String,
                default: null,
            },

            popoverTitle: {
                type: String,
                default: null,
            },
            popoverContent: {
                type: String,
                default: null,
            },
            popoverSide: {
                type: String,
                default: "bottom",
            },

            validationCallback: {
                type: Function,
                default: function(value) {
                    if (value)
                        return true;
                    this.error_message = "Veld is verplicht";
                    return false;
                },
            }
        },
        mounted: function() {
            this.currentValue = this.value;

            $(`#${this.id}`)
                .focus(() => {
                    if (this.popoverTitle != null && this.popoverContent != null) {
                        $(`#${this.id}`).popover({
                            title: this.popoverTitle,
                            content: this.popoverContent,
                            placement: this.popoverSide,
                            html: true,
                        });
                    }
                })
                .blur(() => {
                    if (this.popoverTitle != null && this.popoverContent != null) {
                        $(`#${this.id}`).popover('hide');
                    }
                    this.currentValue = $(`#${this.id}`).val();
                    if (this.validationCallback(this.currentValue)) {
                        this.validationClass = 'is-valid';
                    } else {
                        this.validationClass = 'is-invalid';
                    }
                });
        },
    }
</script>
