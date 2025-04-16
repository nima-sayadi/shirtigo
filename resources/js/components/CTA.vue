<template>
    <div class="cta_grid">
        <div class="cta_prize-wrapper">
            <div class="heading-style-h3 text-color-blue" >0.00 €</div>
            <div>incl. VAT and Shipping</div>
        </div>
        <a id="w-node-d1cfa5df-410a-bc0b-ef5b-0ac4b3c21cb3-4a18769c" @click="handleButton" :style="{ backgroundColor : buttonColor }" class="button is-large w-inline-block">
            <div>Place Order</div>
        </a>
    </div>
</template>

<script setup>
    import { watch, ref } from 'vue'
    const props = defineProps({
        isFormSubmitted: Boolean,
        isFormReady: Boolean,
    });

    const buttonColor = ref("var(--color--primary)");

    const emit = defineEmits([
        'update:isFormSubmitted',
        'callCreateOrder',
    ]);
    function handleButton(){
        emit('update:isFormSubmitted', true);
    }

    watch(() => props.isFormSubmitted, (newVal) => {
        if (newVal && props.isFormReady){
            emit('callCreateOrder');
            buttonColor.value = "darkgreen";
            // Reset the form after 4 seconds
            setTimeout(() => {
                buttonColor.value = "var(--color--primary)";
                emit('update:isFormSubmitted', false);
            }, 4000);
        }
    })

</script>

<style scoped>
    .cta_grid {
        grid-column-gap: 2rem;
        grid-row-gap: 2rem;
        grid-template-rows: auto;
        grid-template-columns: 1fr .5fr;
        grid-auto-columns: 1fr;
        display: grid;
    }
    .button.is-large {
        padding: 1rem 1.75rem;
        font-size: 1.125rem;
    }
    #w-node-d1cfa5df-410a-bc0b-ef5b-0ac4b3c21cb3-4a18769c {
        align-self: center;
    }
</style>