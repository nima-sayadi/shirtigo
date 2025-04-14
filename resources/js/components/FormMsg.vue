<template>
    <div class="form_message-success w-form-done" tabindex="-1" role="region" aria-label="Form success">
        <div>Thank you! Your submission has been received!</div>
    </div>
    <div class="form_message-error w-form-fail" tabindex="-1" role="region" aria-label="Form failure">
        <div>Oops! Something went wrong while submitting the form.</div>
    </div>
</template>

<style scoped>
    .form_message-success {
        padding: 1.25rem;
    }
    .form_message-error {
        margin-top: .75rem;
        padding: .75rem;
    }
</style>