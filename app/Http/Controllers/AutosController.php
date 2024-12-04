<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutosRequest;
use App\Models\Autos;
use Illuminate\Http\Request;

class AutosController extends Controller
{

    protected $autoService;

    public function __construct(\App\Services\AutoService $autoService)
    {
        $this->autoService = $autoService;
    }

    public function crear(AutosRequest $request)
    {
        $data = [
            'comprobante' => $request->comprobante,
            'conductores' => $request->conductores,
            'data' => $request->data,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'modelo_2' => $request->modelo_2,
            'organismo' => $request->organismo,
            'patente' => $request->patente,
            'poliza' => $request->poliza,
        ];
        
        $this->autoService->createAuto($data);
        return response()->json(['message' => 'Auto guardado exitosamente'], 201);
    }
}
