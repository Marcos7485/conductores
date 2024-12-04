<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutosRequest;
use App\Models\Autos;
use App\Services\AutoServices;
use Illuminate\Http\Request;

class AutosController extends Controller
{

    protected $AutoServices;

    public function __construct(AutoServices $AutoServices)
    {
        $this->AutoServices = $AutoServices;
    }

    public function crear(AutosRequest $request)
    {
        $this->AutoServices->createAuto($request->all());
        return response()->json(['message' => 'Auto guardado exitosamente'], 201);
    }

    public function test(){
        die('ok');
    }
}
