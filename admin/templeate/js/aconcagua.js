function GetUserDetails() {
    // Add User ID to the hidden field for furture usage
    content("Cargando Datos...");
    $.post("Login/usr_linea.php", {
            _metod: "getId",
            idLinea: idLinea,
            token: token
        },
        function (data, status) {
            if(JSON.parse(data)["estado"]==1){
                
                Linea = JSON.parse(data)["detalle"];
                PintamosTrayecto(L.Polyline.fromEncoded(Linea.ida)._latlngs,L.Polyline.fromEncoded(Linea.vuelta)._latlngs);
                //Desdeaqui pintaremos los dastos de la Linea
                if(Linea.foto !="")
                    xyz="<img src='admin/img/fotos/"+(Linea.idLinea)+"/"+(Linea.foto)+".png' class='img-responsive' width='500' height='400'>";
                else
                    xyz="La linea no tiene ninguna foto";
                xyz+="<form class='form-horizontal'>";
                    xyz+="<div class='form-group'>";
                        xyz+="<label class='control-label col-xs-4'>Nombre de Linea:</label>";
                        xyz+="<div class='col-xs-8'>";
                        xyz+="<label class=' col-xs-12'>"+Linea.nombre+"</label>";
                        xyz+="</div>";
                    xyz+="</div>";
                    xyz+="<div class='form-group'>";
                        xyz+="<label class='control-label col-xs-4'>Qr:</label>";
                        xyz+="<div class='col-xs-8'>";
                        xyz+="<img src='admin/img/fotos/"+(Linea.idLinea)+"/imgQr.png' class='img-responsive' width='100' height='100'>";
                        xyz+="</div>";
                    xyz+="</div>";
                    xyz+="<div class='form-group'>";
                        xyz+="<label class='control-label col-xs-4'>Sindicato:</label>";
                        xyz+="<div class='col-xs-8'>";
                        xyz+="<label class=' col-xs-12'>"+Linea.sindicato+"</label>";
                        xyz+="</div>";
                    xyz+="</div>";
                    xyz+="<div class='form-group'>";
                        xyz+="<label class='control-label col-xs-4'>Tipo de Transporte:</label>";
                        xyz+="<div class='col-xs-8'>";
                        xyz+="<label class='col-xs-12'>"+Linea.tipo+"</label>";
                        xyz+="</div>";
                    xyz+="</div>";

                    
                xyz+="</form>";
                //ahora mostramos
                content(xyz);
                //Tambien tenemos que definir las paradas
                var response=JSON.parse(data)["paradas"];
                for(var i=0;i<response.length;i++){
                    var r = response[i];
                    nuevo_marker(r["idParada"],r["nombre"],new L.LatLng(r["latitud"],r["longitud"]));
                }
            }else{
                content("No se pudo encotrar la linea");
            }
        }
    );
    // Open modal popup
}
function nuevo_marker(idx,nom,pos){    
    var m =  L.marker(pos,  { icon:myIconA}).addTo(map);
    m.bindPopup("<b>Nombre de parada</b><br>"+nom);
}
function PintamosTrayecto(vec_a,vec_b){
    if(polyline_ida){
        map.removeLayer(polyline_ida);
        if(arrowHead_ida)
            map.removeLayer(arrowHead_ida);
        if(anim_ida)
            clearInterval(anim_ida);
    }
            

    if(polyline_vuelta){
         map.removeLayer(polyline_vuelta);
        if(arrowHead_vuelta)
            map.removeLayer(arrowHead_vuelta);
        if(anim_vuelta)
            clearInterval(anim_vuelta); 
    }
   
    
    polyline_ida = new L.Polyline(vec_a, polylineOptionsIda);
    map.addLayer(polyline_ida);  
    if(vec_a.length>1){
        arrowHead_ida = L.polylineDecorator(polyline_ida);
        map.addLayer(arrowHead_ida);  
        var arrowOffset = 0;
        anim_ida = window.setInterval(function() {
            arrowHead_ida.setPatterns([
                {offset: arrowOffset*3, repeat: 60, symbol: L.Symbol.arrowHead({pixelSize: 15, polygon: false, pathOptions: {color: 'green', stroke: true}})}
            ])
            if(++arrowOffset > 20)
                arrowOffset = 0;
        }, 50);
    }
    
    polyline_vuelta = new L.Polyline(vec_b, polylineOptionsVuelta);
    map.addLayer(polyline_vuelta);
    if(vec_b.length>1){
        arrowHead_vuelta = L.polylineDecorator(polyline_vuelta);
        map.addLayer(arrowHead_vuelta);  
        var arrowOffset2 = 0;
        anim_vuelta = window.setInterval(function() {
            arrowHead_vuelta.setPatterns([
                {offset: arrowOffset2*3, repeat: 60, symbol: L.Symbol.arrowHead({pixelSize: 15, polygon: false, pathOptions: {color: 'red' }})}
            ])
            if(++arrowOffset2 > 20)
                arrowOffset2 = 0;
        }, 50);
    }
        
        if(vec_a.length>0)
            map.fitBounds(polyline_ida.getBounds());
        if(vec_b.length>0)
            map.fitBounds(polyline_vuelta.getBounds());
    
    

}
function Buscar(){
    $.post("Login/usr_linea.php", {
            _metod: "Buscar",
            cadena: cadena,
            token:token
        },
        function (data, status) {
            console.log(data);
            if(JSON.parse(data)["estado"]==1){
                xyz="<table class='table table-striped'>";
                xyz+="<thead>";
                xyz+="<tr>";
                xyz+="<th>#</th>";
                xyz+="<th>Nombre</th>";
                xyz+="<th>sindicato</th>";
                xyz+="<th>Ver</th>";
                xyz+="</tr>";
                xyz+="</thead>";
                xyz+="<tbody>";

                lineas=JSON.parse(data)["lineas"];
                for(i=0;i<lineas.length;i++){

                    xyz+="<tr>";
                    xyz+="<th scope='row'>"+(i+1)+"</th>";
                    xyz+="<td>"+lineas[i].nombre+"</td>";
                    xyz+="<td>"+lineas[i].sindicato+"</td>";
                    xyz+="<td>";
                        xyz+="<form action='webalizer.php' method='GET'>";
                        xyz+="<input type='hidden' name='idLinea' value='"+lineas[i].idLinea+"' />";
                        xyz+="<input type='submit' value='VerLinea' class='btn btn-primary' />";
                        xyz+="</form>";
                    xyz+="</tr>";
                    xyz+="<tr>";
                }
                xyz+="</tbody>";
                xyz+="</table>";
                content(xyz);
            }else{
                content("<h3>No se encontro nada con nombre </h3><br><h1>"+cadena+"</h1>");
            }
        }
    );
}
function content(data){
    $("#update_user_modal").modal("show");
    $(".mensaje").html("").show();
    $(".mensaje").html(data);
}

 
$(document).ready(function () {
    // READ re,cods on page load
    ini_mapa();//iniciamos le mapa
    if(idLinea!=-1){
        GetUserDetails(idLinea);
    }
    if(cadena!="-1"){
        Buscar();
    }
    
});
