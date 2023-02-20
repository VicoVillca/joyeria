// AJAX call for autocomplete 

function selectCountry(id,val) {
$("#search-box").val(val);
console.log(id);
console.log(val);
console.log("-------------------------");
$("#hidden-search-box-id").val(id);
$("#suggesstion-box").hide();
}
// Add Record
function addRecord() {
    console.log("funcion add record");
    // get values
    var idCliente = $("#hidden-search-box-id").val();
    console.log(idCliente);
    var porConcepto = $("#porconcepto").val();
    console.log(porConcepto);
    var nombre = $("#nombre").val();
    var apPaterno = $("#ap_paterno").val();
    var apMaterno = $("#ap_materno").val();
    var calificacion = $("#calificacion").val();
    var descripcion = $("#descripcion").val();
    // Add record
    $.post("DataBase/adm_recibo.php", {
         _metod: "insert",
         idCliente: idCliente,
         tipo: "recibo",
        porConcepto: porConcepto,
        apPaterno: apPaterno,
        apMaterno: apMaterno,
        calificacion: calificacion,
        descripcion: descripcion,
        idAdmin: $("#hidden_id_admin").val(),
        token: $("#hidden_token").val()
    }, function (data, status) {
        console.log(data);
        console.log(status);
        // read records again
        readRecords();
 
        // clear fields from the popup
        $("#ci").val("");
        $("#nombre").val("");
        $("#apPaterno").val("");
        $("#apMaterno").val("");
        $("#calificacion").val("");
        $("#descripcion").val("");
    });
}
 
// READ records
function readRecords() {
    $.post("DataBase/adm_recibo.php", {
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
    $("#search-box").keyup(function(){
        $.post("DataBase/adm_cliente.php", {
             _metod: "buscarCliente",
            data: $(this).val(),
            idAdmin: $("#hidden_id_admin").val(),
            token: $("#hidden_token").val(),
            beforeSend: function(){
            $("#search-box").css("background","#FFF url(img/LoaderIcon.gif) no-repeat 435px");
        }
        },
         function (data, status) {
            console.log(data);
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $("#search-box").css("background","#FFF");
        });
    }


    );
    $("#acuenta").keyup(function(){
        console.log($(this).val());
        $("#numeros").text(NumeroALetras($(this).val()));
        $("#a_cuenta").val($("#acuenta").val());
        console.log(NumeroALetras($(this).val()));
        if($("#total").val()>=0){
            $("#saldo").val($("#total").val()-$("#acuenta").val());
        }
    });
    $("#total").keyup(function(){
        console.log($(this).val());
        //$("#numeros").text(NumeroALetras($(this).val()));
        //console.log(NumeroALetras($(this).val()));
        if($("#acuenta").val()>=0){
            $("#saldo").val($("#total").val()-$("#acuenta").val());
        }
    });
    
});
