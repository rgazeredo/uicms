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
                    <span class="glyphicon glyphicon-list-alt"></span>{{ $module_action }} do módulo {{ $ui_module->name }}
                </div>
            </div>
            {!! Form::open(array('method' => 'post', 'role' => 'form', 'id' => 'formModuleAction')) !!}
                <div class="panel-body">
                    @foreach($ui_module_controller_actions as $ui_module_controller_action)
                        <input type="hidden" name="link[<?php echo $ui_module->id ?>][]" required="required" value="{{ $ui_module_controller_action->link }}">
                        <div class="row">
                            <div class="form-group col-lg-5">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="name[<?php echo $ui_module->id ?>][]" required="required" value="{{ $ui_module_controller_action->name }}">
                            </div>
                            <div class="form-group col-lg-5">
                                <label>Ação</label>
                                <input type="text" class="form-control" readonly="readonly" name="action[<?php echo $ui_module->id ?>][]" required="required" value="{{ $ui_module_controller_action->action }}">
                            </div>
                            <div class="form-group col-lg-2">
                                <label>&nbsp;</label>
                                <?php if(empty($ui_module_controller_action->id)): ?>
                                    <div class="form-control" style="border: none;">
                                        <span class="badge badge-info">Novo</span>
                                    </div>
                                <?php else: ?>
                                    <div class="form-control" style="border: none;">
                                        <a href="{{ url($module_link.'/actionsdelete/'.$ui_module_controller_action->id) }}" class="btn btn-danger btn-xs">
                                            <i class="fa fa-minus-square">&nbsp;&nbsp;Remover</i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
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
        $("#formModuleAction").validate();
    });
</script>
@stop