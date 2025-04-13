<template>
    <div class="home-body_section">
        <div class="padding-global padding-section-medium">
            <div class="container-medium">
                <div class="home-body_grid">
                    <div class="card">
                        <CardTitle title="1. Product" />
                        <SpacerDiv />
                        <div class="form_component w-form">
                            <div id="wf-form-Form" name="wf-form-Form" method="POST" aria-label="Form" ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import SpacerDiv from '../components/SpacerDiv.vue';
    import CardTitle from '../components/CardTitle.vue';
</script>