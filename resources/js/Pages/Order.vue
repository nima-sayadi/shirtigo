<template>
    <div class="home-body_section">
        <div class="padding-global padding-section-medium">
            <div class="container-medium">
                <div class="home-body_grid">
                    <div class="card">
                        <CardTitle title="1. Product" />
                        <SpacerDiv />
                        <div class="form_component w-form">
                            <div id="wf-form-Form" name="wf-form-Form" aria-label="Form"></div>
                            <form class="form_form" @submit.prevent="">
                                <div class="grid_2col">
                                    <div>
                                        <SelectField 
                                            :data="productsData" 
                                            options="product" 
                                            labelStr="Product"
                                            v-model:selectedValue="selectedProduct"
                                            :selectFieldsObject="selectFieldsObject"
                                            :isFormReady="isFormReady"
                                            @update:selectFieldsObject="updateSelectFieldsObject"
                                            />
                                        <SelectField 
                                            :data="productsData" 
                                            options="color" 
                                            labelStr="Color"
                                            v-model:selectedValue="selectedColor"
                                            :isProductSelected="isProductSelected"
                                            :selectFieldsObject="selectFieldsObject"
                                            @update:selectFieldsObject="updateSelectFieldsObject"
                                        />
                                        <SelectField 
                                            :data="productsData" 
                                            options="size" 
                                            labelStr="Size"
                                            v-model:selectedValue="selectedSize" 
                                            :isProductSelected="isProductSelected"
                                            :isColorSelected="isColorSelected"
                                            :selectFieldsObject="selectFieldsObject"
                                            @update:selectFieldsObject="updateSelectFieldsObject"

                                        />
                                        <TextField type="number" :isFormReady="isFormReady" labelStr="Quantity" @callCalculatePrice="calculatePrice" :textFieldsObject="textFieldsObject" @update:textFieldsObject="updateTextFieldsObject" />
                                        <SpacerDiv />
                                        <Divider />
                                        <SpacerDiv />
                                        <SliderField labelStr="Width" min="0" :max="selectFieldsObject.maxWidth" @update:sliderFieldsObject="updateSliderFieldsObject" />
                                        <SliderField labelStr="Offset X" :min="selectFieldsObject.minXOffset" :max="selectFieldsObject.maxXOffset" @update:sliderFieldsObject="updateSliderFieldsObject" />
                                        <SliderField labelStr="Offset Y" min="0" :max="selectFieldsObject.maxYOffset" @update:sliderFieldsObject="updateSliderFieldsObject" />
                                    </div>
                                    <div>
                                        <ImgWrapper :imgURL="selectFieldsObject.imgURL" />
                                        <SpacerDiv />
                                        <DesignImg />
                                    </div>
                                </div>
                                <SpacerDiv />
                                <Divider />
                                <SpacerDiv />
                                <CardTitle title="2. Address" />
                                <SpacerDiv />
                                <TextField type="text" labelStr="First Name" :textFieldsObject="textFieldsObject" @update:textFieldsObject="updateTextFieldsObject" />
                                <TextField type="text" labelStr="Last Name" :textFieldsObject="textFieldsObject" @update:textFieldsObject="updateTextFieldsObject" />
                                <TextField type="text" labelStr="Address" :textFieldsObject="textFieldsObject" @update:textFieldsObject="updateTextFieldsObject" />
                                <TextField type="text" labelStr="ZIP/Postal Code" :textFieldsObject="textFieldsObject" @update:textFieldsObject="updateTextFieldsObject" />
                                <TextField type="text" labelStr="City" :textFieldsObject="textFieldsObject" @update:textFieldsObject="updateTextFieldsObject" />
                                <SelectField options="country" :isFormReady="isFormReady" v-model:selectedValue="selectedCountry" labelStr="Country" :selectFieldsObject="selectFieldsObject" @callCalculatePrice="calculatePrice" @update:selectFieldsObject="updateSelectFieldsObject" />
                            </form>
                            <FormMsg :didOrderFail="didOrderFail" :isFormReady="isFormReady" :isFormSubmitted="isFormSubmitted" />
                        </div>
                    </div>
                    <CTA :predictedPrice="predictedPrice" :isFormReady="isFormReady" @callCreateOrder="createOrder" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref , computed , watch} from 'vue';
    import axios from 'axios';
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
    const productsData = props.products.data || [];
    const selectedProduct = ref('');
    const selectedColor = ref('');
    const selectedSize = ref('');
    const selectedCountry = ref('');
    const predictedPrice = ref('0.00 €');
    const isFormSubmitted= ref(false);
    const didOrderFail= ref(false);
    const sliderFieldsObject = ref({
        widthUserInput : '127',
        offsetxUserInput : '0',
        offsetyUserInput : '127'
    });
    const textFieldsObject = ref({
        qty : 1,
        name : '',
        lastname : '',
        street : '',
        post : '',
        city : ''
    });
    const selectFieldsObject = ref({
        productId : '',
        colorName : '',
        size : '',
        sku : '',
        country : '',
        imgURL : 'https://cdn.prod.website-files.com/666ac9ad988798984a18769a/666c417c51d7e008c7a35618_premium-shirt.jpg',
        maxWidth : '255',
        minXOffset : '-255',
        maxXOffset : '255',
        maxYOffset : '255',
    });
    const isProductSelected = computed(() => selectedProduct.value !== '');
    const isColorSelected = computed(() => selectedColor.value !== '');

    const isFormReady = computed(() => {
        let cond1 = Object.entries(textFieldsObject.value).every(([key, value]) => {
            if (key === 'qty') {
                return value > 0;
            }
            return value !== '';
        });
        let cond2 = Object.entries(selectFieldsObject.value).every(([key, value]) => {
            return value !== '';
        });
        let cond3 = Object.entries(sliderFieldsObject.value).every(([key, value]) => {
            return value !== '';
        });
        if(cond1 && cond2 && cond3){
            return true;
        }
        return false;
    });

    const completeForm = computed(() => {
        return {
            delivery: {
                firstname: textFieldsObject.value.name,
                lastname: textFieldsObject.value.lastname,
                street: textFieldsObject.value.street,
                postcode: textFieldsObject.value.post,
                city: textFieldsObject.value.city,
                country: selectFieldsObject.value.country,
            },
            products: [{
                base_product_sku: selectFieldsObject.value.sku,
                amount: Number(textFieldsObject.value.qty),
                processings: [{
                    processingarea_type: selectFieldsObject.value.processingAreaType,
                    processingposition: "chest-center",
                    processingmethod: selectFieldsObject.value.processingMethod,
                    design_url: "https://cdn.prod.website-files.com/666ac9ad988798984a18769a/666c4566fcd4e48ef8975664_Logo_Shirtigo_RGB.png",
                    width: Number(sliderFieldsObject.value.widthUserInput),
                    offset_top: Number(sliderFieldsObject.value.offsetyUserInput),
                    offset_center: Number(sliderFieldsObject.value.offsetxUserInput),
                    force_position: false,
                    extract_size_and_position: false,
                    ignore_validation : false,
                }],
            }],
            fulfillment_mode_key: "24h-express"
        }
    });

    function calculatePrice() {
        axios.post('/api/predict-price', completeForm.value)
        .then(response => {
            if (response.data.status == 200 || response.data.status == 201){
                predictedPrice.value = (parseFloat(response.data.data.total_gross_price.amount) / response.data.data.total_gross_price.currency_factor).toFixed(2).toString() + " " + response.data.data.total_gross_price.currency_symbol
            }
            else{
                predictedPrice.value = "Price Calculation N/A"
            }
        })
        .catch(error => {
            console.error('Error during API request:', error.response.data);
            predictedPrice.value = "0.00 €"
        });
    }

    function createOrder() {
        isFormSubmitted.value = true
        axios.post('/api/place-order', completeForm.value)
        .then(response => {
            if (response.data.status == 200 || response.data.status == 201){
                // Redirect to the next page?
                isFormSubmitted.value = false
            }
            else{
                didOrderFail.value = true
                isFormSubmitted.value = false
                setTimeout(() => {
                    didOrderFail.value = false
                }, 4000);
            }
        })
        .catch(error => {
            console.error('Error during API request:', error.response.data);
            isFormSubmitted.value = false
            didOrderFail.value = true
            setTimeout(() => {
                didOrderFail.value = false
            }, 4000);
        });
    }

    const updateSelectFieldsObject = (data) => {
        selectFieldsObject.value = { ...selectFieldsObject.value, ...data };
    };

    const updateTextFieldsObject = (data) => {
        textFieldsObject.value = { ...textFieldsObject.value, ...data };
    };

    const updateSliderFieldsObject = (data) => {
        sliderFieldsObject.value = { ...sliderFieldsObject.value, ...data };
    };

    watch(selectedProduct, () => {
        selectedColor.value = '';
        selectedSize.value = '';
        selectFieldsObject.value.colorName = '';
        selectFieldsObject.value.sku = '';

    });
    watch(selectedColor, () => {
        selectedSize.value = '';
        selectFieldsObject.value.sku = '';
    });
    watch(isFormReady, () => {
        predictedPrice.value = '0.00 €';
    });
    

</script>