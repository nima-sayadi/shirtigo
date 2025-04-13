<template>
    <div class="card_title-wrapper">
        <h4>{{ title }}</h4>
    </div>
</template>

<script setup>
defineProps({
  title: String
});
</script>

<style scoped>
  .card_title-wrapper {
    grid-column-gap: var(--space--medium);
    grid-row-gap: var(--space--small);
    justify-content: space-between;
    align-items: center;
    display: flex;
  }
</style>