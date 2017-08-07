/*
    Custom js was made for global function javascript and jquery.
    First make sure you have lates version of jQuery. Donwload : https://jquery.com/
    Then make sure all the library was include on your project.
    Library list :
    -   jQuery
        Download : https://jquery.com/
    -   Select2
        Download : https://select2.github.io/
    -   Number Format
        Download : https://github.com/customd/jquery-number
    -   Toastr
        Download : https://github.com/CodeSeven/toastr
    -   Sweet Alert
        Download : http://t4t5.github.io/sweetalert/
*/

var $base_url = $("body").data("base_url");

function rules() {

    $(".kode").keydown(function(event) {
        if ( event.keyCode != 32 ) {
            // let it happen, don't do anything
        } else {
            event.preventDefault();
        }
    });


    $(".telp").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
            // Allow: home, end, left, right, down, up
            (event.keyCode >= 35 && event.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
            event.preventDefault();
        }
    });


    $(".num").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
            // Allow: home, end, left, right, down, up
            (event.keyCode >= 35 && event.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
            event.preventDefault();
        }
    });


    $(".decimal").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
            // Allow: home, end, left, right, down, up
            (event.keyCode >= 35 && event.keyCode <= 40) || event.keyCode == 190 ) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
            event.preventDefault();
        }
    });


    $('.reset').on('click', function() {
        // resetValidation();
    });


    $('.select2').select2();

    $('.select2').width('100%');

    /*
        .number() is function for formatting number with jquery. Need library jquery number !!
        Download : https://github.com/customd/jquery-number
    */

    $('.money').number( true, 2, '.', ',' );

    $('.money').css('text-align', 'right');

    $('.num2').number( true, 2, '.', ',' );

    $('.num2').css('text-align', 'right');

    $('.decimal').css('text-align', 'right');
  
  // $('.datepicker').datepicker({
  //       locale: {
  //           format: 'DD/MM/YYYY'
  //       },
  //       "opens": "left",
  //       "drops": "down"
  // });
  // var dateToday = new Date();
  // $('.datepicker-range').daterangepicker({
  //       minDate : dateToday,
  //       locale: {
  //           format: 'DD/MM/YYYY',
  //       },
  //       "opens": "left",
  //       "drops": "down"
  // });
  //   $('.timepicker-default').timepicker({
  //       autoclose: true,
  //       minuteStep: 5
  //   });
  //   $('.datetimepicker').datetimepicker({
  //       format: "dd/mm/yyyy hh:ii"
  //   });
}


// Logout


function doLogout() {
    var $base_url = $("body").data("base_url");
    $.ajax({
        url: $base_url+'Gate/doLogout',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
          if (data.status=='200') {
            /*
                Toastr notification. Need library toastr !!
                Download : https://github.com/CodeSeven/toastr
            */
            toastr["success"]("Your sessions has been deleted", "Sukses", {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "200",
                "timeOut": "5000",
                "extendedTimeOut": "200",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
            setTimeout(function(){
                window.location.href = $base_url+'Login';
            }, 2000);
          }
        }
    });
}



// Custom Validation 
var MyFormValidation = function () {

    // Validation
    var handleValidationCustom = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form = $('#formAdd');
            var error2 = $('.alert-danger', form);
            var success2 = $('.alert-success', form);

            form.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success2.hide();
                    error2.show();
                    App.scrollTo(error2, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");  
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },

                submitHandler: function (form) {
                    success2.show();
                    error2.hide();
                }
            });


    }

    return {
        //main function to initiate the module
        init: function () {

            handleValidationCustom();
            resetValidation();

        }

    };
}();


jQuery(document).ready(function() {   
    if (document.getElementById('formAdd')) {
        MyFormValidation.init();
    }
    
});


function resetValidation() {
    $(".has-success").removeClass("has-success");
    $(".fa-check").removeClass("fa-check");
    $('.alert-success').hide();
    $(".has-error").removeClass("has-error");
    $(".fa-warning").removeClass("fa-warning");
    $('.alert-danger').hide();
}


