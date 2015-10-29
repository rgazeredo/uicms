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
                    <span class="glyphicon glyphicon-list-alt"></span>{{ $module_action }} do perfil de acesso {{ $ui_profile->name }}
                </div>
            </div>
            {!! Form::open(array('method' => 'post', 'role' => 'form', 'id' => 'formProfileAction')) !!}
                <div class="panel-body">
                    @foreach($ui_modules as $ui_module)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <h4>{{ $ui_module->name }}</h2>
                                </div>
                                @if(count($ui_module->actions) > 0)
                                    <div class="pull-right">
                                        <a href="javascript:void(0);" onclick="selectAll('{{ strtolower($ui_module->module) }}')">Marcar todos</a> |
                                        <a href="javascript:void(0);" onclick="deselectAll('{{ strtolower($ui_module->module) }}')">Desmarcar todos</a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if(count($ui_module->actions) > 0)
                            <div class="row">
                                <div class="col-md-4">
                                    @foreach($ui_module->actions as $key_action => $action)
                                        <div class="checkbox-custom checkbox-primary">
                                            @if($action->exists)
                                                <input name="permissions[{{ $ui_module->module }}][{{ $action->id }}]" type="checkbox" checked="checked" class="checkbox-{{ strtolower($ui_module->module) }}" id="{{ strtolower($ui_module->module) }}_{{ strtolower($action->action) }}">
                                            @else
                                                <input name="permissions[{{ $ui_module->module }}][{{ $action->id }}]" type="checkbox" class="checkbox-{{ strtolower($ui_module->module) }}" id="{{ strtolower($ui_module->module) }}_{{ strtolower($action->action) }}">
                                            @endif
                                            <label for="{{ strtolower($ui_module->module) }}_{{ strtolower($action->action) }}">{{ $action->name }}</label>
                                        </div>
                                        @if(($key_action+1) % 4 == 0)
                                            </div><div class="col-md-4">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Nenhuma ação cadastrada para esse módulo!</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
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
        $("#formProfileAction").validate();
    });

    function selectAll(module)
    {
        jQuery('.checkbox-'+ module).each(function(index, el) {
            el.checked = true; 
        });
    }

    function deselectAll(module)
    {
        jQuery('.checkbox-'+ module).each(function(index, el) {
            el.checked = false
            ; 
        });
    }
</script>
@stop