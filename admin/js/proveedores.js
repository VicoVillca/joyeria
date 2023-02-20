// Add Record
function addRecord() {
    // get values
    var nombre = $("#nombre").val();
    var celular = $("#celular").val();
    var descripcion = $("#descripcion").val();
    if(nombre == ""){
        nombre = "Indefinido";
    }
    // Add record
    $.post("DataBase/adm_proveedor.php", {
         _metod: "insert",
        nombre: nombre,
        celular: celular,
        descripcion: descripcion,
        idAdmin: $("#hidden_id_admin").val(),
        token: $("#hidden_token").val()
    }, function (data, status) {


        // read records again
        readRecords();
 
        // clear fields from the popup
        $("#nombre").val("");
        $("#celular").val("");
        $("#descripcion").val("");
    });
}
 
// READ records
function readRecords() {
    $.post("DataBase/adm_proveedor.php", {
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
        $.post("DataBase/adm_proveedor.php", {
                _metod: "delete",
                idProveedor: id,
                idAdmin: $("#hidden_id_admin").val(),
                token: $("#hidden_token").val()
            },
            function (data, status) {
				console.log(data);
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
    $.post("DataBase/adm_proveedor.php", {
            _metod: "getById",
            idProveedor: id,
            idAdmin: $("#hidden_id_admin").val(),
            token: $("#hidden_token").val()
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data)["proveedor"];

            // Assing existing values to the modal popup fields
            $("#update_nombre").val(user.nombre);
            $("#update_celular").val(user.celular);
            $("#update_descripcion").val(user.descripcion);
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}
 
function UpdateUserDetails() {
    // get values
    var nombre = $("#update_nombre").val();
    var celular  = $("#update_celular").val();
    var descripcion = $("#update_descripcion").val();

    if(nombre == ""){
        nombre = "Indefinido";
    }
    // get hidden field value
    var id = $("#hidden_user_id").val();
 
    // Update the details by requesting to the server using ajax
    $.post("DataBase/adm_proveedor.php", {
            _metod: "update",
            idProveedor: id,
            nombre: nombre,
            celular: celular,
            descripcion: descripcion,
            idAdmin: $("#hidden_id_admin").val(),
            token: $("#hidden_token").val()
        },
        function (data, status) {
			console.log(data);
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
