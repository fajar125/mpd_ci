<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Daftar BPHTB</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-list font-blue"></i>
                    <span class="caption-subject font-blue bold uppercase"> Daftar BPHTB
                    </span>
                </div>
            </div>
            <!-- CONTENT PORTLET -->
            <div class="form-body">
                <button class="btn btn-danger" id="add-bphtb"> <i class="fa fa-plus"></i>Tambah</button>
                <button class="btn btn-success" id="detail-bphtb" disabled=""> <i class="fa fa-newspaper-o"></i>Detail BPHTB</button>
                <button class="btn btn-warning" id="modify-bphtb" disabled=""> <i class="fa fa-pencil-square-o"></i>Modify BPHTB</button>
                

                <div class="row">
                    <div class="col-md-12 ">
                        <table id="grid-table"></table>
                        <div id="grid-pager"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $('#add-bphtb').on('click', function(event){
        loadContentWithParams('transaksi.t_bphtb_registration', {});

    });

    $('#detail-bphtb').on('click', function(event){
        /*event.stopPropagation();
        var grid = $('#grid-table-account');
        var rowid = grid.jqGrid ('getGridParam', 'selrow');
        var custRef = grid.jqGrid ('getCell', rowid, 'customer_ref');
        var prodSeq = grid.jqGrid ('getCell', rowid, 'product_seq');

        if(rowid == null) {
            swal('Informasi','Silahkan pilih salah satu BPHTB','info');
            return false;
        }

        loadContentWithParams("transaksi.detail_bphtb", {
            customer_ref: custRef,
            product_seq : prodSeq
        });*/

    });

    $('#modify-bphtb').on('click', function(event){
        var grid = $('#grid-table');
        var rowid = grid.jqGrid ('getGridParam', 'selrow');
        var id = grid.jqGrid ('getCell', rowid, 't_bphtb_registration_id');
        alert(id);

    });

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_bphtb_registration_id',  width: 5, sorttype: 'number', hidden: false},
                {label: 'Nama Wajib Pajak', name: 'wp_name',  width: 15, sorttype: 'text', hidden: false},
                {label: 'No Order', name: 'order_no',  width: 7, sorttype: 'text', hidden: false},
                {label: 'Via Online ?', name: 't_ppat_id',  width: 5, sorttype: 'text', hidden: false},
                {name: 'Options',width: 20, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var val = rowObject['t_bphtb_registration_id'];
                        //var url = '<?php echo base_url(); ?>'+'cetak_formulir_skpd_nihil/pageCetak?t_cust_order_id='+val;
                        return '<a class="btn btn-danger btn-xs" href="#" onclick="PopupCenter('+val+');">Submit</a>';

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
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                $('#detail-bphtb').prop( "disabled", false );
                $('#modify-bphtb').prop( "disabled", false );

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
            editurl: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/read"; ?>',
            caption: "Daftar BPHTB"

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

    function PopupCenter(id){
        alert(id);
    }

    function openInNewTab(url) {
        // window.open("../report/cetak_rep_lap_harian_bdhr.php?tgl_penerimaan='" + tgl_penerimaan + "'&kabid=T"+ "&kode_bank="+kode_bank, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
        window.open(url, 'No Payment', 'left=0,top=0,width=500,height=500,toolbar=no,scrollbars=yes,resizable=yes');
      // win.focus();
    }

</script>