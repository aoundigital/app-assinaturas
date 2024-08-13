@extends('adminlte::page')

@section('title', 'Assinaturas')

@section('content')
    <div class="row mb-2 pt-2">
        <div class="col-sm-6">
            <h3>Detalhes da Assinatura | {{ $assinatura->empresa }}</h3>
        </div>
        <div class="col-sm-6 mt-2">
            <div class="float-sm-right">
                <h3>Pagamento mensal de R$ {{ $assinatura->valor }}</h3>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Tabela Dados --}}
        <div class="col-4">
            <div class="card p-4">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Nome</td>
                            <td>{{ $assinatura->nome }}</td>
                        </tr>
                        <tr>
                            <td>Empresa</td>
                            <td>{{ $assinatura->empresa }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $assinatura->email }}</td>
                        </tr>
                        <tr>
                            <td>Sites</td>
                            <td>{{ $assinatura->sites }}</td>
                        </tr>
                        <tr>
                            <td>Plano</td>
                            <td>{{ $assinatura->tipo }}</td>
                        </tr>
                        <tr>
                            <td>Data de Pgto</td>
                            <td>{{ date('d/m/Y', strtotime($assinatura->data_inicio)) }}</td>
                        </tr>
                        <tr>
                            <td>Valor</td>
                            <td>R$ {{ number_format($assinatura->valor, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Ativo</td>
                            <td>
                                {{-- {{dd($assinatura->id)}} --}}
                                @if ($ativo == 1)
                                    <b>SIM</b> <a href="{{ route('desativar',[$id, $assinatura->id] ) }}" class="btn ml-4 btn-danger">Desativar</a>
                                @else
                                    <b>NÃO</b> <a href="{{ route('ativar', [$id, $assinatura->id] ) }}" class="btn ml-4 btn-success">Ativar</a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Tabela de Pagamentos --}}
        <div class="col-4">
            <div class="card p-4">
                <a class="btn btn-warning mb-2" href="{{ route('criar_uma.pagemento', $assinatura->id) }}">Administrar Pagtos</a>
                <table class="table table-striped table-bordered"">
                    <thead>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Tipo</th>
                    </thead>
                    <tbody>
                        @foreach ($assinatura->pagamentos as $pgtos)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($pgtos->data_pagto)) }}</td>
                                <td>R$ {{ number_format($pgtos->valor_pagto, 2, ',', '.') }}</td>
                                <td>{{ $pgtos->tipo_pagto }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><b>TOTAL</b></td>
                            <td><b>R$ {{ number_format($total_pagamentos, 2, ',', '.') }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Tabela de Entregas --}}
        <div class="col-4">
            <div class="card p-4">
                <a href="{{ route('id.entregas', $assinatura->id) }}" class="btn btn-warning mb-2">Administrar Entregas</a>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr role="row">
                            <th>Data Entrega</th>
                            <th>Quantidade</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assinatura->entregas as $entrega)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($entrega->data_entrega)) }}</td>
                                <td>{{ $entrega->quantidade }}</td>
                                <td>{{ $entrega->tipo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
