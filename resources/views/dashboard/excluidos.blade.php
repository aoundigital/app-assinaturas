@extends('adminlte::page')

@section('title', 'Assinaturas')

@section('content')
    {{-- Tabela Excluidos --}}
    <div class="p-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-info">
                        <h3 class="card-title pl-3">Tabela de Assinaturas Excluidas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="dataTables_wrapper">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 table-responsive-md">
                                    <table id="excluidos" class="table table-sm table-bordered table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Nome</th>
                                                <th>Empresa</th>
                                                <th style="width: 20%">Email</th>
                                                <th>Plano</th>
                                                <th>Início</th>
                                                <th>Ferramentas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assinaturas as $ass)
                                                <tr>
                                                    <td class="align-middle">{{ $ass->nome }}</td>
                                                    <td class="align-middle">{{ $ass->empresa }}</td>
                                                    <td class="align-middle">{{ $ass->email }}</td>
                                                    <td class="align-middle initialism text-center">{{ $ass->tipo }}</td>
                                                    <td class="align-middle text-center">
                                                        {{ date('d/m/Y', strtotime($ass->data_inicio)) }}</td>
                                                    <td class="project-actions align-middle text-center">
                                                        <a onclick="return confirm('Quer mesmo reciclar esta assinatura?')"
                                                            href="{{ route('voltou.assinatura', $ass->id) }}"
                                                            class="btn btn-warning btn-sm d-inline">Reciclar</a>
                                                        <a href="{{ route('ass.sozinho', $ass->id) }}"
                                                            class="btn btn-info btn-sm d-inline">Detalhes</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#excluidos').DataTable({
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
