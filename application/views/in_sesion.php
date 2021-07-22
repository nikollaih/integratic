 <?php 
 if(isset($datos)){
    foreach($datos as $row){
        $_SESSION['nom']=$row->nombres;
        $_SESSION['ape']=$row->apellidos;
        $_SESSION['usr']=$row->usuario;
        $_SESSION['rol']=$row->rol;
        $_SESSION['id']=$row->id;
      }   
}
?>
<script>
    $("#usuario").html(<?=$_SESSION['nom'];?>);
</script>