<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>MASTER UBAH SPTPD / SSPD</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <label class="control-label col-md-3">Nama WP/ NPWD / No.Pembayaran :</label>
    <div class="col-md-3">
        <div class="input-group">
            <div class="input-group">
            <input id="s_keyword" type="text" class="FormElement form-control">
            <span class="input-group-btn">
                <button class="btn btn-success" type="button" id="btn-search" onclick="showData()">Cari</button>
            </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <select name="status_bayar" id="status_bayar" class="form-control">
                <option value="all">Status Bayar (Semua)</option>
                <option value="belum_bayar">Belum Bayar</option>
                <option value="sudah_bayar">Sudah Bayar</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <select name="jenis_ketetapan" id="jenis_ketetapan" class="form-control">

            </select>
        </div>
    </div>
</div>


<div class="space-2"></div>

<div class="tab-content no-border">
    <div class="row" id="tabel_id">
        <div class="col-xs-12">
            <div id="gbox_grid-table" class="ui-jqgrid">
                <div id="gview_grid-table" class="ui-jqgrid-view table-responsive" role="grid">
                    <table id="grid-table"></table>
                    <div id="grid-pager"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#status_bayar').change(function() {
        var jenis_ketetapan = $('#jenis_ketetapan').val();
        $("#grid-table").jqGrid('setGridParam', {
            url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_ro_modifikasi_controller/read"; ?>',
            postData: {
				status_bayar: $(this).val(),
                jenis_ketetapan : jenis_ketetapan,
				s_keyword : $('#s_keyword').val()
			}
        });
        $("#grid-table").trigger("reloadGrid");
    });
</script>

<script>
    $(function() {
        $.ajax({
            type: 'POST',
            url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_ro_modifikasi_controller/readJenisKetetapan"; ?>',
            success: function(response) {
                $('#jenis_ketetapan').html(response);
            }
        });
    });

    $('#jenis_ketetapan').change(function() {
        var status_bayar = $('#status_bayar').val();
        $("#grid-table").jqGrid('setGridParam', {
            url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_ro_modifikasi_controller/read"; ?>',
            postData: {
				jenis_ketetapan: $(this).val(),
                status_bayar: status_bayar,
				s_keyword : $('#s_keyword').val()
			}
        });
        $("#grid-table").trigger("reloadGrid");
    });


    function showData(){
        var s_keyword = $('#s_keyword').val();
        var status_bayar = $('#status_bayar').val();
        var jenis_ketetapan = $('#jenis_ketetapan').val();

        jQuery(function($) {

            jQuery("#grid-table").jqGrid('setGridParam',{
                url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_ro_modifikasi_controller/read"; ?>',
                postData: {
                    s_keyword : $('#s_keyword').val(),
                    jenis_ketetapan: jenis_ketetapan,
                    status_bayar : status_bayar

                }
            });
            $("#grid-table").trigger("reloadGrid");
        });
    }

</script>

<?php $this->load->view('lov/lov_ubah_data'); ?>

