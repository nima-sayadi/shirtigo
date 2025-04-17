<template>
    <div class="form_message-success w-form-done" tabindex="-1" :style="{ display : displaySuccess }" role="region" aria-label="Form success">
        <div>Thank you! Your submission has been received!</div>
    </div>
    <div class="form_message-error w-form-fail" tabindex="-1" :style="{ display : displayFail }" role="region" aria-label="Form failure">
        <div>Oops! Something went wrong while submitting the form.</div>
    </div>
</template>

<script setup>
    import { watch, ref } from 'vue'
    const props = defineProps({
        isFormSubmitted: Boolean,
        isFormReady: Boolean,
        didOrderFail: Boolean,
    });

    const displaySuccess = ref("none");
    const displayFail = ref("none");

    watch(() => props.isFormSubmitted, (newVal) => {
        if (newVal && props.isFormReady && props.didOrderFail == false) {
            displaySuccess.value = "block";
        }
        else {
            displaySuccess.value = "none";
        }
    })

    watch(() => props.didOrderFail, (newVal) => {
        if (newVal && props.isFormReady) {
            displayFail.value = "block";
        }
        else {
            displayFail.value = "none";
        }
    })

</script>

<style scoped>
    .form_message-success {
        padding: 1.25rem;
    }
    .form_message-error {
        margin-top: .75rem;
        padding: .75rem;
    }
</style>