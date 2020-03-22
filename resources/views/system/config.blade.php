@extends('main')
@section('content')
@if (\Auth::user()->role != 'STAFF')
<div class="card">
    <div class="card-header">
        Tetapan
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link @if(Request::segment(3)=='1' ) active @endif" href="{!! URL::to('edit/config', '1') !!}">
                                <span class="d-none d-lg-inline">Umum</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane @if(Request::segment(3) == '1') active @endif">
                            @if(Request::segment(3) == '1')
                            <form method="POST" action="{!! \URL::to('update/config/1') !!}" id="form-config-general">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="category">Emel Daripada (Emel)</label>
                                            <div data-dx="textbox" data-name="emel_daripada" data-mode="text" data-value="{!! \Request::old('emel_daripada', isset($emelDaripada) ? $emelDaripada['value'] : null) !!}"
                                                data-validate="true" data-validation-type="required,email" data-validation-group="form-config-general"></div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="category">Emel Daripada (Nama)</label>
                                            <div data-dx="textbox" data-name="emel_nama" data-mode="text" data-value="{!! \Request::old('emel_nama', isset($emelNama) ? $emelNama['value'] : null) !!}"
                                                data-validate="true" data-validation-type="required" data-validation-group="form-config-general"></div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-right">
        <div class="pull-right" style="margin-right: 15px;">
            @if(Request::segment(3) == '1')
            <div data-dx="btn-submit" data-type="default" data-text="Simpan" data-disabled="false" data-validation-group="form-config-general" data-form="form-config-general"></div>
            @endif
        </div>
    </div>
    <div id="delete-token">@csrf</div>
</div>
@endif


@stop

@section('page-script')
<script type="text/javascript">
    $(document).ready(function () {
            var heightBody = $(window).height();
            $('#tabs').height(heightBody - 330);
            $('#setHeight').height(heightBody - 330);
            $('.table-responsive').height(heightBody - 365);

            setTimeout(function () {
                $('.panel-tab').removeClass('hidden');
                $('.loader').remove();
            }, 1000);

            var treeview = $("#area-treeview").dxTreeView({
                dataSource: new DevExpress.data.DataSource({
                    store: new DevExpress.data.ODataStore({
                        url: '{!! URL::to('/') !!}/' + 'data?b=55a0c60437b36'
                    })
                }),
                dataStructure: "plain",
                keyExpr: "id",
                displayExpr: "area_name",
                parentIdExpr: "parent_id",
                hasItemsExpr: "is_group"
            }).dxTreeView("instance");

            $("#search-treeview").dxTextBox({
                placeholder: "Search",
                width: 300,
                mode: "search",
                valueChangeEvent: "keyup",
                onValueChanged: function (e) {
                    treeview.option("searchValue", e.value);
                }
            });

            $('.btn-add').click(function () {
                $('#form').removeClass('hidden');
                $('.btn-save').removeClass('hidden');
                $('.btn-cancel').removeClass('hidden');
                $(this).addClass('hidden');
            });

            $('.btn-cancel').click(function () {
                $('#form').addClass('hidden');
                $('.btn-save').addClass('hidden');
                $('.btn-cancel').addClass('hidden');
                $(this).addClass('hidden');
            });

            $('.save').click(function () {
                formData = {
                    emel_daripada: $('input[name="emel_daripada"]').val(),
                    emel_nama: $('input[name="emel_nama"]').val()

                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{!! URL::to('update/config') !!}',
                    dataType: 'JSON',
                    type: "POST",
                    data: formData,
                    success: function (data, textStatus, jqXHR) {
                        toastr.success('Tetapan telah disimpan!', 'Mesej');
                    }
                });
            });
        });
</script>

@stop