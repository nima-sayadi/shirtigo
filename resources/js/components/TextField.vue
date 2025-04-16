<template>
    <div class="form_field-wrapper">
        <label :for="labelStr + '-Field'" class="form_label">{{ labelStr }}</label>
        <input :placeholder="placeholder" :type="props.type" :id="labelStr + '-Field'" class="form_input w-input" v-model="inputValue" @input="handler" >
    </div>
</template>

<script setup>
    import { ref, watch } from 'vue';
    const inputValue = ref('');
    let placeholder;
    
    const props = defineProps({
        textFieldsObject: Object,
        labelStr: String,
        isFormReady: Boolean,
        type: String
    });
    const emit = defineEmits(['update:textFieldsObject' , 'callCalculatePrice']);
    
    if (props.type == "number") {
        placeholder = "1";
    }
    else{
        placeholder = "";
    }

    // The recalculation of price based on quantity change
    watch(() => props.textFieldsObject.qty, (newValue) => {
        if(props.isFormReady && newValue !== '' && newValue > 1){ // Note that the endpoint requires all information of the form
            emit('callCalculatePrice'); 
        }
    });

    const handler = () => {
        let updatedData = { ...props.textFieldsObject};
        switch (props.labelStr) {
            case "Quantity":
                if (inputValue.value < 1 && inputValue.value !== ""){
                    inputValue.value = 1;
                }
                updatedData.qty = inputValue.value;
                break;
            case "First Name":
                updatedData.name = inputValue.value;
                break;
            case "Last Name":
                updatedData.lastname = inputValue.value;
                break;
            case "Address":
                updatedData.street = inputValue.value;
                break;
            case "ZIP/Postal Code":
                updatedData.post = inputValue.value.toString();
                break;
            case "City":
                updatedData.city = inputValue.value;
                break;
            default:
                break;
        }
        emit('update:textFieldsObject', updatedData);
    }

</script>