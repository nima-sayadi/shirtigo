<template>
    <div class="form_field-wrapper">
        <label :for="labelStr + '-Field'" class="form_label">{{ labelStr }}</label>
        <select :id="labelStr + '-Field'" class="form_input is-select-input w-select" :value="selectedValue" @change="handleChange" >
            <option value="">Select one...</option>
            <option v-for="opt in selectOptions" :key="opt.value" :value="opt.value">
                {{ opt.label }}
            </option>
        </select>
    </div>
</template>

<script setup>
    import { computed , watch} from 'vue';

    const emit = defineEmits([
        'update:selectedValue',
        'update:isProductSelected',
        'update:selectFieldsObject',
        'callCalculatePrice',
    ]);

    const props = defineProps({
        selectedValue: String,
        isProductSelected: Boolean,
        isColorSelected: Boolean,
        isFormReady: Boolean,
        labelStr: String,
        selectFieldsObject: Object,
        data: Array,
        options: String,
    });


    function handleChange(event) {
        emit('update:selectedValue', event.target.value);
        let updatedData = { ...props.selectFieldsObject};
        if (props.options == 'product'){
            updatedData.productId = event.target.value;
            updatedData.colorName = '';
            updatedData.sku = '';
            for (let element of selectOptions.value){
                if(element.value == event.target.value){
                    let min_Xoffset = (-(Number(element.width) / 2) + Number(element.xOffset));
                    let max_Xoffset = ((Number(element.width) / 2) + Number(element.xOffset));
                    let max_Yoffset = (Number(element.height) - Number(element.yOffset)); // The min_Yoffest would always be 0 because the object starts from the collar not the center.
                    updatedData.maxWidth = element.width.toString();
                    updatedData.minXOffset = min_Xoffset.toString();
                    updatedData.maxXOffset = max_Xoffset.toString();
                    updatedData.maxYOffset = max_Yoffset.toString();
                    updatedData.imgURL = element.imgURL;
                    updatedData.processingAreaType = element.processingAreaType;
                    updatedData.processingMethod = element.processingMethod;
                    break;
                }
                
            }
        }
        else if (props.options == 'color'){
            updatedData.colorName = event.target.value;
            updatedData.sku = '';
        }
        else if (props.options == 'size'){
            for (let element of selectOptions.value){
                if(element.value == event.target.value){
                    updatedData.sku = element.sku;
                    updatedData.size = element.value;
                    break;
                }
            }
        }
        else {
            updatedData.country = event.target.value;
            
        }
        emit('update:selectFieldsObject', updatedData);
    }

    // The recalculation of price based on country change
    watch(() => props.selectFieldsObject.country, (newValue) => { // Note that the endpoint requires all information of the form
        if(props.isFormReady && newValue !== ''){
            emit('callCalculatePrice');
        }
    });
    // The recalculation of price based on product change
    watch(() => props.selectFieldsObject.size, (newValue) => {
        if(props.isFormReady && newValue !== ''){ // Note that the endpoint requires all information of the form so it is set to the size instead of the product id
            emit('callCalculatePrice');
        }
    });

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
                    processingAreaType: item.processing_areas.data[0].position_name,
                    processingMethod: item.processing_areas.data[0].processing_method,
                }));

            case 'color':
                if (props.isProductSelected == false){
                    return [];
                }
                for (let element of props.data) {
                    if (element.id == props.selectFieldsObject.productId) {
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
                    if (element.id == props.selectFieldsObject.productId) {
                        for (let colorElement of element.colors.data){
                            if (colorElement.color == props.selectFieldsObject.colorName) {
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
