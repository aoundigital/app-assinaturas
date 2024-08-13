@extends('adminlte::page')

@section('title', 'Assinaturas')

@section('content')
{{-- mensagem --}}
@if(session('mensagem'))
    <div class="row clearfix mb-2 pt-2">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('mensagem') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif
{{-- Topo | Título e Botão --}}
<div class="row mb-2 pt-2">
    <div class="col-sm-6">
        <h1 class="display-4">Assinaturas todos os Planos</h1>
    </div>
    <div class="col-sm-6 mt-2">
        <div class="float-sm-right">
            <a href="{{ route('criar.pagemento') }}" class="btn btn-secondary">Criar Novo Pagamento</a>
            <a href="{{ route('criar.assinatura') }}" class="btn btn-dark">Criar Nova Assinatura</a>
        </div>
    </div>
</div>
{{-- cards coloridos --}}
<div class="row">
    <div class="col-lg-2 col-12">
        <!-- small box -->
        <div class="small-box bg-light">
            <div class="inner">
                <h3>{{ $total_basico }}</h3>
                <p>Básico</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('admin.basico') }}" class="small-box-footer">+ Detalhes <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-12">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $total_regular }}</h3>
                <p>Regular</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('admin.regular') }}" class="small-box-footer">+ Detalhes <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-12">
        <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>{{ $total_completo }}</h3>
                <p>Completo</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.completo') }}" class="small-box-footer">+ Detalhes <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-12">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $pbn }}</h3>
                <p>PBNs</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.pbn') }}" class="small-box-footer">+ Detalhes <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-12">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ $pbn_sinais }}</h3>
                <p>Qualidade</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.pbn_sinais') }}" class="small-box-footer">+ Detalhes <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-12">
        <!-- small box -->
        <div class="small-box bg-teal">
            <div class="inner">
                <h3>{{ $blog_ecom }}</h3>
                <p>Blog / E-commerce</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.blog_ecom') }}" class="small-box-footer">+ Detalhes <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
{{-- Tabela Geral --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-info">
                <h3 class="card-title pl-3">Tabela Geral de Assinaturas da Bestlinks</h3>
                <h3 class="card-title float-right pr-3">R$ {{ number_format($total_pagina, 2, ",", ".") }}</h3>
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
                            <table id="geral" class="table table-sm table-bordered table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nome</th>
                                        <th>Empresa</th>
                                        <th style="width: 20%">Email</th>
                                        {{-- <th style="width: 20%">Sites</th> --}}
                                        <th>Plano</th>
                                        <th>Condição</th>
                                        <th>Pagamento</th>
                                        <th>Tipo</th>
                                        <th>Ferramentas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assinaturas as $ass)
                                        <tr class="@if ($ass->ativo->ativo == 0) bg-secondary @endif">
                                            <td class="align-middle">{{ $ass->nome }}</td>
                                            <td class="align-middle">{{ $ass->empresa }}</td>
                                            <td class="align-middle">{{ $ass->email }}</td>
                                            {{-- <td class="align-middle">{{ $ass->sites }}</td> --}}
                                            <td class="align-middle initialism text-center">{{ $ass->tipo }}</td>
                                            <td class="align-middle initialism text-center">
                                                @if ($ass->ativo->ativo == 1)
                                                    ATIVO
                                                @elseif ($ass->ativo->ativo == 0)
                                                    INATIVO
                                                @endif
                                            </td>
                                            @foreach ($ass->pagamentos as $pagt)
                                                @if ($loop->last)
                                                    <td class="align-middle text-center">{{ date('d/m/Y', strtotime($pagt->data_pagto)) }}</td>
                                                    <td class="align-middle text-center">{{ $pagt->tipo_pagto }}</td>
                                                @endif
                                            @endforeach
                                            <td class="project-actions align-middle text-center">
                                                <a class="btn btn-primary btn-sm d-inline" target="_blank" href="{{ route('criar_uma.pagemento', $ass->id) }}">Pagto</a>
                                                <a href="{{ route('id.entregas', $ass->id) }}" target="_blank" class="btn btn-warning btn-sm d-inline">Entregas</a>
                                                <a href="{{ route('ass.sozinho', $ass->id) }}" target="_blank" class="btn btn-info btn-sm d-inline">Detalhes</a>
                                                <a onclick="return confirm('Quer mesmo deletar esta assinatura?')"
                                                    href="{{ route('del.assinatura', $ass->id) }}"
                                                    class="btn btn-danger btn-sm d-inline">
                                                    <i class="fas fa-trash"> Excluir</i>
                                                </a>
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
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#geral').DataTable({
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
