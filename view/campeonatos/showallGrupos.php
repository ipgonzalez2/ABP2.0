<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Grupos");
$errors = $view->getVariable("errors");
$grupos = $view->getVariable("grupos");
?>

<?php if(count($grupos) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%; height:7%;" id="success-warning" role="alert">

        No hay grupos
    </div>
<?php } ?>


<div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
            <th class="cell100 column1">Categoria_Nivel</th>
            <th class="cell100 column2">Num Parejas</th>
            <th class="cell100 column2"></th>
            <th class="cell100 column2"></th>
            </tr>
        </thead>
      </table>
    </div>
    <?php foreach($grupos as $grupo):?>

      <div class="table100-body js-pscroll">
        <table>
          <tbody>
            <tr class="row100 body">
              <td class="cell100 column1"><?= $grupo->getCategoriaNivelGrupo()?></td>
              <td class="cell100 column2"><?= $grupo->getNumParejas()?></td>
              <td class="cell100 column2"><a href="<?="index.php?controller=campeonatos&action=verLigaRegularGrupo&idGrupo=".$grupo->getIdGrupo() ?>">
    <i class="fas fa-eye"></i>
    </a></td>
    <td class="cell100 column2"><a href="<?="index.php?controller=campeonatos&action=showRanking&idGrupo=".$grupo->getIdGrupo() ?>">
    <i class="fas fa-trophy"></i>
    </a></td>

            </tr>
     
          </tbody>
        </table>
      </div>
  <?php endforeach; ?>
</div>

