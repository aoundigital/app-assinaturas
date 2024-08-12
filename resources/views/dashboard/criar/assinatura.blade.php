@extends('adminlte::page')

@section('title', 'Assinaturas')

@section('content')
    <div class="p-5">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="card-title">Criar Nova Assinaura</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('create.assinatura') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="empresa">Empresa</label>
                                <input type="text" name="empresa" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="mail" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Data de Início</label>
                                <input type="date" name="data_inicio" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <!-- select -->
                            <div class="form-group">
                                <label>Escolha um Plano</label>
                                <select class="form-control" name="tipo" required>
                                    <option value="basico">Básico</option>
                                    <option value="regular">Regular</option>
                                    <option value="completo">Completo</option>
                                    <option value="pbn">PBN</option>
                                    <option value="pbn sinais">Qualidade</option>
                                    <option value="blog ecom">Blog / E-commerce</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Valor</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-dollar-sign"></i>
                                        </span>
                                    </div>
                                    <input type="double" name="valor" placeholder="999.99" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Sites (separados por vírgulas)</label>
                                <textarea class="form-control" name="sites" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Criar</button>
                        <button type="reset" class="btn btn-default float-right">Cancelar</a>
                      </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
