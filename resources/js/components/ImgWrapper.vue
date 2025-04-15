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
import { computed } from 'vue'

const props = defineProps({
    imgURL: String,
});

const imageSrc = computed(() => props.imgURL)

const imageSrcset = computed(() => `${props.imgURL} 500w, ${props.imgURL} 800w`)

const imageSizes = "(max-width: 479px) 93vw, (max-width: 767px) 95vw, (max-width: 800px) 100vw, (max-width: 991px) 800px, 47vw"

</script>