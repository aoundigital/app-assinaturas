@extends('adminlte::page')

@section('title', 'Assinaturas')

@section('content')
{{--Padding --}}
<div class="p-3">
    {{-- Tabela Geral --}}
    <div class="row">
        {{-- tabela entregas --}}
        <div class="col-6">
            <div class="card">
                <div class="card-header text-info">
                    <h3 class="card-title pl-3">Tabela Geral de Entregas</h3>
                    <h3 class="card-title float-right pr-3">{{ $cliente }}</h3>
                </div>
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example3" class="table table-bordered table-hover dataTable dtr-inline"
                                    role="grid" aria-describedby="example2_info">
                                    <thead>
                                        <tr role="row">
                                            <th>Data</th>
                                            <th>Mês</th>
                                            <th>Quant.</th>
                                            <th>Tipo</th>
                                            <th>Descrição</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($entregas as $entrega)
                                            <tr>
                                                <td>{{ date('d/m/Y', strtotime($entrega->data_entrega)) }}</td>
                                                <td>{{ date('m', strtotime($entrega->data_entrega)) }}</td>
                                                <td>{{ $entrega->quantidade }}</td>
                                                <td>{{ $entrega->tipo }}</td>
                                                <td>{{ $entrega->descricao }}</td>
                                                <td><a onclick="return confirm('Quer mesmo deletar esta entrega?')"
                                                    href="{{ route('deletar.entrega', $entrega->id) }}"
                                                    class="btn btn-danger btn-sm d-inline">Deletar</a></td>
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
        {{-- Form Entregas --}}
        <div class="col-6">
            <div class="card">
                <div class="card-header text-info">
                    <h3 class="card-title pl-3">Criar Nova Entrega</h3>
                    <h3 class="card-title float-right pr-3">{{ $cliente }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('create.entrega') }}">
                        @csrf
                        <input type="hidden" name="cliente_id" class="form-control" value="{{ $id }}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="data_entrega">Data da Entrega</label>
                                    <input type="date" name="data_entrega" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="quantidade">Quantidade</label>
                                    <input type="number" name="quantidade" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="qualidade">Escolha um Plano</label>
                                    <select class="form-control" name="qualidade" required>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- select -->
                                <div class="form-group">
                                    <label for="tipo">Tipo</label>
                                    <select class="form-control" name="tipo" required>
                                        <option value="dofollow">Dofollow</option>
                                        <option value="nofollow">Nofollow</option>
                                        <option value="variados">Variados</option>
                                        <option value="sinais">Sinais Sociais</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <textarea name="descricao"  class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Criar Entrega</button>
                            <button type="reset" class="btn btn-default float-right">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#example3').DataTable({
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
