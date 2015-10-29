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

    @if(isset($message_success))
        <div class="col-md-12">
            <div class="alert alert-sm alert-border-left alert-success light alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                    <li>{{ $message_success }}</li>
                </ul>
            </div>
        </div>
    @endif

    <div class="col-md-12">
        <div class="panel panel-visible">
            <div class="panel-heading">
                <div class="panel-title hidden-xs">
                    <span class="glyphicon glyphicon-list-alt"></span>Ordenar menu
                    <div class="btn-group pull-right">
                        <a href="javascript:void(0);" id="btAddMenu" class="btn btn-primary btn-panel">
                            <i class="fa fa-plus-square">&nbsp;&nbsp;Menu</i>
                        </a>
                        <a href="javascript:void(0);" id="btAddTitle" class="btn btn-primary btn-panel">
                            <i class="fa fa-plus-square">&nbsp;&nbsp;Título</i>
                        </a>
                        <!-- <a href="{{ url($module_link .'/create') }}" class="btn btn-primary btn-panel">
                            <i class="fa fa-plus-square">&nbsp;&nbsp;Separador</i>
                        </a> -->
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dd mb35" id="nestable">
                            {!! $module_menu !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                {!! Form::open(array('method' => 'post', 'role' => 'form', 'id' => 'formMenuItems')) !!}
                    <input type="hidden" name="menuserialize" id="menuserialize" value="">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check-square">&nbsp;&nbsp;Salvar</i>
                    </button>
                    &nbsp;
                    <a href="{{ url($module_link) }}" class="btn btn-dark">
                        <i class="fa fa-chevron-circle-left">&nbsp;&nbsp;Voltar</i>
                    </a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!-- Admin Form Popup -->
<div id="uiModalSave" class="popup-basic mfp-with-anim mfp-hide">
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-list-alt"></i>Administrar menu</span>
        </div>
        {!! Form::open(array('method' => 'post', 'role' => 'form', 'autocomplete' => 'off', 'id' => 'formMenuItens')) !!}
            <div class="panel-body p20">
                <div class="section row">
                    <div class="form-group col-md-12">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="name" id="name" required="required">
                    </div>
                    <div class="form-group col-md-12 item-menu item-menu-edit">
                        <label>Módulo</label>
                        {!! Form::select('ui_module_id', $ui_modules, null, array('class' => 'form-control', 'id' => 'ui_module_id')) !!}
                    </div>
                    <div class="form-group col-md-12 item-menu item-menu-edit">
                        <label>Ação</label>
                        {!! Form::select('ui_action_id', $ui_modules, null, array('class' => 'form-control', 'id' => 'ui_action_id')) !!}
                    </div>
                    <div class="form-group col-md-12 item-menu">
                        <label>Link</label>
                        <input type="text" class="form-control" name="link" id="link">
                    </div>
                    <div class="form-group col-md-12 item-menu">
                        <label>Abrir em:</label>
                        {!! Form::select('target', $targets, null, array('class' => 'form-control', 'id' => 'target')) !!}
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <input type="hidden" name="menu_type" id="menu_type">
                <input type="hidden" name="ui_menu_id" id="ui_menu_id" value="{{ $ui_menu->id }}">
                <input type="hidden" name="ui_menu_item_id" id="ui_menu_item_id">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-check-square">&nbsp;&nbsp;Salvar</i>
                </button>
                &nbsp;
                <a href="javascript:void(0);" class="btn btn-danger close-menu">
                    <i class="fa fa-minus-square">&nbsp;&nbsp;Cancelar</i>
                </a>
            </div>
        {!! Form::close() !!}
    </div>
</div>

<!-- Admin Form Popup -->
<div id="uiModalRemove" class="popup-basic mfp-with-anim mfp-hide">
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-list-alt"></i>Remover menu</span>
        </div>
        {!! Form::open(array('method' => 'post', 'role' => 'form', 'id' => 'formMenuItensRemove')) !!}
            <div class="panel-body p20">
                <div class="section row">
                    <p>Tem certeza que deseja remover o registro selecionado?</p>
                </div>
            </div>
            <div class="panel-footer">
                <input type="hidden" name="id_remove" id="id_remove" value="">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-check-square">&nbsp;&nbsp;Sim</i>
                </button>
                &nbsp;
                <a href="javascript:void(0);" class="btn btn-danger close-menu">
                    <i class="fa fa-minus-square">&nbsp;&nbsp;Não</i>
                </a>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('scripts')

<!-- Page Plugins -->
<script type="text/javascript" src="{{ url('admin/vendor/plugins/magnific/jquery.magnific-popup.js') }}"></script>
<script type="text/javascript" src="{{ url('admin/uicms/uicms.js') }}"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {

        // Nestable Output
        var updateOutput = function(e) {
            var list = e.length ? e : jQuery(e.target);
            if (window.JSON) {
                jQuery('#menuserialize').val(window.JSON.stringify(list.nestable('serialize')));
            }
        };

        // Init Nestable on list 1
        jQuery('#nestable').nestable({
            group: 1
        }).on('change', updateOutput);

        jQuery(".close-menu").click(function(event) {
            var magnificPopup = jQuery.magnificPopup.instance; // save instance in magnificPopup variable
                magnificPopup.close();
        });

        //Popula acões
        jQuery("#ui_module_id").change(function(event) {
            var ui_module_id = this.value;

            if(ui_module_id == "")
            {
                jQuery("#ui_action_id").html('<option value="">Selecione</option>');
            } else {
                jQuery("#ui_action_id").uiPopulateCombobox(
                {
                    url: "<?php echo url('uiadmin/uiajax/uipopulatecombobox') ?>",
                    table: "ui_module_action",
                    value: "link",
                    label: "name",
                    conditions: [
                        {
                            field: "ui_module_id",
                            condition: "=",
                            value: ui_module_id
                        }
                    ]
                });
            }
        });

        jQuery("#ui_action_id").change(function(event) {
            var link = this.value;

            if(link != "")
                $("#link").val(link);
        });

        //Adiciona menu
        jQuery('#btAddMenu').click(function(event) {
            //Limpa os campos do formulário
            resetForm();

            jQuery('.item-menu').show();
            jQuery('.item-menu-edit').show();

            //Tipo menu
            jQuery('#menu_type').val('0');

            //Abre o formulário via modal para adicionar novo endereço
            jQuery('#uiModalSave').uiModalSave({
                url: "<?php echo url('uiadmin/uiajax/uimodalsave') ?>",
                form: "#formMenuItens",
                table: "ui_menu_item",
                callback: 'reloadPage',
                validate: true
            });
        });

        //Adiciona título
        jQuery('#btAddTitle').click(function(event) {
            //Limpa os campos do formulário
            resetForm();

            jQuery('.item-menu').hide();

            //Tipo title
            jQuery('#menu_type').val('1');

            //Abre o formulário via modal para adicionar novo endereço
            jQuery('#uiModalSave').uiModalSave({
                url: "<?php echo url('uiadmin/uiajax/uimodalsave') ?>",
                form: "#formMenuItens",
                table: "ui_menu_item",
                callback: 'reloadPage',
                validate: true
            });
        });

        //Editar menu
        jQuery('.btEditMenu').click(function(event) {

            var id = jQuery(this).attr('ui_menu_item');

            jQuery('.btEditMenu').uiFind({
                url: "<?php echo url('uiadmin/uiajax/uifind') ?>",
                table: "ui_menu_item",
                id: id,
                callback: 'uiFindResult',
            });
        });

        //Remover menu
        jQuery('.btRemoveMenu').click(function(event) {
            var id = jQuery(this).attr('ui_menu_item');

            jQuery('#id_remove').val(id);

            jQuery('#uiModalRemove').uiModalRemove({
                url: "<?php echo url('uiadmin/uiajax/uimodalremove') ?>",
                form: "#formMenuItensRemove",
                table: "ui_menu_item",
                callback: 'reloadPage'
            });
        });
    });
    
    function uiFindResult(uiResult)
    {
        if(uiResult.menu_type == 1)
        {
            jQuery('.item-menu').hide();
            jQuery('.item-menu-edit').hide();
        } else {
            jQuery('.item-menu').show();
            jQuery('.item-menu-edit').hide();
        }

        //Popula os dados do formulário
        jQuery('#ui_menu_item_id').val(uiResult.id);
        jQuery('#name').val(uiResult.name);
        jQuery('#ui_module_id').val('');
        jQuery('#ui_action_id').val('');
        jQuery('#link').val(uiResult.link);
        jQuery('#target').val(uiResult.target);

        //Abre o formulário via modal para adicionar novo endereço
        jQuery('#uiModalSave').uiModalSave({
            url: "<?php echo url('uiadmin/uiajax/uimodalsave') ?>",
            form: "#formMenuItens",
            table: "ui_menu_item",
            callback: 'reloadPage',
            validate: true
        });
    }

    function resetForm()
    {
        //Limpa os campos do formulário
        jQuery('#ui_menu_item_id').val('');
        jQuery('#id_remove').val('');
        jQuery('#name').val('');
        jQuery('#ui_module_id').val('');
        jQuery('#ui_action_id').html('<option value="">Selecione...</option>')
        jQuery('#link').val('');
        jQuery('#target').prop('checked', false);
    }

    function reloadPage()
    {
        resetForm();
        window.location.reload();
    }
</script>
@stop