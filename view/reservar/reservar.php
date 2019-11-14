<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Reservar");
$errors = $view->getVariable("errors");


?>

<section class='calendar'>
  <h2>Noviembre 2019</h2>
  <form action='#'>
    <label class='weekday'>Mo</label>
    <label class='weekday'>Tu</label>
    <label class='weekday'>We</label>
    <label class='weekday'>Th</label>
    <label class='weekday'>Fr</label>
    <label class='weekday'>Sa</label>
    <label class='weekday'>Su</label>

    <label class='day invalid' data-day='0'>
      <span>-4</span>
      <em></em>
    </label>
    <label class='day invalid' data-day='1'>
      <span>-3</span>
      <em></em>
    </label>
    <label class='day invalid' data-day='2'>
      <span>-2</span>
      <em></em>
    </label>
    <label class='day invalid' data-day='3'>
      <span>-1</span>
      <em></em>
    </label>
    <label class='day invalid' data-day='4'>
      <span>0</span>
      <em></em>
    </label>
    <label class='day' data-day='5' onclick="openForm()">
      <span>1</span>
      <em></em>
    </label>
    <label class='day' data-day='6' onclick="openForm()">
      <span>2</span>
      <em></em>
    </label>
    <label class='day' data-day='7' onclick="openForm()">
      <span>3</span>
      <em></em>
    </label>
    <label class='day' data-day='8' onclick="openForm()">
      <span>4</span>
      <em></em>
    </label>
    <label class='day' data-day='9' onclick="openForm()">
      <span>5</span>
      <em></em>
    </label>
    <label class='day' data-day='10' onclick="openForm()">
      <span>6</span>
      <em></em>
    </label>
    <label class='day' data-day='11' onclick="openForm()">
      <span>7</span>
      <em></em>
    </label>
    <label class='day' data-day='12' onclick="openForm()">
      <span>8</span>
      <em></em>
    </label>
    <label class='day' data-day='13' onclick="openForm()">
      <span>9</span>
      <em></em>
    </label>
    <label class='day' data-day='14' onclick="openForm()">
      <span>10</span>
      <em></em>
    </label>
    <label class='day' data-day='15' onclick="openForm()">
      <span>11</span>
      <em></em>
    </label>
    <label class='day' data-day='16' onclick="openForm()">
      <span>12</span>
      <em></em>
    </label>
    <label class='day' data-day='17' onclick="openForm()">
      <span>13</span>
      <em></em>
    </label>
    <label class='day' data-day='18' onclick="openForm()">
      <span>14</span>
      <em></em>
    </label>
    <label class='day' data-day='19' onclick="openForm()">
      <span>15</span>
      <em></em>
    </label>
    <label class='day' data-day='20' onclick="openForm()">
      <span>16</span>
      <em></em>
    </label>
    <label class='day' data-day='21' onclick="openForm()">
      <span>17</span>
      <em></em>
    </label>
    <label class='day' data-day='22' onclick="openForm()">
      <span>18</span>
      <em></em>
    </label>
    <label class='day' data-day='23' onclick="openForm()">
      <span>19</span>
      <em></em>
    </label>
    <label class='day' data-day='24' onclick="openForm()">
      <span>20</span>
      <em></em>
    </label>
    <label class='day' data-day='25' onclick="openForm()">
      <span>21</span>
      <em></em>
    </label>
    <label class='day' data-day='26' onclick="openForm()">
      <span>22</span>
      <em></em>
    </label>
    <label class='day' data-day='27' onclick="openForm()">
      <span>23</span>
      <em></em>
    </label>
    <label class='day' data-day='28' onclick="openForm()">
      <span>24</span>
      <em></em>
    </label>
    <label class='day' data-day='29' onclick="openForm()">
      <span>25</span>
      <em></em>
    </label>
    <label class='day' data-day='30' onclick="openForm()">
      <span>26</span>
      <em></em>
    </label>
    <label class='day' data-day='31' onclick="openForm()">
      <span>27</span>
      <em></em>
    </label>
    <label class='day' data-day='32' onclick="openForm()">
      <span>28</span>
      <em></em>
    </label>
    <label class='day' data-day='33' onclick="openForm()">
      <span>29</span>
      <em></em>
    </label>
    <label class='day' data-day='34' onclick="openForm()">
      <span>30</span>
      <em></em>
    </label>
    <label class='day' data-day='35' onclick="openForm()">
      <span>30</span>
      <em></em>
    </label>
   
    <div class="appointment" id="myForm" > 
        <form action="#" class="form-container">
        <label for="appt-time">Reserva (10:00 a 23:00) </label>
        <input id="day" type="time" name="appt-time" min="10:00" max="23:00" step="5400" required>
         <span class="validity"></span>
         <div>
                <input type="submit" value="Guarda Cita">
                <label type="button"  onclick="closeForm()" >cerrar </label>
         </div>
        </form>     
      </div>
    <div class='clearfix'></div>
  </form>






 

<script>

var startTime = document.getElementById("startTime");
var valueSpan = document.getElementById("value");

startTime.addEventListener("input", function() {
  valueSpan.innerText = startTime.value;
}, false);



function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</body>
</html>

</section>
