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
                                        <SelectField :form="form" value="product" type="product" labelStr="Product" />
                                        <SelectField :form="form" value="color" type="color" labelStr="Color" />
                                        <SelectField :form="form" value="size" type="size" labelStr="Size" />
                                        <TextField :form="form" value="number" type="number" labelStr="Quantity" />
                                        <SpacerDiv />
                                        <Divider />
                                        <SpacerDiv />
                                        <SliderField value="width" labelStr="Width" min="0" max="255" />
                                        <SliderField value="offsetx" labelStr="Offset X" min="-255" max="255" />
                                        <SliderField value="offsety" labelStr="Offset Y" min="-255" max="255" />
                                    </div>
                                    <div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
    

    function submitForm() {
        router.post('/submit-form', form);
    }
</script>