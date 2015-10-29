@extends('uiadmin::layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-visible">
            <div class="panel-heading">
                <div class="panel-title hidden-xs">
                    <span class="glyphicon glyphicon-list-alt"></span>{{ $module_action }} usuário
                </div>
            </div>
            {!! Form::open(array('method' => 'post', 'role' => 'form')) !!}
                <input type="hidden" name="id" value="{{ $ui_user->id }}">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Nome</label>
                            <div>{{ $ui_user->name }}</div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>E-mail</label>
                            <div>{{ $ui_user->email }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Ativo</label>
                            @if($ui_user->active)
                                <div>Sim</div>
                            @else
                                <div>Não</div>
                            @endif
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