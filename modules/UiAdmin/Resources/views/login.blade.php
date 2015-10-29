@extends('uiadmin::layouts.login')
 
@section('content')
<div class="admin-form theme-info" id="login1">
    <div class="row mb15 table-layout">

        <div class="col-xs-6 va-m pln">
            <a href="dashboard.html" title="Return to Dashboard">
            <img src="{{ url('admin/assets/img/logos/logo_white.png') }}" name="Logo" class="img-responsive w250">
            </a>
        </div>

        <div class="col-xs-6 text-right va-b pr5">
            <!-- <div class="login-links">
                <a href="pages_login.html" class="active" title="Sign In">Sign In</a>
                <span class="text-white"> | </span>
                <a href="pages_register.html" class="" title="Register">Register</a>
            </div> -->
        </div>
    </div>

    <div class="panel panel-info mt10 br-n">

        <div class="panel-heading heading-border bg-white">
        </div>

        <!-- end .form-header section -->
        {!! Form::open(array('method' => 'post', 'id' => 'formLogin')) !!}
            <div class="panel-body bg-light p30">
                <div class="row">
                    <div class="col-sm-12">
                        
                        @if(!empty($ui_errors))
                            @foreach($ui_errors as $ui_error)
                                <div class="alert alert-sm alert-border-left alert-danger light alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="fa fa-info pr10"></i>
                                    {{ $ui_error }}
                                </div>
                            @endforeach
                        @endif

                        <div class="section">
                            <label for="username" class="field-label text-muted fs18 mb10">E-mail</label>
                            <label for="username" class="field prepend-icon">
                                <input type="text" name="email" id="email" class="gui-input" placeholder="E-mail" required="required">
                                <label for="username" class="field-icon"><i class="fa fa-user"></i>
                                </label>
                            </label>
                        </div>
                        <!-- end section -->

                        <div class="section">
                            <label for="username" class="field-label text-muted fs18 mb10">Senha</label>
                            <label for="password" class="field prepend-icon">
                                <input type="password" name="password" id="password" class="gui-input" placeholder="Senha" required="required">
                                <label for="password" class="field-icon"><i class="fa fa-lock"></i>
                                </label>
                            </label>
                        </div>
                        <!-- end section -->

                    </div>
                </div>
            </div>
            <!-- end .form-body section -->
            <div class="panel-footer clearfix p10 ph15">
                <button type="submit" class="button btn-primary mr10 pull-right">Entrar</button>
                <label class="switch block switch-primary pull-left input-align mt10">
                    <a href="javascript:void();"><span>Esqueci minha senha</span></a>
                </label>
            </div>
            <!-- end .form-footer section -->
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function() {
        $("#formLogin").validate();
    });
</script>
@stop