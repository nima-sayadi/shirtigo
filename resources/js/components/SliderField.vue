<template>
    <div class="form_field-wrapper">
        <label class="form_label">{{ labelStr }} ({{ sliderValue }} mm)</label>
        <div class="form_range-slider">
            <div class="range-slider_bar"></div>
            <a href="#" class="range-slider_knob w-inline-block" :style="{ left: knobLeft + '%' }"></a>
            <input type="range" :min="min" :max="max" v-model="sliderValue" class="range-slider_input" />
        </div>
        <div class="range-slider_text">
            <div class="range-slider_label">{{ min }}</div>
            <div class="range-slider_label">{{ max }}</div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'

const props = defineProps({
    labelStr: String,
    sliderFieldsObject: Object,
    min: String,
    max: String
})
const emit = defineEmits([
    'update:sliderFieldsObject'
]);

const defaultValue = Math.floor((Number(props.min) + Number(props.max)) / 2)

const sliderValue = ref(defaultValue)

watch(sliderValue, (val) => {
    let updatedData = { ...props.sliderFieldsObject};
    switch (props.labelStr) {
        case "Width":
            updatedData.widthUserInput = val.toString();
            break;
        case "Offset X":
            updatedData.offsetxUserInput = val.toString();
            break;
        case "Offset Y":
            updatedData.offsetyUserInput = val.toString();
            break;
        default:
            break;
    }
    emit('update:sliderFieldsObject', updatedData);
})

const centerSliderValue = () => {
    const midValue = Math.floor((Number(props.min) + Number(props.max)) / 2)
    sliderValue.value = midValue
}

watch([() => props.min, () => props.max], () => {
    centerSliderValue()
})

const knobLeft = computed(() => {
    const percentage = ((sliderValue.value - props.min) / (props.max - props.min)) * 100
    return Math.min(100, Math.max(0, percentage)) // Clamping the value to 0% - 100%
})
</script>

<style scoped>

.form_range-slider {
    grid-column-gap: .5rem;
    grid-row-gap: .5rem;
    justify-content: center;
    align-items: center;
    height: 2rem;
    display: flex;
    position: relative;
}

.range-slider_bar {
    background-color: var(--swatches--neutral200);
    width: 100%;
    height: .25rem;
}

.range-slider_knob {
    border-radius: var(--border-radius-full);
    background-color: var(--color--primary);
    width: 2rem;
    height: 2rem;
    position: absolute;
    top: auto;
    bottom: auto;
    left: auto;
    right: auto;
    transform: translateX(-50%);
}

.range-slider_text {
    justify-content: space-between;
    align-items: stretch;
    display: flex;
}

.range-slider_label {
    color: var(--color--text-subtle);
    font-size: var(--text-size--small);
    line-height: 1.5;
}

/* Only this is added to original styles (hidden) to overlay input */
.range-slider_input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 1;
}
</style>