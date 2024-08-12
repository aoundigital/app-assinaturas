<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Assinaturas;
use App\Models\Pagamentos;
use Illuminate\Http\Request;

class PagamentosController extends Controller
{
    public function index()
    {
        $resposta = Pagamentos::with('assinates')->orderBy('data_pagto','DESC');
        $pagamentos =  $resposta->get();
        $total = $resposta->sum('valor_pagto');
        $total_pagina = $pagamentos->sum('valor_pagto');

        return view('dashboard.pagamentos.geral', [
            'pagamentos' => $pagamentos,
            'total' => $total,
            'total_pagina' => $total_pagina,
        ]);
    }

    public function criar()
    {
        $assinaturas = Assinaturas::all();
        $pagamentos = [];
        return view('dashboard.criar.pagamentos', [
            'pagamentos' => $pagamentos,
            'assinaturas' => $assinaturas,
            'unico' => false
        ]);
    }

    public function create(Request $request)
    {
        Pagamentos::create($request->all());
        $this->mensagem = 'Pagamento Criado com Sucesso!';
        return redirect()->route('dashboard')->with('mensagem' , $this->mensagem);
    }

    public function criar_uma(Request $request)
    {
        $assinatura = Assinaturas::where('id', $request->id)->get();
        $pagamentos = Pagamentos::where('cliente_id', $request->id)->get();
        return view('dashboard.criar.pagamentos', [
            'assinaturas' => $assinatura,
            'pagamentos' => $pagamentos,
            'unico' => true
        ]);
    }

    public function buscar_data(Request $request)
    {
        $resposta = Pagamentos::with('assinates')
                    ->whereMonth('data_pagto', $request->mes)
                    ->whereYear('data_pagto', $request->ano);
        $total_mes = $resposta->sum('valor_pagto');

        $pagamentos =  $resposta->get();
        $total_pagina = $pagamentos->sum('valor_pagto');
        return view('dashboard.buscar.pagamentos', [
            'pagamentos' => $pagamentos,
            'mes' => $request->mes,
            'ano' => $request->ano,
            'total_mes' => $total_mes,
            'total_pagina' => $total_pagina,
        ]);
    }

    // verificar diferença entre datas;
    public function diferenca()
    {
        $start_date = \Carbon\Carbon::createFromFormat('d-m-Y', '1-5-2015');
        $end_date = \Carbon\Carbon::createFromFormat('d-m-Y', '10-5-2015');
        $different_days = $start_date->diffInDays($end_date);
        dd($different_days);
    }

    public function deletar($id)
    {
        $pagamentos = Pagamentos::where('id', $id)->first();
        $pagamentos->delete();
        return redirect()->route('buscar.pagemento');
    }

    public function apagar($id)
    {
        $pagamentos = Pagamentos::where('id', $id)->first();
        $ass_id = $pagamentos->cliente_id;
        $pagamentos->delete();
        return redirect()->route('criar_uma.pagemento', $ass_id);
    }
}