function reset() {
    $('#formAdd')[0].reset();
    $('.select2 option').prop('selected', function() {
        return this.defaultSelected;
    });
    $('.select2').select2();
}


//ALERT FUNCTION
/*
    Replacement for javascripts alert. Need library sweet alert !!
    Download : http://t4t5.github.io/sweetalert/
*/

function alert_success_save() {
    swal({
        title: "Success!",
        text: "Data telah tersimpan!",
        type: "success",
        confirmButtonClass: "btn-raised btn-success",
        confirmButtonText: "OK",
    });
}


function alert_fail_save() {
    swal({
        title: "Alert!",
        text: "Data gagal tersimpan!",
        type: "error",
        confirmButtonClass: "btn-raised btn-danger",
        confirmButtonText: "OK",
    });
}


function alert_success_delete() {
    swal({
      title: "Success!",
      text: "Data telah dinonaktifkan!",
      type: "success",
      confirmButtonClass: "btn-raised btn-success",
      confirmButtonText: "OK",
    });
}


function alert_fail_delete() {
    swal({
        title: "Alert!",
        text: "Data gagal dinonaktifkan!",
        type: "error",
        confirmButtonClass: "btn-raised btn-danger",
        confirmButtonText: "OK",
    });
}


function alert_success_nonaktif() {
    swal({
      title: "Success!",
      text: "Data telah dinonaktifkan!",
      type: "success",
      confirmButtonClass: "btn-raised btn-success",
      confirmButtonText: "OK",
    });
}


function alert_fail_nonaktif() {
    swal({
        title: "Alert!",
        text: "Data gagal dinonaktifkan!",
        type: "error",
        confirmButtonClass: "btn-raised btn-danger",
        confirmButtonText: "OK",
    });
}


function alert_success_aktif() {
    swal({
      title: "Success!",
      text: "Data telah diaktifkan!",
      type: "success",
      confirmButtonClass: "btn-raised btn-success",
      confirmButtonText: "OK",
    });
}


function alert_fail_aktif() {
    swal({
        title: "Alert!",
        text: "Data gagal diaktifkan!",
        type: "error",
        confirmButtonClass: "btn-raised btn-danger",
        confirmButtonText: "OK",
    });
}


function alert_success_batal() {
    swal({
      title: "Success!",
      text: "Data telah dibatalkan!",
      type: "success",
      confirmButtonClass: "btn-raised btn-success",
      confirmButtonText: "OK",
    });
}


function alert_fail_batal() {
    swal({
        title: "Alert!",
        text: "Data gagal dibatalkan!",
        type: "error",
        confirmButtonClass: "btn-raised btn-danger",
        confirmButtonText: "OK",
    });
}


//END ALERT FUNCTION


// OPEN FORM
/*
    Dinamic open form in moadal bootstrap. Need library bootstrap !!
    Download : http://getbootstrap.com/
*/

function openForm(url_data = null, id_data = null, id_data2 = null) {
    $.ajax({
        type : 'GET',
        url  : $base_url+url_data,
        data : { id : id_data, id2 : id_data2 },
        dataType : "html",
        success:function(data){
            $("#modaladd .modal-body").html();
            $("#modaladd .modal-body").html(data);
            $('#modaladd').modal('show');
            rules();
            $("#formAdd").submit(function(event){

                actionData();

                return false;
            });
            if (id_data) {
                setTimeout(function(){
                    editData(id_data);
                }, 250);
            }
        }
    });
}


function openForm2(url_data = null, id_data = null, id_data2 = null) {
    $.ajax({
        type : 'GET',
        url  : $base_url+url_data,
        data : { id : id_data, id2 : id_data2 },
        dataType : "html",
        success:function(data){
            $("#modaladd .modal-body").html();
            $("#modaladd .modal-body").html(data);
            $('#modaladd').modal('show');
        }
    });
}


