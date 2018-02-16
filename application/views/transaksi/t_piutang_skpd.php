<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Piutang SKPD</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-md-1">Filter :</div>
    <div class="col-md-3">
        <select name="status_bayar" id="status_bayar" class="form-control">
            <option value="">Semua</option>
            <option value="belum_bayar">Belum Bayar</option>
            <option value="sudah_bayar">Sudah Bayar</option>
        </select>
    </div>
</div>

<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">
        <table id="grid-table"></table>
        <div id="grid-pager"></div>
    </div>
</div>

<script>
    $('#status_bayar').change(function() {

        $("#grid-table").jqGrid('setGridParam', {
            url: '<?php echo WS_JQGRID."transaksi.t_piutang_skpd_controller/read"; ?>',
            postData: {status_bayar: $(this).val()}
        });
        $("#grid-table").trigger("reloadGrid");
    });
</script>

<script>
    $(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        $("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_piutang_skpd_controller/read"; ?>',
            postData: {s_keyword:$('#s_keyword').val()},
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID',name: 't_vat_setllement_id', hidden: true ,width: 180, align: "left"},
                {label: 'ID',name: 't_customer_order_id', hidden: true ,width: 180, align: "left"},
                {label: 'ID',name: 'p_vat_type_id', hidden: true ,width: 180, align: "left"},
				{label: 'receipt no',name: 'receipt_no', hidden: true ,width: 20, align: "left"},
				{label: 'Status Bayar',width: 163,align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var receipt_no = rowObject['receipt_no'];
                        if(receipt_no == '' || receipt_no == null) return '<span class="red"><strong>Belum Bayar</strong></span>';
						return '<span class="green"><strong>Sudah Bayar</strong></span>';
                    }
                },

                {label: 'No. Order',name: 'order_no',width: 120, align: "left"},
                {label: 'No Bayar',name: 'payment_key', width: 180, align: "left"},
                {label: 'NAMA WP',name: 'wp_name',width: 230, align: "left"},
                {label: 'ALAMAT WP',name: 'wp_address_name',width: 230, align: "left"},
                {label: 'Jenis Pajak',name: 'jenis_pajak',width: 230, align: "left"},
                {label: 'NPWPD',name: 'npwd',width: 150, align: "left"},
                {label: 'Periode Tahun',name: 'year_code',width: 150, align: "left"},
                {label: 'Periode',name: 'finance_period_code',width: 150, align: "left"},
                {label: 'Masa Pajak',name: 'masa_pajak',width: 150, align: "left"},
                {label: 'Total Transaksi',name: 'total_trans_amount',width: 180, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'Total Penalti',name: 'total_penalty_amount',width: 180, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'Tanggal Jatuh Tempo',name: 'due_date',width: 150, align: "left"},
                {label: 'Dasar Pengenaan',name: 'debt_vat_amt',width: 150, align: "left"},
                {label: 'Total Pajak',name: 'total_vat_amount',width: 180,summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'Kompensasi kelebihan dari tahun sebelumnya',name: 'cr_adjustment',width: 200, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'Setoran yang dilakukan',name: 'cr_payment',width: 200, align: "left"},
                {label: 'Lain-lain',name: 'cr_others',width: 180, align: "left"},
                {label: 'STP (Pokok)',name: 'cr_stp',width: 180, align: "left"},
                {label: 'Bunga (Pasal 65 ayat(2))',name: 'db_interest_charge',width: 180, align: "left"},
                {label: 'Kenaikan (Pasal 65 ayat (3))',name: 'db_increasing_charge',width: 180, align: "left"},
                {label: 'Perbaharui Denda',width: 163,align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var t_vat_setllement_id = rowObject['t_vat_setllement_id'];
                            return '<a class="btn btn-danger btn-xs" href="#" onclick="updateDenda('+t_vat_setllement_id+');">Perbaharui Denda</a>';

                    }
                },
                {label: 'Submit',width: 163,align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var t_customer_order_id = rowObject['t_customer_order_id'];
                        var payment_key = rowObject['payment_key'];
                        var p_vat_type_id = rowObject['p_vat_type_id'];
                        var t_vat_setllement_id = rowObject['t_vat_setllement_id'];

                        if(payment_key == null || payment_key == ""){
                            return '<a class="btn btn-primary btn-xs" href="#" onclick="submit('+t_customer_order_id+','+payment_key+','+p_vat_type_id+','+t_vat_setllement_id+');">Submit</a>';
                        }
						return 'Telah Disubmit';

                    }
                }

            ],
            height: '100%',
            autowidth: true,
            viewrecords: true,
            rowNum: 10,
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
            //memanggil controller jqgrid yang ada di controller read
            caption: "Daftar Piutang SKPD"

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
                    //reloadTreeMenu();
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
                    setTimeout(function() {
                    clearInputRqstType();
                     },100);
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
                    clearInputRqstType();
                    //reloadTreeMenu();


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
</script>

<script type="text/javascript">
    function responsive_jqgrid(grid_selector, pager_selector) {

        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );

    }
</script>

<script>
    function updateDenda(t_vat_setllement_id){
        var url = "<?php echo WS_JQGRID."transaksi.t_piutang_skpd_controller/updateDenda/?"; ?>";
            url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
            url += "&t_vat_setllement_id=" + t_vat_setllement_id;

        $.getJSON(url, function( items ) {


            if(items.rows != "OK"){
                swal('Peringatan', 'Denda Gagal Diperbaharui', 'error');
                return;
            }else{
                swal('Informasi', 'Denda Berhasil Diperbaharui', 'info');
                return;
            }
        })
    }

    function submit(t_customer_order_id, payment_key, p_vat_type_id, t_vat_setllement_id){

        var url = "<?php echo WS_JQGRID."transaksi.t_piutang_skpd_controller/submit/?"; ?>";
            url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
            url += "&t_customer_order_id=" + t_customer_order_id;
            url += "&payment_key=" + payment_key;
            url += "&p_vat_type_id=" + p_vat_type_id;
            url += "&t_vat_setllement_id=" + t_vat_setllement_id;

        swal({
          title: "Konfirmasi",
          text: "Apa Anda yakin akan submit data ini ? ",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya",
          cancelButtonText: "Tidak",
          closeOnConfirm: false,
          showLoaderOnConfirm: true
        },
        function(){
          //swal("Deleted!", "Your imaginary file has been deleted.", "success");
            setTimeout(function(){
                $.getJSON(url, function( items ) {
                    if(items.rows.o_result_code != "0"){
                        swal('Peringatan', items.rows.o_result_msg, 'error');
                        return;
                    }else{
                        swal('Informasi', items.rows.o_result_msg, 'info');
                        return;
                    }
                })
            }, 2000);
        });


    }

</script>