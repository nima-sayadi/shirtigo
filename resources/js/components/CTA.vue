<template>
    <div class="cta_grid">
        <div class="cta_prize-wrapper">
            <div class="heading-style-h3 text-color-blue" >{{ predictedPrice }}</div>
            <div>incl. VAT and Shipping</div>
        </div>
        <a id="w-node-d1cfa5df-410a-bc0b-ef5b-0ac4b3c21cb3-4a18769c" @click="handleButton" :style="{ backgroundColor : buttonColor }" class="button is-large w-inline-block">
            <div>Place Order</div>
        </a>
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    const props = defineProps({
        isFormReady: Boolean,
        predictedPrice: String,
    });

    const buttonColor = ref("var(--color--primary)");

    const emit = defineEmits([
        'callCreateOrder'
    ]);
    function handleButton(){
        emit('callCreateOrder');
        if (props.isFormReady){
            buttonColor.value = "darkgreen";
        }
        setTimeout(() => {
            buttonColor.value = "var(--color--primary)";
        }, 4000);
    }

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