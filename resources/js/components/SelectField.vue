<template>
    <div class="form_field-wrapper">
        <label :for="labelStr + 'Field'" class="form_label">{{ labelStr }}</label>
        <select :name="labelStr + 'Field'" class="form_input is-select-input w-select" v-model="form[value]">
            <option value="">Select one...</option>
            <option v-for="opt in options" :key="opt.value" :value="opt.value">
            {{ opt.label }}
            </option>
        </select>
    </div>
</template>

<script setup>
    import { reactive } from 'vue';
    import { computed } from 'vue';

    const form = reactive({
        name: '',
        role: '',
    });

    const props = defineProps({
        form: Object,
        value: String,
        labelStr: String,
        type: String
    });

    const optionsMap = {
        'product': [
            { value: 'tshirt', label: 'T-Shirt' },
            { value: 'hoodie', label: 'Hoodie' },
            { value: 'jacket', label: 'Jacket' },
        ],
        'color': [
            { value: 'red', label: 'Red' },
            { value: 'blue', label: 'Blue' },
            { value: 'green', label: 'Green' },
        ],
        'size': [
            { value: '15', label: '15' },
            { value: '16', label: '16' },
            { value: '17', label: '17' },
        ],
        // Add more types as needed

    };
    const options = computed(() => optionsMap[props.type] || []);

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