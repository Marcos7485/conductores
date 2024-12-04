<script setup lang="ts">

const emit = defineEmits(['changeComponent']);

const AltaAuto = async () => {
    try {
        emit('changeComponent', 'FormularioAltaAuto');
    } catch (error) {
        console.log('Error en procesar el alta del vehiculo', error);
    }
}

const ModificacionAuto = async () => {
    try {
        emit('changeComponent', 'FormularioModificacionAuto');
    } catch (error) {
        console.log('Error en procesar el alta del vehiculo', error);
    }
}

const BajaAuto = async () => {
    try {
        emit('changeComponent', 'FormularioBajaAuto');
    } catch (error) {
        console.log('Error en procesar el alta del vehiculo', error);
    }
}


</script>

<template>
    <div class="page">
        <div class="title">
            <h3>Trámites</h3>
            <hr>
        </div>
        <div class="autos-title">
            <h3>Autos</h3>
        </div>
        <div class="autos-menu">
            <button @click="AltaAuto">ALTA</button>
            <button @click="ModificacionAuto">MODIFICACIÓN</button>
            <button @click="BajaAuto">BAJA</button>
        </div>

        <div class="conductores-title">
            <h3>Conductores</h3>
        </div>
        <div class="conductores-menu">
            <button>ALTA</button>
            <button>MODIFICACIÓN</button>
            <button>BAJA</button>
        </div>
    </div>
</template>

<style scoped>

.conductores-menu button {
    height: 4rem;
    width: 35rem;
    margin-right: 2rem;
}

.conductores-title {
    margin-top: 10rem;
    text-align: left;
}


.autos-menu button {
    height: 4rem;
    width: 35rem;
    margin-right: 2rem;
}

.autos-title {
    margin-top: 5rem;
    text-align: left;
}

.conductores-menu {
    display: flex;
    align-items: left;
    font-size: 1.4rem;
}

.autos-menu {
    display: flex;
    align-items: left;
    font-size: 1.4rem;
}

.title {
    text-align: left;
}
</style>