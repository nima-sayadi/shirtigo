<template>
    <div class="image_wrapper">
        <img 
            :src="imageSrc" 
            :srcset="imageSrcset" 
            :sizes="imageSizes" 
            alt="Premium Shirt" 
            class="image_image" 
            loading="lazy" 
        />
    </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
    data: Array,
});

const imageSrc = "https://s3-eu-west-1.amazonaws.com/shirtigo-assets/creator-mockups/368/premium-shirt-flat_creator_mockup_front.webp"

const imageSrcset = "https://s3-eu-west-1.amazonaws.com/shirtigo-assets/creator-mockups/368/premium-shirt-flat_creator_mockup_front.webp 500w, https://s3-eu-west-1.amazonaws.com/shirtigo-assets/creator-mockups/368/premium-shirt-flat_creator_mockup_front.webp 800w"

const imageSizes = "(max-width: 479px) 93vw, (max-width: 767px) 95vw, (max-width: 800px) 100vw, (max-width: 991px) 800px, 47vw"

</script>