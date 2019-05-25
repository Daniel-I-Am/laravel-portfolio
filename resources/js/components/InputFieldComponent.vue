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
                // vuejs data to store the `is-valid` or `is-invalid` class
                validationClass: '',
                // Keep track of the user input
                currentValue: null,
                // Error message to display, null if none
                error_message: null,

                // A collection of all available methods
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
                            // Check if the input matches... _that_ monstrosity
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
            // Core input stuff
            id: String,
            name: String,
            type: {
                type: String,
                default: "text",
            },

            // User-friendly fields
            label: {
                type: String,
                default: null,
            },
            placeholder: {
                type: String,
                default: null,
            },
            value: {
                type: String,
                default: null,
            },

            // Prepend icon, if it exists
            iconClass: {
                type: String,
                default: null
            },

            // Popover, if it exists
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

            // Validation
            shouldValidate: {
                type: Boolean,
                default: true,
            },
            validation: {
                type: String,
                default: "required"
            },

            // Some misc special types of input
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
                })
                .click((e) => {
                    // If we didn't click the submit button, quit now
                    if (this.type !== 'submit') return;
                    // Stop the default submit
                    e.preventDefault();
                    // Grab the parent form ID and all the input fields of the form
                    let formID = $(`#${this.id}`)[0].form.id;
                    let inputFields = $(`#${formID} :input`);

                    // Validate all fields now
                    inputFields.each((i, e) => {
                        e.focus();
                        e.blur();
                    });

                    // Wait a fraction of a second... the `onblur` needs to trigger
                    setTimeout(() => {
                        // Check if all of them are valid.
                        // Exclude fields that are
                        // a) submit buttons
                        // b) hidden inputs
                        let invalidList = inputFields.filter((i, e) => {
                            return !(
                                $(e).hasClass('is-valid')
                                || $(e).attr('type') === 'submit'
                                || $(e).attr('type') === 'hidden'
                            );
                        });

                        if (invalidList.length === 0) {
                            // All fields are successfully validated
                            $(`#${formID}`).submit();
                        } else {
                            // We are missing a field, scroll to the first in the list
                            invalidList[0].scrollIntoView();
                            invalidList.addClass('incorrect-animate');
                            setTimeout(() => {
                                invalidList.removeClass('incorrect-animate');
                            }, 500);
                        }
                    }, 50);
                });
        },
    }
</script>

<style>
    @keyframes incorrect-input-field-animation {
        0% {
            transform: rotate(0deg);
        }
        25% {
            transform: rotate(2deg);
        }
        50% {
            transform: rotate(0deg);
        }
        75% {
            transform: rotate(-2deg);
        }
        100% {
            transform: rotate(0deg);
        }
    }

    .incorrect-animate {
        -webkit-animation: incorrect-input-field-animation 300ms linear infinite;
        -o-animation: incorrect-input-field-animation 300ms linear infinite;
        animation: incorrect-input-field-animation 300ms linear infinite;
    }
</style>
