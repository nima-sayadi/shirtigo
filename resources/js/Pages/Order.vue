<template>
    <div class="home-body_section">
        <div class="padding-global padding-section-medium">
            <div class="container-medium">
                <div class="home-body_grid">
                    <div class="card">
                        <CardTitle title="1. Product" />
                        <SpacerDiv />
                        <div class="form_component w-form">
                            <div id="wf-form-Form" name="wf-form-Form" action="POST" aria-label="Form"></div>
                            <form class="form_form" @submit.prevent="submitForm">
                                <div class="grid_2col">
                                    <div>
                                        <SelectField :data="productsData" options="product" labelStr="Product"
                                            v-model:selectedValue="selectedProduct" @update:productId="updateProductId" />
                                        <SelectField 
                                            :data="productsData" 
                                            options="color" 
                                            labelStr="Color"
                                            v-model:selectedValue="selectedColor"
                                            :isProductSelected="isProductSelected"
                                            :productId="productId"
                                            @update:colorName="updateColor"
                                        />
                                        <SelectField 
                                            :data="productsData" 
                                            options="size" 
                                            labelStr="Size"
                                            v-model:selectedValue="selectedSize" 
                                            :isProductSelected="isProductSelected"
                                            :isColorSelected="isColorSelected"
                                            :productId="productId"
                                            :colorName="colorName"
                                            :sku="sku"
                                            @update:sku="updateSku"

                                        />
                                        <TextField :data="productsData" labelStr="Quantity" />
                                        <SpacerDiv />
                                        <Divider />
                                        <SpacerDiv />
                                        <SliderField :data="productsData" value="width" labelStr="Width" min="0"
                                            max="255" />
                                        <SliderField :data="productsData" value="offsetx" labelStr="Offset X" min="-255"
                                            max="255" />
                                        <SliderField :data="productsData" value="offsety" labelStr="Offset Y" min="-255"
                                            max="255" />
                                    </div>
                                    <div>
                                        <ImgWrapper :data="productsData" />
                                        <SpacerDiv />
                                        <DesignImg />
                                    </div>
                                </div>
                                <SpacerDiv />
                                <Divider />
                                <SpacerDiv />
                                <CardTitle title="2. Address" />
                                <SpacerDiv />
                                <TextField type="text" labelStr="First Name" />
                                <TextField type="text" labelStr="Last Name" />
                                <TextField type="text" labelStr="Address" />
                                <TextField type="text" labelStr="ZIP/Postal Code" />
                                <TextField type="text" labelStr="City" />
                                <SelectField options="country" labelStr="Country" />
                            </form>
                            <FormMsg />
                        </div>
                    </div>
                    <CTA />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { router } from '@inertiajs/vue3';
    import { ref , computed , watch} from 'vue';
    import SpacerDiv from '../components/SpacerDiv.vue';
    import Divider from '../components/Divider.vue';
    import CardTitle from '../components/CardTitle.vue';
    import SelectField from '../components/SelectField.vue';
    import TextField from '../components/TextField.vue';
    import SliderField from '../components/SliderField.vue';
    import ImgWrapper from '../components/ImgWrapper.vue';
    import DesignImg from '../components/DesignImg.vue';
    import FormMsg from '../components/FormMsg.vue';
    import CTA from '../components/CTA.vue';

    const props = defineProps({
        products: Object,
    });
    const productsData = props.products.data.data || [];
    const selectedProduct = ref('');
    const selectedColor = ref('');
    const selectedSize = ref('');
    const productId = ref('');
    const colorName = ref('');
    const sku = ref('');
    const isProductSelected = computed(() => selectedProduct.value !== '');
    const isColorSelected = computed(() => selectedColor.value !== '');

    const updateProductId = (id) => {
        productId.value = id;
    };

    const updateColor = (name) => {
        colorName.value = name;
    };

    const updateSku = (str) => {
        sku.value = str;
        console.log("sku : " + str)
    };

    watch(selectedProduct, () => {
        selectedColor.value = '';
        selectedSize.value = '';
        colorName.value = '';
        sku.value = '';
    });
    watch(selectedColor, () => {
        selectedSize.value = '';
        sku.value = '';
    });
    

</script>