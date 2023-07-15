if ($('form').val() != undefined) {
    var id = $('#id').val() != undefined ? $('#id').val() : null;
    $("form").validate({
        rules: {
            cst_name: "required",
            cst_dob: "required",
            cst_phone_num: "required",
            cst_email: "required",
            nationality_id: "required",
            'fl_relation[]': {
                required : true
            },
            'fl_name[]': {
                required : true
            },
            'fl_dob[]': {
                required : true
            },
        },
        messages: {
            cst_name: "Nama tidak boleh kosong.",
            cst_dob: "Tanggal Lahir tidak boleh kosong.",
            cst_phone_num: "Telepon tidak boleh kosong.",
            cst_email: "Email tidak boleh kosong.",
            nationality_id: "Kewarganegaraan tidak boleh kosong.",
            'fl_relation[]': {
                required: "Hubungan tidak boleh kosong."
            },
            'fl_name[]': {
                required: "Nama tidak boleh kosong."
            },
            'fl_dob[]': {
                required: "Tanggal Lahir tidak boleh kosong."
            },            
        },
        onkeyup: function (element, event) {
            $(element).valid();
        },
        onblur: false,
        highlight: function (element) {
            $(element).closest(".form-control").addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).closest(".form-control").removeClass("is-invalid");
        },
        errorElement: "div",
        errorClass: "invalid-feedback",
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            saveOrUpdate(id);
        },
        invalidHandler: function (form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                validator.errorList[0].element.focus();
            }
        },
    });

    $('form').valid();
}

function hapusBaris(counter_row)
{
    $("#row_" + counter_row).remove();
}

function tambahBaris()
{
    var counter = $("#counter_row").val();
    var new_counter = parseInt(counter) + 1;

    var html = "<tr id='row_" + new_counter + "'>";
    html += "<td>";
    html += "<input class='form-control' type='text' name='fl_relation[]' id='fl_relation_"+new_counter+"'>"
    html += "</td>";
    html += "<td>";
    html += "<input class='form-control' type='text' name='fl_name[]' id='fl_name_"+new_counter+"'>"
    html += "</td>";
    html += "<td>";
    html += "<input class='form-control' type='date' name='fl_dob[]' id='fl_dob_"+new_counter+"'>"
    html += "</td>";
    html += "<td>";
    html += "<button class='btn btn-sm btn-danger' type='button' onclick='hapusBaris("+new_counter+")'>Hapus</button>"
    html += "</td>";

    $("#detail").append(html);
    $("[name^=fl_relation]").valid();
    $("[name^=fl_name]").valid();
    $("[name^=fl_dob]").valid();

    $("#counter_row").val(new_counter);
}

function saveOrUpdate(id)
{
    var url = id == null ? "/customer/store" : "/customer/" + id;
    var method = id == null ? "POST" : "PATCH";
    var data = $('form').serialize();

    $.ajax({
        method: method,
        url: url,
        data: data,
        dataType: "json",
        beforeSend : function()
        {
            $('#btn_simpan').prop('disabled', true);
            $('#btn_simpan').text('Loading ....');
        },
        success: function (response) {
            $('#btn_simpan').prop('disabled', false);
            $('#btn_simpan').text('Simpan');
            alert(response.message);
            window.location = "/customer"
        },
        error : function(jqXHR,textStatus,errorThrown) {
            $('#btn_simpan').prop('disabled', false);
            $('#btn_simpan').text('Simpan');
            var response = jqXHR.responseJSON;
            if(response) {
                alert(response.message)
                if(jqXHR.status == 422) {
                    $('.form-control').removeClass('is-invalid');
                    $.each(response.errors, function (key, value) {
                        $('#'+key).addClass('is-invalid');
                        $('#'+key+'_error_message').text(value[0]);
                        $('#'+key+'_error_message').css('display', '');
                    });
        
                    if(Object.keys(response.errors)[0] != 'undefined') {
                        $('#'+Object.keys(response.errors)[0]).focus();
                    }
                }
            } else {
                alert(jqXHR.status + ' : ' + errorThrown);
            }
            
        }

    });
}

function hapus(cst_id)
{
    if (confirm("Yakin ingin menghapus data ini ?") == true) {
        var url = "/customer/" + cst_id;
        $.ajax({
            method: 'DELETE',
            url: url,
            dataType: "json",
            success: function (response) {
                alert(response.message);
                window.location = "/customer"
            },
            error : function(jqXHR,textStatus,errorThrown) {
                var response = jqXHR.responseJSON;
                alert(response.message)
            }    
        });
    }
}