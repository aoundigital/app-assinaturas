@extends('adminlte::page')

@section('title', 'Assinaturas')

@section('content')
    <div class="p-4">
        <div class="row">
            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-light">
                    <div class="inner">
                        <h3>R$ {{ number_format($total, 2, ",", ".") }}</h3>
                        <p>Faturamento Total</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>R$ {{ number_format(($total / count($pagamentos)), 2, ",", ".")  }}</h3>
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title pl-3">Tabela Geral de Pagamentos</h3>
                        <h3 class="card-title float-right pr-3">R$ {{ number_format($total_pagina, 2, ",", ".") }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12 table-responsive">
                            <table id="pagtos" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>Cliente ID</th>
                                        <th>Nome / Email</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($pagamentos)
                                        @foreach ($pagamentos as $pgto)
                                            <tr>
                                                <td class="align-middle text-center">{{ $pgto->cliente_id }}</td>
                                                <td class="align-middle"><b>{{ $pgto->assinates->nome }}</b> | {{ $pgto->assinates->email }}</td>
                                                <td class="align-middle text-center">R$ {{ number_format($pgto->valor_pagto, 2, ",", ".") }}</td>
                                                <td class="align-middle text-center">{{ date('d/m/Y', strtotime($pgto->data_pagto)) }}</td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
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
