var edit_id ;
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

// ADD NAME PLATE DETAILS
$(document).on("click", "#submit", function(e) {
    e.preventDefault();
    var name = $("#name").val();
    var price = $("#price").val();
    var descr = $("#descr").val();
    var image = $("#image")[0].files[0];
    var image2 = $("#image2")[0].files[0];
    var image3 = $("#image3")[0].files[0];
    
    if (name == "" || price == "" || descr == "" || image.name == "" || image2.name == "" || image3.name == "") {
        alert("All field are required");
    } else {
        var fd = new FormData();
        fd.append("name", name);
        fd.append("price", price);
        fd.append("descr", descr);
        fd.append("image", image);
        fd.append("image2", image2);
        fd.append("image3", image3);
        fd.append("status", 1);
    $.ajax({
        type: "post",
        url: _base_url+"admin/adddata",
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


// FETCH DATA
function fetch() {
    jQuery(document).ready(function($){
        $.noConflict();
    $('#showname').DataTable({
        responsive: true,
        "bProcessing": true,
        "bServerSide": true,
        "pageLength": 100,
        "sAjaxDataProp":"",
        "sAjaxSource":_base_url+"admin/fetchdata",
        "columns": [
                { "data": "name" }, { "data": "price" },
                { "data": "image" },{ "data": "descr" },
                { "data": "status" },{ "data": "action" }
         ],
        "aaSorting": [[ 0, "desc" ]]
});
});
}

fetch(); 

//EDIT DATA

$("#editRecords").on("hide.bs.modal", function(e) {
    $("#editForm")[0].reset();
    $(".custom-file-label").html("Choose file");
});


$(document).on("click", "#edit", function(e) {
    e.preventDefault();

    edit_id = $(this).attr("value");

    $.ajax({
        url: _base_url+"admin/editdata",
        type: "get",
        dataType: "JSON",
        data: {
            edit_id: edit_id,
        },
        success: function(data) {
            if (data.res === "success") {
                $("#editRecords").modal("show");
                $("#edit_name").val(data.post.name);
                $("#edit_price").val(data.post.price);
                $("#edit_descr").val(data.post.descr);
                $("#show_img").html(`
                    <img src="${_base_url}upload/${data.post.image}" width="130" height="90" class="rounded img-thumbnail">
                `);
                $("#show_img2").html(`
                    <img src="${_base_url}upload/${data.post.image2}" width="130" height="90" class="rounded img-thumbnail">
                `);
                $("#show_img3").html(`
                    <img src="${_base_url}upload/${data.post.image3}" width="130" height="90" class="rounded img-thumbnail">
                `);
            } else {
                toastr["error"](data.message, "Error");
            }
        },
    });
});
 

//UPDATE DATA

$(document).on("click", "#update", function(e) {
    e.preventDefault();

    var name = $("#edit_name").val();
    var price = $("#edit_price").val();
    var descr = $("#edit_descr").val();
    var edit_img = $("#edit_img")[0].files[0];
    var edit_img2 = $("#edit_img2")[0].files[0];
    var edit_img3 = $("#edit_img3")[0].files[0];

    if (name == "" || price == "" || descr=="" ) {
        alert("All field are required");
    } else {
        var fd = new FormData();

        fd.append("edit_id", edit_id);
        fd.append("name", name);
        fd.append("price",price)
        fd.append("descr",descr)
        if ($("#edit_img")[0].files.length > 0) {
            fd.append("edit_img", edit_img);
        }
        if ($("#edit_img2")[0].files.length > 0) {
            fd.append("edit_img2", edit_img2);
        }
        if ($("#edit_img3")[0].files.length > 0) {
            fd.append("edit_img3", edit_img3);
        }

        $.ajax({
            type: "post",
            url: _base_url+"admin/updatedata",
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
                    $('#showname').DataTable().destroy();
                    fetch();
                } else {
                    toastr["error"](response.message);
                }
            },
        });
    }
});


//delete record
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
                url: _base_url + "admin/deletedata",
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
                        $("#showname").DataTable().destroy();
                        fetch();
                    }
                },
            });
        }
    });
});


//status change
function statchange(id,stat){
        $.ajax({
            type: "post",
            url: _base_url+"admin/updatestatus",
            data: {
                id:id,
                stat:stat
            },
            dataType: "json",
            success: function(response) {
                if (response.res == "success") {
                    toastr["success"](response.message);
                    $("#showname").DataTable().destroy();
                        fetch();
                } else {
                    toastr["error"](response.message);
                }
            },
        });
}