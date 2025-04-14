<template>
    <div class="home-body_section">
        <div class="padding-global padding-section-medium">
            <div class="container-medium">
                <div class="home-body_grid">
                    <div class="card">
                        <CardTitle title="1. Product" />
                        <SpacerDiv />
                        <div class="form_component w-form">
                            <div id="wf-form-Form" name="wf-form-Form" action="POST" aria-label="Form" ></div>
                            <form class="form_form" @submit.prevent="submitForm">
                                <div class="grid_2col">
                                    <div>
                                        <SelectField :form="form" options="product" labelStr="Product" />
                                        <SelectField :form="form" options="color" labelStr="Color" />
                                        <SelectField :form="form" options="size" labelStr="Size" />
                                        <TextField :form="form" labelStr="Quantity" />
                                        <SpacerDiv />
                                        <Divider />
                                        <SpacerDiv />
                                        <SliderField value="width" labelStr="Width" min="0" max="255" />
                                        <SliderField value="offsetx" labelStr="Offset X" min="-255" max="255" />
                                        <SliderField value="offsety" labelStr="Offset Y" min="-255" max="255" />
                                    </div>
                                    <div>
                                        <ImgWrapper />
                                        <SpacerDiv />
                                        <DesignImg />
                                    </div>
                                </div>
                                <SpacerDiv />
                                <Divider />
                                <SpacerDiv />
                                <CardTitle title="2. Address" />
                                <SpacerDiv />
                                <TextField :form="form" type="text" labelStr="First Name" />
                                <TextField :form="form" type="text" labelStr="Last Name" />
                                <TextField :form="form" type="text" labelStr="Address" />
                                <TextField :form="form" type="text" labelStr="ZIP/Postal Code" />
                                <TextField :form="form" type="text" labelStr="City" />
                                <SelectField :form="form" options="country" labelStr="Country" />
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
    
    const form = {};
    function submitForm() {
        router.post('/submit-form', form);
    }
</script>