// END OPEN FORM

// DATA STATUS

function nonaktifData(url_data = null, id_data = null) {
    swal({
        title: "Apakah anda yakin?",
        text: "Data akan dinonaktifkan !",
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: "btn-raised btn-warning",
        cancelButtonText: "Batal!",
        confirmButtonClass: "btn-raised btn-danger",
        confirmButtonText: "Ya!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
            url  : $base_url+url_data,
            data : { id : id_data },
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.status=='200') {
                    alert_success_nonaktif();
                    searchData();
                } else if (data.status=='204') {
                    alert_fail_nonaktif();
                }
            }
        });
    })
}

function aktifData(url_data = null, id_data = null) {
    swal({
        title: "Apakah anda yakin?",
        text: "Data akan diaktifkan !",
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: "btn-raised btn-warning",
        cancelButtonText: "Batal!",
        confirmButtonClass: "btn-raised btn-danger",
        confirmButtonText: "Ya!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
            url  : $base_url+url_data,
            data : { id : id_data },
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.status=='200') {
                    alert_success_aktif();
                    searchData();
                } else if (data.status=='204') {
                    alert_fail_aktif();
                }
            }
        });
    })
}

// END DATA STATUS


// ACTION FORM
/*
    Form action with ajax, no need reload document.
*/

function actionData(){
    $.ajax({
        type : "POST",
        url  : $base_url+''+$("#url").val(),
        data : $( "#formAdd" ).serialize(),
        dataType : "json",
        success:function(data){
            if(data.status=='200'){
                // $('#modaladd').modal('hide');
                window.scrollTo(0, 0);
                alert_success_save();
                reset();
                resetValidation();
                searchData();
            } else if (data.status=='204') {
                alert_fail_save();
            }
        }
    });
}


function actionDataFile(){
    var formData = new FormData($( "#formAdd" )[0]);
    $.each($("input[type='file']")[0].files, function(i, file) {
        formData.append('file', file);
    });

    $.ajax({
        type : "POST",
        url  : $base_url+''+$("#url").val(),
        data : formData,
        dataType : "json",
        processData: false,
        contentType: false,
        success:function(data){
            if(data.status=='200'){
                $('#modaladd').modal('hide');
                window.scrollTo(0, 0);
                alert_success_save();
                reset();
                resetValidation();
                searchData();
            } else if (data.status=='204') {
                alert_fail_save();
            }
        }
    });
}


function actionData2(){
    $.ajax({
        type : "POST",
        url  : $base_url+''+$("#url").val(),
        data : $( "#formAdd" ).serialize(),
        dataType : "json",
        success:function(data){
            if(data.status=='200'){
                alert_success_save();
                window.location.href = $base_url+''+$("#url_data").val();
            } else if (data.status=='204') {
                alert_fail_save();
            }
        }
    });
}


// END ACTION FORM


// SELECT2 AJAX
/*
    Jquery replacement for select boxes. Need library select2 !!
    Download : https://select2.github.io/
*/

function FormatResult(data) {
    markup = '<div>'+data.text+'</div>';
    return markup;
}


function FormatSelection(data) {
    return data.text;
}


