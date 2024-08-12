@extends('adminlte::page')

@section('title', 'Assinaturas')

@section('content')
    <h1>Plano Qualidade</h1>

    {{-- Tabela Geral --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                    role="grid" aria-describedby="example2_info">
                                    <thead>
                                        <tr role="row">
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Sites</th>
                                            <th>Data</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assinaturas as $ass)
                                        <tr>
                                            <td>{{ $ass->nome }}</td>
                                            <td>{{ $ass->email }}</td>
                                            <td>{{ $ass->sites }}</td>
                                            <td>{{  date('d/m/Y', strtotime($ass->data_inicio)) }}</td>
                                            <td>{{ number_format($ass->valor, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@stop
