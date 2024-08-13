@extends('adminlte::page')

@section('title', 'Assinaturas')

@section('content')
<div class="p-5">
    <div class="card">
        <form action="{{ route('create.pagementos') }}" method="POST">
            <div class="card-header bg-info">
                <h3 class="card-title">Novo Pagamento</h3>
                @foreach ($assinaturas as $ass)
                <h3 class="card-title float-right pr-3"><a href="{{ route('ass.sozinho', $ass->id) }}" class="btn btn-dark">VOLTAR</a></h3>
                @endforeach
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        @csrf
                        <label>Cliente</label>
                        <select class="form-control" name="cliente_id" name="tipo" required>
                            @foreach ($assinaturas as $ass)
                                <option value="{{ $ass->id }}">{{ $ass->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Data</label>
                        <input type="date" name="data_pagto" class="form-control" required>
                    </div>
                    <div class="col-3">
                        <label>Valor</label>
                        <input type="text" name="valor_pagto" class="form-control" placeholder="99.99" required>
                    </div>
                    <div class="col-3">
                        <label>Tipo</label>
                        <input type="text" name="tipo_pagto" class="form-control" placeholder="PayPal" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Criar</button>
                <button type="reset" class="btn btn-default float-right">Cancelar
                </button>
            </div>
        </form>
        <!-- /.card-body -->
    </div>

    <div class="row">
        <div class="col-6">
            @if ($unico)
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Dados da Assinatura</h3>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($assinaturas as $ass)
                            <li class="mb-2">Nome: <b>{{ $ass->nome }}</b></li>
                            <li class="mb-2">Email: <b>{{ $ass->email }}</b></li>
                            <li class="mb-2">Sites: <b>{{ $ass->sites }}</b></li>
                            <li class="mb-2">Plano: <b>{{ $ass->tipo }}</b></li>
                            <li class="mb-2">Data Inicial: <b>{{ date('d/m/Y', strtotime($ass->data_inicio)) }}</b></li>
                            <li class="mb-2">Valor Mensal: <b>R$ {{ $ass->valor }}</b></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
        <div class="col-6">
            @if ($unico)
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Tabela de Pagamentos</h3>
                </div>
                <div class="card-body">
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>Valor</th>
                                    <th>Data</th>
                                    <th>Tipo</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pagamentos as $pgto)
                                    <tr>
                                        <td class="align-middle text-center">R$ {{ number_format($pgto->valor_pagto, 2, ",", ".") }}</td>
                                        <td class="align-middle text-center">{{ date('d/m/Y', strtotime($pgto->data_pagto)) }}</td>
                                        <td class="align-middle text-center">{{ ($pgto->tipo_pagto) }}</td>
                                        <td><a onclick="return confirm('Quer mesmo deletar esta pagamento?')"
                                            href="{{ route('apagar.pagemento', $pgto->id) }}"
                                            class="btn btn-danger btn-sm d-inline">Deletar</a></td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