function select2List(idElemen = null, url_data = null, label = null, parameter = null) {
    $(idElemen).select2({
        placeholder: label,
        multiple: false,
        allowClear: true,
        ajax: {
            url: $base_url+url_data,
            dataType: 'json',
            delay: 100,
            cache: true,
            data: function (params) {
                return {
                    q: params.term, // search term
                    parameter: parameter,
                    page: params.page
                };
            },
            processResults: function (data, params) {
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            }
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: FormatResult,
        templateSelection: FormatSelection,
    });
}


function select2MultipleList(idElemen = null, url_data = null, label = null, parameter = null) {
    $(idElemen).select2({
        placeholder: label,
        multiple: true,
        allowClear: true,
        ajax: {
            url: $base_url+url_data,
            dataType: 'json',
            delay: 100,
            cache: true,
            data: function (params) {
                return {
                    q: params.term, // search term
                    parameter: parameter,
                    page: params.page
                };
            },
            processResults: function (data, params) {
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            }
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: FormatResult,
        templateSelection: FormatSelection,
    });
}


// END SELECT 2 AJAX


// NOTIFICATION


function getNotification() {
    $.ajax({
        type : "GET",
        url  : $base_url+'Notifikasi/notificationShow',
        dataType : "json",
        success:function(data){
            
            $("#menu-notifikasi").empty();
            $("#menu-notifikasi-jumlah").empty();

            if(data.status=='200'){

                for(var i = 0; i < data.items.length; i++){
                    $("#menu-notifikasi").append('\
                        <li style="background:'+data.items[i].notif_status+'"> \
                            <a href="'+$base_url+data.items[i].notif_link+'" onclick="javascript:updateNotification('+data.items[i].notif_id+')"> \
                                <span class="image"> \
                                    <img src="'+$base_url+'assets/uploads/user_image/'+data.items[i].notif_image+'" alt="Profile Image" /> \
                                </span> \
                                <span> \
                                    <span> \
                                        '+data.items[i].notif_name+' \
                                    </span> \
                                    <span class="time"> \
                                        '+data.items[i].notif_time+' \
                                    </span> \
                                </span> \
                                <span class="message"> \
                                    '+data.items[i].notif_detail+' \
                                </span> \
                            </a> \
                        </li> \
                    ');
                }

                if (data.notif_jumlah > 0) {
                    $("#menu-notifikasi-jumlah").append(data.notif_jumlah);
                }

            } else if (data.status=='204') {

                $("#menu-notifikasi").append('\
                    <li> \
                        <a> \
                            <span class="message"> \
                                Belum ada pemberitahuan untuk sekarang. \
                            </span> \
                        </a> \
                    </li> \
                ');

            }
        }
    });
}


function getNotificationList() {
    $.ajax({
        type : "GET",
        url  : $base_url+'Notifikasi/notificationList',
        dataType : "json",
        success:function(data){
            if(data.status=='200'){

                for(var i = 0; i < data.items.length; i++){
                    $("#menu-notifikasi-list").append(' \
                        <li style="background:'+data.items[i].notif_status+'"> \
                            <img src="'+$base_url+'assets/uploads/user_image/'+data.items[i].notif_image+'" class="avatar" alt="Avatar"> \
                            <div class="message_date"> \
                                '+data.items[i].notif_time+' \
                            </div> \
                            <div class="message_wrapper"> \
                                <h4 class="heading">'+data.items[i].notif_name+'</h4> \
                                <a href="'+$base_url+data.items[i].notif_link+'" onclick="javascript:updateNotification('+data.items[i].notif_id+')"> \
                                <blockquote class="message">'+data.items[i].notif_detail+'</blockquote> \
                                </a> \
                                <br /> \
                            </div> \
                        </li> \
                    ');
                }

                setTimeout(function(){ updateAllNotification(); }, 3000);

            } else if (data.status=='204') {

                $("#menu-notifikasi-list").append(' \
                    <li> \
                        Belum ada pemberitahuan untuk sekarang. \
                    </li> \
                ');

            }            
        }
    });
}        


function updateNotification(id = null) {
    $.ajax({
        type : "POST",
        url  : $base_url+'Notifikasi/notificationUpdate',
        data : { tipe : 1, id : id },
        dataType : "json",
    });
}


function updateAllNotification() {
    $.ajax({
        type : "POST",
        url  : $base_url+'Notifikasi/notificationUpdate',
        data : { tipe : 2 },
        dataType : "json",
    });
}


// END NOTIFICATION

/***
Usage
***/
//Custom.doSomeStuff();