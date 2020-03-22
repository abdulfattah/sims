jQuery(function ($) {

    var baseURL = window.location.protocol + "//" + window.location.host;
    var grid;
    var triggerCroppie = false,
        errorAssement = false;
    var displayText, area_id, currentNode;
    var delBuildingPlanId = [];

    if ($('input[name="avatar"]').length > 0) {
        $uploadCrop = $('#crop').croppie({
            url: baseURL + '/images/upload.png?' + moment().unix(),
            enableExif: true,
            showZoomer: false,
            viewport: {
                width: 158,
                height: 158
            },
            boundary: {
                width: 162,
                height: 162
            },
            update: function (e) {
                triggerCroppie = true;
            }
        });

        if ($('input[name="avatar"]').val() !== null) {
            $uploadCrop.croppie('bind', {
                url: $('input[name="avatar"]').val()
            });
        }

        $("#profile_pic").dxFileUploader({
            selectButtonText: "Select photo",
            labelText: "",
            accept: "image/*",
            uploadMode: "useForm",
            showFileList: false,
            onValueChanged: function (e) {
                var reader = new FileReader();
                reader.onload = function (f) {
                    $uploadCrop.croppie('bind', {
                        url: f.target.result
                    });
                };
                reader.readAsDataURL(e.value[0]);
                triggerCroppie = true;
            }
        });
    }

    //form
    $('[data-dx]').each(function () {
        var $this = $(this);
        if ($this.attr('data-dx') === 'tooltip') {
            $this.removeClass('d-none');
            $this.dxTooltip({
                target: $this.prev(),
                showEvent: "mouseenter",
                hideEvent: "mouseleave",
                closeOnOutsideClick: false
            });
        }

        if ($this.attr('data-dx') === 'textbox') {
            $this.dxTextBox({
                name: $this.attr('data-name'),
                placeholder: $(this).is('[data-placeholder]') ? $this.attr('data-placeholder') : '',
                mode: $this.attr('data-mode'),
                value: $this.attr('data-value'),
                mask: $this.attr('data-mask'),
                readOnly: $this.attr('data-readonly')
            });

            if ($this.attr('data-name') === 'username' || $this.attr('data-name') === 'email' || $this.attr('data-name') === 'emel_daripada') {
                $this.dxTextBox('instance').option('inputAttr', {
                    style: 'text-transform:none'
                });
            }

            if ($this.attr('data-name') === 'area_text') {
                $this.dxTextBox('instance').option('readOnly', true);
                $('#btnSelectArea').click(function () {
                    $this.dxTextBox('instance').option('value', displayText);
                    $('input[name="area_id"]').val(area_id);
                });
            }
        }

        if ($this.attr('data-dx') === 'tagbox') {
            $.getJSON(baseURL + '/data?b=55a0c60438017&c=' + $this.attr('data-source'), function (data) {
                selectBoxData = new DevExpress.data.DataSource({
                    store: data
                });
                $this.dxTagBox({
                    name: $this.attr('data-name'),
                    items: data,
                    showSelectionControls: true,
                    displayExpr: "item",
                    valueExpr: $this.attr('data-value-exp'),
                    searchEnabled: true,
                    applyValueMode: "instantly",
                    value: $this.attr('data-value') != '' ? JSON.parse($this.attr('data-value')) : []
                });
            });
        }

        if ($this.attr('data-dx') === 'textarea') {
            $this.dxTextArea({
                name: $this.attr('data-name'),
                placeholder: $(this).is('[data-placeholder]') ? $this.attr('data-placeholder') : '',
                value: $this.attr('data-value'),
                inputAttr: {
                    style: 'text-transform:none'
                },
                height: $this.attr('data-height')
            });
        }

        if ($this.attr('data-dx') === 'checkbox') {
            $this.dxCheckBox({
                text: $this.attr('data-text'),
                name: $this.attr('data-name'),
                value: $this.attr('data-value') === '1'
            });
        }

        //dxselectbox
        if ($this.attr('data-dx') === 'selectbox') {
            $.getJSON(baseURL + '/data?b=55a0c60438017&c=' + $this.attr('data-source'), function (data) {
                selectBoxData = new DevExpress.data.DataSource({
                    store: data
                });
                $this.dxSelectBox({
                    dataSource: selectBoxData,
                    displayExpr: "item",
                    valueExpr: $this.attr('data-value-exp'),
                    searchEnabled: true,
                    name: $this.attr('data-name'),
                    showClearButton: true,
                    value: $this.attr('data-value')
                });

                if (window.location.href.indexOf('/create/property/single/1') > 0 || window.location.href.indexOf('/edit/property/single/1') > 0) {
                    if ($this.attr('data-name') === 'category_key') {
                        $this.dxSelectBox('instance').option('onValueChanged', function (e) {
                            if (e.value === 'hartaKerajaanPersekutuan' || e.value === 'hartaKerajaanNegeri' || e.value === 'hartaBadanBerkanun') {
                                $.getJSON(baseURL + '/data?b=55a0c60438017&c=' + e.value).done(function (data) {
                                    $('div[data-name="agency"]').dxSelectBox('instance').option('dataSource', new DevExpress.data.DataSource({
                                        store: data
                                    }));
                                    $('#modal-property-agency').modal('show');
                                });
                            } else {
                                $('#span-agency').html('<code></code>');
                            }
                        });
                    }

                    if ($this.attr('data-name') === 'state') {
                        hideLoadPanel();
                    }
                }

                if (window.location.href.indexOf('/edit/property/single/2') > 0) {
                    if ($this.attr('data-name') === 'ownership_type') {
                        $this.dxSelectBox('instance').option('onValueChanged', function (e) {
                            if (e.value == 'PAJAKAN') {
                                $('#modal-land-lease').modal('show');
                            } else {
                                $('#spanLease').hide();
                                $('input[name="ownership_duration"]').val('');
                                $('input[name="ownership_end_at"]').val('');
                            }
                        });
                    }

                    if ($this.attr('data-name') === 'bahagian_pagar') {
                        $this.dxSelectBox('instance').option('onValueChanged', function (e) {
                            $.getJSON(baseURL + '/data?b=55a0c60438017&c=' + e.value).done(function (data) {
                                $('div[data-name="jenis_binaan"]').dxSelectBox('instance').option('dataSource', new DevExpress.data.DataSource({
                                    store: data
                                }));
                            });
                        });
                    }

                    if ($this.attr('data-name') === 'level') {
                        hideLoadPanel();
                    }
                }

                if (window.location.href.indexOf('/edit/property/single/3') > 0 || window.location.href.indexOf('/rate/building') > 0 || window.location.href.indexOf('/rate/tax') > 0) {
                    if ($this.attr('data-name') === 'category_key') {
                        $this.dxSelectBox('instance').option('onValueChanged', function (e) {
                            $.getJSON(baseURL + '/data?b=55a0c60438017&c=' + e.value).done(function (data) {
                                $('div[data-name="type"]').dxSelectBox('instance').option('dataSource', new DevExpress.data.DataSource({
                                    store: data
                                }));
                            });
                        });
                    }
                }

                if (window.location.href.indexOf('/edit/property/single/4') > 0) {
                    if ($this.attr('data-name') === 'type') {
                        $this.dxSelectBox('instance').option('onValueChanged', function (e) {
                            if (e.value == 'PERSENDIRIAN') {
                                $('#persendirian').removeClass('d-none');
                                $('#lain-lain').addClass('d-none');
                                $('#syarikat').addClass('d-none');
                                $('div[data-name="officer_company"]').dxTextBox('instance').option('value', '');
                                $('div[data-name="officer_gov"]').dxTextBox('instance').option('value', '');
                            } else if (e.value == 'SYARIKAT') {
                                $('#persendirian').addClass('d-none');
                                $('#lain-lain').addClass('d-none');
                                $('#syarikat').removeClass('d-none');
                                $('div[data-name="officer_gov"]').dxTextBox('instance').option('value', '');
                            } else if (e.value == 'KERAJAAN PERSEKUTUAN' || e.value == 'KERAJAAN NEGERI' || e.value == 'BADAN BERKANUN' || e.value == 'PERTUBUHAN BUKAN KERAJAAN (NGO)') {
                                $('#persendirian').addClass('d-none');
                                $('#lain-lain').removeClass('d-none');
                                $('#syarikat').addClass('d-none');
                                $('div[data-name="officer_company"]').dxTextBox('instance').option('value', '');
                            }
                        });
                    }
                }
            });
        }

        if ($this.attr('data-dx') === 'numberbox') {
            $this.dxNumberBox({
                format: "#0",
                name: $this.attr('data-name'),
                value: $this.attr('data-value'),
                placeholder: $(this).is('[data-placeholder]') ? $this.attr('data-placeholder') : '',
            });
        }

        if ($this.attr('data-dx') === 'datebox') {
            $this.dxDateBox({
                name: $this.attr('data-name'),
                width: '100%',
                firstDayOfWeek: 0,
                value: $this.attr('data-value'),
                displayFormat: $this.attr('data-display-format'),
                maxZoomLevel: $this.attr('data-max-level'),
                minZoomLevel: $this.attr('data-min-level'),
            });
        }

        if ($this.attr('data-dx') === 'radiogroup') {
            $.getJSON(baseURL + '/data?b=55a0c60438017&c=' + $this.attr('data-source'), function (data) {
                dataSource = new DevExpress.data.DataSource({
                    store: data
                });
                $this.dxRadioGroup({
                    dataSource: dataSource,
                    displayExpr: 'item',
                    valueExpr: $this.attr('data-value-exp'),
                    name: $this.attr('data-name'),
                    layout: $this.attr('data-layout'),
                    value: $this.attr('data-value')
                });
            });
        }

        if ($this.attr('data-dx') === 'fileuploader') {
            $this.dxFileUploader({
                multiple: $this.attr('data-multiple'),
                uploadMode: $this.attr('data-mode'),
                accept: $this.attr('data-accept'),
                readyToUploadMessage: "Ready to upload",
                selectButtonText: "Pilih Fail",
                width: '100%',
                name: $this.attr('data-name')
            });

            if (window.location.href.indexOf('/edit/property/single/3') > 0 || window.location.href.indexOf('/edit/property/single/6') > 0) {
                $this.next().children(":first").click(function () {
                    $this.dxFileUploader('instance').reset();
                });
            }

            if (window.location.href.indexOf('/edit/property/single/6') > 0) {
                $this.next().children(":nth-child(2)").click(function () {
                    var formAttachment = $(this).closest('form');
                    if ($('.dx-fileuploader-file-container').length > 0) {
                        formAttachment.submit();
                    } else {
                        toast('error', 'Please select file');
                    }
                });
            }
        }

        if ($this.attr('data-dx') === 'btn-back') {
            $this.dxButton({
                icon: 'back',
                type: 'danger',
                height: '31px',
                onClick: function (params) {
                    history.go(-1);
                }
            });
        }

        //dxbutton
        if ($this.attr('data-dx') === 'btn-submit') {
            var dataAfter = $this.attr('data-after');
            $this.dxButton({
                text: $this.attr('data-text'),
                disabled: $this.attr('data-disabled') === 'true',
                validationGroup: $this.attr('data-validation-group'),
                type: $this.attr('data-type'), //back,danger,default,normal,success'
                height: '33px',
                onClick: function (params) {
                    if (dataAfter != null) {
                        $('input[name="data_after"]').val(dataAfter);
                    }
                    if (params.validationGroup !== undefined) {
                        var result = params.validationGroup.validate();
                        if (result.isValid) {
                            if (triggerCroppie) {
                                $uploadCrop.croppie('result', {
                                    type: 'canvas',
                                    size: 'viewport'
                                }).then(function (resp) {
                                    if (resp !== 'data;,') {
                                        $('input[name="profile_image"]').val(resp);
                                        $('#' + $this.attr('data-form')).submit();
                                    }
                                    return false;
                                });
                            } else {
                                $('#' + $this.attr('data-form')).submit();
                            }
                        }
                    } else {
                        if (triggerCroppie) {
                            $uploadCrop.croppie('result', {
                                type: 'canvas',
                                size: 'viewport'
                            }).then(function (resp) {
                                if (resp !== 'data;,') {
                                    $('input[name="profile_image"]').val(resp);
                                    $('#' + $this.attr('data-form')).submit();
                                }
                                return false;
                            });
                        } else {
                            $('#' + $this.attr('data-form')).submit();
                        }
                    }
                }
            });
        }

        if ($this.attr('data-dx') === 'btn-without-submit') {
            $this.dxButton({
                text: $this.attr('data-text'),
                disabled: $this.attr('data-disabled') === 'true',
                validationGroup: $this.attr('data-validation-group'),
                type: $this.attr('data-type'),
                height: '33px',
                onClick: function (params) {
                    if (params.validationGroup !== undefined) {
                        var result = params.validationGroup.validate();
                        if (result.isValid) {
                            if ($this.attr('data-name') == 'property_add_agency') {
                                propertyAddAgency();
                            } else if ($this.attr('data-name') == 'land_add_lease') {
                                landAddLease();
                            } else if ($this.attr('data-name') == 'land_add_gate') {
                                landAddGate();
                            } else if ($this.attr('data-name') == 'land_add_owner') {
                                landAddOwner();
                            } else if ($this.attr('data-name') == 'owner_checking') {
                                ownerChecking();
                            } else if ($this.attr('data-name') == 'building_save_wide') {
                                buildingAddWide();
                            } else if ($this.attr('data-name') == 'add_building_rate') {
                                saveBuildingRate();
                            } else if ($this.attr('data-name') == 'add_tax_rate') {
                                saveTaxRate();
                            }
                        }
                    } else {
                        if ($this.attr('data-name') == 'property_add_agency') {
                            propertyAddAgency();
                        } else if ($this.attr('data-name') == 'land_add_lease') {
                            landAddLease();
                        } else if ($this.attr('data-name') == 'land_add_gate') {
                            landAddGate();
                        } else if ($this.attr('data-name') == 'land_add_owner') {
                            landAddOwner();
                        } else if ($this.attr('data-name') == 'owner_checking') {
                            ownerChecking();
                        } else if ($this.attr('data-name') == 'add_building_rate') {
                            saveBuildingRate();
                        } else if ($this.attr('data-name') == 'add_tax_rate') {
                            saveTaxRate();
                        }
                    }

                    if (window.location.href.indexOf('/rate/building') > 0 || window.location.href.indexOf('/rate/tax') > 0) {
                        $('div[data-name="area_text"]').css('min-height', '31px');
                    }
                }
            });
        }

        $('.dx-datebox .dx-texteditor-input').attr('readonly', true);
    });

    setTimeout(function () {
        $('[data-dx]').each(function () {
            var $this = $(this);
            if ($this.attr('data-validate') === 'true') {
                var validationRules = [];
                if ($this.attr('data-validation-type').indexOf(',') !== -1) {
                    $.each($this.attr('data-validation-type').split(','), function (k, v) {
                        if (v === 'telephone') {
                            validationRules.push({
                                type: 'custom',
                                validationCallback: function (params) {
                                    if (params.value != null && params.value.toString() !== '' && params.value.toString().substring(0, 2) !== '60') {
                                        params.rule.isValid = false;
                                        params.rule.message = 'Please enter country code "60"';
                                        params.validator.validate();
                                        return false;
                                    } else {
                                        $this.dxNumberBox('instance').option("isValid", true);
                                        return true;
                                    }
                                }
                            });
                        } else if (v === 'retype_password') {
                            validationRules.push({
                                type: 'compare',
                                comparisonTarget: function () {
                                    var password = $("div[data-name='password']").dxTextBox("instance");
                                    if (password) {
                                        return password.option("value");
                                    }
                                },
                                message: "New password with retype new password not same"
                            });
                        } else {
                            validationRules.push({
                                type: v
                            });
                        }
                    });
                } else {
                    if ($this.attr('data-validation-type') === 'telephone') {
                        validationRules.push({
                            type: 'custom',
                            validationCallback: function (params) {
                                if (params.value != null && params.value.toString() !== '' && params.value.toString().substring(0, 2) !== '60') {
                                    params.rule.isValid = false;
                                    params.rule.message = 'Please enter country code "60"';
                                    params.validator.validate();
                                    return false;
                                } else {
                                    $this.dxNumberBox('instance').option("isValid", true);
                                    return true;
                                }
                            }
                        });
                    } else if ($this.attr('data-validation-type') === 'retype_password') {
                        validationRules.push({
                            type: 'compare',
                            comparisonTarget: function () {
                                var password = $("div[data-name='password']").dxTextBox("instance");
                                if (password) {
                                    return password.option("value");
                                }
                            },
                            message: "New password with retype new password not same"
                        });
                    } else {
                        validationRules.push({
                            type: $this.attr('data-validation-type')
                        });
                    }
                }
                $this.dxValidator({
                    validationRules: validationRules,
                    validationGroup: $this.attr('data-validation-group')
                });
            }
        });
        if ($('div[data-dx="btn-submit"]').length > 0) {
            $('div[data-dx="btn-submit"]').dxButton('instance').option('disabled', false);
        }
    }, 2000);
    //end form

    //grid
    $(".grid-btn-plus").click(function () {
        if ($(this).attr('data-for') == 'users') {
            location.href = baseURL + '/create/user';
        } else if ($(this).attr('data-for') == 'property') {
            location.href = baseURL + '/create/property/single/1';
        } else if ($(this).attr('data-for') == 'owner') {
            initOwnerForm();
        } else if ($(this).attr('data-for') == 'building-rate') {
            $('#modal-building-rate').modal('show');
            $('input[name="building_rate_id"]').val('');
        } else if ($(this).attr('data-for') == 'tax-rate') {
            $('#modal-tax-rate').modal('show');
            $('input[name="tax_rate_id"]').val('');
        }
    });
    $(".grid-btn-refresh").click(function () {
        grid.state({});
        grid.option("searchPanel.visible", false);
        grid.refresh();
    });
    $(".grid-btn-excel").click(function () {
        var sort = [];
        for (var i = 0; i < grid.option("columns").length; i++) {
            if (grid.columnOption(i, "sortOrder") !== undefined) {
                sort.push({
                    "selector": grid.columnOption(i, "dataField"),
                    "desc": grid.columnOption(i, "sortOrder") === 'desc'
                });
            }
        }
        if ($(this).attr('data-for') == 'users') {
            location.href = baseURL + '/export/excel/user?filter=' + JSON.stringify(grid.getCombinedFilter()) + '&sort=' + JSON.stringify(sort);
        } else if ($(this).attr('data-for') == 'property') {
            location.href = baseURL + '/export/excel/property?filter=' + JSON.stringify(grid.getCombinedFilter()) + '&sort=' + JSON.stringify(sort);
        } else if ($(this).attr('data-for') == 'owner') {
            location.href = baseURL + '/export/excel/owner?filter=' + JSON.stringify(grid.getCombinedFilter()) + '&sort=' + JSON.stringify(sort);
        } else if ($(this).attr('data-for') == 'building-rate') {
            location.href = baseURL + '/export/excel/assessment/building-rate?filter=' + JSON.stringify(grid.getCombinedFilter()) + '&sort=' + JSON.stringify(sort);
        } else if ($(this).attr('data-for') == 'tax-rate') {
            location.href = baseURL + '/export/excel/assessment/tax-rate?filter=' + JSON.stringify(grid.getCombinedFilter()) + '&sort=' + JSON.stringify(sort);
        } else if ($(this).attr('data-for') == 'assessment') {
            location.href = baseURL + '/export/excel/assessment/assessment?filter=' + JSON.stringify(grid.getCombinedFilter()) + '&sort=' + JSON.stringify(sort);
        }
    });
    $(".grid-btn-error1").click(function () {
        grid.filter(['Error', 'notcontains', '[]']);
        $('#filter-text').html('<em>Kesemua rekod bermasalah</em>');
    });
    $(".grid-btn-error2").click(function () {
        grid.filter(['Error', 'contains', 'Tiada maklumat kawasan']);
        $('#filter-text').html('<em>Tiada maklumat kawasan</em>');
    });
    $(".grid-btn-error3").click(function () {
        grid.filter(['tax_rate', '=', '0']);
        $('#filter-text').html('<em>Tiada kadar cukai</em>');
    });
    $(".grid-btn-error4").click(function () {
        grid.filter(['Error', 'contains', 'Tiada kadar bagi keluasan']);
        $('#filter-text').html('<em>Tiada kadar nilaian</em>');
    });
    $(".grid-btn-error5").click(function () {
        grid.filter(['Error', 'contains', 'Harta tiada maklumat bangunan']);
        $('#filter-text').html('<em>Harta tiada maklumat bangunan</em>');
    });
    $(".grid-btn-error6").click(function () {
        grid.filter(['Error', 'contains', 'Bangunan tiada maklumat keluasan']);
        $('#filter-text').html('<em>Bangunan tiada maklumat keluasan</em>');
    });

    $("#grid").each(function () {
        var $this = $(this);
        grid = $this.dxDataGrid({
            allowColumnReordering: true,
            showBorders: true,
            showRowLines: false,
            rowAlternationEnabled: true,
            wordWrapEnabled: true,
            allowColumnResizing: true,
            columnResizingMode: "widget",
            // height: 400,
            grouping: {
                autoExpandAll: true
            },
            remoteOperations: {
                filtering: true,
                grouping: true,
                groupPaging: true,
                paging: true,
                sorting: true
            },
            searchPanel: {
                visible: false
            },
            groupPanel: {
                visible: true
            },
            sorting: {
                mode: 'multiple'
            },
            paging: {
                enable: true,
                pageSize: 15
            },
            pager: {
                visible: true
            },
            headerFilter: {
                visible: false
            },
            filterRow: {
                visible: true,
                applyFilter: "auto"
            },
            selection: {
                mode: 'single',
                allowSelectAll: false
            },
            columnFixing: {
                enabled: true
            },
            columnAutoWidth: true,
            onContentReady: function (e) {
                e.element.find(".dx-datagrid-text-content").removeClass("dx-text-content-alignment-left");
            }
        }).dxDataGrid('instance');

        if ($this.attr('data-for') == 'users') {
            grid.option('dataSource', {
                store: DevExpress.data.AspNet.createStore({
                    key: 'id',
                    loadUrl: baseURL + '/data?b=' + '55a0c60437bd8'
                })
            })
            grid.option('columns', [{
                    caption: '',
                    alignment: 'center',
                    dataField: 'id',
                    width: '50px',
                    fixed: true,
                    showInColumnChooser: false,
                    allowSearch: false,
                    allowSorting: false,
                    allowGrouping: false,
                    allowHiding: false,
                    allowFiltering: false,
                    allowHeaderFiltering: false,
                    cellTemplate: function (container, options) {
                        $("<div/>").dxMenu({
                            dataSource: [{
                                text: "",
                                icon: "preferences",
                                items: [{
                                        id: "edit",
                                        text: "Kemaskini"
                                    }, {
                                        id: "resendActivation",
                                        text: "Ulang Pengaktifan"
                                    }, {
                                        id: "resetPassword",
                                        text: "Reset Katalaluan"
                                    },
                                    {
                                        id: "delete",
                                        text: "Hapus",
                                        template: function (itemData, itemIndex, itemElement) {
                                            itemElement.append('<span class="dx-menu-item-text" style="color: red;">' + itemData.text + '</span>');
                                        }
                                    }
                                ]
                            }],
                            cssClass: "grid-cog-menu",
                            onItemClick: function (data) {
                                if (data.itemData.id == 'edit') {
                                    location.href = baseURL + '/edit/user/' + options.data.id;
                                } else if (data.itemData.id == 'resendActivation') {
                                    location.href = baseURL + '/resend/activation/' + options.data.id;
                                } else if (data.itemData.id == 'resetPassword') {
                                    location.href = baseURL + '/reset/password/' + options.data.id;
                                } else if (data.itemData.id == 'delete') {
                                    var msg = "This user will deleted from the system if :<br />" +
                                        "<ul><li>Not related to tax payer info</li></ul>" +
                                        "If this user is related with above data, this user will be deactivated";
                                    deleteGridRecord(baseURL + '/delete/user/' + options.data.id, grid, msg);
                                }
                            }
                        }).appendTo(container);
                    }
                },
                {
                    caption: 'Fullname',
                    dataField: "fullname",
                    cellTemplate: function (container, options) {
                        $('<a/>').addClass('dx-link')
                            .text(options.text)
                            .on('dxclick', function () {
                                location.href = baseURL + '/show/user/' + options.key;
                            })
                            .appendTo(container);
                    }
                },
                {
                    caption: 'Email',
                    dataField: "username"
                },
                {
                    caption: 'Role',
                    dataField: "role"
                }
            ]);
        } else if ($this.attr('data-for') == 'property') {
            grid.option('dataSource', {
                store: DevExpress.data.AspNet.createStore({
                    key: 'reference_no',
                    loadUrl: baseURL + '/data?b=' + '55a0c60437d14'
                })
            })
            grid.option('columns', [{
                    caption: '',
                    alignment: 'center',
                    dataField: 'reference_no',
                    width: '50px',
                    fixed: true,
                    showInColumnChooser: false,
                    allowSearch: false,
                    allowSorting: false,
                    allowGrouping: false,
                    allowHiding: false,
                    allowFiltering: false,
                    allowHeaderFiltering: false,
                    cellTemplate: function (container, options) {
                        $("<div/>").dxMenu({
                            dataSource: [{
                                text: "",
                                icon: "preferences",
                                items: [
                                    // {
                                    //     id: "edit",
                                    //     text: "Edit"
                                    // },
                                    {
                                        id: "assessment",
                                        text: "Nilaikan Harta"
                                    },
                                    {
                                        id: "delete",
                                        text: "Delete",
                                        template: function (itemData, itemIndex, itemElement) {
                                            itemElement.append('<span class="dx-menu-item-text" style="color: red;">' + itemData.text + '</span>');
                                        }
                                    }
                                ]
                            }],
                            cssClass: "grid-cog-menu",
                            onItemClick: function (data) {
                                if (data.itemData.id == 'edit') {
                                    location.href = baseURL + '/edit/property/single/1/' + options.data.reference_no;
                                } else if (data.itemData.id == 'assessment') {
                                    location.href = baseURL + '/assessment/calculate/one/' + options.data.reference_no;
                                } else if (data.itemData.id == 'delete') {
                                    var msg = "Harta ini dan semua maklumat berkaitan dengan harta ini akan dihapuskan<br />";
                                    deleteGridRecord(baseURL + '/delete/property/single/1/' + options.data.reference_no, grid, msg);
                                }
                            }
                        }).appendTo(container);
                    }
                },
                {
                    caption: 'No Rujukan',
                    dataField: "reference_no",
                    dataType: 'string',
                    cellTemplate: function (container, options) {
                        $('<a/>').addClass('dx-link')
                            .text(options.text)
                            .on('dxclick', function () {
                                location.href = baseURL + '/edit/property/single/1/' + options.key;
                            })
                            .appendTo(container);
                    },
                    allowHeaderFiltering: false
                },
                {
                    caption: 'No Akaun',
                    dataType: 'string',
                    dataField: "account_no",
                    allowHeaderFiltering: false
                },
                {
                    caption: 'No Fail',
                    dataType: 'string',
                    dataField: "file_no",
                    allowHeaderFiltering: false
                },
                {
                    caption: 'Berada Di Kawasan',
                    dataType: 'string',
                    dataField: "area_text"
                },
                {
                    caption: 'Alamat',
                    dataType: 'string',
                    dataField: "address",
                    allowHeaderFiltering: false
                },
                {
                    caption: 'Kategori Harta',
                    dataType: 'string',
                    dataField: "category"
                },
                {
                    caption: 'Status Rekod',
                    dataType: 'string',
                    dataField: "current_status"
                },
                {
                    caption: 'Updated',
                    dataField: "updated_at",
                    allowHeaderFiltering: false,
                    visible: false,
                    showInColumnChooser: false,
                }
            ]);
        } else if ($this.attr('data-for') == 'owner') {
            grid.option('dataSource', {
                store: DevExpress.data.AspNet.createStore({
                    key: 'reference_no',
                    loadUrl: baseURL + '/data?b=' + '55a0c604380b1'
                })
            })
            grid.option('columns', [{
                    caption: '',
                    alignment: 'center',
                    dataField: 'reference_no',
                    width: '50px',
                    fixed: true,
                    showInColumnChooser: false,
                    allowSearch: false,
                    allowSorting: false,
                    allowGrouping: false,
                    allowHiding: false,
                    allowFiltering: false,
                    allowHeaderFiltering: false,
                    cellTemplate: function (container, options) {
                        $("<div/>").dxMenu({
                            dataSource: [{
                                text: "",
                                icon: "preferences",
                                items: [{
                                        id: "edit",
                                        text: "Edit"
                                    },
                                    // {
                                    //     id: "addProperty",
                                    //     text: "Tambah Harta"
                                    // },
                                    {
                                        id: "delete",
                                        text: "Delete",
                                        template: function (itemData, itemIndex, itemElement) {
                                            itemElement.append('<span class="dx-menu-item-text" style="color: red;">' + itemData.text + '</span>');
                                        }
                                    }
                                ]
                            }],
                            cssClass: "grid-cog-menu",
                            onItemClick: function (data) {
                                if (data.itemData.id == 'edit') {
                                    editOwnerForm(options.data.id);
                                } else if (data.itemData.id == 'delete') {
                                    deleteGridRecord(baseURL + '/delete/user/' + options.data.reference_no, grid)
                                }
                            }
                        }).appendTo(container);
                    }
                },
                {
                    caption: 'Nama Pemilik',
                    dataField: "owner_name",
                    dataType: 'string',
                    cellTemplate: function (container, options) {
                        $('<a/>').addClass('dx-link')
                            .text(options.text)
                            .on('dxclick', function () {
                                location.href = baseURL + '/show/owner/' + options.data.id;
                            })
                            .appendTo(container);
                    },
                    allowHeaderFiltering: false
                },
                {
                    caption: 'Jenis Pemilik',
                    dataType: 'string',
                    dataField: "type"
                },
                {
                    caption: 'No Kad Pengenalan',
                    dataType: 'string',
                    dataField: "identification_no"
                },
                {
                    caption: 'No Syarikat',
                    dataType: 'string',
                    dataField: "company_no"
                },
                {
                    caption: 'Alamat',
                    dataType: 'string',
                    dataField: "address",
                    allowHeaderFiltering: false
                },
                {
                    caption: 'E-mel',
                    dataType: 'string',
                    dataField: "email"
                },
                {
                    caption: 'No Telefon',
                    dataType: 'string',
                    dataField: "phone_no"
                },
                {
                    caption: 'Updated',
                    dataField: "updated_at",
                    allowHeaderFiltering: false,
                    visible: false,
                    showInColumnChooser: false,
                }
            ]);
        } else if ($this.attr('data-for') == 'assessment') {
            grid.option('dataSource', {
                store: DevExpress.data.AspNet.createStore({
                    key: 'reference_no',
                    loadUrl: baseURL + '/data?b=' + '55a0c60437f7d'
                })
            })
            grid.option('columns', [{
                    caption: '',
                    alignment: 'center',
                    dataField: 'reference_no',
                    width: '50px',
                    fixed: true,
                    showInColumnChooser: false,
                    allowSearch: false,
                    allowSorting: false,
                    allowGrouping: false,
                    allowHiding: false,
                    allowFiltering: false,
                    allowHeaderFiltering: false,
                    cellTemplate: function (container, options) {
                        $("<div/>").dxMenu({
                            dataSource: [{
                                text: "",
                                icon: "preferences",
                                items: [{
                                        id: "print",
                                        text: "Cetak"
                                    },
                                    {
                                        id: "manual",
                                        text: "Penilaian Manual"
                                    }
                                ]
                            }],
                            cssClass: "grid-cog-menu",
                            onItemClick: function (data) {
                                if (data.itemData.id == 'print') {
                                    location.href = baseURL + '/edit/property/single/1/' + options.data.reference_no;
                                } else if (data.itemData.id == 'manual') {
                                    location.href = baseURL + '/assessment/calculate/one/' + options.data.reference_no;
                                }
                            }
                        }).appendTo(container);
                    }
                },
                {
                    caption: 'No Rujukan',
                    dataField: "id",
                    dataType: "string",
                    cellTemplate: function (container, options) {
                        $('<a/>').addClass('dx-link')
                            .text(options.text)
                            .on('dxclick', function () {
                                window.open(baseURL + '/edit/property/single/1/' + options.key);
                            })
                            .appendTo(container);
                    },
                    allowHeaderFiltering: false
                },
                {
                    caption: 'No Akaun Lama',
                    dataField: "account_no",
                    allowHeaderFiltering: false
                },
                {
                    caption: 'Zon',
                    dataField: "area"
                },
                {
                    caption: 'Sub Zon',
                    dataField: "sub_area"
                },
                {
                    caption: 'Kegunaan Tanah',
                    dataField: "use_of_land"
                },
                {
                    caption: 'Total MFA',
                    dataField: "total_mfa",
                    dataType: "number",
                    allowHeaderFiltering: false,
                    format: {
                        type: 'fixedPoint',
                        precision: 2
                    }
                },
                {
                    caption: 'Total AFA',
                    dataField: "total_afa",
                    dataType: "number",
                    allowHeaderFiltering: false,
                    format: {
                        type: 'fixedPoint',
                        precision: 2
                    }
                },
                {
                    caption: 'Alamat Harta',
                    dataField: "address",
                    allowHeaderFiltering: false
                },
                {
                    caption: 'Nama Pemilik',
                    dataField: "owner",
                    visible: false
                },
                {
                    caption: 'Alamat Pemilik',
                    dataField: "owner_address",
                    allowHeaderFiltering: false,
                    visible: false
                },
                {
                    caption: 'Rupacara Bangunan',
                    dataField: "building_type"
                },
                {
                    caption: 'Nilai Sebulan (RM)',
                    dataField: "monthly_value",
                    dataType: "number",
                    allowHeaderFiltering: false
                },
                {
                    caption: 'Nilai Setahun (RM)',
                    dataField: "total_value",
                    dataType: "number",
                    allowHeaderFiltering: false
                },
                {
                    caption: 'Diskaun (%)',
                    dataField: "discount",
                    dataType: "number",
                    allowHeaderFiltering: false
                },
                {
                    caption: 'Nilai Bersih Setahun (RM)',
                    dataField: "value_after_discount",
                    dataType: "number",
                    allowHeaderFiltering: false
                },
                {
                    caption: 'Kadar Cukai (%)',
                    dataField: "tax_rate",
                    dataType: "number",
                    allowHeaderFiltering: false
                },
                {
                    caption: 'Cukai (RM)',
                    dataField: "tax",
                    dataType: "number",
                    allowHeaderFiltering: false
                },
                {
                    caption: 'Error',
                    dataField: "error",
                    allowHeaderFiltering: false,
                    visible: false,
                    showInColumnChooser: false
                },
                {
                    caption: 'Updated',
                    dataField: "updated_at",
                    allowHeaderFiltering: false,
                    visible: false,
                    showInColumnChooser: false,
                    sortOrder: 'desc'
                }
            ]);

            grid.option('onRowPrepared', function (info) {
                if (info.rowType != 'header' && info.rowType != 'filter' && info.data.auto == 0) {
                    info.rowElement.removeClass('dx-row-alt').addClass('manual-assessment');
                }
                if (info.rowType != 'header' && info.rowType != 'filter' && info.data.error != '[]') {
                    info.rowElement.removeClass('dx-row-alt').addClass('data-not-complete');
                }
            });

            grid.option('onSelectionChanged', function (info) {
                var data = selectedItems.selectedRowsData[0];
                if (data.error != '[]') {
                    errorAssement = true;
                } else {
                    errorAssement = false;
                }
            });
        } else if ($this.attr('data-for') == 'building-rate') {
            grid.option('dataSource', {
                store: DevExpress.data.AspNet.createStore({
                    key: 'id',
                    loadUrl: baseURL + '/data?b=' + '55a0c60437e48'
                })
            })
            grid.option('columns', [{
                    caption: '',
                    alignment: 'center',
                    dataField: 'id',
                    width: '50px',
                    fixed: true,
                    showInColumnChooser: false,
                    allowSearch: false,
                    allowSorting: false,
                    allowGrouping: false,
                    allowHiding: false,
                    allowFiltering: false,
                    allowHeaderFiltering: false,
                    cellTemplate: function (container, options) {
                        $("<div/>").dxMenu({
                            dataSource: [{
                                text: "",
                                icon: "preferences",
                                items: [{
                                        id: "edit",
                                        text: "Kemaskini"
                                    },
                                    {
                                        id: "delete",
                                        text: "Hapus",
                                        template: function (itemData, itemIndex, itemElement) {
                                            itemElement.append('<span class="dx-menu-item-text" style="color: red;">' + itemData.text + '</span>');
                                        }
                                    }
                                ]
                            }],
                            cssClass: "grid-cog-menu",
                            onItemClick: function (data) {
                                if (data.itemData.id == 'edit') {
                                    $.getJSON(baseURL + '/edit/rate/building/' + options.data.id).done(function (buildingRate) {
                                        $('#modal-building-rate').modal('show');
                                        $('div[data-name="area_text"]').dxTextBox('instance').option('value', buildingRate['area_text']);
                                        $('input[name="building_rate_id"]').val(buildingRate['id']);
                                        $('input[name="area_id"]').val(buildingRate['area_id']);
                                        $('div[data-name="category_key"]').dxSelectBox('instance').option('value', buildingRate['category_key']);
                                        $('div[data-name="type"]').dxSelectBox('instance').option('value', buildingRate['type']);
                                        $('div[data-name="total_level"]').dxSelectBox('instance').option('value', buildingRate['total_level']);
                                        $('div[data-name="for_level"]').dxSelectBox('instance').option('value', buildingRate['for_level']);
                                        $('div[data-name="wide_type"]').dxSelectBox('instance').option('value', buildingRate['wide_type']);
                                        $('div[data-name="rate"]').dxNumberBox('instance').option('value', buildingRate['rate']);
                                    });
                                } else if (data.itemData.id == 'delete') {
                                    var msg = "Adakah anda pasti untuk menghapuskan kadar nilaian ini?";
                                    deleteGridRecord(baseURL + '/delete/rate/building/' + options.data.id, grid, msg);
                                }
                            }
                        }).appendTo(container);
                    }
                },
                {
                    caption: 'Kawasan',
                    dataField: "area_text"
                },
                {
                    caption: 'Kategori Bangunan',
                    dataField: "category_name"
                },
                {
                    caption: 'Jenis Bangunan',
                    dataField: "type"
                },
                {
                    caption: 'Bilangan Tingkat',
                    dataField: "total_level"
                },
                {
                    caption: 'Aras / Tingkat',
                    dataField: "for_level"
                },
                {
                    caption: 'Jenis Luas',
                    dataField: "wide_type"
                },
                {
                    caption: 'Kadar (RM)',
                    dataField: "rate",
                    dataType: "number",
                    allowHeaderFiltering: false,
                    format: {
                        type: 'fixedPoint',
                        precision: 2
                    }
                }
            ]);
        } else if ($this.attr('data-for') == 'tax-rate') {
            grid.option('dataSource', {
                store: DevExpress.data.AspNet.createStore({
                    key: 'id',
                    loadUrl: baseURL + '/data?b=' + '55a0c60437e96'
                })
            })
            grid.option('columns', [{
                    caption: '',
                    alignment: 'center',
                    dataField: 'id',
                    width: '50px',
                    fixed: true,
                    showInColumnChooser: false,
                    allowSearch: false,
                    allowSorting: false,
                    allowGrouping: false,
                    allowHiding: false,
                    allowFiltering: false,
                    allowHeaderFiltering: false,
                    cellTemplate: function (container, options) {
                        $("<div/>").dxMenu({
                            dataSource: [{
                                text: "",
                                icon: "preferences",
                                items: [{
                                        id: "edit",
                                        text: "Kemaskini"
                                    },
                                    {
                                        id: "delete",
                                        text: "Hapus",
                                        template: function (itemData, itemIndex, itemElement) {
                                            itemElement.append('<span class="dx-menu-item-text" style="color: red;">' + itemData.text + '</span>');
                                        }
                                    }
                                ]
                            }],
                            cssClass: "grid-cog-menu",
                            onItemClick: function (data) {
                                if (data.itemData.id == 'edit') {
                                    $.getJSON(baseURL + '/edit/rate/tax/' + options.data.id).done(function (taxRate) {
                                        $('#modal-tax-rate').modal('show');
                                        $('div[data-name="area_text"]').dxTextBox('instance').option('value', taxRate['area_text']);
                                        $('input[name="tax_rate_id"]').val(taxRate['id']);
                                        $('input[name="area_id"]').val(taxRate['area_id']);
                                        $('div[data-name="category_key"]').dxSelectBox('instance').option('value', taxRate['category_key']);
                                        $('div[data-name="type"]').dxSelectBox('instance').option('value', taxRate['type']);
                                        $('div[data-name="rate"]').dxNumberBox('instance').option('value', taxRate['rate']);
                                    });
                                } else if (data.itemData.id == 'delete') {
                                    var msg = "Adakah anda pasti untuk menghapuskan kadar cukai ini?";
                                    deleteGridRecord(baseURL + '/delete/rate/tax/' + options.data.id, grid, msg);
                                }
                            }
                        }).appendTo(container);
                    }
                },
                {
                    caption: 'Kawasan',
                    dataField: "area_text"
                },
                {
                    caption: 'Kategori Bangunan',
                    dataField: "category_name"
                },
                {
                    caption: 'Jenis Bangunan',
                    dataField: "type"
                },
                {
                    caption: 'Kadar (RM)',
                    dataField: "rate",
                    dataType: "number",
                    allowHeaderFiltering: false,
                    format: {
                        type: 'fixedPoint',
                        precision: 2
                    }
                }
            ]);
        }
    });
    //end grid

    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    var loadPanel = $("#loadPanel").dxLoadPanel({
        shadingColor: "rgba(0,0,0,0.4)",
        position: {
            of: ".main"
        },
        visible: false,
        showIndicator: true,
        showPane: true,
        shading: true,
        closeOnOutsideClick: false
    }).dxLoadPanel("instance");

    function toast(type, msg) {
        $("#toastContainer").dxToast({
            message: msg,
            type: type,
            width: 320,
            position: {
                my: "right",
                at: "top right",
                offset: '-5 30',
                of: ".main"
            },
            displayTime: 10000
        });
        $("#toastContainer").dxToast('show');
    }

    $('[data-toggle="tooltip"]').tooltip();

    //tree area
    $("#config-area").dxTreeView({
        dataSource: new DevExpress.data.DataSource({
            store: new DevExpress.data.ODataStore({
                url: baseURL + '/data?b=55a0c60437b36'
            })
        }),
        dataStructure: "plain",
        keyExpr: "id",
        displayExpr: "item",
        parentIdExpr: "parent_id",
        selectByClick: true,
        selectionMode: "single",
        onItemClick: function (e) {
            currentNode = e.node;
            $('#modal-config-zone').find('input[name="id"]').val(e.node.itemData.id);
        }
    });

    $("#config-area-search").dxTextBox({
        placeholder: "Search",
        width: 300,
        mode: "search",
        valueChangeEvent: "keyup",
        onValueChanged: function (e) {
            $("#config-area").dxTreeView('instance').option("searchValue", e.value);
        }
    });

    $("#area-treeview").dxTreeView({
        dataSource: new DevExpress.data.DataSource({
            store: new DevExpress.data.ODataStore({
                url: baseURL + '/data?b=55a0c60437b36'
            })
        }),
        dataStructure: "plain",
        keyExpr: "id",
        displayExpr: "item",
        parentIdExpr: "parent_id",
        selectByClick: true,
        selectionMode: "single",
        onItemClick: function (e) {
            var item = e.itemData;
            if (e.node.parent.itemData.item == 'KAWASAN-KAWASAN') {
                displayText = e.node.itemData.item;
            } else {
                displayText = e.node.parent.itemData.item + ' > ' + e.node.itemData.item;
            }
            area_id = e.node.itemData.id;
        }
    });

    $("#search-treeview").dxTextBox({
        placeholder: "Search",
        width: 300,
        mode: "search",
        valueChangeEvent: "keyup",
        onValueChanged: function (e) {
            $("#area-treeview").dxTreeView("instance").option("searchValue", e.value);
        }
    });
    //end area

    //config
    $('#add-config-zone').click(function (e) {
        $('#form-config-zone').attr('action', baseURL + '/store/config/2');
        $('#modal-config-zone').modal('show');
    });
    $('#edit-config-zone').click(function (e) {
        if (currentNode != undefined && currentNode.itemData.item != 'KAWASAN-KAWASAN') {
            $('#form-config-zone').attr('action', baseURL + '/update/config/2');
            $('#form-config-zone').find('.modal-title').html('Kemaskini Kawasan');
            $('#form-config-zone').find('div[data-name="zone"]').dxTextBox('instance').option('value', currentNode.itemData.item);
            $('#form-config-zone').find('input[name="id"]').val(currentNode.itemData.id);
            $('#modal-config-zone').modal('show');
        }
    });
    $('#delete-config-zone').click(function (e) {
        if (currentNode.itemData.item != 'KAWASAN-KAWASAN') {
            var title = 'Hapuskan Kawasan';
            var msg = 'Dengan menghapuskan kawasan <b>' + currentNode.itemData.item + ' dan semua sub-sub kawasan</b> ini <br />' +
                'akan menyebabkan kawasan dan sub-sub kawasan ini juga akan di buang daripada :<br />' +
                '- Rekod pegangan/harta<br />' +
                '- Rekod kadar nilaian dan kadar cukai<br />' +
                'Walaubagaimanapun, tindakan ini tidak melibatkan rekod senarai nilaian<br /><br />' +
                'Adakah anda pasti?';
            deleteRecord(baseURL + '/delete/config/2', currentNode.itemData.id, title, msg);
        }
    });

    $('#add-config-procategory').click(function (e) {
        $('#form-config-procategory').attr('action', baseURL + '/store/config/3');
        $('#modal-config-procategory').modal('show');
    });
    $('.edit-config-procategory').click(function (e) {
        $('#form-config-procategory').attr('action', baseURL + '/update/config/3');
        $('#form-config-procategory').find('.modal-title').html('Kemaskini Kategori Harta');
        $('#form-config-procategory').find('div[data-name="procategory_item"]').dxTextBox('instance').option('value', $(this).parent().prev().html());
        $('#form-config-procategory').find('input[name="id"]').val($(this).attr('data-id'));
        $('#modal-config-procategory').modal('show');
    });
    $('.delete-config-procategory').click(function (e) {
        var title = 'Hapuskan Kategori Harta';
        var msg = 'Adakah anda pasti untuk menghapuskan kategori harta ini?';
        deleteRecord(baseURL + '/delete/config/3', $(this).attr('data-id'), title, msg);
    });

    $('#add-config-building').click(function (e) {
        $('#form-config-building').attr('action', baseURL + '/store/config/4');
        $('#modal-config-building').modal('show');
    });
    $('.edit-config-building').click(function (e) {
        $('#form-config-building').attr('action', baseURL + '/update/config/4');
        $('#form-config-building').find('.modal-title').html('Kemaskini Jenis Bangunan');
        $('#form-config-building').find('div[data-name="building_type"]').dxTextBox('instance').option('value', $(this).parent().prev().html());
        $('#form-config-building').find('input[name="id"]').val($(this).attr('data-id'));
        $('#modal-config-building').modal('show');
    });
    $('.delete-config-building').click(function (e) {
        var title = 'Hapuskan Jenis Bangunan';
        var msg = 'Adakah anda pasti untuk menghapuskan jenis bangunan ini?';
        deleteRecord(baseURL + '/delete/config/4', $(this).attr('data-id'), title, msg);
    });

    $('#add-config-gate').click(function (e) {
        $('#form-config-gate').attr('action', baseURL + '/store/config/5');
        $('#modal-config-gate').modal('show');
    });
    $('.edit-config-gate').click(function (e) {
        $('#form-config-gate').attr('action', baseURL + '/update/config/5');
        $('#form-config-gate').find('.modal-title').html('Kemaskini Jenis Struktur Pagar');
        $('#form-config-gate').find('div[data-name="gate_type"]').dxTextBox('instance').option('value', $(this).parent().prev().html());
        $('#form-config-gate').find('input[name="id"]').val($(this).attr('data-id'));
        $('#modal-config-gate').modal('show');
    });
    $('.delete-config-gate').click(function (e) {
        var title = 'Hapuskan Jenis Struktur Pagar';
        var msg = 'Adakah anda pasti untuk menghapuskan jenis struktur pagar ini?';
        deleteRecord(baseURL + '/delete/config/5', $(this).attr('data-id'), title, msg);
    });

    $('#add-config-other').click(function (e) {
        $('#form-config-other').attr('action', baseURL + '/store/config/6');
        $('#modal-config-other').modal('show');
    });
    $('.edit-config-other').click(function (e) {
        $('#form-config-other').attr('action', baseURL + '/update/config/6');
        $('#form-config-other').find('.modal-title').html('Kemaskini Item');
        $('#form-config-other').find('div[data-name="other_type"]').dxTextBox('instance').option('value', $(this).parent().prev().html());
        $('#form-config-other').find('input[name="id"]').val($(this).attr('data-id'));
        $('#modal-config-other').modal('show');
    });
    $('.delete-config-other').click(function (e) {
        var title = 'Hapuskan Item';
        var msg = 'Adakah anda pasti untuk menghapuskan item ini?';
        deleteRecord(baseURL + '/delete/config/6', $(this).attr('data-id'), title, msg);
    });

    $('.config-procategory').click(function () {
        $('.config-procategory').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('#form-config-procategory').find('input[name="property_category"]').val($(this).attr('data-key'));
        $.getJSON(baseURL + '/data?b=55a0c60438017&c=' + $(this).attr('data-key'), function (data) {
            $('#table-config-procategory > tbody').empty();
            $.each(data, function (i, item) {
                $('#table-config-procategory > tbody').append('<tr><td>' + item.item + '</td><td style="width: 60px; text-align: center">' +
                    '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-title="Edit" class="edit-config-procategory" data-id="' + item.id + '"> <i class="fa fa-pencil"></i></a>' +
                    '<a href="javascript:void(0)" class="pl-1 delete-config-procategory" data-toggle="tooltip" data-placement="top" data-title="Hapus" data-id="' + item.id + '"> <i class="fa fa-trash text-danger"></i></a>' +
                    '</td></tr>');
            });
            $('[data-toggle="tooltip"]').tooltip();
            $('.edit-config-procategory').click(function (e) {
                $('#form-config-procategory').attr('action', baseURL + '/update/config/3');
                $('#form-config-procategory').find('.modal-title').html('Kemaskini Kategori Harta');
                $('#form-config-procategory').find('div[data-name="procategory_item"]').dxTextBox('instance').option('value', $(this).parent().prev().html());
                $('#form-config-procategory').find('input[name="id"]').val($(this).attr('data-id'));
                $('#modal-config-procategory').modal('show');
            });
            $('.delete-config-procategory').click(function (e) {
                var title = 'Hapuskan Kategori Harta';
                var msg = 'Adakah anda pasti untuk menghapuskan kategori harta ini?';
                deleteRecord(baseURL + '/delete/config/3', $(this).attr('data-id'), title, msg);
            });
        });
    });

    $('.config-building').click(function () {
        $('.config-building').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('#form-config-building').find('input[name="building_category"]').val($(this).attr('data-key'));
        $.getJSON(baseURL + '/data?b=55a0c60438017&c=' + $(this).attr('data-key'), function (data) {
            $('#table-config-building > tbody').empty();
            $.each(data, function (i, item) {
                $('#table-config-building > tbody').append('<tr><td>' + item.item + '</td><td style="width: 60px; text-align: center">' +
                    '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-title="Edit" class="edit-config-building" data-id="' + item.id + '"> <i class="fa fa-pencil"></i></a>' +
                    '<a href="javascript:void(0)" class="pl-1 delete-config-building" data-toggle="tooltip" data-placement="top" data-title="Hapus" data-id="' + item.id + '"> <i class="fa fa-trash text-danger"></i></a>' +
                    '</td></tr>');
            });
            $('[data-toggle="tooltip"]').tooltip();
            $('.edit-config-building').click(function (e) {
                $('#form-config-building').attr('action', baseURL + '/update/config/4');
                $('#form-config-building').find('.modal-title').html('Kemaskini Jenis Bangunan');
                $('#form-config-building').find('div[data-name="building_type"]').dxTextBox('instance').option('value', $(this).parent().prev().html());
                $('#form-config-building').find('input[name="id"]').val($(this).attr('data-id'));
                $('#modal-config-building').modal('show');
            });
            $('.delete-config-building').click(function (e) {
                var title = 'Hapuskan Jenis Bangunan';
                var msg = 'Adakah anda pasti untuk menghapuskan jenis bangunan ini?';
                deleteRecord(baseURL + '/delete/config/4', $(this).attr('data-id'), title, msg);
            });
        });
    });

    $('.config-gate').click(function () {
        $('.config-gate').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('#form-config-gate').find('input[name="gate_category"]').val($(this).attr('data-key'));
        $.getJSON(baseURL + '/data?b=55a0c60438017&c=' + $(this).attr('data-key'), function (data) {
            $('#table-config-gate > tbody').empty();
            $.each(data, function (i, item) {
                $('#table-config-gate > tbody').append('<tr><td>' + item.item + '</td><td style="width: 60px; text-align: center">' +
                    '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-title="Edit" class="edit-config-gate" data-id="' + item.id + '"> <i class="fa fa-pencil"></i></a>' +
                    '<a href="javascript:void(0)" class="pl-1 delete-config-gate" data-toggle="tooltip" data-placement="top" data-title="Hapus" data-id="' + item.id + '"> <i class="fa fa-trash text-danger"></i></a>' +
                    '</td></tr>');
            });
            $('[data-toggle="tooltip"]').tooltip();
            $('.edit-config-gate').click(function (e) {
                $('#form-config-gate').attr('action', baseURL + '/update/config/5');
                $('#form-config-gate').find('.modal-title').html('Kemaskini Jenis Bangunan');
                $('#form-config-gate').find('div[data-name="gate_type"]').dxTextBox('instance').option('value', $(this).parent().prev().html());
                $('#form-config-gate').find('input[name="id"]').val($(this).attr('data-id'));
                $('#modal-config-gate').modal('show');
            });
            $('.delete-config-gate').click(function (e) {
                var title = 'Hapuskan Jenis Struktur Pagar';
                var msg = 'Adakah anda pasti untuk menghapuskan jenis struktur pagar ini?';
                deleteRecord(baseURL + '/delete/config/5', $(this).attr('data-id'), title, msg);
            });
        });
    });

    $('.config-other').click(function () {
        $('.config-other').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('#form-config-other').find('input[name="other_category"]').val($(this).attr('data-key'));
        $.getJSON(baseURL + '/data?b=55a0c60438017&c=' + $(this).attr('data-key'), function (data) {
            $('#table-config-other > tbody').empty();
            $.each(data, function (i, item) {
                $('#table-config-other > tbody').append('<tr><td>' + item.item + '</td><td style="width: 60px; text-align: center">' +
                    '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-title="Edit" class="edit-config-other" data-id="' + item.id + '"> <i class="fa fa-pencil"></i></a>' +
                    '<a href="javascript:void(0)" class="pl-1 delete-config-other" data-toggle="tooltip" data-placement="top" data-title="Hapus" data-id="' + item.id + '"> <i class="fa fa-trash text-danger"></i></a>' +
                    '</td></tr>');
            });
            $('[data-toggle="tooltip"]').tooltip();
            $('.edit-config-other').click(function (e) {
                $('#form-config-other').attr('action', baseURL + '/update/config/6');
                $('#form-config-other').find('.modal-title').html('Kemaskini Jenis Bangunan');
                $('#form-config-other').find('div[data-name="other_type"]').dxTextBox('instance').option('value', $(this).parent().prev().html());
                $('#form-config-other').find('input[name="id"]').val($(this).attr('data-id'));
                $('#modal-config-other').modal('show');
            });
            $('.delete-config-other').click(function (e) {
                var title = 'Hapuskan Jenis Struktur Pagar';
                var msg = 'Adakah anda pasti untuk menghapuskan jenis struktur pagar ini?';
                deleteRecord(baseURL + '/delete/config/6', $(this).attr('data-id'), title, msg);
            });
        });
    });
    //end config

    //property
    function propertyAddAgency() {
        $('input[name="cbk_used_by"]').val($('div[data-name="agency"]').dxSelectBox('instance').option('value'));
        $('#span-agency').html('<code>' + $('div[data-name="agency"]').dxSelectBox('instance').option('value').toLowerCase() + '</code>');
        $('#modal-property-agency').modal('hide');
    }
    //end property

    //land
    $('#modal-land-lease').on('show.bs.modal', function (e) {
        $('div[data-name="lease_duration"]').dxNumberBox('instance').reset();
        $('div[data-name="end_lease_date"]').dxDateBox('instance').reset();
    });

    function landAddGate() {
        var bahagianPagarText = $('div[data-name="bahagian_pagar"]').dxSelectBox('instance').option('text').toUpperCase();
        var bahagianPagarValue = $('div[data-name="bahagian_pagar"]').dxSelectBox('instance').option('value');
        var jenisBinaan = $('div[data-name="jenis_binaan"]').dxSelectBox('instance').option('value').toUpperCase();
        var panjang = $('div[data-name="panjang"]').dxNumberBox('instance').option('value');
        var row = '<tr>\
                           <td>' + bahagianPagarText + '<input type="hidden" name="bahagian_pagar[]" value="' + bahagianPagarValue + '" /> </td>\
                           <td>' + jenisBinaan + '<input type="hidden" name="jenis_binaan[]" value="' + jenisBinaan + '" /> </td>\
                           <td>' + panjang + '<input type="hidden" name="panjang[]" value="' + panjang + '" /> </td>\
                           <td class="text-center">\
                               <a href="#" data-toggle="tooltip" data-placement="top" title="" data-action="delete">\
                               <i class="fa fa-trash-o"></i></a>\
                           </td>\
                       </tr>';
        var tblGate = $('#land-gate-table').find('tbody').append(row);
        tblGate.find('a[data-action=delete]').on('click', function (e) {
            e.preventDefault();
            $(this).closest('tr').hide(300, function () {
                $(this).remove();
            });
        });
        $('div[data-name="bahagian_pagar"]').dxSelectBox('instance').option('value', '');
        $('div[data-name="jenis_binaan"]').dxSelectBox('instance').option('value', '');
        $('div[data-name="panjang"]').dxNumberBox('instance').option('value', '');
        $('div[data-name="bahagian_pagar"]').dxValidator('instance').reset();
        $('div[data-name="jenis_binaan"]').dxValidator('instance').reset();
        $('div[data-name="panjang"]').dxValidator('instance').reset();
        $('#modal-land-gate').modal('hide');
    };

    function landAddOwner() {
        var namaPemilik = $('div[data-name="pemilik_tanah"]').dxTextBox('instance').option('value').toUpperCase();
        var row = '<tr>\
                       <td>' + namaPemilik + '<input type="hidden" name="pemilik_tanah[]" value="' + namaPemilik + '" /> </td>\
                       <td class="text-center">\
                           <a href="#" data-toggle="tooltip" data-placement="top" title="" data-action="delete">\
                           <i class="fa fa-trash-o"></i></a>\
                       </td>\
                   </tr>';
        var tblOwner = $('#land-owner-table').find('tbody').append(row);
        tblOwner.find('a[data-action=delete]').on('click', function (e) {
            e.preventDefault();
            $(this).closest('tr').hide(300, function () {
                $(this).remove();
            });
        });
        $('div[data-name="pemilik_tanah"]').dxTextBox('instance').option('value', '');
        $('div[data-name="pemilik_tanah"]').dxValidator('instance').reset();
        $('#modal-land-owner').modal('hide');
    }

    function landAddLease() {
        var tempohPajakan = $('div[data-name="lease_duration"]').dxNumberBox('instance').option('value');
        var tarikhAkhirPajakan = $('div[data-name="end_lease_date"]').dxDateBox('instance').option('value');
        if (tarikhAkhirPajakan != '' && tarikhAkhirPajakan != null) {
            var dt = moment(tarikhAkhirPajakan);
            $('input[name="ownership_end_at"]').val(dt.format('YYYY-MM-DD'));
            $('#spanLease').html(' Dipajak selama <code>' + tempohPajakan + '</code> tahun dan berakhir pada ' +
                '<code>' + dt.format('DD MMM YYYY') + '</code>');
        } else {
            $('#spanLease').html(' Dipajak selama <code>' + tempohPajakan + '</code> tahun');
        }
        $('input[name="ownership_duration"]').val(tempohPajakan);
        $('#spanLease').show();
        $('#modal-land-lease').modal('hide');
    }
    //end land

    //building
    //nak elakkan user tekan sebelum dxvalidator initialize
    setTimeout(function () {
        $('button[data-target="#modal-building-form"]').prop('disabled', false);
    }, 2500);

    $('#modal-building-form').on('show.bs.modal', function (e) {
        if ($(e.relatedTarget).attr('data-mode') == 'add') {
            $('div[data-name="build_no"]').dxTextBox('instance').reset();
            $('div[data-name="build_on"]').dxDateBox('instance').reset();
            $('div[data-name="structure"]').dxSelectBox('instance').reset();
            $('div[data-name="condition"]').dxSelectBox('instance').reset();
            $('div[data-name="category_key"]').dxSelectBox('instance').reset();
            $('div[data-name="type"]').dxSelectBox('instance').reset();
            $('div[data-name="total_level"]').dxSelectBox('instance').reset();
            $('div[data-name="category_key"]').dxValidator('instance').reset();
            $('div[data-name="type"]').dxValidator('instance').reset();
            $('div[data-name="total_level"]').dxValidator('instance').reset();
            $('#building-table-wide tbody').empty();
            $('#building_cancel_wide').trigger('click');
            $('#clear_building_plan').trigger('click');
            $("#building-plan-table tbody").empty();
            $('#form-property').attr('action', window.location.href.replace('edit', 'store'));
        } else if ($(e.relatedTarget).attr('data-mode') == 'edit') {
            buildingId = $(e.relatedTarget).attr('data-id');
            $('input[name="building_id"]').val(buildingId);
            $('#building-table-wide tbody').empty();
            $("#building-plan-table tbody").empty();
            $.getJSON(baseURL + '/data?b=55a0c60437fca&c=' + buildingId).done(function (data) {
                $('div[data-name="build_no"]').dxTextBox('instance').option('value', data['probuilding']['build_no']);
                $('div[data-name="build_on"]').dxDateBox('instance').option('value', data['probuilding']['build_on']);
                $('div[data-name="structure"]').dxSelectBox('instance').option('value', data['probuilding']['structure']);
                $('div[data-name="condition"]').dxSelectBox('instance').option('value', data['probuilding']['condition']);
                $('div[data-name="category_key"]').dxSelectBox('instance').option('value', data['probuilding']['category_key']);
                $('div[data-name="type"]').dxSelectBox('instance').option('value', data['probuilding']['type']);
                $('div[data-name="total_level"]').dxSelectBox('instance').option('value', data['probuilding']['total_level']);

                if (data['probuildingwide'] != null) {
                    $.each(data['probuildingwide'], function (k, v) {
                        var inspection_floor = v['inspection_floor'] == 'undefined' || v['inspection_floor'] == null ? '' : v['inspection_floor'];
                        var wide_type = v['wide_type'] == 'undefined' || v['wide_type'] == null ? '' : v['wide_type'];
                        var ceiling = v['ceiling'] == 'undefined' || v['ceiling'] == null ? '' : v['ceiling'];
                        var flooor = v['floor'] == 'undefined' || v['floor'] == null ? '' : v['floor'];
                        var wall = v['wall'] == 'undefined' || v['wall'] == null ? '' : v['wall'];
                        var roof = v['roof'] == 'undefined' || v['roof'] == null ? '' : v['roof'];
                        var total_wide = v['total_wide'] == 'undefined' || v['total_wide'] == null ? '' : v['total_wide'];
                        var row = '<tr>\
                                    <td>' + inspection_floor + '<input type="hidden" name="inspection_floor[]" value="' + inspection_floor + '" /> </td>\
                                    <td>' + wide_type + '<input type="hidden" name="wide_type[]" value="' + wide_type + '" /> </td>\
                                    <td>' + ceiling + '<input type="hidden" name="ceiling[]" value="' + ceiling + '" /> </td>\
                                    <td>' + flooor + '<input type="hidden" name="floor[]" value="' + flooor + '" /> </td>\
                                    <td>' + wall + '<input type="hidden" name="wall[]" value="' + wall + '" /> </td>\
                                    <td>' + roof + '<input type="hidden" name="roof[]" value="' + roof + '" /> </td>\
                                    <td>' + total_wide + '<input type="hidden" name="total_wide[]" value="' + total_wide + '" /> </td>\
                                    <td class="text-center">\
                                        <a href="javascript:void(0)" data-action="delete" title="Hapus luas">\
                                            <i class="fa fa-trash-o"></i>\
                                        </a>\
                                    </td>\
                                </tr>';
                        var tblWide = $('#building-table-wide tbody').append(row);

                        tblWide.find('a[data-action=delete]').on('click', function (e) {
                            e.preventDefault();
                            $(this).closest('tr').hide(300, function () {
                                $(this).remove();
                            });
                        });
                    });
                }

                if (data['plan'].length > 0) {
                    $.each(data['plan'], function (k, v) {
                        var tblPlan = $("#building-plan-table tbody").append('<tr>\
                                            <td style="color: #ff5344;">\
                                                ' + v['link'] + '\
                                            </td>\
                                            <td style="width: 10px;text-align: center">\
                                                <a href="javascript:void(0)" data-action="delete" data-id="' + v['id'] + '" title="Hapus pelan bangunan">\
                                                    <i class="fa fa-trash-o"></i>\
                                                </a>\
                                            </td>\
                                        </tr>');

                        tblPlan.find('a[data-action=delete]').on('click', function (e) {
                            e.preventDefault();
                            $(this).closest('tr').hide(300, function () {
                                $(this).remove();
                            });
                            if ($.inArray($(this).attr('data-id'), delBuildingPlanId) === -1) {
                                delBuildingPlanId.push($(this).attr('data-id'));
                                $('input[name="del_building_plan_id"]').val(JSON.stringify(delBuildingPlanId));
                            }
                        });
                    });
                    $('.magnific-popup-link').magnificPopup({
                        type: 'image'
                    });
                }
                $('#form-property').attr('action', window.location.href.replace('edit', 'update'));
                $('#modal-building-form').modal('show');
            });
        }
    });

    $('#building_add_wide').click(function () {
        $('div[data-name="aras_inspect"]').dxSelectBox('instance').reset();
        $('div[data-name="jenis_luas"]').dxSelectBox('instance').reset();
        $('div[data-name="siling"]').dxSelectBox('instance').reset();
        $('div[data-name="lantai"]').dxSelectBox('instance').reset();
        $('div[data-name="dinding"]').dxSelectBox('instance').reset();
        $('div[data-name="bumbung"]').dxSelectBox('instance').reset();
        $('div[data-name="luas"]').dxNumberBox('instance').reset();
        $('div[data-name="aras_inspect"]').dxValidator('instance').reset();
        $('div[data-name="jenis_luas"]').dxValidator('instance').reset();
        $('div[data-name="luas"]').dxValidator('instance').reset();
        $('#building-table-wide-form').removeClass('d-none');
        $('div[data-name="building_save_wide"]').removeClass('d-none');
        $('#building_cancel_wide').removeClass('d-none');
        $(this).addClass('d-none');
    });

    $('#building_cancel_wide').click(function () {
        $('#building-table-wide-form').addClass('d-none');
        $('div[data-name="building_save_wide"]').addClass('d-none');
        $('#building_add_wide').removeClass('d-none');
        $(this).addClass('d-none');
    });

    $('.delete-building').click(function (e) {
        var title = 'Hapuskan Bangunan';
        var msg = 'Adakah anda pasti ingin menghapuskan rekod bangunan ini?';
        deleteRecord(window.location.href.replace('edit', 'delete'), $(this).attr('data-id'), title, msg);
    });

    function buildingAddWide() {
        var level = $('div[data-name="aras_inspect"]').dxSelectBox('instance').option('value');
        var wideType = $('div[data-name="jenis_luas"]').dxSelectBox('instance').option('value');
        var ceiling = $('div[data-name="siling"]').dxSelectBox('instance').option('value');
        var floor = $('div[data-name="lantai"]').dxSelectBox('instance').option('value');
        var wall = $('div[data-name="dinding"]').dxSelectBox('instance').option('value');
        var roof = $('div[data-name="bumbung"]').dxSelectBox('instance').option('value');
        var totalWide = $('div[data-name="luas"]').dxNumberBox('instance').option('value');
        var row = '<tr>\
                       <td>' + level + '<input type="hidden" name="inspection_floor[]" value="' + level + '" /> </td>\
                       <td>' + wideType + '<input type="hidden" name="wide_type[]" value="' + wideType + '" /> </td>\
                       <td>' + (ceiling != null ? ceiling : '') + '<input type="hidden" name="ceiling[]" value="' + (ceiling != null ? ceiling : '') + '" /> </td>\
                       <td>' + (floor != null ? floor : '') + '<input type="hidden" name="floor[]" value="' + (floor != null ? floor : '') + '" /> </td>\
                       <td>' + (wall != null ? wall : '') + '<input type="hidden" name="wall[]" value="' + (wall != null ? wall : '') + '" /> </td>\
                       <td>' + (roof != null ? roof : '') + '<input type="hidden" name="roof[]" value="' + (roof != null ? roof : '') + '" /> </td>\
                       <td>' + totalWide + '<input type="hidden" name="total_wide[]" value="' + totalWide + '" /> </td>\
                       <td class="text-center">\
                           <a href="#" data-toggle="tooltip" data-placement="top" title="" data-action="delete">\
                           <i class="fa fa-trash-o"></i></a>\
                       </td>\
                   </tr>';
        var tblWide = $('#building-table-wide tbody').append(row);
        tblWide.find('a[data-action=delete]').on('click', function (e) {
            e.preventDefault();
            $(this).closest('tr').hide(300, function () {
                $(this).remove();
            });
        });
    };
    //end building

    //owner
    //nak elakkan user tekan sebelum dxvalidator initialize
    setTimeout(function () {
        $('button[data-target="#modal-owner-checking"]').prop('disabled', false);
    }, 2500);

    $('#modal-owner-checking').on('show.bs.modal', function (e) {
        $('div[data-name="checking_value"]').dxTextBox('instance').option('value', '');
        $('#checking-owner-table').find('tbody').empty();
    });

    $('#modal-owner-form').on('show.bs.modal', function (e) {
        if ($(e.relatedTarget).attr('data-mode') == 'add') {
            initOwnerForm();
        } else if ($(e.relatedTarget).attr('data-mode') == 'edit') {
            editOwnerForm($(e.relatedTarget).attr('data-id'));
        }
    });

    $('.delete-owner').click(function (e) {
        var title = 'Hapuskan Pemilik';
        var msg = 'Adakah anda pasti ingin menghapuskan rekod pemilik ini?';
        deleteRecord(window.location.href.replace('edit', 'delete'), $(this).attr('data-id'), title, msg);
    });

    function ownerChecking() {
        var checkingValue = $('div[data-name="checking_value"]').dxTextBox('instance').option('value');
        $.getJSON(baseURL + '/data?b=55a0c60438064&c=' + checkingValue).done(function (data) {
            var row;
            $('#checking-owner-table').find('tbody').empty();
            if (data.length > 0) {
                $.each(data, function (k, v) {
                    if (v.type == 'PERSENDIRIAN') {
                        ownerName = v.identification_no != null ? v.owner_name + ' / ' + v.type + ' / ' + v.identification_no : v.owner_name + ' (' + v.type + ')';
                    } else if (v.type == 'SYARIKAT') {
                        ownerName = v.company_no != null ? v.owner_name + ' / ' + v.type + ' / ' + v.company_no : v.owner_name + ' (' + v.type + ')';
                    } else {
                        ownerName = v.owner_name + ' (' + v.type + ')';
                    }
                    row += '<tr>\
                                <td>' + ownerName + '</td>\
                                <td class="text-center">\
                                    <button type="button" class="btn btn-sm btn-info" data-id="' + v.id + '">Pilih</button>\
                                </td>\
                            </tr>';
                });
            } else {
                row += '<tr><td colspan="2">Tiada dalam rekod</td></tr>';
            }
            var tblCheckingOwner = $('#checking-owner-table').find('tbody').append(row);
            tblCheckingOwner.find('.btn-info').on('click', function (e) {
                e.preventDefault();
                $.getJSON(baseURL + '/data?b=55a0c6043880f&c=' + $(this).attr('data-id')).done(function (data) {
                    $('input[name="owner_id"]').val(data['id']);
                    $('input[name="attach_to_property"]').val(true);
                    $('div[data-name="owner_name"]').dxTextBox('instance').option('value', data['owner_name']);
                    $('div[data-name="type"]').dxSelectBox('instance').option('value', data['type']);
                    $('div[data-name="identification_no"]').dxTextBox('instance').option('value', data['identification_no']);
                    $('div[data-name="race"]').dxSelectBox('instance').option('value', data['race']);
                    $('div[data-name="citizen"]').dxSelectBox('instance').option('value', data['citizen']);
                    $('div[data-name="company_no"]').dxTextBox('instance').option('value', data['company_no']);
                    $('div[data-name="officer_company"]').dxTextBox('instance').option('value', data['officer']);
                    $('div[data-name="officer_gov"]').dxTextBox('instance').option('value', data['officer']);
                    $('div[data-name="billing_to"]').dxCheckBox('instance').option('value', null);
                    $('div[data-name="address"]').dxTextBox('instance').option('value', data['address']);
                    $('div[data-name="town"]').dxTextBox('instance').option('value', data['town']);
                    $('div[data-name="postcode"]').dxTextBox('instance').option('value', data['postcode']);
                    $('div[data-name="state"]').dxSelectBox('instance').option('value', data['state']);
                    $('div[data-name="email"]').dxTextBox('instance').option('value', data['email']);
                    $('div[data-name="phone_no"]').dxNumberBox('instance').option('value', data['phone_no']);
                    $('div[data-name="note"]').dxTextArea('instance').option('value', data['note']);
                    $('#form-property').attr('action', window.location.href.replace('edit', 'update'));
                    $('#modal-owner-form').modal('show');
                    $('#modal-owner-checking').modal('hide');
                });
            });
            $('.checking-owner-row').removeClass('d-none');
        });
    }

    function initOwnerForm() {
        $('div[data-name="owner_name"]').dxTextBox('instance').reset();
        $('div[data-name="owner_name"]').dxValidator('instance').reset();
        $('div[data-name="type"]').dxSelectBox('instance').reset();
        $('div[data-name="type"]').dxValidator('instance').reset();
        $('div[data-name="identification_no"]').dxTextBox('instance').reset();
        $('div[data-name="race"]').dxSelectBox('instance').reset();
        $('div[data-name="citizen"]').dxSelectBox('instance').reset();
        $('div[data-name="company_no"]').dxTextBox('instance').reset();
        $('div[data-name="officer_company"]').dxTextBox('instance').reset();
        $('div[data-name="officer_gov"]').dxTextBox('instance').reset();
        $('div[data-name="billing_to"]').dxCheckBox('instance').reset();
        $('div[data-name="address"]').dxTextBox('instance').reset();
        $('div[data-name="town"]').dxTextBox('instance').reset();
        $('div[data-name="postcode"]').dxTextBox('instance').reset();
        $('div[data-name="state"]').dxSelectBox('instance').reset();
        $('div[data-name="email"]').dxTextBox('instance').reset();
        $('div[data-name="phone_no"]').dxNumberBox('instance').reset();
        $('div[data-name="note"]').dxTextArea('instance').reset();
        $('#modal-owner-form').modal('show');
        $('#form-property').attr('action', window.location.href.replace('edit', 'store'));
        $('#modal-owner-checking').modal('hide');
    }

    function editOwnerForm(id) {
        $.getJSON(baseURL + '/data?b=55a0c6043880f&c=' + id).done(function (data) {
            $('input[name="owner_id"]').val(data['id']);
            $('input[name="attach_to_property"]').val(false);
            $('div[data-name="owner_name"]').dxTextBox('instance').option('value', data['owner_name']);
            $('div[data-name="type"]').dxSelectBox('instance').option('value', data['type']);
            $('div[data-name="identification_no"]').dxTextBox('instance').option('value', data['identification_no']);
            $('div[data-name="race"]').dxSelectBox('instance').option('value', data['race']);
            $('div[data-name="citizen"]').dxSelectBox('instance').option('value', data['citizen']);
            $('div[data-name="company_no"]').dxTextBox('instance').option('value', data['company_no']);
            $('div[data-name="officer_company"]').dxTextBox('instance').option('value', data['officer']);
            $('div[data-name="officer_gov"]').dxTextBox('instance').option('value', data['officer']);
            $('div[data-name="billing_to"]').dxCheckBox('instance').option('value', data['billing_to']);
            $('div[data-name="address"]').dxTextBox('instance').option('value', data['address']);
            $('div[data-name="town"]').dxTextBox('instance').option('value', data['town']);
            $('div[data-name="postcode"]').dxTextBox('instance').option('value', data['postcode']);
            $('div[data-name="state"]').dxSelectBox('instance').option('value', data['state']);
            $('div[data-name="email"]').dxTextBox('instance').option('value', data['email']);
            $('div[data-name="phone_no"]').dxNumberBox('instance').option('value', data['phone_no']);
            $('div[data-name="note"]').dxTextArea('instance').option('value', data['note']);

            $('#form-property').attr('action', window.location.href.replace('edit', 'update'));
            $('#modal-owner-form').modal('show');
        });
    }
    //end owner

    //maps
    if (window.location.href.indexOf('/edit/property/single/5') > 0) {
        var latitude = parseFloat($('div[data-name="lat"]').dxNumberBox('instance').option('value'));
        var longitude = parseFloat($('div[data-name="long"]').dxNumberBox('instance').option('value'));
        var mapOptions = {
            center: new google.maps.LatLng(latitude, longitude),
            zoom: 19,
            disableDefaultUI: true,
            zoomControl: true,
            streetViewControl: true,
            rotateControl: true,
            fullscreenControl: true
        };
        var map = new google.maps.Map(document.getElementById('gmaps-view'), mapOptions);

        if (latitude !== NaN && longitude !== NaN) {
            var marker = new google.maps.Marker({
                map: map,
                position: {
                    lat: latitude,
                    lng: longitude
                },
                icon: {
                    url: "http://maps.google.com/mapfiles/ms/icons/red.png"
                }
            });
            var infowindow = new google.maps.InfoWindow({
                content: $('#marker-info').html()
            });
            marker.addListener('click', function () {
                infowindow.open(map, marker);
            });
        }
    }
    //end maps

    //property attachment
    $('.delete-property-attachment').click(function (e) {
        var title = 'Hapuskan Lampiran';
        var msg = 'Adakah anda pasti ingin menghapuskan lampiran ini?';
        deleteRecord(window.location.href.replace('edit', 'delete'), $(this).attr('data-id'), title, msg);
    });
    //

    //building rate       
    $('#modal-building-rate').on('show.bs.modal', function (e) {
        $('div[data-name="area_text"]').dxTextBox('instance').option('value', '');
        $('div[data-name="area_text"]').dxValidator('instance').reset();
        $('input[name="area_id"]').val('');
        $('div[data-name="category_key"]').dxSelectBox('instance').option('value', '');
        $('div[data-name="category_key"]').dxValidator('instance').reset();
        $('div[data-name="type"]').dxSelectBox('instance').option('value', '');
        $('div[data-name="type"]').dxValidator('instance').reset();
        $('div[data-name="total_level"]').dxSelectBox('instance').option('value', '');
        $('div[data-name="total_level"]').dxValidator('instance').reset();
        $('div[data-name="for_level"]').dxSelectBox('instance').option('value', '');
        $('div[data-name="for_level"]').dxValidator('instance').reset();
        $('div[data-name="wide_type"]').dxSelectBox('instance').option('value', '');
        $('div[data-name="wide_type"]').dxValidator('instance').reset();
        $('div[data-name="rate"]').dxNumberBox('instance').option('value', '');
        $('div[data-name="rate"]').dxValidator('instance').reset();
    });

    $('#modal-property-zone').on('show.bs.modal', function (e) {
        $(this).css('z-index', 1200);
    });

    function saveBuildingRate() {
        var postURL;
        if ($('input[name="building_rate_id"]').val() != null && $('input[name="building_rate_id"]').val() != '') {
            postURL = baseURL + '/update/rate/building/' + $('input[name="building_rate_id"]').val();
        } else {
            postURL = baseURL + '/store/rate/building';
        }

        formData = {
            area_text: $('div[data-name="area_text"]').dxTextBox('instance').option('value'),
            area_id: $('input[name="area_id"]').val(),
            category_key: $('div[data-name="category_key"]').dxSelectBox('instance').option('value'),
            type: $('div[data-name="type"]').dxSelectBox('instance').option('value'),
            total_level: $('div[data-name="total_level"]').dxSelectBox('instance').option('value'),
            for_level: $('div[data-name="for_level"]').dxSelectBox('instance').option('value'),
            wide_type: $('div[data-name="wide_type"]').dxSelectBox('instance').option('value'),
            rate: $('div[data-name="rate"]').dxNumberBox('instance').option('value'),
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            url: postURL,
            dataType: 'JSON',
            type: "POST",
            data: formData,
            success: function (status) {
                if (status['status'] == 'error') {
                    toast('error', status['msg']);
                } else {
                    $('#grid').dxDataGrid('instance').refresh();
                    toast('success', status['msg']);
                    $('#modal-building-rate').modal('hide')
                }
            }
        });
    }
    //end building rate

    //tax rate       
    $('#modal-tax-rate').on('show.bs.modal', function (e) {
        $('div[data-name="area_text"]').dxTextBox('instance').option('value', '');
        $('div[data-name="area_text"]').dxValidator('instance').reset();
        $('input[name="area_id"]').val('');
        $('div[data-name="category_key"]').dxSelectBox('instance').option('value', '');
        $('div[data-name="category_key"]').dxValidator('instance').reset();
        $('div[data-name="type"]').dxSelectBox('instance').option('value', '');
        $('div[data-name="type"]').dxValidator('instance').reset();
        $('div[data-name="rate"]').dxNumberBox('instance').option('value', '');
        $('div[data-name="rate"]').dxValidator('instance').reset();
    });

    $('#modal-property-zone').on('show.bs.modal', function (e) {
        $(this).css('z-index', 1200);
    });

    function saveTaxRate() {
        var postURL;
        if ($('input[name="tax_rate_id"]').val() != null && $('input[name="tax_rate_id"]').val() != '') {
            postURL = baseURL + '/update/rate/tax/' + $('input[name="tax_rate_id"]').val();
        } else {
            postURL = baseURL + '/store/rate/tax';
        }

        formData = {
            area_text: $('div[data-name="area_text"]').dxTextBox('instance').option('value'),
            area_id: $('input[name="area_id"]').val(),
            category_key: $('div[data-name="category_key"]').dxSelectBox('instance').option('value'),
            type: $('div[data-name="type"]').dxSelectBox('instance').option('value'),
            rate: $('div[data-name="rate"]').dxNumberBox('instance').option('value'),
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            url: postURL,
            dataType: 'JSON',
            type: "POST",
            data: formData,
            success: function (status) {
                if (status['status'] == 'error') {
                    toast('error', status['msg']);
                } else {
                    $('#grid').dxDataGrid('instance').refresh();
                    toast('success', status['msg']);
                    $('#modal-tax-rate').modal('hide')
                }
            }
        });
    }
    //end tax rate

    $('a[data-action=delete]').on('click', function (e) {
        e.preventDefault();
        $(this).closest('tr').hide(300, function () {
            $(this).remove();
        });
    });

    $('.my-collapse').on('shown.bs.collapse', function () {
        $(this).parent().find(".icon-arrow-down").removeClass("icon-arrow-down").addClass("icon-arrow-up");
    });

    $('.my-collapse').on('hidden.bs.collapse', function () {
        $(this).parent().find(".icon-arrow-up").removeClass("icon-arrow-up").addClass("icon-arrow-down");
    });

    if (window.location.href.indexOf('/login') === -1 && window.location.href.indexOf('/activate') === -1) {
        $('.magnific-popup-link').magnificPopup({
            type: 'image'
        });

        $('.magnific-popup-gallery-link').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    }

    function deleteGridRecord(url, grid, msg) {
        DevExpress.ui.dialog.custom({
            title: "Adakah anda pasti?",
            message: msg,
            buttons: [{
                    text: "Pasti",
                    type: "danger",
                    onClick: function () {
                        return true;
                    }
                },
                {
                    text: "Batal",
                    type: "normal",
                    onClick: function () {
                        return false;
                    }
                }
            ]
        }).show().done(function (dialogResult) {
            if (dialogResult) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: "JSON",
                    data: {
                        "_token": $('input[name="_token"]').val()
                    },
                    success: function (response) {
                        if (response.status == true) {
                            toast('success', response.message);
                            grid.refresh();
                        } else {
                            toast('error', response.message)
                        }
                    }
                });
            }
        });
    }

    //ref untuk delete owner
    function deleteRecord(url, id, title, msg) {
        DevExpress.ui.dialog.custom({
            title: title,
            message: msg,
            buttons: [{
                    text: "Pasti",
                    type: "danger",
                    onClick: function () {
                        return true;
                    }
                },
                {
                    text: "Batal",
                    type: "normal",
                    onClick: function () {
                        return false;
                    }
                }
            ]
        }).show().done(function (dialogResult) {
            if (dialogResult) {
                var deleteForm = document.createElement('form');
                deleteForm.setAttribute('action', url);
                deleteForm.setAttribute('method', 'POST');
                deleteForm.appendChild(document.getElementsByName("_token")[0]);
                var inputMethod = document.createElement('input');
                inputMethod.setAttribute('type', 'hidden');
                inputMethod.setAttribute('name', '_method');
                inputMethod.setAttribute('value', 'DELETE');
                deleteForm.appendChild(inputMethod);
                var inputId = document.createElement('input');
                inputId.setAttribute('type', 'hidden');
                inputId.setAttribute('name', 'id');
                inputId.setAttribute('value', id);
                deleteForm.appendChild(inputId);
                document.body.appendChild(deleteForm);
                deleteForm.submit();
            }
        });
    }

    function hideLoadPanel() {
        $('.panel-body').removeClass('d-none');
        loadPanel.hide();
    }
});
