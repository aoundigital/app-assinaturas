@extends('adminlte::page')

@section('title', 'Assinaturas')

@section('content')

<div class="p-4">
    {{-- form de busca --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('buscar.pagemento') }}" method="post">
                        <div class="row align-items-center">
                            <div class="col-5">
                                @csrf
                                <div class="form-group">
                                    <label>Escolha o mês</label>
                                    <select class="form-control" name="mes" required>
                                        <option value="01">Janeiro</option>
                                        <option value="02">Fevereiro</option>
                                        <option value="03">Março</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Maio</option>
                                        <option value="06">Junho</option>
                                        <option value="07">Julho</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Setembro</option>
                                        <option value="10">Outubro</option>
                                        <option value="11">Novembro</option>
                                        <option value="12">Dezembro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Escolha o ano</label>
                                    <select class="form-control" name="ano" required>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary mt-2" type="submit">Buscar por Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- faturamento --}}
    @if (count($pagamentos) > 0)
        <div class="row">

            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-light">
                    <div class="inner">
                        <h3>R$ {{ number_format($total_mes, 2, ",", ".") }}</h3>
                        <p>Faturamento Total do Período</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>R$ {{ number_format(($total_mes / count($pagamentos)), 2, ",", ".")  }}</h3>
                        <p>Média dos pagamentos</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{{ count($pagamentos) }}</h3>
                        <p>Pagamentos Recebidos</p>
                    </div>
                </div>
            </div>

        </div>
    @endif

    {{-- Tabela de resultados --}}
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title pl-3">Tabela de Pagamentos | Mês <b>{{ $mes }}</b> / Ano
                        <b>{{ $ano }}</b>
                    </h3>
                    <h3 class="card-title float-right pr-3">R$ {{ number_format($total_pagina, 2, ',', '.') }}</h3>
                </div>
                {{-- /.card-header --}}
                <div class="card-body">
                    @if (count($pagamentos) == 0)
                        <h2 class="text-center">Nenhum dado encontrado!</b></h2>
                    @else
                    <div class="col-sm-12 table-responsive">
                        <table id="pagtos" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>Cliente ID</th>
                                    <th>Nome / Email</th>
                                    <th>Valor</th>
                                    <th>Data</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pagamentos as $pgto)
                                    <tr>
                                        <td class="align-middle text-center">{{ $pgto->cliente_id }}</td>
                                        <td class="align-middle"><b>{{ $pgto->assinates->nome }}</b> |
                                            {{ $pgto->assinates->email }}</td>
                                        <td class="align-middle text-center">R$
                                            {{ number_format($pgto->valor_pagto, 2, ',', '.') }}</td>
                                        <td class="align-middle text-center">
                                            {{ date('d/m/Y', strtotime($pgto->data_pagto)) }}</td>
                                        <td><a onclick="return confirm('Quer mesmo deletar esta pagamento?')"
                                            href="{{ route('apagar.pagemento', $pgto->id) }}"
                                            class="btn btn-danger btn-sm d-inline">Deletar</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#pagtos').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "responsive": true,
        });
    } );
</script>
@endsection
