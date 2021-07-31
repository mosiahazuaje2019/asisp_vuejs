<?php

namespace App\Http\Requests\Patients;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'     => ['required'],
            'last_name'      => ['required'],
            'type_document'  => ['required'],
            'identification' => 'required|unique:patients',
            'phone'          => ['required'],
            'email'          => 'required|unique:patients',
            'sex'            => ['required'],
            'city_id'        => ['required'],
            'birthday'       => ['required'],
            'address'        => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'     => "Debe ingresar el nombre del paciente",
            'last_name.required'      => "Debe ingresar el apellido del paciente",
            'type_document.required'  => "Selecccione tipo de documento",
            'identification.required' => "Ingrese número de documento",
            'identification.unique'   => "Ya existe un registro con este número de documento",
            'phone.required'          => "Ingrese un numero de contacto",
            'email.required'          => "Ingrese un correo eléctronico",
            'email.unique'            => "El correo ya se encuentra registrado",
            'sex.required'            => "Seleccione el sexo",
            'city_id.required'        => "Seleccione una ciudad",
            'birthday.required'       => "Coloque su fecha de nacimiento",
            'address.required'        => "Ingrese su dirección"
        ];
    }
}
