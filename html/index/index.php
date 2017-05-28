<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section class="mbr-section mbr-after-navbar">
<div class="mbr-section__container container mbr-section__container--isolated">

  <?php
  if(isset($_GET['success'])) {
    echo '<div class="alert alert-dismissible alert-success">
      <strong>Activado!</strong> tu usuario ha sido activado correctamente.
    </div>';
  }
  if(isset($_GET['error'])) {
    echo '<div class="alert alert-dismissible alert-danger">
      <strong>Error!</strong></strong> no se ha podido activar tu usuario.
    </div>';
  }
  ?>

<div class="row container">
  <?php
      if(isset($_SESSION['app_id']) and $_users[$_SESSION['app_id']]['permisos'] >= 2) {
        echo '
        <div class="pull-right">
          <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
            <a class="mbr-buttons__btn btn btn-danger" href="?view=configforos">GESTIONAR FOROS</a>
          </li></ul></div>
          <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
            <a class="mbr-buttons__btn btn btn-danger" href="?view=categorias">GESTIONAR CATEGORÍAS</a>
          </li></ul></div>
        </div>
        ';
      }
  ?>
    <ol class="breadcrumb">
      <li><a href="?view=index"><i class="fa fa-home"></i> Inicio</a></li>
    </ol>
</div>

<?php
  for($i = 1; $i <= 3; $i++) {
?>
<div class="row categorias_con_foros">
  <div class="col-sm-12">
      <div class="row titulo_categoria">Esto es la categoría</div>

      <?php
        for($x = 1; $x <= 5; $x++) {
      ?>
      <div class="row foros">
        <div class="col-md-1" style="height:50px;line-height: 37px;">
          <img src="views/app/img/foros/foro_leido.png" />
        </div>
        <div class="col-md-7 puntitos" style="padding-left: 0px;">
          <a href="#">Esto es el titulo de un foro</a><br />
          Descripción corta sobre este foro
        </div>
        <div class="col-md-2 left_border" style="text-align: center;font-weight: bold;">
          407 Temas<br />
          1084 Mensajes
        </div>
        <div class="col-md-2 left_border puntitos" style="line-height: 37px;">
          <a href="#">Ultimo mensaje acá texto largo</a>
        </div>
      </div>
      <?php
        }
      ?>

  </div>
</div>

<?php
  }
?>

</div>
</section>


<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>
