@extends('uiadmin::layouts.master')

@section('content')
<div class="row">
    @if(isset($messages_errors))
        <div class="col-md-12">
            <div class="alert alert-sm alert-border-left alert-danger light alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                    @foreach($messages_errors as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
	<div class="col-md-12">
		<div class="panel panel-visible">
            <div class="panel-heading">
                <div class="panel-title hidden-xs">
                    <span class="glyphicon glyphicon-list-alt"></span>{{ $module_action }} módulo
                </div>
            </div>
            {!! Form::open(array('method' => 'post', 'role' => 'form', 'id' => 'formModule')) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Módulo</label>
                            @if(!empty($ui_module->id))
                                <select name="module" class="form-control" required="required" disabled="disabled">
                            @else
                                <select name="module" class="form-control" required="required">
                            @endif
                                <option value="">Selecione...</option>
                                @foreach($ui_modules as $item_module)
                                    @if($item_module->exists)
                                        @if($item_module->id == $ui_module->id && !empty($ui_module->id))
                                            <option value="{{ $item_module->name }}" disabled="disabled" selected="selected">{{ $item_module->name }}</option>
                                        @else
                                            <option value="{{ $item_module->name }}" disabled="disabled">{{ $item_module->name }}</option>
                                        @endif
                                    @else
                                        <option value="{{ $item_module->name }}">{{ $item_module->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="name" required="required" value="{{ $ui_module->name }}">
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check-square">&nbsp;&nbsp;Salvar</i>
                    </button>
                    &nbsp;
                    <a href="{{ url($module_link) }}" class="btn btn-danger">
                        <i class="fa fa-minus-square">&nbsp;&nbsp;Cancelar</i>
                    </a>
                </div>
            {!! Form::close() !!}
        </div>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function() {
        $("#formModule").validate();
    });
</script>
@stop