<script>

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_ro_modifikasi_controller/read"; ?>',
            postData: { s_keyword : $('#s_keyword').val()},
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_vat_setllement_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID CUST', name: 't_customer_order_id',  width: 5, sorttype: 'number', hidden: true},
				{label: 'receipt no',name: 'receipt_no', hidden: true ,width: 20, align: "left"},
				{label: 'Status Bayar',width: 120,align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var receipt_no = rowObject['receipt_no'];
                        if(receipt_no == '' || receipt_no == null) return '<span class="red"><strong>Belum Bayar</strong></span>';
						return '<span class="green"><strong>Sudah Bayar</strong></span>';
                    }
                },
                {label: 'Ayat Pajak',name: 'vat_code', hidden: false ,width: 120, align: "left"},
                {label: 'Merk Dagang',name: 'company_brand',width: 200, align: "left"},
                {label: 'NPWPD',name: 'npwd',width: 110, align: "left"},
                {label: 'No Order',name: 'order_no',width: 80, align: "left", hidden:true},
                {label: 'Periode',name: 'finance_period_code',width: 130, align: "left"},
                {label: 'Ketetapan',name: 'sett_code',width: 90, align: "left",editable: false},
                {label: 'Total Transaksi',name: 'total_trans_amount',width: 120, align: "right",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:'.', decimalSeparator:","}},
                {label: 'Total Pajak',name:'total_vat_amount',width: 120, align: "right",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:'.', decimalSeparator:","}},
                {label: 'Denda',name:'total_penalty_amount',width: 90, align: "right",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:'.', decimalSeparator:","}},
                {label: 'Tgl. Lapor',name: 'settlement_date',width: 130, align: "left",editable: false},
                {label: 'Tgl. Bayar',name: 'payment_date',width: 130, align: "left",editable: false},
                {label: 'No. Bayar',name: 'payment_key',width: 120, align: "left",editable: false},
                {label: 'Dibuat Oleh',name: 'created_by',width: 100, align: "left",editable: false},
				{name: 'Cetak No. Bayar',width: 150, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var val = rowObject['payment_key'];
                        var url = '<?php echo base_url(); ?>'+'cetak_no_bayar/pageCetak?no_bayar='+val;
                        return '<a class="btn btn-success btn-xs" href="#" onclick="PopupCenter(\''+url+'\',\'No. Bayar\',500,500);"><i class="fa fa-print"></i>Cetak No. Bayar</a>';

                    }
                },
				{name: 'Cetak Kuitansi',width: 150, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var val = rowObject['receipt_no'];
						if(val == '' || val == null) return '';

						var payment_key = rowObject['payment_key'];
                        var url = '<?php echo base_url(); ?>'+'cetak_registrasi_payment_large_arial/pageCetak?payment_key='+payment_key;
                        return '<a class="btn btn-success btn-xs" href="#" onclick="PopupCenter(\''+url+'\',\'No. Kuitansi\',500,500);"><i class="fa fa-print"></i>Cetak Kuitansi</a>';

                    }
                },

                {name: 'Hapus Transaksi',width: 160, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var val = rowObject['t_vat_setllement_id'];
                        return '<a class="btn btn-danger btn-xs" href="#" onclick="showLOVUbahData('+val+',6)"><i class="fa fa-trash-o"></i>Hapus Transaksi</a>';

                    }
                },

                {name: 'Ubah Ayat',width: 150, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var val = rowObject['t_vat_setllement_id'];
                        return '<a class="btn btn-danger btn-xs" href="#" onclick="showLOVUbahData('+val+',1)"><i class="fa fa-pencil"></i>Ubah Ayat</a>';

                    }
                },

                {name: 'Ubah Tanggal',width: 150, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var val = rowObject['t_vat_setllement_id'];
                        return '<a class="btn btn-danger btn-xs" href="#" onclick="showLOVUbahData('+val+',2)"><i class="fa fa-pencil"></i>Ubah Tanggal</a>';

                    }
                },

                {name: 'Ubah Total Trans.',width: 190, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var val = rowObject['t_vat_setllement_id'];
                        return '<a class="btn btn-danger btn-xs" href="#" onclick="showLOVUbahData('+val+',3)"><i class="fa fa-pencil"></i>Ubah Total Transaksi</a>';

                    }
                },

                {name: 'Ubah Ketetapan',width: 160, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var val = rowObject['t_vat_setllement_id'];
                        return '<a class="btn btn-danger btn-xs" href="#" onclick="showLOVUbahData('+val+',4)"><i class="fa fa-pencil"></i>Ubah Ketetapan</a>';

                    }
                },

                {name: 'Ubah Denda',width: 150, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var val = rowObject['t_vat_setllement_id'];
                        return '<a class="btn btn-danger btn-xs" href="#" onclick="showLOVUbahData('+val+',5)"><i class="fa fa-pencil"></i>Ubah Denda</a>';

                    }
                }
            ],
            height: '100%',
            autowidth: false,
            viewrecords: true,
            rowNum: 7,
            rowList: [10,20,50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: false,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            pager: '#grid-pager',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }

            },
            //memanggil controller jqgrid yang ada di controller crud
            caption: "MASTER UBAH SPTPD / SSPD"

        });

        jQuery('#grid-table').jqGrid('navGrid', '#grid-pager',
            {   //navbar options
                edit: false,
                editicon: 'fa fa-pencil blue bigger-120',
                add: false,
                addicon: 'fa fa-plus-circle purple bigger-120',
                del: false,
                delicon: 'fa fa-trash-o red bigger-120',
                search: true,
                searchicon: 'fa fa-search orange bigger-120',
                refresh: true,
                afterRefresh: function () {
                    // some code here
                    jQuery("#detailsPlaceholder").hide();
                },

                refreshicon: 'fa fa-refresh green bigger-120',
                view: false,
                viewicon: 'fa fa-search-plus grey bigger-120'
            },

            {
                // options for the Edit Dialog
                closeAfterEdit: true,
                closeOnEscape:true,
                recreateForm: true,
                serializeEditData: serializeJSON,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    style_edit_form(form);

                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    return [true,"",response.responseText];
                }
            },
            {
                //new record form
                closeAfterAdd: false,
                clearAfterAdd : true,
                closeOnEscape:true,
                recreateForm: true,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                serializeEditData: serializeJSON,
                viewPagerButtons: false,
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    style_edit_form(form);
                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }

                    $(".tinfo").html('<div class="ui-state-success">' + response.message + '</div>');
                    var tinfoel = $(".tinfo").show();
                    tinfoel.delay(3000).fadeOut();


                    return [true,"",response.responseText];
                }
            },
            {
                //delete record form
                serializeDelData: serializeJSON,
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                    style_delete_form(form);

                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                onClick: function (e) {
                    //alert(1);
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    return [true,"",response.responseText];
                }
            },
            {
                //search form
                closeAfterSearch: false,
                recreateForm: true,
                afterShowSearch: function (e) {
                    var form = $(e[0]);
                    style_search_form(form);
                    form.closest('.ui-jqdialog').center();
                },
                afterRedraw: function () {
                    style_search_filters($(this));
                }
            },
            {
                //view record form
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                }
            }
        );

    });

    function responsive_jqgrid(grid_selector, pager_selector) {

        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );

    }

</script>
<script>
    function showLOVUbahData(id,i_mode) {
        modal_ubah_data_show(id,i_mode);
    }
</script>