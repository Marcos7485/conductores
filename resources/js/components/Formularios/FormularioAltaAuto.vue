<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';

const emit = defineEmits(['changeComponent']);

const formularioActivo1 = ref<boolean>(true);
const formularioActivo2 = ref<boolean>(false);
const formularioActivo3 = ref<boolean>(false);

interface FormData {
    marca: string;
    patente: string;
    modelo: string | number;
    poliza: string | number;
    modelo_2: string;
    comprobante: string;
    data: string;
    organismo: string;
    conductores: string[];
}

const formData = ref<FormData>({
    marca: '',
    patente: '',
    modelo: '',
    poliza: '',
    modelo_2: '',
    comprobante: '',
    data: '',
    organismo: '',
    conductores: []
});

const responseMessage = ref<string | null>(null);
const isDisabled = ref<boolean>(false);

const PrimerPasoSubmit = async () => {
    try {
        SegundoPaso();
    } catch (error) {
        console.log("Error en el primer paso", error);
    }
}

const AltaAutoSumbit = async () => {
    if (isDisabled.value) return;
    isDisabled.value = true;
    try {
        // const response = await axios.post('/api/', formData.value);
        // responseMessage.value = response.data.message;
        console.log(formData.value);
        formDataClear();
        TecerPaso();
    } catch (error) {
        console.error('Error enviando formulario', error);
        responseMessage.value = 'Error al guardar el cliente.';
    } finally {
        isDisabled.value = false;
    }
};

const formDataClear = async () => {
    formData.value = {
        marca: '',
        patente: '',
        modelo: '',
        poliza: '',
        modelo_2: '',
        comprobante: '',
        data: '',
        organismo: '',
        conductores: []
    };
}

const PrimerPaso = async () => {
    formularioActivo1.value = true;
    formularioActivo2.value = false;
    formularioActivo3.value = false;
}

const SegundoPaso = async () => {
    formularioActivo1.value = false;
    formularioActivo2.value = true;
    formularioActivo3.value = false;
}

const TecerPaso = async () => {
    formularioActivo1.value = false;
    formularioActivo2.value = false;
    formularioActivo3.value = true;
}

const conductorInput = ref('');

const plusFunction = async () => {
    if (conductorInput.value.trim() !== '') {
        formData.value.conductores.push(conductorInput.value.trim());
        conductorInput.value = '';
    }
}

const removeConductor = (index: number) => {
    formData.value.conductores.splice(index, 1);
};

const inicio = async () => {
    try {
        emit('changeComponent', 'Principal');
    } catch (error) {
        console.log("Error al volver al inicio", error);
    }
}

</script>

<template>
    <div class="page">

        <div class="title">
            <h3>Alta de Auto</h3>
            <hr>
        </div>
        <div class="formulario">
            <div class="form-titles">
                <div class="col-4 first-opcion">
                    <p>PASO 1</p>
                    <hr :class="{ active: formularioActivo1 }">
                </div>

                <div class="col-4 second-opcion">
                    <p>PASO 2</p>
                    <hr :class="{ active: formularioActivo2 }">
                </div>

                <div class="col-4 third-opcion">
                    <p>FINALIZAR</p>
                    <hr :class="{ active: formularioActivo3 }">
                </div>
            </div>
            <form @submit.prevent="PrimerPasoSubmit">
                <div class="card-1" v-if="formularioActivo1">
                    <div class="form-A col-6">
                        <div class="input-form">
                            <label><b>Marca</b></label>
                            <select v-model="formData.marca" required>
                                <option value="1">Fiat</option>
                                <option value="2">Ford</option>
                                <option value="3">Volkswagen</option>
                                <option value="4">Renault</option>
                                <option value="5">Nissan</option>
                            </select>
                        </div>

                        <div class="input-form">
                            <label><b>Modelo</b></label>
                            <select v-model="formData.modelo" required>
                                <option value="1">A</option>
                                <option value="2">B</option>
                                <option value="3">C</option>
                                <option value="4">D</option>
                                <option value="5">E</option>
                            </select>
                        </div>
                        <div class="input-form">
                            <label><b>Modelo</b></label>
                            <input type="text" v-model="formData.modelo_2" placeholder="label" required>
                        </div>
                        <div class="input-form">
                            <label><b>Año</b></label>
                            <input type="number" v-model="formData.data" min="1900" max="2100" placeholder="label" required>
                        </div>
                    </div>

                    <div class="form-B col-6">
                        <div class="input-form">
                            <label><b>Patente</b></label>
                            <input type="text" v-model="formData.patente" placeholder="label" required>
                        </div>

                        <div class="input-form">
                            <label><b>Póliza de seguro</b></label>
                            <div class="input-withbutton">
                                <input type="text" v-model="formData.poliza" placeholder="label" required>
                                <button>BUTTON</button>
                            </div>
                        </div>

                        <div class="input-form">
                            <label><b>Comprobante de pago patente</b></label>
                            <div class="input-withbutton">
                                <input type="text" v-model="formData.comprobante" placeholder="label" required>
                                <button>BUTTON</button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="opciones-buttons">
                    <div>
                        <div v-if="formularioActivo1">
                            <button type="submit">SIGUIENTE</button>
                        </div>
                    </div>
                </div>
            </form>
            <form @submit.prevent="AltaAutoSumbit">

                <div class="card-2" v-if="formularioActivo2">
                    <div class="form-SegundoPaso col-12">
                        <div class="input-form-Seg">
                            <label><b>Organismo</b></label>
                            <select v-model="formData.organismo" required>
                                <option value="1">A</option>
                                <option value="2">B</option>
                                <option value="3">C</option>
                                <option value="4">D</option>
                                <option value="5">E</option>
                            </select>
                        </div>

                        <div class="input-form-Seg">
                            <label><b>Nombre y Apellido del Conductor</b></label>
                            <input type="text" v-model="conductorInput">
                            <div class="plus-icon" @click="plusFunction()">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                    </div>
                    <div class="selected-SegundoPaso">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td colspan="4" style="text-align: left;">Conductores</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(conductor, index) in formData.conductores" :key="index">
                                    <td>{{ conductor }}</td>
                                    <td>
                                        <button @click="removeConductor(index)">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="opciones-buttons">
                    <div v-if="formularioActivo2">
                        <button class="anterior-button" @click="PrimerPaso">ANTERIOR</button>
                        <button type="submit" :disabled="isDisabled">FINALIZAR</button>
                    </div>
                </div>
            </form>

            <div class="card-3" v-if="formularioActivo3">
                <div class="finalizado">
                    <div class="card">
                        <h1>TRÁMITE FINALIZADO</h1>
                        <p>Nuestro equipo de administradores revisará el trámite para aprobarl. <br>
                            Le enviaremos por e-mail novedades.</p>
                    </div>
                </div>
            </div>
            <div class="opciones-buttons">
                <div v-if="formularioActivo3">
                    <button @click="inicio()">VOLVER AL INICIO</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.finalizado {
    padding: 15rem 15rem 9rem 15rem;
    width: 90%;
}

