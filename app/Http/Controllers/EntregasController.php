<?php

namespace App\Http\Controllers;

use App\Models\Assinaturas;
use App\Models\Entregas;
use Illuminate\Http\Request;

class EntregasController extends Controller
{
    public function index()
    {
        $entregas = Entregas::with('assinates')->paginate();
        dd($entregas);
    }

    public function entrega_id(Request $request)
    {
        $entregas = Entregas::with('assinates')->where('cliente_id', $request->id)->orderBy('data_entrega', 'DESC')->get();
        $cliente = Assinaturas::where('id', $request->id)->first()->empresa;
        return view('dashboard.entregas.assinante', [
            'entregas' => $entregas,
            'id' => $request->id,
            'cliente' => $cliente
        ]);
    }

    public function create(Request $request)
    {
        Entregas::create($request->all());
        return redirect()->route('id.entregas', $request->cliente_id);
    }

    public function deletar($id)
    {
        $entrega = Entregas::where('id', $id)->first();
        $cliente_id = $entrega->cliente_id;
        $entrega->delete();
        return redirect()->route('id.entregas', $cliente_id);
    }
}
