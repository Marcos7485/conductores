<script setup lang="ts">
import { ref, markRaw } from 'vue';
import Principal from '../components/Principal.vue';
import HeaderTitle from '../components/layouts/header.vue';
import FormularioAltaAuto from '../components/Formularios/FormularioAltaAuto.vue';


const components = {
    Principal: markRaw(Principal),
    FormularioAltaAuto:markRaw(FormularioAltaAuto)
};

const currentComponentName = ref(components.Principal);


function changeComponent(componentName: string) {
    currentComponentName.value = components[componentName];
}


</script>

<template>
    <div class="app-layout">
        <HeaderTitle></HeaderTitle>
        <div class="content">
            <component :is="currentComponentName" @changeComponent="changeComponent" />
        </div>
    </div>
</template>

<style scoped>

.app-layout {
    position: relative;
    width: 100vw;
    min-height: 100vh;
    overflow: hidden;
}

.content {
    padding: 5rem 12rem 0 12rem;
    width: 100%;
    margin-top: 5rem;
}

</style>
