jQuery(function ($) {

    var baseURL = window.location.protocol + "//" + window.location.host;
    var grid;
    var triggerCroppie = false;
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

            if ($this.attr('data-case') === 'lowercase') {
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
                readOnly: $this.attr('data-readonly')
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
                multiple: $this.attr('data-multiple') === 'true',
                uploadMode: $this.attr('data-mode'),
                accept: $this.attr('data-accept'),
                readyToUploadMessage: "Ready to upload",
                selectButtonText: "Choose File",
                width: '100%',
                name: $this.attr('data-name')
            });
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
            location.href = baseURL + '/user/create';
        } else if ($(this).attr('data-for') == 'tax') {
            location.href = baseURL + '/tax/create';
        }
    });
    $(".grid-btn-sync").click(function () {
        location.href = baseURL + '/tax/sync';
    });
    $(".grid-btn-refresh").click(function () {
        if ($(this).attr('data-for') == 'users') {
            localStorage.removeItem("indexUsers");
        } else if ($(this).attr('data-for') == 'tax') {
            localStorage.removeItem("indexTax");
        } else if ($(this).attr('data-for') == 'profiling_01') {
            localStorage.removeItem("indexProfile01");
        } else if ($(this).attr('data-for') == 'profiling_02') {
            localStorage.removeItem("indexProfile02");
        } else if ($(this).attr('data-for') == 'profiling_03') {
            localStorage.removeItem("indexProfile03");
        }
        grid.state({});
        grid.option("searchPanel.visible", false);
        grid.refresh();
    });
    $(".grid-btn-column").click(function () {
        grid.showColumnChooser();
    });
    $(".grid-btn-trash").click(function () {
        if ($(this).attr('data-for') == 'users') {
            location.href = baseURL + '/user?show=trashed';
        } else if ($(this).attr('data-for') == 'tax') {
            location.href = baseURL + '/tax?show=trashed';
        }
    });
    $(".grid-btn-excel").click(function () {
        var sort = [];
        var column = [];
        $.each((grid.getVisibleColumns()), function (k, v) {
            column.push(v.dataField);
        });
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
        } else if ($(this).attr('data-for') == 'tax') {
            location.href = baseURL + '/export/excel/tax/list?column=' + JSON.stringify(column) + '&filter=' + JSON.stringify(grid.getCombinedFilter()) + '&sort=' + JSON.stringify(sort);
        } else if ($(this).attr('data-for') == 'profiling_01') {
            location.href = baseURL + '/export/excel/tax/profiling_01?column=' + JSON.stringify(column) + '&filter=' + JSON.stringify(grid.getCombinedFilter()) + '&sort=' + JSON.stringify(sort);
        } else if ($(this).attr('data-for') == 'profiling_02') {
            location.href = baseURL + '/export/excel/tax/profiling_02?column=' + JSON.stringify(column) + '&filter=' + JSON.stringify(grid.getCombinedFilter()) + '&sort=' + JSON.stringify(sort);
        } else if ($(this).attr('data-for') == 'profiling_03') {
            location.href = baseURL + '/export/excel/tax/profiling_03?column=' + JSON.stringify(column) + '&filter=' + JSON.stringify(grid.getCombinedFilter()) + '&sort=' + JSON.stringify(sort);
        }
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
            columnChooser: {
                enabled: true,
                mode: "dragAndDrop" // or "select"
            },
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
                visible: true
            },
            filterRow: {
                visible: true,
                applyFilter: "auto"
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
                    loadUrl: baseURL + '/data?b=' + '55a0c60437bd8' + '&c=' + $this.attr('data-trashed')
                })
            });
            grid.option('stateStoring', {
                enabled: true,
                type: 'custom',
                storageKey: 'indexUsers',
                customLoad: function () {
                    var d = new $.Deferred();
                    setTimeout(function () {
                        var state = localStorage.getItem("indexUsers");
                        d.resolve($.parseJSON(state));
                    }, 1000);
                    return d.promise();
                },
                customSave: function (gridState) {
                    localStorage.setItem("indexUsers", JSON.stringify(gridState));
                }
            });
            var columns = [];
            if ($this.attr('data-trashed') == '1') {
                columns.push({
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
                        $("<a/>")
                            .attr('href', 'javascript:void')
                            .html('<i class="c-icon cil-action-undo"></i>')
                            .bind("click", function () {
                                var msg = "This user will be restored";
                                restoreRecord(baseURL + '/tax/restore/' + options.data.id, grid, msg);
                            })
                            .appendTo(container);
                    }
                }, {
                    caption: 'Deleted Date',
                    dataField: "deleted_at",
                    width: '140',
                    dataType: "date",
                    format: 'dd MMM yyyy hh:mm a',
                    allowHeaderFiltering: false
                });
            } else {
                columns.push({
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
                                    text: "Edit"
                                }, {
                                    id: "resendActivation",
                                    text: "Resend Activation"
                                }, {
                                    id: "resetPassword",
                                    text: "Reset Password"
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
                                    location.href = baseURL + '/user/' + options.data.id + '/edit';
                                } else if (data.itemData.id == 'resendActivation') {
                                    location.href = baseURL + '/resend/activation/' + options.data.id;
                                } else if (data.itemData.id == 'resetPassword') {
                                    location.href = baseURL + '/reset/password/' + options.data.id;
                                } else if (data.itemData.id == 'delete') {
                                    var msg = "This user will deleted from the system if :<br />" +
                                        "<ul><li>Not related to tax payer info</li></ul>" +
                                        "If this user is related with above data, this user will be deactivated";
                                    deleteGridRecord(baseURL + '/user/' + options.data.id, grid, msg);
                                }
                            }
                        }).appendTo(container);
                    }
                });
            }
            columns.push({
                caption: 'Fullname',
                dataField: "fullname",
                allowHeaderFiltering: false,
                cellTemplate: function (container, options) {
                    $('<a/>').addClass('dx-link')
                        .text(options.text)
                        .on('dxclick', function () {
                            location.href = baseURL + '/user/' + options.key;
                        })
                        .appendTo(container);
                }
            }, {
                caption: 'Email',
                dataField: "username",
                allowHeaderFiltering: false,
            }, {
                caption: 'Role',
                dataField: "role",
                allowHeaderFiltering: false,
                cellTemplate: function (container, options) {
                    var roles = JSON.parse(options.text);
                    $('<span />').html(roles.join(' / ')).appendTo(container);
                }
            });
            grid.option('columns', columns);
        } else if ($this.attr('data-for') == 'tax') {
            grid.option('dataSource', {
                store: DevExpress.data.AspNet.createStore({
                    key: 'id',
                    loadUrl: baseURL + '/data?b=' + '55a0c60437d14' + '&c=' + $this.attr('data-trashed')
                })
            });
            grid.option('stateStoring', {
                enabled: true,
                type: 'custom',
                storageKey: 'indexTax',
                customLoad: function () {
                    var d = new $.Deferred();
                    setTimeout(function () {
                        var state = localStorage.getItem("indexTax");
                        d.resolve($.parseJSON(state));
                    }, 1000);
                    return d.promise();
                },
                customSave: function (gridState) {
                    localStorage.setItem("indexTax", JSON.stringify(gridState));
                }
            });
            var columns = [];
            if ($this.attr('data-trashed') == '1') {
                columns.push({
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
                        $("<a/>")
                            .attr('href', 'javascript:void')
                            .html('<i class="c-icon cil-action-undo"></i>')
                            .bind("click", function () {
                                var msg = "This tax record will be restored";
                                restoreRecord(baseURL + '/tax/restore/' + options.data.id, grid, msg);
                            })
                            .appendTo(container);
                    }
                }, {
                    caption: 'Deleted Date',
                    dataField: "deleted_at",
                    width: '140',
                    dataType: "date",
                    format: 'dd MMM yyyy hh:mm a',
                    allowHeaderFiltering: false
                });
            } else {
                columns.push({
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
                        $("<a/>")
                            .attr('href', 'javascript:void')
                            .html('<i class="c-icon cil-trash text-danger"></i>')
                            .bind("click", function () {
                                var msg = "This tax record will be deleted from system";
                                deleteGridRecord(baseURL + '/tax/' + options.data.id, grid, msg);
                            })
                            .appendTo(container);
                    }
                });
            }
            columns.push({
                caption: 'Business/Branch Name',
                dataType: 'string',
                dataField: "business_name",
                width: '280',
                sortOrder: 'asc',
                allowHeaderFiltering: false,
                cellTemplate: function (container, options) {
                    $('<a/>').addClass('dx-link')
                        .text(options.text)
                        .on('dxclick', function () {
                            location.href = baseURL + '/tax/' + options.data.id + '?section=basic';
                        })
                        .appendTo(container);
                }
            }, {
                caption: 'Trade Name',
                dataType: 'string',
                dataField: "trade_name",
                visible: false,
                allowHeaderFiltering: false
            }, {
                caption: 'Status Name',
                dataField: "registration_status",
                width: '110',
                dataType: 'string'
            }, {
                caption: 'Register Date',
                dataField: "registration_date",
                dataType: "date",
                width: '110',
                format: 'dd MMM yyyy'
            }, {
                caption: 'Cancellation Approval',
                dataField: "cancellation_approval",
                visible: false,
                dataType: "date",
                format: 'dd MMM yyyy',
                allowHeaderFiltering: false
            }, {
                caption: 'Cancellation Effective',
                dataField: "cancellation_effective",
                visible: false,
                dataType: "date",
                format: 'dd MMM yyyy',
                allowHeaderFiltering: false
            }, {
                caption: 'SST No',
                dataType: 'string',
                dataField: "sst_no",
                width: '130',
                allowHeaderFiltering: false
            }, {
                caption: 'Station Code',
                dataType: 'string',
                dataField: "station_code",
                width: '100',
                visible: false
            }, {
                caption: 'Station Name',
                dataType: 'string',
                width: '140',
                dataField: "station_name"
            }, {
                caption: 'GST No',
                dataType: 'string',
                dataField: "gst_no",
                width: '100',
                allowHeaderFiltering: false
            }, {
                caption: 'Brn No',
                dataType: 'string',
                dataField: "brn_no",
                width: '100',
                allowHeaderFiltering: false
            }, {
                caption: 'SST Type',
                dataType: 'string',
                width: '120',
                dataField: "sst_type"
            }, {
                caption: 'Email Address',
                dataType: 'string',
                dataField: "email_address",
                allowHeaderFiltering: false
            }, {
                caption: 'Telephone No',
                dataType: 'string',
                dataField: "telephone_no",
                width: '120',
                allowHeaderFiltering: false
            }, {
                caption: 'Company Address 1',
                dataType: 'string',
                dataField: "company_address_1",
                visible: false,
                allowHeaderFiltering: false
            }, {
                caption: 'Company Address 2',
                dataType: 'string',
                dataField: "company_address_2",
                visible: false,
                allowHeaderFiltering: false
            }, {
                caption: 'Company Address 3',
                dataType: 'string',
                dataField: "company_address_3",
                visible: false,
                allowHeaderFiltering: false
            }, {
                caption: 'Company Postcode',
                dataType: 'string',
                dataField: "company_postcode",
                visible: false,
                allowHeaderFiltering: false
            }, {
                caption: 'Company City',
                dataType: 'string',
                dataField: "company_city",
                visible: false
            }, {
                caption: 'Company State',
                dataType: 'string',
                width: '130',
                dataField: "company_state",
            }, {
                caption: 'Correspondence Address 1',
                dataType: 'string',
                dataField: "correspondence_address_1",
                visible: false,
                allowHeaderFiltering: false
            }, {
                caption: 'Correspondence Address 2',
                dataType: 'string',
                dataField: "correspondence_address_2",
                visible: false,
                allowHeaderFiltering: false
            }, {
                caption: 'Correspondence Address 3',
                dataType: 'string',
                dataField: "correspondence_address_3",
                visible: false,
                allowHeaderFiltering: false
            }, {
                caption: 'Correspondence Postcode',
                dataType: 'string',
                dataField: "correspondence_postcode",
                visible: false,
                allowHeaderFiltering: false
            }, {
                caption: 'Correspondence city',
                dataType: 'string',
                dataField: "correspondence_city",
                visible: false
            }, {
                caption: 'Correspondence State',
                dataType: 'string',
                dataField: "correspondence_state",
                visible: false
            }, {
                caption: 'Factory Name',
                dataType: 'string',
                width: '120',
                dataField: "factory_name",
                allowHeaderFiltering: false
            }, {
                caption: 'Entity Type',
                dataType: 'string',
                width: '120',
                dataField: "entity_type"
            }, {
                caption: 'Business Activity',
                dataType: 'string',
                width: '140',
                dataField: "business_activity"
            }, {
                caption: 'Product',
                dataType: 'string',
                width: '120',
                dataField: "product_tax"
            }, {
                caption: 'Facility Applied',
                dataType: 'string',
                width: '120',
                dataField: "facility_applied"
            }, {
                caption: 'Local Marketing',
                dataType: 'string',
                width: '120',
                dataField: "local_marketing"
            }, {
                caption: 'Statement',
                dataType: 'string',
                dataField: "statement",
                visible: false
            }, {
                caption: 'Statement Status',
                dataType: 'string',
                dataField: "statement_status",
                visible: false
            }, {
                caption: 'Uncomplience Type',
                dataType: 'string',
                dataField: "uncomplience_type",
                visible: false
            });
            grid.option('columns', columns);
        } else if ($this.attr('data-for') == 'profiling_01') {
            grid.option('dataSource', {
                store: DevExpress.data.AspNet.createStore({
                    key: 'id',
                    loadUrl: baseURL + '/data?b=' + '55a0c604380fe' + '&c=profiling_01'
                })
            });
            grid.option('stateStoring', {
                enabled: true,
                type: 'custom',
                storageKey: 'indexProfile01',
                customLoad: function () {
                    var d = new $.Deferred();
                    setTimeout(function () {
                        var state = localStorage.getItem("indexProfile01");
                        d.resolve($.parseJSON(state));
                    }, 1000);
                    return d.promise();
                },
                customSave: function (gridState) {
                    localStorage.setItem("indexProfile01", JSON.stringify(gridState));
                }
            });
            grid.option('columns', [
                {
                    caption: '#',
                    cellTemplate: function(cellElement, cellInfo) {
                        cellElement.text(cellInfo.row.rowIndex + 1)
                    }
                }, {
                caption: 'Business Name',
                dataType: 'string',
                dataField: "business_name",
                width: '24%',
                sortOrder: 'asc',
                allowHeaderFiltering: false,
                cellTemplate: function (container, options) {
                    $('<a/>').addClass('dx-link')
                        .text(options.text)
                        .on('dxclick', function () {
                            location.href = baseURL + '/tax/' + options.data.id + '?section=basic';
                        })
                        .appendTo(container);
                }
            }, {
                caption: 'Brn No',
                dataType: 'string',
                dataField: "brn_no",
                allowHeaderFiltering: false,
                width: '10%'
            }, {
                caption: 'S1',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_01"
            }, {
                caption: 'S2',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_02"
            }, {
                caption: 'S3',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_03"
            }, {
                caption: 'S4',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_04"
            }, {
                caption: 'S5',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_05"
            }, {
                caption: 'S6',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_06"
            }, {
                caption: 'S7',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_07"
            }, {
                caption: 'S8',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_08"
            }, {
                caption: 'S9',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_09"
            }, {
                caption: 'S10',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_10"
            }, {
                caption: 'S11',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_11"
            }, {
                caption: 'S12',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_12"
            }, {
                caption: 'Risk Level',
                dataType: 'string',
                width: '10%',
                dataField: "risk_level_text"
            }]);
        } else if ($this.attr('data-for') == 'profiling_02') {
            grid.option('dataSource', {
                store: DevExpress.data.AspNet.createStore({
                    key: 'id',
                    loadUrl: baseURL + '/data?b=' + '55a0c604380fe' + '&c=profiling_02'
                })
            });
            grid.option('stateStoring', {
                enabled: true,
                type: 'custom',
                storageKey: 'indexProfile02',
                customLoad: function () {
                    var d = new $.Deferred();
                    setTimeout(function () {
                        var state = localStorage.getItem("indexProfile02");
                        d.resolve($.parseJSON(state));
                    }, 1000);
                    return d.promise();
                },
                customSave: function (gridState) {
                    localStorage.setItem("indexProfile02", JSON.stringify(gridState));
                }
            });

            grid.option('columns', [{
                caption: '#',
                cellTemplate: function(cellElement, cellInfo) {
                    cellElement.text(cellInfo.row.rowIndex + 1)
                }
            }, {
                caption: 'Business Name',
                dataType: 'string',
                dataField: "business_name",
                width: '24%',
                sortOrder: 'asc',
                allowHeaderFiltering: false,
                cellTemplate: function (container, options) {
                    $('<a/>').addClass('dx-link')
                        .text(options.text)
                        .on('dxclick', function () {
                            location.href = baseURL + '/tax/' + options.data.id + '?section=basic';
                        })
                        .appendTo(container);
                }
            }, {
                caption: 'Brn No',
                dataType: 'string',
                dataField: "brn_no",
                width: '10%',
                allowHeaderFiltering: false
            }, {
                caption: 'S1',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_01"
            }, {
                caption: 'S2',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_02"
            }, {
                caption: 'S3',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_03"
            }, {
                caption: 'S4',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_04"
            }, {
                caption: 'S5',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_05"
            }, {
                caption: 'S6',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_06"
            }, {
                caption: 'S7',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_07"
            }, {
                caption: 'S8',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_08"
            }, {
                caption: 'S9',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_09"
            }, {
                caption: 'S10',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_10"
            }, {
                caption: 'S11',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_11"
            }, {
                caption: 'S12',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_12"
            }, {
                caption: 'Risk Level',
                dataType: 'string',
                width: '10%',
                dataField: "risk_level_text"
            }]);
        } else if ($this.attr('data-for') == 'profiling_03') {
            grid.option('dataSource', {
                store: DevExpress.data.AspNet.createStore({
                    key: 'id',
                    loadUrl: baseURL + '/data?b=' + '55a0c604380fe' + '&c=profiling_03'
                })
            });
            grid.option('stateStoring', {
                enabled: true,
                type: 'custom',
                storageKey: 'indexProfile03',
                customLoad: function () {
                    var d = new $.Deferred();
                    setTimeout(function () {
                        var state = localStorage.getItem("indexProfile03");
                        d.resolve($.parseJSON(state));
                    }, 1000);
                    return d.promise();
                },
                customSave: function (gridState) {
                    localStorage.setItem("indexProfile03", JSON.stringify(gridState));
                }
            });
            grid.option('columns', [
                {
                    caption: '#',
                    cellTemplate: function(cellElement, cellInfo) {
                        cellElement.text(cellInfo.row.rowIndex + 1)
                    }
                }, {
                caption: 'Business Name',
                dataType: 'string',
                dataField: "business_name",
                width: '35%',
                sortOrder: 'asc',
                allowHeaderFiltering: false,
                cellTemplate: function (container, options) {
                    $('<a/>').addClass('dx-link')
                        .text(options.text)
                        .on('dxclick', function () {
                            location.href = baseURL + '/tax/' + options.data.id + '?section=basic';
                        })
                        .appendTo(container);
                }
            }, {
                caption: 'Brn No',
                dataType: 'string',
                dataField: "brn_no",
                width: '14%',
                allowHeaderFiltering: false
            }, {
                caption: 'S1',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_01"
            }, {
                caption: 'S2',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_02"
            }, {
                caption: 'S3',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_03"
            }, {
                caption: 'S4',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_04"
            }, {
                caption: 'S5',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_05"
            }, {
                caption: 'S6',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_06"
            }, {
                caption: 'S7',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_07"
            }, {
                caption: 'S8',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_08"
            }, {
                caption: 'S9',
                dataType: 'number',
                width: '5%',
                allowHeaderFiltering: false,
                dataField: "mark_09"
            }, {
                caption: 'Risk Level',
                dataType: 'string',
                width: '10%',
                dataField: "risk_level_text"
            }]);
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

    $('.edit-cdn-status').click(function () {
        $.getJSON(baseURL + '/data?b=55a0c604381b6&c=' + $(this).attr('data-id'), function (data) {
            $('[data-name="cdn_status_desc"]').dxTextArea('instance').option('value', data.cdn_status_desc);
            $('#modal-cdn-status').modal('show');
        });
    });

    $('#update-addtional-info').click(function () {
        $('#modal-additional-info').modal('show');
    });

    $('#upload-attachment').click(function () {
        $('#method-attachment').val('');
        $('#title-attachment').html('Upload New Attachment');
        $('[data-name="title"]').dxTextBox('instance').option('value', '');
        $('[data-name="description"]').dxTextArea('instance').option('value', '');
        $('[data-name="filename"]').dxFileUploader('instance').reset();
        $('[data-name="filename"]').dxValidator('instance').reset();
        $('[data-name="filename"]').dxValidator('instance').option('validationRules', [{
            type: 'required'
        }]);
        $('#modal-attachment').modal('show');
    });

    $('.edit-attachment').click(function () {
        $.getJSON(baseURL + '/data?b=55a0c60438163&c=' + $(this).attr('data-id'), function (data) {
            $('#form-attachment').attr('action', baseURL + '/tax/' + data.for_id + '?section=attachment&id=' + data.id);
            $('#method-attachment').val('PUT');
            $('#title-attachment').html('Update Note');
            $('[data-name="title"]').dxTextBox('instance').option('value', data.title);
            $('[data-name="description"]').dxTextArea('instance').option('value', data.description);
            $('[data-name="filename"]').dxValidator('instance').reset();
            $('[data-name="filename"]').dxValidator('instance').option('validationRules', []);
            $('#modal-attachment').modal('show');
        });
    });

    $('.delete-attachment').click(function () {
        var msg = "This attachment will be deleted from this tax record";
        deleteRecord(baseURL + '/tax/' + $(this).attr('data-tax-id') + '?section=attachment&id=' + $(this).attr('data-id'), null, 'Are you sure?', msg);
    });

    $('#add-note').click(function () {
        $('#method-note').val('');
        $('#title-note').html('Create New Note');
        $('[data-name="note_title"]').dxTextBox('instance').option('value', '');
        $('[data-name="note_title"]').dxValidator('instance').reset();
        $('#modal-note').modal('show');
    });

    $('.edit-note').click(function () {
        $.getJSON(baseURL + '/data?b=55a0c604381b5&c=' + $(this).attr('data-id'), function (data) {
            $('#form-note').attr('action', baseURL + '/tax/' + data.tax_record_id + '?section=note&id=' + data.id);
            $('#method-note').val('PUT');
            $('#title-note').html('Update Note');
            $('[data-name="note_title"]').dxTextBox('instance').option('value', data.note_title);
            $('.ql-editor')[0].innerHTML = data.note;
            $('#modal-note').modal('show');
        });
    });

    $('.show-note').click(function () {
        $.getJSON(baseURL + '/data?b=55a0c604381b5&c=' + $(this).attr('data-id'), function (data) {
            $('#show-title').html(data.note_title);
            $('#show-note').html(data.note);
            $('#modal-show-note').modal('show');
        });
    });

    $('.delete-note').click(function () {
        var msg = "This note will be deleted from this tax record";
        deleteRecord(baseURL + '/tax/' + $(this).attr('data-tax-id') + '?section=note&id=' + $(this).attr('data-id'), null, 'Are you sure?', msg);
    });

    function toast(type, msg) {
        $("#toastContainer").dxToast({
            message: msg,
            type: type,
            width: 320,
            position: {
                my: "right",
                at: "top right",
                offset: '-20 0',
                of: ".c-subheader"
            },
            displayTime: 10000
        });
        $("#toastContainer").dxToast('show');
    }

    $('[data-toggle="tooltip"]').tooltip();

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

    if ($('#progress-bar-base').length > 0) {
        var intervalProgressBar = setInterval(() => {
            $.getJSON(baseURL + '/data?b=55a0c60438203', function (data) {
                if (data == '100') {
                    clearInterval(intervalProgressBar);
                    $('#progress-bar-base').attr('aria-valuenow', data);
                    $('#progress-bar-base').css('width', '100%');
                    $('#progress-bar-base').html('100%');
                    var counter = 6;
                    setInterval(function () {
                        counter--;
                        $('#progress-label-base').html('Syncronization has been success. Redirect in ' + counter + ' seconds');
                    }, 1000);
                    setTimeout(() => {
                        location.href = baseURL + '/tax';
                    }, 6000);
                } else {
                    $('#progress-bar-base').attr('aria-valuenow', data);
                    $('#progress-bar-base').css('width', data + '%');
                    $('#progress-bar-base').html(data + '%');
                }
            });
        }, 1000);
    }

    if ($('#progress-bar-statement').length > 0) {
        var intervalProgressBar = setInterval(() => {
            $.getJSON(baseURL + '/data?b=55a0c60438303', function (data) {
                if (data == '100') {
                    clearInterval(intervalProgressBar);
                    $('#progress-bar-statement').attr('aria-valuenow', data);
                    $('#progress-bar-statement').css('width', '100%');
                    $('#progress-bar-statement').html('100%');
                    var counter = 6;
                    setInterval(function () {
                        counter--;
                        $('#progress-label-statement').html('Syncronization has been success. Redirect in ' + counter + ' seconds');
                    }, 1000);
                    setTimeout(() => {
                        location.href = baseURL + '/tax';
                    }, 6000);
                } else {
                    $('#progress-bar-statement').attr('aria-valuenow', data);
                    $('#progress-bar-statement').css('width', data + '%');
                    $('#progress-bar-statement').html(data + '%');
                }
            });
        }, 1000);
    }

    function deleteRecord(url, id, title, msg) {
        DevExpress.ui.dialog.custom({
            title: title,
            message: msg,
            buttons: [{
                text: "Yes",
                type: "danger",
                onClick: function () {
                    return true;
                }
            },
                {
                    text: "No",
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

    function deleteGridRecord(url, grid, msg) {
        DevExpress.ui.dialog.custom({
            title: "Are you sure?",
            message: msg,
            buttons: [{
                text: "Confirm",
                type: "danger",
                onClick: function () {
                    return true;
                }
            },
                {
                    text: "Cancel",
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

    function restoreRecord(url, id, msg) {
        DevExpress.ui.dialog.custom({
            title: "Are You Sure?",
            message: msg,
            buttons: [{
                text: "Confirm",
                type: "danger",
                onClick: function () {
                    return true;
                }
            },
                {
                    text: "Cancel",
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
                    type: 'POST',
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
});
