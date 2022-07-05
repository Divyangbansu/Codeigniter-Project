$(".custom-file-input").on("change", function() {
    let fileName = $(this).val().split("\\").pop();
    let label = $(this).siblings(".custom-file-label");

    if (label.data("default-title") === undefined) {
        label.data("default-title", label.html());
    }

    if (fileName === "") {
        label.removeClass("selected").html(label.data("default-title"));
    } else {
        label.addClass("selected").html(fileName);
    }
});



// ADD Banners DETAILS
$(document).on("click", "#submit", function(e) {
    e.preventDefault();
    var name = $("#name").val();
    var descr = $("#descr").val();
    var image = $("#image")[0].files[0];
    
    if (name == "" || descr == "" || image.name == "") {
        alert("All field are required");
    } else {
        var fd = new FormData();
        fd.append("name", name);
        fd.append("descr", descr);
        fd.append("image", image);
        fd.append("status", 1);
    $.ajax({
        type: "post",
        url: _base_url+"admin/addbannerdata",
        data: fd,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (response) {
            if (response.res == "success") {
            $('#form1')[0].reset();
            alert('successfully added');
            $(".custom-file-label").html("Choose file");
            $("#showname").DataTable().destroy();
            fetch();
        }
        else {
            toastr["error"](response.message);
        }
    }
});
}
});

// FETCH BANNER DATA
function fetch() {
    jQuery(document).ready(function($){
        $.noConflict();
    $('#showbanner').DataTable({
        responsive: true,
        "bProcessing": true,
        "bServerSide": true,
        "pageLength": 100,
        "sAjaxDataProp":"",
        "sAjaxSource":_base_url+"admin/fetchbannerdata",
        "columns": [
                { "data": "name" }, { "data": "image" },{ "data": "descr" },
                { "data": "status" },{ "data": "action" }
         ],
        "aaSorting": [[ 0, "desc" ]]
});
});
}

fetch(); 

//EDIT BANNER DATA

$("#editRecords").on("hide.bs.modal", function(e) {
    $("#editForm")[0].reset();
    $(".custom-file-label").html("Choose file");
});


$(document).on("click", "#edit", function(e) {
    e.preventDefault();

    edit_id = $(this).attr("value");

    $.ajax({
        url: _base_url+"admin/editbannerdata",
        type: "get",
        dataType: "JSON",
        data: {
            edit_id: edit_id,
        },
        success: function(data) {
            if (data.res === "success") {
                $("#editRecords").modal("show");
                $("#edit_name").val(data.post.name);
                $("#edit_descr").val(data.post.descr);
                $("#show_img").html(`
                    <img src="${_base_url}upload/${data.post.image}" width="130" height="90" class="rounded img-thumbnail">
                `);
            } else {
                toastr["error"](data.message, "Error");
            }
        },
    });
});


//UPDATE BANNER DATA

$(document).on("click", "#update", function(e) {
    e.preventDefault();

    var name = $("#edit_name").val();
    var descr = $("#edit_descr").val();
    var edit_img = $("#edit_img")[0].files[0];

    if (name == "" || descr=="" ) {
        alert("All field are required");
    } else {
        var fd = new FormData();

        fd.append("edit_id", edit_id);
        fd.append("name", name);
        fd.append("descr",descr)
        if ($("#edit_img")[0].files.length > 0) {
            fd.append("edit_img", edit_img);
        }

        $.ajax({
            type: "post",
            url: _base_url+"admin/updatebannerdata",
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                if (response.res == "success") {
                    toastr["success"](response.message);
                    $("#editRecords").modal("hide");
                    $("#editForm")[0].reset();
                    $(".edit-file-label").html("Choose file");
                    $('#showbanner').DataTable().destroy();
                    fetch();
                } else {
                    toastr["error"](response.message);
                }
            },
        });
    }
});


//delete banner record
$(document).on("click", "#delete", function(e) {
    e.preventDefault();

    var del_id = $(this).attr("value");

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: _base_url + "admin/deletebannerdata",
                data: {
                    del_id: del_id,
                },
                dataType: "json",
                success: function(response) {
                    if (response.res == "success") {
                        Swal.fire(
                            "Deleted!",
                            "Your file has been deleted.",
                            "success"
                        );
                        $("#showbanner").DataTable().destroy();
                        fetch();
                    }
                },
            });
        }
    });
});

//banner status change
function statchange(id,stat){
    $.ajax({
        type: "post",
        url: _base_url+"admin/updatebannerstatus",
        data: {
            id:id,
            stat:stat
        },
        dataType: "json",
        success: function(response) {
            if (response.res == "success") {
                toastr["success"](response.message);
                $("#showbanner").DataTable().destroy();
                    fetch();
            } else {
                toastr["error"](response.message);
            }
        },
    });
}
