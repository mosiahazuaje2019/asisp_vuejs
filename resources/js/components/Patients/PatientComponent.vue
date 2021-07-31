<template>
    <div class="container">
        <Card>
            <template #header><h4 class="ml-2 mt-2">Módulo Pacientes</h4></template>
            <template #title>
                <div class="float-right mb-4">
                    <Button label="Nuevo" icon="pi pi-plus" iconPos="right" @click="createPatient" />
                </div>
            </template>
            <template #content>
                <DataTable :filters="filter" :value="patients" dataKey="id" responsiveLayout="scroll">
                    <Column field="first_name" header="Nombres"></Column>
                    <Column field="last_name" header="Apellidos"></Column>
                    <Column field="identification" header="Identificación"></Column>
                    <Column field="email" header="Correo"></Column>
                    <Column field="birthday" header="Fecha de nacimiento"></Column>
                    <Column bodyStyle="text-align: center; overflow: visible" header="Acción"
                            headerStyle="width: 14rem; text-align: center">
                        <template #body="slotProps">
                            <Button type="button"
                                    class="p-button-raised p-button-rounded"
                                    @click="editPatient(slotProps.data.id)">Editar
                            </Button>
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
        <Dialog :header="editId === null ? 'Crear paciente' : 'Editar paciente'" :style="{width: '50vw'}"
                :visible.sync="display" :maximizable="true">
            <PatientForm :editId="editId"/>
        </Dialog>
    </div>
</template>

<script>
import moment from 'moment'
import axios from 'axios'
import Swal from 'sweetalert2'
import EventBus from '../../bus'
import PatientForm from "./PatientForm";

export default {
    name: "PatientComponent",
    components: {PatientForm},
    data () {
        return {
            filter: null,
            patients: [],
            editId: null,
            display: false,
        }
    },
    methods: {
        async getPatients () {
            const res = await axios.get('/api/patients')
            this.patients = res.data
        },
        async createPatient () {
            this.editId = null
            this.display = true
        },
        async editPatient (id) {
            this.editId = id
            this.display = true
        },
        async destroyPatient (id) {
            Swal.fire( {
                title: 'Seguro de eliminar el paciente?',
                showDenyButton: true,
                confirmButtonText: `Borrar`,
                denyButtonText: `No borrar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/api/patients/${id}`).then(() => {
                        EventBus.$emit('patient_reload')
                    }).catch(() => {
                        Swal.fire('No se logro obtener información', '', 'error')
                    })
                }
                else if (result.isDenied) {
                    Swal.fire('No se a borrado...', '', 'info')
                }
            })
        },
    },
    filters: {
        dateFilter (value) {
            return moment(value).format('LLL a')
        },
    },
    mounted() {
        moment.locale('es')
        this.getPatients()

        EventBus.$root.$on('patient_reload', () => {
            this.getPatients()
            this.$toast.add({
                severity:'success', summary: 'SUCCESS!',
                detail: `Operación realizada con éxito!`, life:3000,
            })
        })
    }
}
</script>

<style scoped>

</style>
