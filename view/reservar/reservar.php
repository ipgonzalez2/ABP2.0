<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Reservar");
$errors = $view->getVariable("errors");


?>


<div class="container" style="margin-top: 100px">
      
      <div class="row" style="margin-left: 39%">
        <div class="col-xss-4">
          <div id="glob-data" data-toggle="calendar"></div>
        </div>
      
      
  </div>
  <form>
  Mete datos:<br>
  <input type="text" name="firstname"><br>
  Ya les dare css:<br>
  <input type="text" name="lastname">
</form>

  
</div>


    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/dateTimePicker.min.js"></script>
    <script type="text/javascript">

   
    $(document).ready(function()
    { 
       
        


        $('#glob-data').calendar({
            onSelectDate: function(date, month, year)

        {
          alert([year, month, date].join('-') );
        }
        })

        $('#glob-data').calendar({
            day_name: [ 'D','L', 'M', 'X', 'J', 'V', 'S']

        })
     
    });

  
    </script>