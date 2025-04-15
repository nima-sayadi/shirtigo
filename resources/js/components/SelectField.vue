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

    const emit = defineEmits([
        'update:selectedValue',
        'update:isProductSelected',
        'update:productId',
        'update:colorName',
        'update:sku',
        'update:country',
        'update:maxWidth',
        'update:minXOffset',
        'update:maxXOffset',
        'update:maxYOffset',
        'update:imgURL'
    ]);

    const props = defineProps({
        selectedValue: String,
        isProductSelected: Boolean,
        isColorSelected: Boolean,
        labelStr: String,
        data: Array,
        options: String,
        productId: String,
        maxWidth: String,
        minXOffset: String,
        maxXOffset: String,
        maxYOffset: String,
        imgURL: String,
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
            for (let element of selectOptions.value){
                if(element.value == event.target.value){
                    let min_Xoffset = (-(Number(element.width) / 2) + Number(element.xOffset));
                    let max_Xoffset = ((Number(element.width) / 2) + Number(element.xOffset));
                    let max_Yoffset = (Number(element.height) - Number(element.yOffset)); // The min_Yoffest would always be 0 because the object starts from the collar not the center.
                    emit('update:maxWidth', element.width.toString());
                    emit('update:minXOffset', min_Xoffset.toString());
                    emit('update:maxXOffset', max_Xoffset.toString());
                    emit('update:maxYOffset', max_Yoffset.toString());
                    emit('update:imgURL', element.imgURL);
                    break;
                }
            }
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
                    imgURL: item.mockups.data[0].image_url,
                    width: item.processing_areas.data[0].width_in_mm,
                    height: item.processing_areas.data[0].height_in_mm,
                    xOffset: item.processing_areas.data[0].offset_x_center_mm,
                    yOffset: item.processing_areas.data[0].offset_y_collar_mm,
                }));

            case 'color':
                if (props.isProductSelected == false){
                    return [];
                }
                for (let element of props.data) {
                    if (element.id == props.productId) {
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
