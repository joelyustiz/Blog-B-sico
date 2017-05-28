<?php
if(isset($_SESSION['app_id']) and $_users[$_SESSION['app_id']]['permisos'] >= 2) {
  $isset_id = isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >=1;
  require('core/models/classCategorias.php');
  $categorias = new Categorias();
  switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
    case 'add':
      if($_POST){
        $categorias->Add();
      }else {
        echo "plantilla";
      }
      break;

      case 'edit':
        if ($isset_id) {
          if ($_POST) {
            $categorias->Edit();
          }else {
            echo "Plantilla que dice que se va a editar";
          }
        }else {
        header('location: ?view=categorias');seti
        }
        break;

      case 'delete':
        if ($isset_id) {
        $categorias->Delete();
        }
          break;

    default:
      $db = new Conexion();
      $sql = $db->query("SELECT * FROM categorias;");
      if ($db->rows($sql)>0) {
        while ($data = $db->recorrer($sql)) {
          # code...
          $categs[] = array(
            'id' => $data['id'],
            'nombre' => $data['nombre']
          );
        }
      }
      $db->close();
      break;
  }
}else {
  header('location: ?view=index');
}
 ?>
