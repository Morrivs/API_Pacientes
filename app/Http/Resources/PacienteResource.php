<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PacienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombres' => Str::of($this->nombres)->upper(),
            'apellidos' => Str::upper($this->apellidos),
            'edad' => $this->edad,
            'sexo' => $this->sexo,
            'cedula' => $this->dni,
            'tipoSangre' => $this->tipo_sangre,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
            'fechaCreado' => $this->created_at->format('d-m-Y'),
            'fechaModificado' => $this->updated_at->format('d-m-Y')
        ];
    }

    //devolver el resultado de las peticiones (res)
    public function with($request){
        return [
            'res'=>true,

        ];
    }
}
