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
                    <span class="glyphicon glyphicon-list-alt"></span>{{ $module_action }} usuário
                </div>
            </div>
            {!! Form::open(array('method' => 'post', 'role' => 'form', 'id' => 'formUser')) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Perfil de acesso</label>
                            {!! Form::select('ui_profile_id', $ui_profiles, $ui_user->ui_profile_id, array('class' => 'form-control', 'required' => 'required')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="name" required="required" value="{{ $ui_user->name }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>E-mail</label>
                            <input type="email" class="form-control" name="email" required="required" value="{{ $ui_user->email }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Senha</label>
                            @if(!empty($ui_user->id))
                                <input type="password" class="form-control" name="password" id="password">
                            @else
                                <input type="password" class="form-control" name="password" required="required" id="password">
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Confirmar senha</label>
                            @if(!empty($ui_user->id))
                                <input type="password" class="form-control" name="confirm_password" equalTo="#password">
                            @else
                                <input type="password" class="form-control" name="confirm_password" required="required" equalTo="#password">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <div class="checkbox-custom checkbox-primary mb5">
                                @if($ui_user->active)
                                    <input type="checkbox" name="active" id="cbActive" value="1" checked="checked">
                                @else
                                    <input type="checkbox" name="active" id="cbActive" value="1">
                                @endif
                                <label for="cbActive">Ativo</label>
                            </div>
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
        $("#formUser").validate();
    });
</script>
@stop