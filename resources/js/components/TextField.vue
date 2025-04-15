<template>
    <div class="form_field-wrapper">
        <label :for="labelStr + '-Field'" class="form_label">{{ labelStr }}</label>
        <input :placeholder="placeholder" :type="props.type" :id="labelStr + '-Field'" class="form_input w-input" v-model="inputValue" @input="validateInput" >
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    const inputValue = ref('');
    let placeholder;
    

    const props = defineProps({
        form: Object,
        labelStr: String,
        data: Array,
        type: String
    });

    if (props.type == "number") {
        placeholder = "1";
    }
    else{
        placeholder = "";
    }

    const validateInput = () => {
        if (props.type == "number"){
            if (inputValue.value < 1 && inputValue.value !== ""){
                inputValue.value = 1
            }
        }
    }

</script>