.card h1 {
    font-size: var(--fontsize);
}

.card {
    text-align: left;
    padding: 1rem;
    border: solid 2px black;
    border-radius: .5rem;
}

.anterior-button {
    background-color: white;
    border: solid .2rem black;
    color: black;
}

.opciones-buttons button {
    height: 3rem;
    width: 25rem;
    margin-right: 2rem;
}

.opciones-buttons {
    display: flex;
    justify-content: flex-end;
    width: 100%;
    justify-content: right;
    margin-bottom: 2rem;
}


.selected-SegundoPaso table {
    width: 25%;
    font-size: 1.2rem;
}

.selected-SegundoPaso {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

.plus-icon {
    cursor: pointer;
}

.input-form-Seg i {
    position: absolute;
    top: 20rem;
    left: 85rem;
    border-radius: 50%;
    background-color: black;
    color: white;
    padding: 1.3rem;
}

.input-form-Seg select {
    width: 20rem;
}

.input-form-Seg label {
    margin-right: 5rem;
}

.input-form-Seg {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: right;
    width: 70%;
    font-size: 1.2rem;
    margin-bottom: 2rem;
}

.form-SegundoPaso {
    justify-content: center;
    align-items: center;
    margin-top: 5rem;
    margin-bottom: 5rem;
}

.input-withbutton button {
    margin-left: 1rem;
}

.input-withbutton {
    display: flex;
}

.input-form {
    display: flex;
    flex-direction: column;
    width: 70%;
    font-size: 1.2rem;
    margin-top: 1rem;
}

.form-A {
    text-align: left;
    margin-top: 5rem;
    margin-bottom: 5rem;
}

.form-B {
    text-align: left;
    margin-top: 5rem;
    margin-bottom: 5rem;
}

.card-2 {
    display: flex;
    flex-direction: column;
    margin-bottom: 2rem;
    width: 100%;
    height: 33rem;
    overflow-y: auto;
}


.card-1 {
    display: flex;
    margin-bottom: 2rem;

}

.first-opcion hr.active {
    width: 100%;
    height: .2rem;
    background-color: black;
    opacity: 1;
    margin-top: -1rem;
}

.first-opcion hr {
    opacity: 0;
    margin-top: -1rem;
    transition: all 1s ease;
}

.first-opcion {
    cursor: pointer;
}

.second-opcion hr.active {
    width: 100%;
    height: .2rem;
    background-color: black;
    opacity: 1;
    margin-top: -1rem;
}

.second-opcion hr {
    opacity: 0;
    margin-top: -1rem;
    transition: all 1s ease;
}

.third-opcion hr.active {
    width: 100%;
    height: .2rem;
    background-color: black;
    opacity: 1;
    margin-top: -1rem;
}

.third-opcion hr {
    opacity: 0;
    margin-top: -1rem;
    transition: all 1s ease;
}

.form-titles {
    display: flex;
    font-size: var(--fontsize);
    height: 3rem;
    background-color: rgb(217, 219, 219);
}

.formulario {
    padding: 0rem 25rem;
}

.title {
    text-align: left;
}
</style>