@extends('uiadmin::layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-visible">
            <div class="panel-heading">
                <div class="panel-title hidden-xs">
                    <span class="glyphicon glyphicon-list-alt"></span>{{ $module_action }} perfil de acesso
                </div>
            </div>
            {!! Form::open(array('method' => 'post', 'role' => 'form')) !!}
                <input type="hidden" name="id" value="{{ $ui_module->id }}">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Nome</label>
                            <div>{{ $ui_module->name }}</div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Módulo</label>
                            <div>{{ $ui_module->module }}</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <p><strong>Tem certeza que deseja remover?</strong></p>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check-square">&nbsp;&nbsp;Sim</i>
                    </button>
                    &nbsp;
                    <a href="{{ url($module_link) }}" class="btn btn-danger">
                        <i class="fa fa-minus-square">&nbsp;&nbsp;Não</i>
                    </a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop