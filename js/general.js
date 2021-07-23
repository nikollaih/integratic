function cambiar_clave(){
    console.log($("#frmcambio").serialize());
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