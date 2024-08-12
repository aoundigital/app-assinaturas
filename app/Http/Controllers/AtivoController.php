<?php

namespace App\Http\Controllers;

use App\Models\Ativo;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class AtivoController extends Controller
{
    public function index()
    {
        return;
    }

    public function ativar(Request $request)
    {
        if ($request->id == 0) {
            Ativo::create([
                'cliente_id' => $request->cliente_id,
                'ativo' => true
            ]);
            $this->mensagem =  'Assinaturas Ativada com Sucesso!';
            return redirect()->route('ass.sozinho', $request->cliente_id)->with('mensagem' , $this->mensagem);
        } else {
            Ativo::where('id', $request->id)->update([
                'ativo' => true
            ]);
            $this->mensagem =  'Assinaturas Ativada com Sucesso!';
            return redirect()->route('ass.sozinho', $request->cliente_id)->with('mensagem' , $this->mensagem);
        }
        return;
    }

    public function desativar(Request $request)
    {
        if ($request->id == 0) {
            Ativo::create([
                'cliente_id' => $request->cliente_id,
                'ativo' => false
            ]);
            $this->mensagem =  'Assinaturas Desativada com Sucesso!';
            return redirect()->route('ass.sozinho', $request->cliente_id)->with('mensagem' , $this->mensagem);
        } else {
            Ativo::where('id', $request->id)->update([
                'ativo' => false
            ]);
            $this->mensagem =  'Assinaturas Desativada com Sucesso!';
            return redirect()->route('ass.sozinho', $request->cliente_id)->with('mensagem' , $this->mensagem);
        }
    }
}
