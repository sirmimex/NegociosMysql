<?php

  $registros = array();
   $lasInsertID=0;
  
     //Realizar la conexion con MySQL
    $conn = new mysqli("127.0.0.1", "root", "N1ct@3l", "registros");
    if($conn->errno){
      die("DB no can: " . $conn->error);
    }
  
  if(isset($_POST["btnIns"])){
    $registro = array();
    $registro["descripcion"] = $_POST["prddsc"];
    $registro["prdbrc"] = $_POST["prdbrc"];
    $registro["cantidad"] = $_POST["prdctd"];
    $registro["status"] = $_POST["prdest"];
    $registro["Categoria"] = $_POST["prdctd"];
 
    //Preparar el Insert Statement
    $sqlinsert ="INSERT INTO `productos` ( `prddsc`, `prdbrc`, `prdctd`, `prdest`, `prdctd`)";
    $sqlinsert.="VALUES ('". $registro["descripcion"] ."' , '". $registro["prdbrc"] ."' , '". $registro["cantidad"] ."' , '". $registro["status"] ."', '". $registro["Categoria"] ."' );";
    //Ejecutar el Insert Statement
    $result = $conn->query($sqlinsert);
    //Obtener el último codigo generado
 
   
 
  }
    $lasInsertID= $conn->insert_id;
 
  $sqlQuery="Select * from proveedores;";
  $resulCursor=$conn->query($sqlQuery);
 
 while($registro = $resulCursor->fetch_assoc()){
      $registros[] = $registro;
    }
 
 
  //Obtener los registros de la tabla
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Tabla Proveedores</title>
  </head>
  <body>
    <h1>Proveedores</h1>
    <form action="T2.php" method="POST">
        <label for="prddsc">Descripción</label>
        <input type="text" name="prddsc" id="prddsc" />
        <br/>
        <label for="prdbrc">prdbrc</label>
        <input type="text" name="prdbrc" id="prdbrc" />
        <br/>
        <label for="prdctd">Cantidad</label>
        <input type="text" name="prdctd" id="prdctd" />
        <br/>
        <label for="prdctd">Categoria</label>
        <input type="text" name="prdctd" id="prdctd" />
        <br/>
        <label for="prdest">Estado</label>
        <select name="prdest" id="prdest">
            <option value="PND">Pendiente</option>
            <option value="CNF">Confirmado</option>
            <option value="CNL">Cancelado</option>
        </select>
        <br/>
        <input type="submit" name="btnIns" value="Guardar" />
    </form>
    <div>
      <h2>Datos</h2>
     
      <table>
        <tr>
          <th>Codigo</th>
          <th>Descripción</th>
          <th>prdbrc</th>
          <th>Cantidad</th>
          <th>Categoria</th>
          <th>Estado</th>
        </tr>
        <?php
        if(count($registros)>0){
          foreach($registros as $registro){
             
              echo "<tr><td>".$registro["prdid"]."</td>";
              echo "<td>".$registro["prddsc"]."</td>";
              echo "<td>".$registro["prdbrc"]."</td>";
              echo "<td>".$registro["prdctd"]."</td>";
              echo "<td>".$registro["prdctd"]."</td>";
              echo "<td>".$registro["prdest"]."</td></tr>";
           
          }
        }
     
        ?>
      </table>
    </div>
  </body>
</html>