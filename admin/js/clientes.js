// Add Record
function addRecord() {
    // get values
    var ci = $("#ci").val();
    var nombre = $("#nombre").val();
    var apPaterno = $("#ap_paterno").val();
    var apMaterno = $("#ap_materno").val();
    var calificacion = $("#calificacion").val();
    var descripcion = $("#descripcion").val();
    // Add record
    $.post("DataBase/adm_cliente.php", {
         _metod: "insert",
        ci: ci,
        nombre: nombre,
        apPaterno: apPaterno,
        apMaterno: apMaterno,
        calificacion: calificacion,
        descripcion: descripcion,
        idAdmin: $("#hidden_id_admin").val(),
        token: $("#hidden_token").val()
    }, function (data, status) {
        // read records again
        readRecords();
 
        // clear fields from the popup
        $("#ci").val("");
        $("#nombre").val("");
        $("#ap_paterno").val("");
        $("#ap_materno").val("");
        $("#calificacion").val("");
        $("#descripcion").val("");
    });
}
 
// READ records
function readRecords() {
    $.post("DataBase/adm_cliente.php", {
        _metod: "getAll",
        idAdmin: $("#hidden_id_admin").val(),
        token: $("#hidden_token").val()
    }, function (data, status) {
        
        $(".panel-body").html(data);
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
}
 
 
function DeleteUser(id) {
	$("#delete_modal").modal("show");
	$("#hidden_user_id").val(id);
}
function ConfirmarDeleteUser() {
		var id = $("#hidden_user_id").val()
		$("#hidden_user_id").val(id);
        $.post("DataBase/adm_cliente.php", {
                _metod: "delete",
                idCliente: id,
                idAdmin: $("#hidden_id_admin").val(),
                token: $("#hidden_token").val()
            },
            function (data, status) {
                // reload Users by using readRecords();
                var user = JSON.parse(data);
                    if(user.estado==1){
                        readRecords();
                    }else{
                        alert(user.mensaje);
                    }
            }
        );
    
}
 
function GetUserDetails(id) {
	
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("DataBase/adm_cliente.php", {
            _metod: "getById",
            idCliente: id,
            idAdmin: $("#hidden_id_admin").val(),
            token: $("#hidden_token").val()
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data)["cliente"];

            // Assing existing values to the modal popup fields
            $("#update_ci").val(user.ci);
            $("#update_nombre").val(user.nombre);
            $("#update_ap_paterno").val(user.apPaterno);
            $("#update_ap_materno").val(user.apMaterno);
            $("#update_calificacion").val(user.calificacion);
            $("#update_descripcion").val(user.descripcion);
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}
 
function UpdateUserDetails() {
    // get values
    var ci = $("#update_ci").val();
    var nombre = $("#update_nombre").val();
    var apPaterno = $("#update_ap_paterno").val();
    var apMaterno = $("#update_ap_materno").val();
    var calificacion = $("#update_calificacion").val();
    var descripcion = $("#update_descripcion").val();
    
    // get hidden field value
    var id = $("#hidden_user_id").val();
  
    // Update the details by requesting to the server using ajax
    $.post("DataBase/adm_cliente.php", {
            _metod: "update",
            idCliente: id,
            ci: ci,
            nombre: nombre,
            apPaterno: apPaterno,
            apMaterno: apMaterno,
            calificacion: calificacion,
            descripcion: descripcion,
            idAdmin: $("#hidden_id_admin").val(),
            token: $("#hidden_token").val()
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}
 
$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
    
});
