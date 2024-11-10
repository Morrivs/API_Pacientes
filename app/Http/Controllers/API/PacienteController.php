<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarPacienteRequest;
use App\Http\Requests\ActualizarPacienteRequest;
use App\Models\Paciente;
use App\Http\Resources\PacienteResource;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return PacienteResource::collection(Paciente::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardarPacienteRequest $request)
    {
        return (new PacienteResource(Paciente::create($request->all())))->additional([
            'msg'=>'Paciente creado correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        return new PacienteResource($paciente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActualizarPacienteRequest $request, Paciente $paciente)
    {
        //
        $paciente->update($request->all());
        return new PacienteResource($paciente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        //
        $paciente->delete();
        return new PacienteResource($paciente);
    }
}
