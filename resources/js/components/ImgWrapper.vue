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

const imageSrc = "https://cdn.prod.website-files.com/666ac9ad988798984a18769a/666c417c51d7e008c7a35618_premium-shirt.jpg"

const imageSrcset = "https://cdn.prod.website-files.com/666ac9ad988798984a18769a/666c417c51d7e008c7a35618_premium-shirt-p-500.jpg 500w, https://cdn.prod.website-files.com/666ac9ad988798984a18769a/666c417c51d7e008c7a35618_premium-shirt.jpg 800w"

const imageSizes = "(max-width: 479px) 93vw, (max-width: 767px) 95vw, (max-width: 800px) 100vw, (max-width: 991px) 800px, 47vw"

</script>