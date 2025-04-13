<template>
    <div class="form_field-wrapper">
        <label :for="labelStr + 'Field'" class="form_label">{{ labelStr }}</label>
        <input :placeholder="placeholder" :type="props.type" :name="labelStr + 'Field'" class="form_input w-input" v-model="inputValue" @input="validateInput" >
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    const inputValue = ref('');
    let placeholder;
    

    const props = defineProps({
        form: Object,
        labelStr: String,
        type: String
    });

    if (props.type == "number") {
        placeholder = "1";
    }
    else{
        placeholder = "";
    }

    const validateInput = () => {
        if (inputValue.value < 1 && inputValue.value !== ""){
            inputValue.value = 1
        }
    }

</script>

<style scoped>
    .form_field-wrapper {
        margin-bottom: 1.25rem;
    }
    .form_label {
        font-weight: 600;
    }
    .form_input {
        padding: var(--space--xsmall) var(--space--small);
        border: .1rem solid var(--color--border);
        color: var(--color--text);
        border-radius: .5rem;
        min-height: 3.25rem;
        margin-bottom: 0;
        font-size: 1rem;
    }
    .form_input.is-select-input {
        background-color: var(--swatches--neutral0);
        align-items: center;
        display: flex;
    }
    .w-input:focus, .w-select:focus {
        border-color: #3898ec;
        outline: 0;
    }
</style>