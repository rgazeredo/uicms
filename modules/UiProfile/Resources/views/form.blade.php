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
                    <span class="glyphicon glyphicon-list-alt"></span>{{ $module_action }} perfil de acesso
                </div>
            </div>
            {!! Form::open(array('method' => 'post', 'role' => 'form', 'id' => 'formProfile')) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="name" required="required" value="{{ $ui_profile->name }}">
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
        $("#formProfile").validate();
    });
</script>
@stop