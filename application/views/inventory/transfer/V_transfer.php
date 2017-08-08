        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            
            <!-- BEGIN PAGE HEAD-->
            <!-- <div class="page-head">
                <div class="container"> -->
                    <!-- BEGIN PAGE TITLE -->
                    <!-- <div class="page-title">
                        <h1>Blank Page </h1>
                    </div> -->
                    <!-- END PAGE TITLE -->
                <!-- </div>
            </div> -->
            <!-- END PAGE HEAD-->

            <!-- BEGIN PAGE CONTENT BODY -->
            <div class="page-content">
                <div class="container">
                    
                    <!-- BEGIN PAGE BREADCRUMBS -->
                    <!-- <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Layouts</span>
                        </li>
                    </ul> -->
                    <!-- END PAGE BREADCRUMBS -->

                    <!-- BEGIN PAGE CONTENT INNER -->
                    <div class="page-content-inner">

                        <div class="row">
                            <input type="hidden" id="form-open" value="0">

                            <div class="col-md-12" id="table-data">
                            <div class="portlet light ">
                                
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-list font-dark"></i> &nbsp;&nbsp;
                                        <span class="caption-subject font-dark sbold uppercase">Data <?php if(isset($title_page)) echo $title_page;?></span>
                                    </div>
                                </div>

                                <div class="portlet-body">

                                  <div class="table-toolbar">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="btn-group">
                                                <?php
                                                    if($priv_add == 'y')
                                                    {
                                                        echo '
                                                        <button id="modalAdd-btn" class="btn sbold blue-ebonyclay">
                                                            <i class="icon-plus"></i>&nbsp; Tambah Data
                                                        </button>';
                                                    }
                                                ?>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <table class="table table-striped table-bordered table-hover table-checkable order-column table-scroll" id="default-table">
                                      <thead>
                                          <tr>
                                              <th> No </th>
                                              <th> Tanggal </th>
                                              <th> Dari Outlet </th>
                                              <th> Ke Outlet </th>
                                              <th> Keterangan </th>
                                              <th> Action </th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                  </table>

                                </div>

                            </div>
                            </div>

                            <div class="col-md-6 hidden" id="form-data">
                            <div class="portlet light bordered">
                                
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-note font-dark"></i> &nbsp;&nbsp;
                                        <span class="caption-subject font-dark sbold uppercase">Form <?php if(isset($title_page)) echo $title_page;?></span>
                                    </div>
                                </div>

                                <div class="portlet-body">

                                  <form action="#" id="formAdd" class="form-horizontal" method="post">
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                        <input type="hidden" id="url" value="Inventory/Transfer/postData/">
                                        <input type="hidden" name="kode" readonly />

                                        <div class="form-group">
                                            <label class="control-label col-md-4">Dari Outlet
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control select2" id="outlet_pengirim_id" name="outlet_pengirim_id" aria-required="true" aria-describedby="select-error" onchange="resetTransfer()" required>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4">Ke Outlet
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control select2" id="outlet_penerima_id" name="outlet_penerima_id" aria-required="true" aria-describedby="select-error" required>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group last" style="margin: 20px 0 !important;">
                                            <label class="control-label">TRANSFER STOK</label>
                                        </div>
                                        <hr>

                                        <div class="form-group" id="groupTambah">
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control select2" id="item_id" name="item_id" aria-required="true" aria-describedby="select-error" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <button type="button" id="btnAddDetail" class="btn btn-primary">
                                                    Add Items
                                                </button>
                                            </div>
                                        </div>

                                        <input type="text" class="hidden" name="jml_detail" id="jml_detail" value="0" />
                                        <div id="tableDiv"></div>

                                        <hr>

                                        <div class="form-group">
                                            <label class="control-label col-md-4">Keterangan
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="transfer_keterangan"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="button" id="batal" class="btn default">Batal</button>
                                                <button type="submit" id="simpan" class="btn green-jungle">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                </div>

                            </div>
                            </div>

                        </div>

                    </div>
                    <!-- END PAGE CONTENT INNER -->
                </div>
            </div>
            <!-- END PAGE CONTENT BODY -->
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->

        <?php $this->load->view('layout/V_footer');?>

        <script>
            
            $(document).ready(function()
            {
                searchData();
                rules();
                searchOutlet();

                jmlItemDetail = 0;
                searchItem();

                $("#formAdd").submit(function(event){
                    actionData();
                    reset();
                    searchItem();
                    flag = $("#form-open").val();
                    if (flag == 0) {
                        $("#table-data").removeClass("col-md-12");
                        $("#table-data").addClass("col-md-6");
                        $("#form-data").removeClass("hidden");
                        $("#form-open").val(1);
                    } else {
                        $("#table-data").removeClass("col-md-6");
                        $("#table-data").addClass("col-md-12");
                        $("#form-data").addClass("hidden");
                        $("#form-open").val(0);
                    }
                    return false;
                    jmlItemDetail = 0;
                    $("#jml_detail").val(0);
                    $("#tableDiv").empty();
                    document.getElementById('simpan').disabled = false;
                    document.getElementById('btnAddDetail').disabled = false;
                    document.getElementById('outlet_penerima_id').disabled = false;
                    document.getElementById('outlet_pengirim_id').disabled = false;
                    document.getElementById('item_id').disabled = false;
                    document.getElementsByName('transfer_keterangan')[0].disabled = false;
                    $("#groupTambah").removeClass("hidden");
                });                

                $("#modalAdd-btn").click(function(){
                    reset();
                    searchItem();
                    flag = $("#form-open").val();
                    if (flag == 0) {
                        $("#table-data").removeClass("col-md-12");
                        $("#table-data").addClass("col-md-6");
                        $("#form-data").removeClass("hidden");
                        $("#form-open").val(1);
                    }
                    jmlItemDetail = 0;
                    $("#jml_detail").val(0);
                    $("#tableDiv").empty();
                    document.getElementById('simpan').disabled = false;
                    document.getElementById('btnAddDetail').disabled = false;
                    document.getElementById('outlet_penerima_id').disabled = false;
                    document.getElementById('outlet_pengirim_id').disabled = false;
                    document.getElementById('item_id').disabled = false;
                    document.getElementsByName('transfer_keterangan')[0].disabled = false;
                    $("#groupTambah").removeClass("hidden");
                });

                $("#batal").click(function(){
                    reset();
                    flag = $("#form-open").val();
                    if (flag == 1) {
                        $("#table-data").removeClass("col-md-6");
                        $("#table-data").addClass("col-md-12");
                        $("#form-data").addClass("hidden");
                        $("#form-open").val(0);
                    }
                    jmlItemDetail = 0;
                    $("#jml_detail").val(0);
                    $("#tableDiv").empty();
                    document.getElementById('simpan').disabled = false;
                    document.getElementById('btnAddDetail').disabled = false;
                    document.getElementById('outlet_penerima_id').disabled = false;
                    document.getElementById('outlet_pengirim_id').disabled = false;
                    document.getElementById('item_id').disabled = false;
                    document.getElementsByName('transfer_keterangan')[0].disabled = false;
                    $("#groupTambah").removeClass("hidden");
                });

                $("#btnAddDetail").click(function(){
                    transferDetail = $("#jml_detail").val();
                    if (transferDetail == 0) {
                        $("#tableTbody").empty();
                        $("#tableTbody2").empty();
                        $("#jml_detail").val(1);
                    }
                    
                    transferDetail = $("#jml_detail").val();
                    if (transferDetail == 1) {
                        jmlItemDetail++;
                        $.ajax({
                            type : "GET",
                            url  : '<?php echo base_url();?>Library/Item/loadDataWhere',
                            data : { id : document.getElementById("item_id").value, outletId : document.getElementById("outlet_pengirim_id").value },
                            dataType : "json",
                            success:function(data){
                                $("#tableDiv").append(' \
                                <div id="default-div'+jmlItemDetail+'"> \
                                    <hr> \
                                    <div class="form-group"> \
                                        <div class="col-md-12 text-right"> \
                                            <button class="btn btn-default" type="button" title="Remove Detail" onclick="removeItemDetail('+jmlItemDetail+')"> \
                                                <i class="fa fa-ban" aria-hidden="true"></i> \
                                            </button> \
                                        </div> \
                                    </div> \
                                    <input type="hidden" id="item_id'+jmlItemDetail+'" name="item_id[]" value="'+data.val[0].kode+'"> \
                                </div>');
                                $("#default-div"+jmlItemDetail).append(' \
                                <table class="table table-striped table-bordered table-hover table-checkable order-column table-scroll" id="default-table-detail'+jmlItemDetail+'">\
                                    <tbody id="tableTbody'+jmlItemDetail+'">\
                                    </tbody>\
                                </table>');
                                $("#tableTbody"+jmlItemDetail+"").append(' \
                                    <tr id="detail'+jmlItemDetail+'"> \
                                        <td class="text-center" width="50%"> VARIANT </td> \
                                        <td class="text-center" width="25%"> IN STOCK </td> \
                                        <td class="text-center" width="25%"> QUANTITY </td> \
                                    </tr> \
                                ');                    
                                if (data.val2.length > 1) {
                                    for(var i=0; i<data.val.length;i++){
                                        $("#tableTbody"+jmlItemDetail+"").append(' \
                                            <tr id="detail'+jmlItemDetail+'"> \
                                                <td colspan="3"> \
                                                    <input type="text" class="form-control text-center" id="itemdet_nama_real'+jmlItemDetail+'" name="itemdet_nama_real[]" value="'+data.val[i].item_nama+'" required readonly /> \
                                                </td> \
                                            </tr> \
                                        ');
                                    }
                                    for(var i=0; i<data.val2.length;i++){
                                        $("#tableTbody"+jmlItemDetail+"").append(' \
                                            <tr id="detail'+jmlItemDetail+'"> \
                                                <td width="50%"> \
                                                    <input type="hidden" id="itemdet_id'+jmlItemDetail+''+i+'" name="itemdet_id[]" value="'+data.val2[i].itemdet_id+'"> \
                                                    <input type="text" class="form-control" id="itemdet_nama'+jmlItemDetail+''+i+'" name="itemdet_nama[]" value="'+data.val2[i].itemdet_nama+'" required readonly /> \
                                                </td> \
                                                <td width="25%"> \
                                                    <input type="text" class="form-control num2" id="transferdet_stokawal_pengirim'+jmlItemDetail+''+i+'" name="transferdet_stokawal_pengirim[]" value="'+data.val2[i].stok_jumlah+'" required readonly /> \
                                                </td> \
                                                <td width="25%"> \
                                                    <input type="text" class="form-control num2" id="transferdet_quantity'+jmlItemDetail+''+i+'" name="transferdet_quantity[]" value="0" onchange="checkStokReal('+jmlItemDetail+', '+i+')" required /> \
                                                </td> \
                                            </tr> \
                                        ');
                                        $('.num2').number( true, 2, '.', ',' );
                                        $('.num2').css('text-align', 'right');
                                    }
                                } else {
                                    for(var i=0; i<data.val2.length;i++){
                                        $("#tableTbody"+jmlItemDetail+"").append(' \
                                            <tr id="detail'+jmlItemDetail+'"> \
                                                <td width="50%"> \
                                                    <input type="hidden" id="itemdet_id'+jmlItemDetail+''+i+'" name="itemdet_id[]" value="'+data.val2[i].itemdet_id+'"> \
                                                    <input type="text" class="form-control" id="itemdet_nama'+jmlItemDetail+''+i+'" name="itemdet_nama[]" value="'+data.val[0].item_nama+'" required readonly /> \
                                                </td> \
                                                <td width="25%"> \
                                                    <input type="text" class="form-control num2" id="transferdet_stokawal_pengirim'+jmlItemDetail+''+i+'" name="transferdet_stokawal_pengirim[]" value="'+data.val2[i].stok_jumlah+'" required readonly /> \
                                                </td> \
                                                <td width="25%"> \
                                                    <input type="text" class="form-control num2" id="transferdet_quantity'+jmlItemDetail+''+i+'" name="transferdet_quantity[]" value="0" onchange="checkStokReal('+jmlItemDetail+', '+i+')" required /> \
                                                </td> \
                                            </tr> \
                                        ');
                                        $('.num2').number( true, 2, '.', ',' );
                                        $('.num2').css('text-align', 'right');
                                    }
                                }
                                $("#default-div"+jmlItemDetail).append('<br>');
                                searchItem();
                            }
                        });
                    }
                });

            })

            function searchData() { 
                $('#default-table').DataTable({
                    destroy: true,
                    "processing": true,
                    "serverSide": true,
                    ajax: {
                      url: '<?php echo base_url();?>Inventory/Transfer/loadData/'
                    },
                    "columns": [
                      {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},
                      {"name": "transfer_tanggal"},
                      {"name": "outlet_pengirim_nama"},
                      {"name": "outlet_penerima_nama"},
                      {"name": "transfer_keterangan"},
                      {"name": "action","orderable": false,"searchable": false, "className": "text-center", "width": "15%"}
                    ],
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "No data available in table",
                        "info": "Showing _START_ to _END_ of _TOTAL_ records",
                        "infoEmpty": "No records found",
                        "infoFiltered": "(filtered1 from _MAX_ total records)",
                        "lengthMenu": "Show _MENU_",
                        "search": "Search:",
                        "zeroRecords": "No matching records found",
                        "paginate": {
                            "previous":"Prev",
                            "next": "Next",
                            "last": "Last",
                            "first": "First"
                        }
                    },

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                    "pagingType": "bootstrap_extended",

                    "lengthMenu": [
                        [10, 25, 50, 100],
                        [10, 25, 50, 100] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 10,
                    "columnDefs": [{  // set default column settings
                        'orderable': false,
                        'targets': [0]
                    }, {
                        "searchable": false,
                        "targets": [0]
                    }],
                    "order": [
                        [1, "desc"]
                    ],
                    "iDisplayLength": 10
                });
            }

            function searchOutlet() {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Library/Outlet/loadDataSelect/2',
                  dataType : "json",
                  success:function(data){
                    
                    for(var i=0; i<data.items.length;i++){
                        $('#outlet_pengirim_id').append('<option id="outlet1-'+data.items[i].id+'" value="'+data.items[i].id+'"> '+data.items[i].text+' </option>');
                    }

                    setTimeout(function(){ searchOutlet2(); }, 600);

                  }

                });
            }

            function searchOutlet2() {
                $('#outlet_penerima_id').empty();
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Library/Outlet/loadDataSelect/2',
                  data : { outletId : document.getElementById("outlet_pengirim_id").value },
                  dataType : "json",
                  success:function(data){
                    
                    for(var i=0; i<data.items.length;i++){
                        $('#outlet_penerima_id').append('<option id="outlet2-'+data.items[i].id+'" value="'+data.items[i].id+'"> '+data.items[i].text+' </option>');
                    }

                  }

                });                
            }

            function searchItem() {                
                $('#item_id').empty();
                var itemId = [];
                var itemId_temp = "";
                for (var i = 1; i <= jmlItemDetail; i++) {
                    if (document.getElementById('item_id'+i)) {
                        itemId_temp = document.getElementById('item_id'+i).value;
                        itemId.push(itemId_temp);                       
                    }
                }
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Library/Item/loadDataSelect/2',
                  data : { itemId : itemId },
                  dataType : "json",
                  success:function(data){
                    
                    for(var i=0; i<data.items.length;i++){
                        $('#item_id').append('<option id="item-'+data.items[i].id+'" value="'+data.items[i].id+'"> '+data.items[i].text+' </option>');
                    }
                    if (data.items.length == 0) {
                        document.getElementById("btnAddDetail").disabled = true;
                    } else {
                        document.getElementById("btnAddDetail").disabled = false;
                    }

                  }

                });                
            }

            function removeItemDetail(idx) {
                $("#default-div"+idx).empty();
                searchItem();
            }

            function resetTransfer() {
                for (var i = 1; i <= jmlItemDetail; i++) {
                    $("#default-div"+i).empty();
                }
                searchItem();
                searchOutlet2();
            }

            function checkStokReal(idx1, idx2) {
                stokReal        = parseFloat(document.getElementById('transferdet_stokawal_pengirim'+idx1+''+idx2).value.replace(/\,/g, ""));
                stokTransfer    = parseFloat(document.getElementById('transferdet_quantity'+idx1+''+idx2).value.replace(/\,/g, ""));
                if (stokTransfer > stokReal) {
                    document.getElementById('transferdet_quantity'+idx1+''+idx2).value = stokReal;
                    $('.num2').number( true, 2, '.', ',' );
                    $('.num2').css('text-align', 'right');
                }
            }

            function showForm(id) {
                flag = $("#form-open").val();
                if (flag == 0) {
                    $("#table-data").removeClass("col-md-12");
                    $("#table-data").addClass("col-md-6");
                    $("#form-data").removeClass("hidden");
                    $("#form-open").val(1);
                }
                $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Inventory/Transfer/loadDataWhere/',
                    data : "id="+id,
                    dataType : "json",
                    success:function(data){
                        for(var i=0; i<data.val.length;i++){
                            document.getElementsByName("kode")[0].value = data.val[i].kode;
                            if (document.getElementById('outlet1-'+data.val[i].outlet_pengirim_id)) {
                                document.getElementById('outlet1-'+data.val[i].outlet_pengirim_id).selected = true;
                            }
                            if (document.getElementById('outlet2-'+data.val[i].outlet_penerima_id)) {
                                document.getElementById('outlet2-'+data.val[i].outlet_penerima_id).selected = true;
                            }
                            $('#outlet_pengirim_id').select2();
                            $('#outlet_penerima_id').select2();
                            document.getElementsByName("transfer_keterangan")[0].value = data.val[i].transfer_keterangan;
                            document.getElementById('outlet_pengirim_id').disabled = true;
                            document.getElementById('outlet_penerima_id').disabled = true;
                            document.getElementById('item_id').disabled = true;
                            document.getElementsByName('transfer_keterangan')[0].disabled = true;
                        }
                        
                        $("#tableDiv").empty();

                        for(var i=0; i<data.val2.length;i++){
                            jmlItemDetail++;
                            if (data.val2[i].item_detail.val3[0].flag == 1) {
                                $("#tableDiv").append(' \
                                <div id="default-div'+jmlItemDetail+'"> \
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column table-scroll" id="default-table-detail'+jmlItemDetail+'"> \
                                        <tbody id="tableTbody'+jmlItemDetail+'"> \
                                            <tr id="detail'+jmlItemDetail+'"> \
                                                <td class="text-center" width="50%"> VARIANT </td> \
                                                <td class="text-center" width="25%"> IN STOCK </td> \
                                                <td class="text-center" width="25%"> QUANTITY </td> \
                                            </tr> \
                                            <tr id="detail'+jmlItemDetail+'"> \
                                                <td colspan="3"> \
                                                    '+data.val2[i].item_nama+' \
                                                </td> \
                                            </tr> \
                                        </tbody> \
                                    </table> \
                                </div>');
                                for(var j=0; j<data.val2[i].item_detail.val3.length;j++){
                                    $("#tableTbody"+jmlItemDetail).append(' \
                                    <tr id="detail'+jmlItemDetail+'"> \
                                        <td width="50%"> \
                                            '+data.val2[i].item_detail.val3[j].itemdet_nama+' \
                                        </td> \
                                        <td width="25%" class="text-right"> \
                                            '+data.val2[i].item_detail.val3[j].transferdet_stokawal_pengirim+' \
                                        </td> \
                                        <td width="25%" class="text-right"> \
                                            '+data.val2[i].item_detail.val3[j].transferdet_quantity+' \
                                        </td> \
                                    </tr>');
                                }
                            } else {
                                $("#tableDiv").append(' \
                                <div id="default-div'+jmlItemDetail+'"> \
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column table-scroll" id="default-table-detail'+jmlItemDetail+'"> \
                                        <tbody id="tableTbody'+jmlItemDetail+'"> \
                                            <tr id="detail'+jmlItemDetail+'"> \
                                                <td class="text-center" width="50%"> VARIANT </td> \
                                                <td class="text-center" width="25%"> IN STOCK </td> \
                                                <td class="text-center" width="25%"> QUANTITY </td> \
                                            </tr> \
                                            <tr id="detail'+jmlItemDetail+'"> \
                                                <td width="50%"> \
                                                    '+data.val2[i].item_nama+' \
                                                </td> \
                                                <td width="25%" class="text-right"> \
                                                    '+data.val2[i].item_detail.val3[0].transferdet_stokawal_pengirim+' \
                                                </td> \
                                                <td width="25%" class="text-right"> \
                                                    '+data.val2[i].item_detail.val3[0].transferdet_quantity+' \
                                                </td> \
                                            </tr> \
                                        </tbody> \
                                    </table> \
                                </div>');
                            }
                        }
                        document.getElementById('simpan').disabled = true;
                        document.getElementById('btnAddDetail').disabled = true;
                        $("#groupTambah").addClass("hidden");
                    }
                });
            }

        </script>

    </body>

</html>