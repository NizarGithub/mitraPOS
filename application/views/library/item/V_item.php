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
                            <!-- <div class="portlet light portlet-fit portlet-datatable bordered"> -->
                                
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
                                              <th> Nama </th>
                                              <th> Kategori </th>
                                              <th> Status </th>
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
                            <!-- <div class="portlet light portlet-fit portlet-datatable bordered"> -->
                                
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
                                        <input type="hidden" id="url" value="Library/Item/postData/">
                                        <input type="hidden" name="kode" readonly />

                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nama
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="item_nama" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4">Kategori
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control select2" id="kategori_id" name="kategori_id" aria-required="true" aria-describedby="select-error" required>
                                                        <option id="kategori-0" value="0" selected> Tidak Dikategorikan </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group last" style="margin: 20px 0 !important;">
                                            <label class="control-label">VARIANT</label>
                                        </div>
                                        <hr>

                                        <input type="text" class="hidden" name="jml_detail" id="jml_detail" value="0" />
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column table-scroll" id="default-table2">
                                            <tbody id="tableTbody">
                                                <tr>
                                                    <td width="50%">
                                                        <input type="text" class="form-control money" id="itemdet_harga1" name="itemdet_harga[]" placeholder="Harga" required />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" id="itemdet_sku1" name="itemdet_sku[]" placeholder="SKU" required />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="form-group">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="button" id="btnAddDetail" class="btn btn-primary">
                                                    Add Variant
                                                </button>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group last" class="form-group last" style="margin: 20px 0 !important;">
                                            <label class="control-label">INVENTORY</label>
                                        </div>
                                        <hr>

                                        <table class="table table-striped table-bordered table-hover table-checkable order-column table-scroll" id="default-table3">
                                            <thead>
                                                <tr>
                                                    <th> Variant </th>
                                                    <th> Track Stock </th>
                                                    <th> Alert Stock </th>
                                                    <th> Alert at </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableTbody2">
                                                <tr>
                                                    <td width="50%">
                                                        <input type="text" class="form-control" id="itemdet_namatemp1" name="itemdet_namatemp[]" readonly />
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="hidden" id="itemdet_istrack_stock1" name="itemdet_istrack_stock[]" value="n" readonly />
                                                        <label class="mt-checkbox mt-checkbox-outline">
                                                            <input type="checkbox" id="itemdet_istrack_stocktemp1" name="itemdet_istrack_stocktemp[]" onclick="checkTrack(1)">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="hidden" id="itemdet_islimit_alert1" name="itemdet_islimit_alert[]" value="n" readonly />
                                                        <label class="mt-checkbox mt-checkbox-outline">
                                                            <input type="checkbox" id="itemdet_islimit_alerttemp1" name="itemdet_islimit_alerttemp[]" onclick="checkAlert(1)">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control num2" id="itemdet_limit1" name="itemdet_limit[]" placeholder="Limit" value="0" required />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <hr>

                                        <div class="form-group">
                                            <label class="control-label col-md-4">Outlet
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control select2" id="item_outlet" name="item_outlet" aria-required="true" aria-describedby="select-error" required>
                                                        <option id="outlet-0" value="0" selected> Semua Outlet </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4">Keterangan
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="item_keterangan"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4">Status
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control select2" name="item_status_aktif" aria-required="true" aria-describedby="select-error" required>
                                                        <option id="aktif" value="y" selected> Aktif </option>
                                                        <option id="nonaktif" value="n"> Non Aktif </option>
                                                    </select>
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
                searchKategori();
                searchOutlet();
                jmlItemDetail = 0;

                $("#formAdd").submit(function(event){
                    actionData();
                    reset();
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
                    $("#tableTbody").empty();
                    $("#tableTbody2").empty();
                    $("#tableTbody").append(' \
                        <tr> \
                            <td width="50%"> \
                                <input type="hidden" id="itemdet_id1" name="itemdet_id[]" readonly /> \
                                <input type="text" class="form-control money" id="itemdet_harga1" name="itemdet_harga[]" placeholder="Harga" required /> \
                            </td> \
                            <td> \
                                <input type="text" class="form-control" id="itemdet_sku1" name="itemdet_sku[]" placeholder="SKU" required /> \
                            </td> \
                        </tr> \
                    ');
                    $("#tableTbody2").append(' \
                        <tr id="detail2'+jmlItemDetail+'"> \
                            <td width="50%"> \
                                <input type="text" class="form-control" id="itemdet_namatemp1" name="itemdet_namatemp[]" readonly /> \
                            </td> \
                            <td class="text-center"> \
                                <input type="text" class="hidden" id="itemdet_istrack_stock1" name="itemdet_istrack_stock[]" value="n" readonly /> \
                                <label class="mt-checkbox mt-checkbox-outline"> \
                                    <input type="checkbox" id="itemdet_istrack_stocktemp1" name="itemdet_istrack_stocktemp[]" onclick="checkTrack(1)"> \
                                    <span></span> \
                                </label> \
                            </td> \
                            <td class="text-center"> \
                                <input type="text" class="hidden" id="itemdet_islimit_alert1" name="itemdet_islimit_alert[]" value="n" readonly /> \
                                <label class="mt-checkbox mt-checkbox-outline"> \
                                    <input type="checkbox" id="itemdet_islimit_alerttemp1" name="itemdet_islimit_alerttemp[]" onclick="checkAlert(1)"> \
                                    <span></span> \
                                </label> \
                            </td> \
                            <td> \
                                <input type="text" class="form-control num2" id="itemdet_limit1" name="itemdet_limit[]" placeholder="Limit" value="0" required /> \
                            </td> \
                        </tr> \
                    ');
                    $('.money').number( true, 2, '.', ',' );
                    $('.money').css('text-align', 'right');
                    $('.num2').number( true, 2, '.', ',' );
                    $('.num2').css('text-align', 'right');
                });                

                $("#modalAdd-btn").click(function(){
                    reset();
                    flag = $("#form-open").val();
                    if (flag == 0) {
                        $("#table-data").removeClass("col-md-12");
                        $("#table-data").addClass("col-md-6");
                        $("#form-data").removeClass("hidden");
                        $("#form-open").val(1);
                    }
                    jmlItemDetail = 0;
                    $("#jml_detail").val(0);
                    $("#tableTbody").empty();
                    $("#tableTbody2").empty();
                    $("#tableTbody").append(' \
                        <tr> \
                            <td width="50%"> \
                                <input type="hidden" id="itemdet_id1" name="itemdet_id[]" readonly /> \
                                <input type="text" class="form-control money" id="itemdet_harga1" name="itemdet_harga[]" placeholder="Harga" required /> \
                            </td> \
                            <td> \
                                <input type="text" class="form-control" id="itemdet_sku1" name="itemdet_sku[]" placeholder="SKU" required /> \
                            </td> \
                        </tr> \
                    ');
                    $("#tableTbody2").append(' \
                        <tr id="detail2'+jmlItemDetail+'"> \
                            <td width="50%"> \
                                <input type="text" class="form-control" id="itemdet_namatemp1" name="itemdet_namatemp[]" readonly /> \
                            </td> \
                            <td class="text-center"> \
                                <input type="text" class="hidden" id="itemdet_istrack_stock1" name="itemdet_istrack_stock[]" value="n" readonly /> \
                                <label class="mt-checkbox mt-checkbox-outline"> \
                                    <input type="checkbox" id="itemdet_istrack_stocktemp1" name="itemdet_istrack_stocktemp[]" onclick="checkTrack(1)"> \
                                    <span></span> \
                                </label> \
                            </td> \
                            <td class="text-center"> \
                                <input type="text" class="hidden" id="itemdet_islimit_alert1" name="itemdet_islimit_alert[]" value="n" readonly /> \
                                <label class="mt-checkbox mt-checkbox-outline"> \
                                    <input type="checkbox" id="itemdet_islimit_alerttemp1" name="itemdet_islimit_alerttemp[]" onclick="checkAlert(1)"> \
                                    <span></span> \
                                </label> \
                            </td> \
                            <td> \
                                <input type="text" class="form-control num2" id="itemdet_limit1" name="itemdet_limit[]" placeholder="Limit" value="0" required /> \
                            </td> \
                        </tr> \
                    ');
                    $('.money').number( true, 2, '.', ',' );
                    $('.money').css('text-align', 'right');
                    $('.num2').number( true, 2, '.', ',' );
                    $('.num2').css('text-align', 'right');
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
                    $("#tableTbody").empty();
                    $("#tableTbody2").empty();
                    $("#tableTbody").append(' \
                        <tr> \
                            <td width="50%"> \
                                <input type="hidden" id="itemdet_id1" name="itemdet_id[]" readonly /> \
                                <input type="text" class="form-control money" id="itemdet_harga1" name="itemdet_harga[]" placeholder="Harga" required /> \
                            </td> \
                            <td> \
                                <input type="text" class="form-control" id="itemdet_sku1" name="itemdet_sku[]" placeholder="SKU" required /> \
                            </td> \
                        </tr> \
                    ');
                    $("#tableTbody2").append(' \
                        <tr id="detail2'+jmlItemDetail+'"> \
                            <td width="50%"> \
                                <input type="text" class="form-control" id="itemdet_namatemp1" name="itemdet_namatemp[]" readonly /> \
                            </td> \
                            <td class="text-center"> \
                                <input type="text" class="hidden" id="itemdet_istrack_stock1" name="itemdet_istrack_stock[]" value="n" readonly /> \
                                <label class="mt-checkbox mt-checkbox-outline"> \
                                    <input type="checkbox" id="itemdet_istrack_stocktemp1" name="itemdet_istrack_stocktemp[]" onclick="checkTrack(1)"> \
                                    <span></span> \
                                </label> \
                            </td> \
                            <td class="text-center"> \
                                <input type="text" class="hidden" id="itemdet_islimit_alert1" name="itemdet_islimit_alert[]" value="n" readonly /> \
                                <label class="mt-checkbox mt-checkbox-outline"> \
                                    <input type="checkbox" id="itemdet_islimit_alerttemp1" name="itemdet_islimit_alerttemp[]" onclick="checkAlert(1)"> \
                                    <span></span> \
                                </label> \
                            </td> \
                            <td> \
                                <input type="text" class="form-control num2" id="itemdet_limit1" name="itemdet_limit[]" placeholder="Limit" value="0" required /> \
                            </td> \
                        </tr> \
                    ');
                    $('.money').number( true, 2, '.', ',' );
                    $('.money').css('text-align', 'right');
                    $('.num2').number( true, 2, '.', ',' );
                    $('.num2').css('text-align', 'right');
                });

                $("#btnAddDetail").click(function(){
                    itemDetail = $("#jml_detail").val();
                    if (itemDetail == 0) {
                        $("#tableTbody").empty();
                        $("#tableTbody2").empty();
                        $("#jml_detail").val(1);
                    // } else {
                    //     $("#jml_detail").val(0);
                    }
                    
                    itemDetail = $("#jml_detail").val();
                    console.log(itemDetail);
                    if (itemDetail == 1) {
                        jmlItemDetail++;
                        if (jmlItemDetail == 1) {
                            var button = '';
                        } else {
                            var button = '\
                            <button class="btn btn-default" type="button" title="Remove Detail" onclick="removeItemDetail('+jmlItemDetail+')">\
                                <i class="fa fa-ban" aria-hidden="true"></i> \
                            </button>';
                        }
                        $("#tableTbody").append(' \
                            <tr id="detail'+jmlItemDetail+'"> \
                                <td width="30%"> \
                                    <input type="hidden" id="itemdet_id'+jmlItemDetail+'" name="itemdet_id[]" readonly /> \
                                    <input type="text" class="form-control" id="itemdet_nama'+jmlItemDetail+'" name="itemdet_nama[]" placeholder="Nama" onchange="copyName('+jmlItemDetail+')" required /> \
                                </td> \
                                <td> \
                                    <input type="text" class="form-control money" id="itemdet_harga'+jmlItemDetail+'" name="itemdet_harga[]" placeholder="Harga" required /> \
                                </td> \
                                <td> \
                                    <input type="text" class="form-control" id="itemdet_sku'+jmlItemDetail+'" name="itemdet_sku[]" placeholder="SKU" required /> \
                                </td> \
                                <td width="10%"class="text-center"> \
                                    '+button+'\
                                </td> \
                            </tr> \
                        ');
                        $("#tableTbody2").append(' \
                            <tr id="detail2'+jmlItemDetail+'"> \
                                <td width="30%"> \
                                    <input type="text" class="form-control" id="itemdet_namatemp'+jmlItemDetail+'" name="itemdet_namatemp[]" readonly /> \
                                </td> \
                                <td class="text-center"> \
                                    <input type="text" class="hidden" id="itemdet_istrack_stock'+jmlItemDetail+'" name="itemdet_istrack_stock[]" value="n" readonly /> \
                                    <label class="mt-checkbox mt-checkbox-outline"> \
                                        <input type="checkbox" id="itemdet_istrack_stocktemp'+jmlItemDetail+'" name="itemdet_istrack_stocktemp[]" onclick="checkTrack('+jmlItemDetail+')"> \
                                        <span></span> \
                                    </label> \
                                </td> \
                                <td class="text-center"> \
                                    <input type="text" class="hidden" id="itemdet_islimit_alert'+jmlItemDetail+'" name="itemdet_islimit_alert[]" value="n" readonly /> \
                                    <label class="mt-checkbox mt-checkbox-outline"> \
                                        <input type="checkbox" id="itemdet_islimit_alerttemp'+jmlItemDetail+'" name="itemdet_islimit_alerttemp[]" onclick="checkAlert('+jmlItemDetail+')"> \
                                        <span></span> \
                                    </label> \
                                </td> \
                                <td> \
                                    <input type="text" class="form-control num2" id="itemdet_limit'+jmlItemDetail+'" name="itemdet_limit[]" placeholder="Limit" value="0" required /> \
                                </td> \
                            </tr> \
                        ');
                        $('.money').number( true, 2, '.', ',' );
                        $('.money').css('text-align', 'right');
                        $('.num2').number( true, 2, '.', ',' );
                        $('.num2').css('text-align', 'right');
                    }
                });

            })

            function searchData() { 
                $('#default-table').DataTable({
                    destroy: true,
                    "processing": true,
                    "serverSide": true,
                    ajax: {
                      url: '<?php echo base_url();?>Library/Item/loadData/'
                    },
                    "columns": [
                      {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},
                      {"name": "item_nama"},
                      {"name": "kategori_nama"},
                      {"name": "item_status_aktif"},
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
                        [1, "asc"]
                    ],
                    "iDisplayLength": 10
                });
            }

            function searchKategori() {                
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Library/Kategori/loadDataSelect/2',
                  dataType : "json",
                  success:function(data){
                    
                    for(var i=0; i<data.items.length;i++){
                        $('#kategori_id').append('<option id="kategori-'+data.items[i].id+'" value="'+data.items[i].id+'"> '+data.items[i].text+' </option>');
                    }

                  }

                });                
            }

            function searchOutlet() {                
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Library/Outlet/loadDataSelect/2',
                  dataType : "json",
                  success:function(data){
                    
                    for(var i=0; i<data.items.length;i++){
                        $('#item_outlet').append('<option id="outlet-'+data.items[i].id+'" value="'+data.items[i].id+'"> '+data.items[i].text+' </option>');
                    }

                  }

                });                
            }

            function removeItemDetail(idx) {
                var parent = document.getElementById("tableTbody");
                var parent2 = document.getElementById("tableTbody2");
                for (var i = 1; i <= jmlItemDetail; i++) {
                    if (i >= idx && i < jmlItemDetail) {
                        document.getElementById("itemdet_id"+i).value = document.getElementById("itemdet_id"+(i+1)).value;
                        document.getElementById("itemdet_nama"+i).value = document.getElementById("itemdet_nama"+(i+1)).value;
                        document.getElementById("itemdet_harga"+i).value = document.getElementById("itemdet_harga"+(i+1)).value;
                        document.getElementById("itemdet_sku"+i).value = document.getElementById("itemdet_sku"+(i+1)).value;
                        document.getElementById("itemdet_namatemp"+i).value = document.getElementById("itemdet_namatemp"+(i+1)).value;
                        document.getElementById("itemdet_limit"+i).value = document.getElementById("itemdet_limit"+(i+1)).value;
                        document.getElementById("itemdet_istrack_stock"+i).value = document.getElementById("itemdet_istrack_stock"+(i+1)).value;
                        document.getElementById("itemdet_islimit_alert"+i).value = document.getElementById("itemdet_islimit_alert"+(i+1)).value;
                        if (document.getElementById("itemdet_istrack_stocktemp"+(i+1)).checked == true) {
                            document.getElementById("itemdet_istrack_stocktemp"+i).checked = true;
                        } else {
                            document.getElementById("itemdet_istrack_stocktemp"+i).checked = false;
                        }
                        if (document.getElementById("itemdet_islimit_alerttemp"+(i+1)).checked == true) {
                            document.getElementById("itemdet_islimit_alerttemp"+i).checked = true;
                        } else {
                            document.getElementById("itemdet_islimit_alerttemp"+i).checked = false;
                        }
                    };
                };
                for (var i = 1; i <= jmlItemDetail; i++) {
                    if (i == jmlItemDetail) {
                        var child = document.getElementById("detail"+i);
                        parent.removeChild(child);
                    };
                    if (i == jmlItemDetail) {
                        var child2 = document.getElementById("detail2"+i);
                        parent2.removeChild(child2);
                    };
                };
                jmlItemDetail--;
                if (jmlItemDetail == 0) {
                    $("#jml_detail").val(0);
                    $("#tableTbody").empty();
                    $("#tableTbody2").empty();
                    $("#tableTbody").append(' \
                        <tr> \
                            <td width="50%"> \
                                <input type="hidden" id="itemdet_id1" name="itemdet_id[]" readonly /> \
                                <input type="text" class="form-control money" id="itemdet_harga1" name="itemdet_harga[]" placeholder="Harga" required /> \
                            </td> \
                            <td> \
                                <input type="text" class="form-control" id="itemdet_sku1" name="itemdet_sku[]" placeholder="SKU" required /> \
                            </td> \
                        </tr> \
                    ');
                    $("#tableTbody2").append(' \
                        <tr> \
                            <td width="50%"> \
                                <input type="text" class="form-control" id="itemdet_namatemp1" name="itemdet_namatemp[]" readonly /> \
                            </td> \
                            <td class="text-center"> \
                                <input type="text" class="hidden" id="itemdet_istrack_stock1" name="itemdet_istrack_stock[]" value="n" readonly /> \
                                <label class="mt-checkbox mt-checkbox-outline"> \
                                    <input type="checkbox" id="itemdet_istrack_stocktemp1" name="itemdet_istrack_stocktemp[]" onclick="checkTrack(1)"> \
                                    <span></span> \
                                </label> \
                            </td> \
                            <td class="text-center"> \
                                <input type="text" class="hidden" id="itemdet_islimit_alert1" name="itemdet_islimit_alert[]" value="n" readonly /> \
                                <label class="mt-checkbox mt-checkbox-outline"> \
                                    <input type="checkbox" id="itemdet_islimit_alerttemp1" name="itemdet_islimit_alerttemp[]" onclick="checkAlert(1)"> \
                                    <span></span> \
                                </label> \
                            </td> \
                            <td> \
                                <input type="text" class="form-control num2" id="itemdet_limit1" name="itemdet_limit[]" placeholder="Limit" value="0" required /> \
                            </td> \
                        </tr> \
                    ');
                }
                $('.money').number( true, 2, '.', ',' );
                $('.money').css('text-align', 'right');
                $('.num2').number( true, 2, '.', ',' );
                $('.num2').css('text-align', 'right');
            }

            function copyName(idx) {
                document.getElementById("itemdet_namatemp"+idx).value = document.getElementById("itemdet_nama"+idx).value;
            }

            function checkTrack(idx) {
                if (document.getElementById("itemdet_istrack_stocktemp"+idx).checked == true) {
                    document.getElementById("itemdet_istrack_stock"+idx).value = 'y';
                } else {
                    document.getElementById("itemdet_istrack_stock"+idx).value = 'n';
                }
            }

            function checkAlert(idx) {
                if (document.getElementById("itemdet_islimit_alerttemp"+idx).checked == true) {
                    document.getElementById("itemdet_islimit_alert"+idx).value = 'y';
                } else {
                    document.getElementById("itemdet_islimit_alert"+idx).value = 'n';
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
                    url  : '<?php echo base_url();?>Library/Item/loadDataWhere/',
                    data : "id="+id,
                    dataType : "json",
                    success:function(data){
                        for(var i=0; i<data.val.length;i++){
                            document.getElementsByName("kode")[0].value = data.val[i].kode;
                            document.getElementsByName("item_nama")[0].value = data.val[i].item_nama;
                            if (document.getElementById('outlet-'+data.val[i].item_outlet)) {
                                document.getElementById('outlet-'+data.val[i].item_outlet).selected = true;
                            }
                            $('#item_outlet').select2();
                            if (document.getElementById('kategori-'+data.val[i].kategori_id)) {
                                document.getElementById('kategori-'+data.val[i].kategori_id).selected = true;
                            }
                            $('#kategori_id').select2();
                            document.getElementsByName("item_keterangan")[0].value = data.val[i].item_keterangan;
                            if (data.val[i].item_status_aktif == 'y') {
                                document.getElementById('aktif').selected = true;
                            } else if (data.val[i].item_status_aktif == 'n') {
                                document.getElementById('nonaktif').selected = true;
                            }
                        }
                        
                        $("#tableTbody").empty();
                        $("#tableTbody2").empty();

                        if (data.val2.length == 0) {
                            $("#jml_detail").val(0);
                            $("#tableTbody").empty();
                            $("#tableTbody2").empty();
                            $("#tableTbody").append(' \
                                <tr> \
                                    <td width="50%"> \
                                        <input type="hidden" id="itemdet_id1" name="itemdet_id[]" readonly /> \
                                        <input type="text" class="form-control money" id="itemdet_harga1" name="itemdet_harga[]" placeholder="Harga" required /> \
                                    </td> \
                                    <td> \
                                        <input type="text" class="form-control" id="itemdet_sku1" name="itemdet_sku[]" placeholder="SKU" required /> \
                                    </td> \
                                </tr> \
                            ');
                            $("#tableTbody2").append(' \
                                <tr> \
                                    <td width="50%"> \
                                        <input type="text" class="form-control" id="itemdet_namatemp1" name="itemdet_namatemp[]" readonly /> \
                                    </td> \
                                    <td class="text-center"> \
                                        <input type="text" class="hidden" id="itemdet_istrack_stock1" name="itemdet_istrack_stock[]" value="n" readonly /> \
                                        <label class="mt-checkbox mt-checkbox-outline"> \
                                            <input type="checkbox" id="itemdet_istrack_stocktemp1" name="itemdet_istrack_stocktemp[]" onclick="checkTrack(1)"> \
                                            <span></span> \
                                        </label> \
                                    </td> \
                                    <td class="text-center"> \
                                        <input type="text" class="hidden" id="itemdet_islimit_alert1" name="itemdet_islimit_alert[]" value="n" readonly /> \
                                        <label class="mt-checkbox mt-checkbox-outline"> \
                                            <input type="checkbox" id="itemdet_islimit_alerttemp1" name="itemdet_islimit_alerttemp[]" onclick="checkAlert(1)"> \
                                            <span></span> \
                                        </label> \
                                    </td> \
                                    <td> \
                                        <input type="text" class="form-control num2" id="itemdet_limit1" name="itemdet_limit[]" placeholder="Limit" value="0" required /> \
                                    </td> \
                                </tr> \
                            ');
                            $('.money').number( true, 2, '.', ',' );
                            $('.money').css('text-align', 'right');
                            $('.num2').number( true, 2, '.', ',' );
                            $('.num2').css('text-align', 'right');
                        }

                        for(var i=0; i<data.val2.length;i++){
                            jmlItemDetail++;

                            if (data.val2[i].itemdet_istrack_stock == 'y') {
                                var checked1 = 'checked';
                            } else {
                                var checked1 = '';
                            }

                            if (data.val2[i].itemdet_islimit_alert == 'y') {
                                var checked2 = 'checked';
                            } else {
                                var checked2 = '';
                            }

                            if (data.val2.length > 1) {
                                $("#jml_detail").val(1);
                                if (i == 0) {
                                    var button = '';
                                } else {
                                    var button = ' \
                                    <button class="btn btn-default" type="button" title="Remove Detail" onclick="removeItemDetail('+jmlItemDetail+')">\
                                        <i class="fa fa-ban" aria-hidden="true"></i> \
                                    </button>';
                                }
                                $("#tableTbody").append(' \
                                    <tr id="detail'+jmlItemDetail+'"> \
                                        <td width="30%"> \
                                            <input type="hidden" id="itemdet_id'+jmlItemDetail+'" name="itemdet_id[]" value="'+data.val2[i].itemdet_id+'" readonly /> \
                                            <input type="text" class="form-control" id="itemdet_nama'+jmlItemDetail+'" name="itemdet_nama[]" placeholder="Nama" onchange="copyName('+jmlItemDetail+')" value="'+data.val2[i].itemdet_nama+'" required /> \
                                        </td> \
                                        <td> \
                                            <input type="text" class="form-control money" id="itemdet_harga'+jmlItemDetail+'" name="itemdet_harga[]" placeholder="Harga" value="'+data.val2[i].itemdet_harga+'" required /> \
                                        </td> \
                                        <td> \
                                            <input type="text" class="form-control" id="itemdet_sku'+jmlItemDetail+'" name="itemdet_sku[]" placeholder="SKU" value="'+data.val2[i].itemdet_sku+'" required /> \
                                        </td> \
                                        <td width="10%"class="text-center"> \
                                            '+button+'\
                                        </td> \
                                    </tr> \
                                ');
                                $("#tableTbody2").append(' \
                                    <tr id="detail2'+jmlItemDetail+'"> \
                                        <td width="30%"> \
                                            <input type="text" class="form-control" id="itemdet_namatemp'+jmlItemDetail+'" name="itemdet_namatemp[]" value="'+data.val2[i].itemdet_nama+'" readonly /> \
                                        </td> \
                                        <td class="text-center"> \
                                            <input type="text" class="hidden" id="itemdet_istrack_stock'+jmlItemDetail+'" name="itemdet_istrack_stock[]" value="'+data.val2[i].itemdet_istrack_stock+'" readonly /> \
                                            <label class="mt-checkbox mt-checkbox-outline"> \
                                                <input type="checkbox" id="itemdet_istrack_stocktemp'+jmlItemDetail+'" name="itemdet_istrack_stocktemp[]" onclick="checkTrack('+jmlItemDetail+')" '+checked1+'> \
                                                <span></span> \
                                            </label> \
                                        </td> \
                                        <td class="text-center"> \
                                            <input type="text" class="hidden" id="itemdet_islimit_alert'+jmlItemDetail+'" name="itemdet_islimit_alert[]" value="'+data.val2[i].itemdet_islimit_alert+'" readonly /> \
                                            <label class="mt-checkbox mt-checkbox-outline"> \
                                                <input type="checkbox" id="itemdet_islimit_alerttemp'+jmlItemDetail+'" name="itemdet_islimit_alerttemp[]" onclick="checkAlert('+jmlItemDetail+')" '+checked2+'> \
                                                <span></span> \
                                            </label> \
                                        </td> \
                                        <td> \
                                            <input type="text" class="form-control num2" id="itemdet_limit'+jmlItemDetail+'" name="itemdet_limit[]" placeholder="Limit" value="'+data.val2[i].itemdet_limit+'" required /> \
                                        </td> \
                                    </tr> \
                                ');
                            } else {
                                $("#jml_detail").val(0);
                                $("#tableTbody").append(' \
                                    <tr> \
                                        <td width="50%"> \
                                            <input type="hidden" id="itemdet_id1" name="itemdet_id[]" value="'+data.val2[i].itemdet_id+'" readonly /> \
                                            <input type="text" class="form-control money" id="itemdet_harga1" name="itemdet_harga[]" placeholder="Harga" value="'+data.val2[i].itemdet_harga+'" required /> \
                                        </td> \
                                        <td> \
                                            <input type="text" class="form-control" id="itemdet_sku1" name="itemdet_sku[]" placeholder="SKU" value="'+data.val2[i].itemdet_sku+'" required /> \
                                        </td> \
                                    </tr> \
                                ');
                                $("#tableTbody2").append(' \
                                    <tr> \
                                        <td width="50%"> \
                                            <input type="text" class="form-control" id="itemdet_namatemp1" name="itemdet_namatemp[]" readonly /> \
                                        </td> \
                                        <td class="text-center"> \
                                            <input type="text" class="hidden" id="itemdet_istrack_stock1" name="itemdet_istrack_stock[]" value="'+data.val2[i].itemdet_istrack_stock+'" readonly /> \
                                            <label class="mt-checkbox mt-checkbox-outline"> \
                                                <input type="checkbox" id="itemdet_istrack_stocktemp1" name="itemdet_istrack_stocktemp[]" onclick="checkTrack('+jmlItemDetail+')" '+checked1+'> \
                                                <span></span> \
                                            </label> \
                                        </td> \
                                        <td class="text-center"> \
                                            <input type="text" class="hidden" id="itemdet_islimit_alert1" name="itemdet_islimit_alert[]" value="'+data.val2[i].itemdet_islimit_alert+'" readonly /> \
                                            <label class="mt-checkbox mt-checkbox-outline"> \
                                                <input type="checkbox" id="itemdet_islimit_alerttemp1" name="itemdet_islimit_alerttemp[]" onclick="checkAlert('+jmlItemDetail+')" '+checked2+'> \
                                                <span></span> \
                                            </label> \
                                        </td> \
                                        <td> \
                                            <input type="text" class="form-control num2" id="itemdet_limit1" name="itemdet_limit[]" placeholder="Limit" value="'+data.val2[i].itemdet_limit+'" required /> \
                                        </td> \
                                    </tr> \
                                ');
                            }
                        }
                        $('.money').number( true, 2, '.', ',' );
                        $('.money').css('text-align', 'right');
                        $('.num2').number( true, 2, '.', ',' );
                        $('.num2').css('text-align', 'right');
                    }
                });
            }

            function setNonaktif(id) {
              nonaktifData('Library/Item/nonaktifData', id);
            }

            function setAktif(id) {
              aktifData('Library/Item/aktifData', id);
            }

        </script>

    </body>

</html>