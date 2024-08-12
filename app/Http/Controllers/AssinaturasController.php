<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assinaturas;
use App\Models\Ativo;
use App\Models\Pagamentos;

class AssinaturasController extends Controller
{

    public function index()
    {
        $assinaturas = Assinaturas::with(['pagamentos', 'ativo'])->where('del', 'nao')->orderBy('data_inicio','DESC')->get();
        $total_pagina = $assinaturas->sum('valor');
        $basico = Assinaturas::where('tipo', 'basico')->where('del', 'nao')->count();
        $regular = Assinaturas::where('tipo', 'regular')->where('del', 'nao')->count();
        $completo = Assinaturas::where('tipo', 'completo')->where('del', 'nao')->count();
        $pbn = Assinaturas::where('tipo', 'pbn')->where('del', 'nao')->count();
        $pbn_sinais = Assinaturas::where('tipo', 'pbn sinais')->where('del', 'nao')->count();
        $blog_ecom = Assinaturas::where('tipo', 'blog ecom')->where('del', 'nao')->count();
        // dd($assinaturas);
        return view('home', [
            'assinaturas' => $assinaturas,
            'total_basico' => $basico,
            'total_regular' => $regular,
            'total_completo' => $completo,
            'total_pagina' => $total_pagina,
            'total_pbns' => $pbn + $pbn_sinais,
            'blog_ecom' => $pbn + $blog_ecom,
            'pbn' => $pbn,
            'pbn_sinais' => $pbn_sinais,
        ]);
    }

    public function sozinho(Request $request)
    {
        $assinatura = Assinaturas::with(['pagamentos', 'ativo', 'entregas'])->where('id', $request->id)->first();
        $total_pagamentos = ($assinatura->pagamentos)->sum('valor_pagto');

        if ($assinatura->ativo == null) {
            $ativo = 0;
            $id = 0;
        } else {
            $ativo = $assinatura->ativo->ativo;
            $id = $assinatura->ativo->id;
        }

        return view('dashboard.sozinho', [
            'assinatura' => $assinatura,
            'total_pagamentos' => $total_pagamentos,
            'ativo' => $ativo,
            'id' => $id
        ]);
    }

    public function basico()
    {
        $assinaturas = Assinaturas::with(['pagamentos'])->where('tipo', 'basico')->where('del', 'nao')->orderBy('data_inicio','DESC')->get();
        // dd($assinaturas);
        return view('dashboard.basico', [
            'assinaturas' => $assinaturas
        ]);
    }

    public function regular()
    {
        $assinaturas = Assinaturas::with(['pagamentos'])->where('tipo', 'regular')->where('del', 'nao')->orderBy('data_inicio','DESC')->get();
        return view('dashboard.regular', [
            'assinaturas' => $assinaturas
        ]);
    }

    public function completo()
    {
        $assinaturas = Assinaturas::with(['pagamentos'])->where('tipo', 'completo')->where('del', 'nao')->orderBy('data_inicio','DESC')->get();
        // dd($assinaturas);
        return view('dashboard.completo', [
            'assinaturas' => $assinaturas
        ]);
    }

    public function pbn()
    {
        $assinaturas = Assinaturas::with(['pagamentos'])->where('tipo', 'pbn')->where('del', 'nao')->orderBy('data_inicio','DESC')->get();
        return view('dashboard.pbn', [
            'assinaturas' => $assinaturas
        ]);
    }

    public function pbn_sinais()
    {
        $assinaturas = Assinaturas::with(['pagamentos'])->where('tipo', 'pbn sinais')->where('del', 'nao')->orderBy('data_inicio','DESC')->get();
        return view('dashboard.pbn_sinais', [
            'assinaturas' => $assinaturas
        ]);
    }

    public function blog_ecom()
    {
        $assinaturas = Assinaturas::with(['pagamentos'])->where('tipo', 'blog ecom')->where('del', 'nao')->orderBy('data_inicio','DESC')->get();
        return view('dashboard.blog_ecom', [
            'assinaturas' => $assinaturas
        ]);
    }

    public function criar()
    {
        return view('dashboard.criar.assinatura');
    }

    public function create(Request $request)
    {
        $ass = Assinaturas::create($request->all());
        Ativo::create([
            'cliente_id' => $ass->id,
            'ativo' => true
        ]);
        Pagamentos::create([
            'cliente_id' => $ass->id,
            'data_pagto'=> $ass->data_inicio,
            'valor_pagto' => $ass->valor
        ]);
        $this->mensagem = 'Assinaturas Criada com Sucesso!';
        return redirect()->route('dashboard')->with('mensagem' , $this->mensagem);
    }

    public function del(Request $request)
    {
        Assinaturas::where('id', $request->id)->update([
            'del' => 'sim'
        ]);
        $this->mensagem = 'Assinaturas Deletada com Sucesso!';
        return redirect()->route('dashboard')->with('mensagem' , $this->mensagem);
    }

    public function excluidos()
    {
        $excluidos = Assinaturas::where('del', 'sim')->get();
        return view('dashboard.excluidos', [
            'assinaturas' => $excluidos
        ]);
    }

    public function voltar_excluidos(Request $request)
    {
        Assinaturas::where('id', $request->id)->update([
            'del' => 'não'
        ]);
        $this->mensagem = 'Assinaturas Voltou com Sucesso!';
        return redirect()->route('dashboard')->with('mensagem' , $this->mensagem);
    }
}
