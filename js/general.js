function cambiar_clave(){
    var url = "./index.php/principal/cambio_clave";   
        $.ajax({
               url:url,
               type:'POST',
               data:$("#frmcambio").serialize(),
               success:function(data){
                var data = JSON.parse(data);
                
                if(data.status){
                    user["clave"] = data.object.nueva;
                    $("#contenedor").html('');  
                }
                alert(data.message); 
                
              },
               error:function(){ alert("Error!");}                                   
               });

}

function ver_foro(id_foro){
    var url = "./index.php/Foros/ver/" + id_foro;   
        $.ajax({
            url:url,
            type:'GET',
            success:function(data){
            $("#listacon").html(data); 
            },
            error:function(){ alert("Error!");}                                   
            });
}