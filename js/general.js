function cambiar_clave(){
    console.log($("#frmcambio").serialize());
    var url = "./index.php/principal/cambio_clave";   
        $.ajax({
               url:url,
               type:'POST',
               data:$("#frmcambio").serialize(),
               success:function(respuesta){
                   console.log(respuesta);
                alert("Clave Modificada con Éxito!"); 
                $("#contenedor").html('');  
              },
               error:function(){ alert("Error!");}                                   
               });

}