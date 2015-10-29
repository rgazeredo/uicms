@extends('uiadmin::layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-visible">
            <div class="panel-heading">
                <div class="panel-title hidden-xs">
                    <span class="glyphicon glyphicon-tasks"></span>Lista de módulos
                    <div class="btn-group pull-right">
                        <a href="{{ url($module_link .'/create') }}" class="btn btn-primary">
                            <i class="fa fa-plus-square">&nbsp;&nbsp;Adicionar</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel-body pn">
                <table class="table table-striped table-bordered table-hover" id="datatableUser" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Módulo</th>
                            <th>Rota</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ui_modules as $ui_module)
                            <tr>
                                <td>{{ $ui_module->id }}</td>
                                <td>{{ $ui_module->name }}</td>
                                <td>{{ $ui_module->module }}</td>
                                <td>{{ $ui_module->route }}</td>
                                <td>
                                    <a href="{{ url($module_link .'/actions/'. $ui_module->id) }}" class="btn btn-xs btn-primary">
                                        <i class="fa fa-check-square">&nbsp;&nbsp;Ações</i>
                                    </a>
                                    &nbsp;
                                    <a href="{{ url($module_link .'/edit/'. $ui_module->id) }}" class="btn btn-xs btn-warning">
                                        <i class="fa fa-pencil-square">&nbsp;&nbsp;Editar</i>
                                    </a>
                                    &nbsp;
                                    @if($ui_module->root)
                                        <a href="javascript:void(0)" disabled="disabled" class="btn btn-xs btn-danger">
                                            <i class="fa fa-minus-square">&nbsp;&nbsp;Remover</i>
                                        </a>
                                    @else
                                        <a href="{{ url($module_link .'/delete/'. $ui_module->id) }}" class="btn btn-xs btn-danger">
                                            <i class="fa fa-minus-square">&nbsp;&nbsp;Remover</i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	jQuery(document).ready(function() {
		$('#datatableUser').dataTable({
            "columns": [
                { "width": "8%", "className": "center" },
                null,
                null,
                null,
                { "width": "25%", "className": "center", "orderable": false },
            ],
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": "",
                    "sNext": ""
                },
                "sUrl": "{{ url('admin/vendor/plugins/datatables/Portuguese-Brasil.json') }}"
            },
            "iDisplayLength": 5,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "sDom": '<"dt-panelmenu clearfix"lfr>t<"dt-panelfooter clearfix"ip>',
        });
    });
</script>
@stop