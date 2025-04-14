<template>
    <div class="form_field-wrapper">
        <label :for="labelStr + '-Field'" class="form_label">{{ labelStr }}</label>
        <select :id="labelStr + '-Field'" class="form_input is-select-input w-select" v-model="selectedValue">
            <option value="">Select one...</option>
            <option v-for="opt in selectOptions" :key="opt.value" :value="opt.value">
            {{ opt.label }}
            </option>
        </select>
    </div>
</template>

<script setup>
    import { computed, ref, watch } from 'vue'

    const emit = defineEmits(['update:options'])

    const props = defineProps({
        form: Object,
        labelStr: String,
        options: String
    });
    
    const SelectOptionsMap = {
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
        'country': [
            { value: 'ch', label: 'Germany - DE' },
            { value: 'de', label: 'Switzerland - CH' },
        ],

    };
    const selectOptions = computed(() => SelectOptionsMap[props.options] || []);
    const selectedValue = ref('');

    watch(selectedValue, (newValue) => {
        emit('update:options', newValue);
    });


</script>