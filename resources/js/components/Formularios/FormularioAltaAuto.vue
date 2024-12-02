<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';


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

const AltaAutoSumbit = async () => {
    if (isDisabled.value) return;
    isDisabled.value = true;

    try {
        const response = await axios.post('/new/cliente', formData.value);
        responseMessage.value = response.data.message;
        formDataClear();
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

</script>

<template>
    <div class="page">
        <form @submit.prevent="AltaAutoSumbit">
            <div class="title">
                <h3>Alta de Auto</h3>
                <hr>
            </div>
            <div class="formulario">
                <div class="form-titles">
                    <div class="col-4 first-opcion" @click="PrimerPaso">
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
                            <input type="text" placeholder="label" required>
                        </div>
                        <div class="input-form">
                            <label><b>Año</b></label>
                            <input type="number" min="1900" max="2100" placeholder="label" required>
                        </div>
                    </div>

                    <div class="form-B col-6">
                        <div class="input-form">
                            <label><b>Patente</b></label>
                            <input type="text" placeholder="label" required>
                        </div>

                        <div class="input-form">
                            <label><b>Póliza de seguro</b></label>
                            <div class="input-withbutton">
                                <input type="text" placeholder="label" required>
                                <button>BUTTON</button>
                            </div>
                        </div>

                        <div class="input-form">
                            <label><b>Comprobante de pago patente</b></label>
                            <div class="input-withbutton">
                                <input type="text" placeholder="label" required>
                                <button>BUTTON</button>
                            </div>
                        </div>


                        <div class="next-1">
                            <button @click="SegundoPaso">SIGUIENTE</button>
                        </div>
                    </div>
                </div>

                <div class="card-2" v-if="formularioActivo2">
                    <div class="form-SegundoPaso">
                        <div class="input-form-Seg">
                            <label><b>Marca</b></label>
                            <select v-model="formData.marca" required>
                                <option value="1">Fiat</option>
                                <option value="2">Ford</option>
                                <option value="3">Volkswagen</option>
                                <option value="4">Renault</option>
                                <option value="5">Nissan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card-3" v-if="formularioActivo3">

                </div>
            </div>
        </form>
    </div>
</template>

<style scoped>

.input-form-Seg {
    display: flex;
    flex-direction: row;
    width: 100%;
    font-size: 1.2rem;
    margin-top: 1rem;
}

.form-SegundoPaso {
    display: flex;
    flex-direction: column;
    align-items: center;
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

.card-1 {
    display: flex;
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

.next-1 button {
    margin-top: 15rem;
    height: 4rem;
    width: 35rem;
}

.title {
    text-align: left;
}
</style>