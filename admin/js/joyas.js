// Add Record
function addRecord() {
    console.log("Adicionar");
    // get values
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var inversion = $("#inversion").val();
    var fecha = $("#fecha").val();
    // Add record
    $.post("DataBase/adm_joya.php", {
         _metod: "insert",
        nombre: nombre,
        descripcion: descripcion,
        inversion: inversion,
        fecha: fecha,
        idAdmin: $("#hidden_id_admin").val(),
        token: $("#hidden_token").val()
    }, function (data, status) {

        // read records again
        readRecords();
 
        // clear fields from the popup
        $("#nombre").val("");
        $("#descripcion").val("");
        $("#inversion").val("");
        $("#fecha").val("");
    });
}
 
// READ records
function readRecords() {
    $.post("DataBase/adm_joya.php", {
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
        $.post("DataBase/adm_joya.php", {
                _metod: "delete",
                idJoya: id,
                idAdmin: $("#hidden_id_admin").val(),
                token: $("#hidden_token").val()
            },
            function (data, status) {
                console.log("eliminado weee");
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
    $.post("DataBase/adm_joya.php", {
            _metod: "getById",
            idJoya: id,
            idAdmin: $("#hidden_id_admin").val(),
            token: $("#hidden_token").val()
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data)["joya"];

            // Assing existing values to the modal popup fields
            $("#update_nombre").val(user.nombre);
            $("#update_descripcion").val(user.descripcion);
            $("#update_inversion").val(user.inversion);
            $("#update_fecha").val(user.fecha);
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}
 
function UpdateUserDetails() {
    // get values
    var nombre = $("#update_nombre").val();
    var descripcion = $("#update_descripcion").val();
    var inversion = $("#update_inversion").val();
    var fecha = $("#update_fecha").val();

    if(nombre == ""){
        nombre = "Indefinido";
    }
    // get hidden field value
    var id = $("#hidden_user_id").val();
  
    // Update the details by requesting to the server using ajax
    $.post("DataBase/adm_joya.php", {
            _metod: "update",
            idJoya: id,
            nombre: nombre,
            descripcion: descripcion,
            inversion: inversion,
            fecha: fecha,
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
