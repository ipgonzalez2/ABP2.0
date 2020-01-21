<?php
//file: view/users/login.php

require_once __DIR__ . "/../../core/ViewManager.php";
$view = ViewManager::getInstance();
$view->setVariable("title", "Clases pendientes");
$errors = $view->getVariable("errors");
$clases = $view->getVariable("clasesPendientes");
$i = 0;

?>

<?php if (count($clases) == 0) {?>
    <div class="alert alert-warning text-center" style="width:100%;height:7%" id="success-warning" role="alert">

        No tienes ninguna solicitud de clases
    </div>
<?php }?>

        <div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
            <th class="cell100 column2">Deportista</th>
            <th class="cell100 column1">Clases pendientes</th>
            <th class="cell100 column1">Horario</th>
            <th class="cell100 column1">Fijar Horario Clase</th>
            </tr>
        </thead>
      </table>
    </div>
    <?php for ($i = 0; $i < count($clases); $i = $i + 5) {?>

        <div class="table100-body js-pscroll">
        <table>
          <tbody>
            <tr class="row100 body">
              <td class="cell100 column2"><?=$clases[$i + 1]?></td>
              <td class="cell100 column1"><?=$clases[$i + 3]?></td>
              <td class="cell100 column1"><?=$clases[$i + 4]?></td>
              <td class="cell100 column1">
                <select class="selectBox" size="1" onfocus="changeFunc();">
                <option > Selecciona clase a Fijar </option>
              <?php for ($j = 1; $j <= $clases[$i + 3]; $j++) {?> 
              <option value="<?='index.php?controller=clases&action=reservarClase&idClase=' . $clases[$i]?>" > <?=$j?></option>
                <i class="fas fa-calendar-alt"></i>
                </a>
                </div>
              <?php }?>
              </td>
            </tr>

    <?php }?>
        </tbody>
        </table>
        </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">

function changeFunc() {
 var selectBox = document.getElementById("selectBox");
 
 
}


$(document).ready(function(){
    $("select.selectBox").change(function(){
        var url = $(this).children("option:selected").val();
        $(location).attr('href', url)

    });
});
</script>

