<template>
    <div class="form_field-wrapper">
        <label :for="labelStr + 'Field'" class="form_label">{{ labelStr }}</label>
        <select :id="labelStr + 'Field'" class="form_input is-select-input w-select" v-model="form[value]">
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