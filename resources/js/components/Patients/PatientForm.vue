<template>
    <div class="p-grid">

                <div class="p-fluid">
                    <div class="p-field">
                        <label>Nombres</label>
                        <div>
                            <InputText v-model="form.first_name" type="text" class="w-100"/>
                            <small class="text-danger">{{ error_name }}</small>
                        </div>
                    </div>
                    <div class="p-field">
                        <label>Apellidos</label>
                        <div>
                            <InputText v-model="form.last_name" type="text" class="w-100"/>
                            <small class="text-danger">{{ error_last }}</small>
                        </div>
                    </div>
                </div>
                <div class="p-fluid p-formgrid p-grid">
                    <div class="p-field p-col">
                        <label>Tipo de documento</label>
                        <div>
                            <Dropdown v-model="form.type_document" :options="types" optionLabel="name"
                                      placeholder="Seleccione tipo" class="w-100" optionValue="code"/>
                            <small class="text-danger">{{ error_type }}</small>
                        </div>
                    </div>
                    <div class="p-field p-col">
                        <label>Identificación</label>
                        <div>
                            <InputText v-model="form.identification" type="text" class="w-100"/>
                            <small class="text-danger">{{ error_identification }}</small>
                        </div>
                    </div>
                </div>

                <div class="p-fluid">
                    <div class="p-field">
                        <label>Seleccione una ciudad</label>
                        <Dropdown v-model="form.city_id" :options="cities" dataKey="id" optionLabel="city"
                                  optionValue="id" placeholder="Seleccione una ciudad" :filter="true" />
                        <small class="text-danger">{{ error_city }}</small>
                    </div>
                </div>
                <div class="p-fluid">
                    <div class="p-field">
                        <label>Ingrese email</label>
                        <InputText v-model="form.email" type="text"/>
                        <small class="text-danger">{{ error_email }}</small>
                    </div>
                </div>

                <div class="p-fluid p-formgrid p-grid">
                    <div class="p-field p-col">
                        <label>Seleccione sexo</label>
                        <Dropdown v-model="form.sex" :options="sexs" dataKey="code" optionLabel="name" optionValue="code" />
                        <small class="text-danger">{{ error_sex }}</small>
                    </div>
                    <div class="p-field p-col">
                        <label>Teléfono</label>
                        <InputText v-model="form.phone" type="text" />
                        <small class="text-danger">{{ error_phone }}</small>
                    </div>
                    <div class="p-field p-col">
                        <label>Fecha de nacimiento</label>
                        <Calendar v-model="form.birthday" dateFormat="dd/mm/yy" :monthNavigator="true" />
                        <small class="text-danger">{{ error_birthday }}</small>
                    </div>
                </div>

                <div class="p-fluid">
                    <div class="p-field">
                        <label>Indique una dirección</label>
                        <Textarea v-model="form.address" rows="5" cols="30" :autoResize="true"/>
                        <small class="text-danger">{{ error_address }}</small>
                        <Button icon="pi pi-save" label="Guardar" @click="submit"/>
                    </div>
                </div>
    </div>
</template>

<script>
import Calendar from 'primevue/calendar';
import moment from "moment";

export default {
    name: "PatientForm",
    components: { Calendar },
    data () {
        return {
            value: null,
            form: {
                first_name: null,
                last_name: null,
                type_document: null,
                identification: null,
                phone: null,
                email: null,
                sex: null,
                city_id: null,
                birthday: null,
                address: null,
            },
            cities: [],
            types: [
                { name: 'CC',  code: 'CC' },
                { name: 'CE',  code: 'CE' },
                { name: 'PEP', code: 'PEP' },
                { name: 'TI',  code: 'TI' }
            ],
            sexs: [
                { name: 'Femenino',  code: 'F'},
                { name: 'Masculino', code: 'M'}
            ],
            error_name: null,
            error_last: null,
            error_type: null,
            error_identification: null,
            error_phone: null,
            error_email: null,
            error_sex: null,
            error_city: null,
            error_birthday: null,
            error_address: null,
        }
    },
    props: {
        editId: Number,
    },
    methods: {
        cleanForm () {
            Object.keys(this.form).map((val, index) => this.form[index] = null)
        },
        async submit () {
            if (!this.$props.editId) {
                try {
                    const res = await axios.post('/api/patients', this.form)
                    this.cleanForm()
                    return EventBus.$emit('patient_reload')
                }
                catch (e) {
                    if (e.response) {
                        switch (e.response.status) {
                            case 422:
                                let err = e.response.data.errors
                                this.error_name              = err.first_name ? err.first_name[0] : null
                                this.error_last              = err.last_name ? err.last_name[0] : null
                                this.error_type              = err.type_document ? err.type_document[0] : null
                                this.error_identification    = err.identification ? err.identification[0] : null
                                this.error_phone             = err.phone ? err.phone[0] : null
                                this.error_email             = err.email ? err.email[0] : null
                                this.error_sex               = err.sex ? err.sex[0] : null
                                this.error_city              = err.city_id ? err.city_id[0] : null
                                this.error_birthday          = err.birthday ? err.birthday[0] : null
                                this.error_address           = err.address ? err.address[0] : null
                        }
                    }
                    return null
                }
            }
            try {
                const res = await axios.put(`/api/patients/${this.$props.editId}`, this.form)
                this.cleanForm()
                return EventBus.$emit('patient_reload')
            }
            catch (e) {
                if (e.response) {
                    switch (e.response.status) {
                        case 422:
                            let err = e.response.data.errors
                            this.error_name              = err.first_name ? err.first_name[0] : null
                            this.error_last              = err.last_name ? err.last_name[0] : null
                            this.error_type              = err.type_document ? err.type_document[0] : null
                            this.error_identification    = err.identification ? err.identification[0] : null
                            this.error_phone             = err.phone ? err.phone[0] : null
                            this.error_email             = err.email ? err.email[0] : null
                            this.error_sex               = err.sex ? err.sex[0] : null
                            this.error_city              = err.city_id ? err.city_id[0] : null
                            this.error_birthday          = err.birthday ? err.birthday[0] : null
                            this.error_address           = err.address ? err.address[0] : null
                    }
                }
                return null
            }
        },
        async getCities() {
            const res = await axios.get('/api/cities')
            this.cities = res.data
        }
    },
    mounted() {
        this.getCities()
    }
}
</script>

<style scoped>

</style>
