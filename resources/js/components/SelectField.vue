<template>
    <div class="form_field-wrapper">
        <label :for="labelStr + '-Field'" class="form_label">{{ labelStr }}</label>
        <select :id="labelStr + '-Field'" class="form_input is-select-input w-select" :value="selectedValue" @change="handleChange">
            <option value="">Select one...</option>
            <option v-for="opt in selectOptions" :key="opt.value" :value="opt.value">
                {{ opt.label }}
            </option>
        </select>
    </div>
</template>

<script setup>
    import { computed } from 'vue';

    const emit = defineEmits(['update:selectedValue' , 'update:isProductSelected' , 'update:productId' , 'update:colorName' , 'update:sku' , 'update:country']);

    const props = defineProps({
        selectedValue: String,
        isProductSelected: Boolean,
        isColorSelected: Boolean,
        labelStr: String,
        data: Array,
        options: String,
        productId: String,
        colorName: String,
        sku: String,
        country: String,
    });


    function handleChange(event) {
        emit('update:selectedValue', event.target.value);
        if (props.options == 'product'){
            emit('update:productId', event.target.value);
            emit('update:colorName', '');
            emit('update:sku', '');
        }
        else if (props.options == 'color'){
            emit('update:colorName', event.target.value);
            emit('update:sku', '');
        }
        else if (props.options == 'size'){
            for (let element of selectOptions.value){
                if(element.value == event.target.value){
                    emit('update:sku', element.sku);
                    break;
                }
            }
        }
        else {
            emit('update:country', event.target.value);
        }
    }

    const selectOptions = computed(() => {
        let productObj = null;
        let colorObj = null;
        switch (props.options) {

            case 'product':
                return props.data.map(item => ({
                    value: item.id,
                    label: item.name,
                }));

            case 'color':
                if (props.isProductSelected == false){
                    return [];
                }
                for (let element of props.data) {
                    if (element.id == props.productId) {
                        console.log(element)
                        productObj = element;
                        break;
                    }
                }
                return productObj.colors.data.map(item => ({
                    value: item.color,
                    label: item.color,
                }));

            case 'size':
                if (props.isColorSelected == false){
                    return [];
                }
                for (let element of props.data) {
                    if (element.id == props.productId) {
                        for (let colorElement of element.colors.data){
                            if (colorElement.color == props.colorName) {
                                colorObj = colorElement;
                                break;
                            }
                        }
                    }
                }
                return colorObj.sizes.map(item => ({
                    value: item.size,
                    label: item.size,
                    sku: item.base_product_sku
                }));

            case 'country':
                return [
                    { value: 'DE', label: 'Germany - DE' },
                    { value: 'CH', label: 'Switzerland - CH' },
                ];
            default:
                return [];
        }
    });

</script>
