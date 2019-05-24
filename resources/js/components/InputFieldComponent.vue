<template>
    <div class="form-group">
        <label :for="this.id">{{ this.label }}</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend" v-if="this.iconClass">
                <div class="input-group-text">
                    <i :class="this.iconClass"></i>
                </div>
            </div>
            <input v-if="!this.isTextArea"
                :class="`form-control ${this.validationClass}`"

                :id="this.id"
                :name="this.name"
                :type="this.type"

                :placeholder="this.placeholder != null ? this.placeholder : null"
                :value="this.currentValue"
            >
            <textarea v-else
                :class="`form-control ${this.validationClass}`"

                :id="this.id"
                :name="this.name"

                :placeholder="this.placeholder != null ? this.placeholder : null"

                :cols="this.textAreaCols"
                :rows="this.textAreaRows"
            >{{ this.currentValue }}</textarea>
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

                validationMethods: {
                    none: (value) => {
                        return true;
                    },
                    required: (value) => {
                        if (value)
                            return true;
                        this.error_message = "Veld is verplicht";
                        return false;
                    },
                    email: (value) => {
                        if (value) {
                            // 'Basic' JS email validation. Source: https://emailregex.com/ | resource used @ 24-05-2019
                            const regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                            if (regex.test(value)) {
                                return true;
                            }
                            this.error_message = "E-mail voldoet niet aan formaat: user@example.com";
                            return false;
                        }
                        this.error_message = "Veld is verplicht";
                        return false;
                    },
                }
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

            shouldValidate: {
                type: Boolean,
                default: true,
            },
            validation: {
                type: String,
                default: "required"
            },

            isTextArea: {
                type: Boolean,
                default: false,
            },
            textAreaCols: Number,
            textAreaRows: Number,
        },
        mounted: function() {
            // Grab the property and store as data, so we can edit it later on
            this.currentValue = this.value;

            // Execute on element with id
            $(`#${this.id}`)
                // on focus
                .focus(() => {
                    // if we have popup content, popup
                    if (this.popoverTitle != null && this.popoverContent != null) {
                        $(`#${this.id}`).popover({
                            title: this.popoverTitle,
                            content: this.popoverContent,
                            placement: this.popoverSide,
                            html: true,
                        });
                    }
                })
                // on blur (un-focus)
                .blur(() => {
                    // if we have popup content, hide popup
                    if (this.popoverTitle != null && this.popoverContent != null) {
                        $(`#${this.id}`).popover('hide');
                    }
                    // Assign the new value (any info the user edited) into the currentValue data that we assigned before
                    this.currentValue = $(`#${this.id}`).val();
                    // Check if we even have to validate
                    if (this.shouldValidate) {
                        // If so, try to validate with the validation method stored in `this.validation`
                        if (this.validationMethods[this.validation](this.currentValue)) {
                            // Validation succeeded (returned `true`)
                            this.validationClass = 'is-valid';
                        } else {
                            // Validation did not succeed (returned `false` or `null`)
                            this.validationClass = 'is-invalid';
                        }
                    }
                });
        },
    }
</script>
