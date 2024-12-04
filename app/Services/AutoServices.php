<?php

namespace App\Services;

use App\Models\Autos;

class AutoService
{
    public function getAllAutos()
    {
        return Autos::all();
    }

    public function createAuto(array $data)
    {
        $auto = new Autos();
        $auto->comprobante = $data['comprobante'];
        $auto->conductores = json_encode($data['conductores']);
        $auto->data = $data['data'];
        $auto->marca = $data['marca'];
        $auto->modelo = $data['modelo'];
        $auto->modelo_2 = $data['modelo_2'];
        $auto->organismo = $data['organismo'];
        $auto->patente = $data['patente'];
        $auto->poliza = $data['poliza'];
        $auto->save();
    }

    public function updateAuto(int $id, array $data)
    {
        $auto = Autos::findOrFail($id);
        $auto->update($data);
        return $auto;
    }

    public function deleteAuto(int $id)
    {
        $auto = Autos::findOrFail($id);
        $auto->delete();
        return $auto;
    }
}