<?php
  require_once "connect.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    

    <!-- Підключення html2canvas та jsPDF через CDN -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>


    <!-- Додаємо посилання на jsPDF -->

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  

    <title>Eko menegment</title>
    <meta property="og:title" content="Eko menegment" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

    <style data-tag="reset-style-sheet">
      hr {
    border: none; '/* Убираем границу */
    background-color: red; /* Цвет линии */
    color: red; /* Цвет линии для IE6-7 */
    height: 2px; /* Толщина линии */
   }
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Inter;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-gray-black);
        background-color: var(--dl-color-gray-white);

      }
    </style>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <!--This is the head section-->
    <!-- <style> ... </style> -->
    <style data-section-id="dropdown">
      [data-thq="thq-dropdown"]:hover > [data-thq="thq-dropdown-list"] {
          display: flex;
        }

        [data-thq="thq-dropdown"]:hover > div [data-thq="thq-dropdown-arrow"] {
          transform: rotate(90deg);
        }
    </style>
  </head>
  <body>
    <div>
    <!-- <div class="thisblock"></div> -->
      <link href="./main.css" rel="stylesheet" />

      <div class="main-container">
        <!-- <header data-role="Header" class="main-header">
        </header> -->
        
        <form class="forform" method="post">
        <div class="tabs">
            <div class="tab" onclick="showTab('tab2')">Виведення значень</div>
            <div class="tab" onclick="showTab('tab1')">Заміна значень</div>
        </div>
        
        <div class="tab-content" id="tab2">
        <div class="forblock">
        <!-- <span class="main-text">Вивести показник:</span> -->
        <div class="block-header">Вибір даних:</div>
        <div class="main-container004">
        <select id="type1" name="type1" class="main-select">
          <option value='all' selected>Всі об'єкти</option>
          <?php
              $temp = 1;
              $sql01 = "SELECT elementname FROM objects";
              $answer = mysqli_query($con, $sql01) or die (mysqli_error($con));
              while($row = mysqli_fetch_array($answer))
              {
                echo "<option value='$temp'>$row[0]</option>";
                $temp++;
              }
          ?>
          </select>
          <select id="year1" name="year1" class="main-select">
          <option value='all' selected>Роки</option>
          <?php
              for ($i = 2013; $i<2023; $i++)
              {
                echo "<option value='$i'>$i</option>";
              }
          ?>
          </select>
          <select id="pokaznik" name="pokaznik" class="main-select">
          <option value='all' selected>Показники</option>
          <?php
              $sql01 = "SELECT * FROM resources where id < 8";
              $answer = mysqli_query($con, $sql01) or die (mysqli_error($con));
              while($row = mysqli_fetch_array($answer))
              {
                echo "<option value='$row[0]'>$row[1]</option>";
              }
          ?>
        </select>
        </div>
        
        </div>
        <div class="forblock">
        <div class="block-header">Дії:</div>
          <div class="main-container004">
            <button id="select2" name="select2" type="submit" class="main-button2 button">Вивести таблицю</button>
            <button id="select3" name="select3" type="submit" class="main-button2 button">Середнє значення</button>
            <button id="selectgraph" name="selectgraph" onclick="drawGraph2()" type="submit" class="main-button2 button">Вивести графіки</button>
            <button id="selectind" name="selectind" type="submit" class="main-button2 button">Індикатор питомого енергоспоживання</button>
            <button id="selectco" name="selectco" type="submit" class="main-button2 button">Індикатор питомої теплоємності та питомих викидів СО2</button>
            <button id="select4" name="select4" onclick="drawPie()" class="main-button2 button">Енергобаланс</button>
            <button id="select8" name="select8" class="button">Коментарі</button>
          </div>
        </div>
        </div>
        <div class="tab-content" id="tab1">
        <div class="forblock">
        <!-- <span class="main-text">Заміна значення показника:</span> -->
        <div class="main-container002">
          <select id="type" name="type" class="main-select">
            <option value='all' selected>Всі об'єкти</option>
            <?php
                $temp = 1;
                $sql0 = "SELECT elementname FROM objects";
                $answer = mysqli_query($con, $sql0) or die (mysqli_error($con));
                while($row = mysqli_fetch_array($answer))
                {
                  echo "<option value='$temp'>$row[0]</option>";
                  $temp++;
                }
            ?>
          </select>
          <!-- <input
            type="text" id="year" name="year"
            placeholder="Рік"
            class="main-textinput input"
          /> -->
          <select id="year" name="year" class="main-select">
            <option value='all' selected>Роки</option>
            <?php
                for ($i = 2013; $i<2023; $i++)
                {
                  echo "<option value='$i'>$i</option>";
                }
            ?>
          </select>
          <!-- <input
            type="text" id="month" name="month"
            placeholder="Місяць"
            class="main-textinput1 input"
          /> -->
          <select id="month" name="month" class="main-select">
            <option value='all' selected>Місяці</option>
            <?php
                for ($i = 1; $i<13; $i++)
                {
                  echo "<option value='$i'>$i</option>";
                }
            ?>
          </select>
          <!-- <input
            type="text" id="index" name="index"
            placeholder="Показник"
            class="main-textinput2 input"
          /> -->
          <select id="index" name="index" class="main-select">
            <option value='all' selected>Показники</option>
            <?php
                $sql01 = "SELECT * FROM resources where id < 8";
                $answer = mysqli_query($con, $sql01) or die (mysqli_error($con));
                while($row = mysqli_fetch_array($answer))
                {
                  echo "<option value='$row[0]'>$row[1]</option>";
                  $temp++;
                }
            ?>
          </select>
          </div>
          <div class="main-container002">
          <input
            type="text" id="new" name="new"
            placeholder="Нове значення"
            class="main-textinput2 input"
          />
          <button id="select" name="select" class="button">Замінити</button>
        </div>
        </div>
        </div>
        </form>

      <!-- <div style="text-align: center;">Робота з заходами:</div> -->
      <form  class="forform" method="post">
        <div align="center" id="forcomm" class="main-container004" style="display:none;">
        <div style="width: 100%; height: 20px;" ></div>
        <span class="main-text">Додати коментар:</span>
        <input
            type="text" id="elem" name="elem"
            placeholder="Підрозділ"
            class="main-textinput0 input"
          />
        <input
            type="text" id="pokaz" name="pokaz"
            placeholder="Показник"
            class="main-textinput0 input"
          />
          <input
            type="text" id="year2" name="year2"
            placeholder="Рік"
            class="main-textinput0 input"
          />
        <input
            type="text" id="comment" name="comment"
            placeholder="Коментар"
            class="main-textinput6 input"
          />
           <button id="select5" name="select5" class="button">Записати</button></div>
        <div align="center" id="forcomm2" class="main-container004" style="display:none;">
        <span class="main-text">Коментар по рокам:</span>
        <input
            type="text" id="elem2" name="elem2"
            placeholder="Підрозділ"
            class="main-textinput0 input"
          />
        <input
            type="text" id="pokaz2" name="pokaz2"
            placeholder="Показник"
            class="main-textinput0 input"
          />
          <input
            type="text" id="year3" name="year3"
            placeholder="Рік"
            class="main-textinput0 input"
          />
        <input
            type="text" id="comment2" name="comment2"
            placeholder="Коментар"
            class="main-textinput6 input"
          />
           <button id="select6" name="select6" class="button">Записати</button></div>
        <div align="center" id="forcomm3" class="main-container004" style="display:none;">
        <div style="width: 100%; height: 20px;" ></div>
        <span class="main-text">Додати коментар по енергобалансу:</span>
        <input
            type="text" id="elem3" name="elem3"
            placeholder="Підрозділ"
            class="main-textinput0 input"
          />
        <input
            type="text" id="pokaz3" name="pokaz3"
            placeholder="Показник:"
            class="main-textinput0 input"
          />
          <input
            type="text" id="year4" name="year4"
            placeholder="Рік"
            class="main-textinput0 input"
          />
        <input
            type="text" id="comment3" name="comment3"
            placeholder="Коментар"
            class="main-textinput6 input"
          />
           <button id="select7" name="select7" class="button">Записати</button></div>
    </form>

    
        <?php
        if (isset($_REQUEST["select"])) {
          $type = $_REQUEST["type"];
          $year = $_REQUEST["year"];
          $month = $_REQUEST["month"];
          $index = $_REQUEST["index"];
          $new = $_REQUEST["new"];
          $sql = "UPDATE resourсу_quantity SET amount = $new WHERE str_el = $type AND year = $year AND month = $month AND resource = $index";
          mysqli_query($con, $sql);
        }


        if (isset($_REQUEST["select2"])) {
          $pokaznik = $_REQUEST["pokaznik"];
          $type1 = $_REQUEST["type1"];
          $year1 = $_REQUEST["year1"];
          $this1 = 1;
          if ($type1 == "all" AND $year1 == "all") {
            $sql = "SELECT * FROM resourсу_quantity where resource = $pokaznik order by year, month, str_el;";
            $this1 = 10;
          }
          elseif ($type1 == "all") {
            $sql = "SELECT * FROM resourсу_quantity where resource = $pokaznik AND year = $year1 order by month, str_el;";
            $this1 = 10;
          }
          elseif ($year1 == "all") {
            $sql = "SELECT * FROM resourсу_quantity WHERE str_el = $type1 AND resource = $pokaznik";
          }
          else {
            $sql = "SELECT * FROM resourсу_quantity WHERE str_el = $type1 AND year = $year1 AND resource = $pokaznik";
          }
          $answer = mysqli_query($con, $sql) or die (mysqli_error($con));
          
            
          while($row = mysqli_fetch_array($answer)) {
            echo '<span class="main-text034">
            Показники за '.$row[1].' рік:
          </span>';
            echo '<div class="main-container036">
              <div class="main-container037">';
                for ($month = 1; $month <= 12; $month++) {
                  echo '<div class="main-container0' . (38 + $month) . '">
                          <span class="main-text0' . (39 + $month) . '">' . date('F', mktime(0, 0, 0, $month, 10)) . '</span>
                        </div>';
              }
              echo '</div>';
              echo '<div class="main-container051">
                <div class="main-container053">';
                  $temp1 = $row[4];
                    if ($this1 == 10) {
                      for ($j = 1; $j < 10; $j++) {
                        $row = mysqli_fetch_array($answer);
                        $temp1 += $row[4];
                      }
                    }
                  echo "<div class='main-container054'><span class='main-text053'>".$temp1."</span></div>";
                  for ($i = 1; $i < 12; $i++) {
                    $temp1 = 0;
                    for ($j = 0; $j < $this1; $j++) {
                      $row = mysqli_fetch_array($answer);
                      $temp1 += $row[4];
                    }
                    echo "<div class='main-container054'><span class='main-text053'>".$temp1."</span></div>";
                  }
                echo "</div>";
            echo "</div>";
            echo "</div>";
            }
            
      }
      
     
        if (isset($_REQUEST["select3"])) {
          $pokaznik = $_REQUEST["pokaznik"];
          $type1 = $_REQUEST["type1"];
          $year1 = $_REQUEST["year1"];
          $graph = 0;
          
          if ($year1 == "all") {
            // echo '<span>Графік грошових витрат по рокам:</span>
            // <div id="graph2" style="width: 900px; height: 600px;"></div>
            // <button id="downloadPdfBtn2" style="margin: 20px;" class="button">Завантажити PDF</button>';
            $sql = "SELECT * FROM resourсу_quantity WHERE str_el = $type1 AND resource = $pokaznik";
          }
          else {
            $graph = 1;
            $sql = "SELECT * FROM resourсу_quantity WHERE str_el = $type1 AND year = $year1 AND resource = $pokaznik";
          }
          $answer = mysqli_query($con, $sql) or die (mysqli_error($con));
          
          $text = array('
          <span class="main-text223">', ' рік</span>', '
          <div class="main-container144">
            <div class="main-container146">
            <span class="main-text227">', '</span>
          </div>
          <div class="main-container147">
            <span class="main-text228">Робочі дні</span>
          </div>
          <div class="main-container148">
            <span class="main-text229">
              <span>Середньо</span>
              <br />
              <span>добове</span>
              <br />
            </span>
          </div>
          <div class="main-container149">
            <span class="main-text234">', '</span>
          </div>
          <div class="main-container150">
            <span class="main-text235">Робочі дні</span>
          </div>
          <div class="main-container151">
            <span class="main-text236">
              <span>Середньо</span>
              <br />
              <span>добове</span>
              <br />
            </span>
          </div>
          <div class="main-container152">
            <span class="main-text241">', '</span>
          </div>
          <div class="main-container153">
            <span class="main-text242">Робочі дні</span>
          </div>
          <div class="main-container154">
            <span class="main-text243">
              <span>Середньо</span>
              <br />
              <span>добове</span>
            </span>
          </div>
          <div class="main-container155">
            <span class="main-text247">', '</span>
          </div>
          <div class="main-container156">
            <span class="main-text248">Робочі дні</span>
          </div>
          <div class="main-container157">
            <span class="main-text249">
              <span>Середньо</span>
              <br />
              <span>добове</span>
            </span>
          </div>
          <div class="main-container158">
            <span class="main-text253">', '</span>
          </div>
          <div class="main-container159">
            <span class="main-text254">Робочі дні</span>
          </div>
          <div class="main-container160">
            <span class="main-text255">
              <span>Середньо</span>
              <br />
              <span>добове</span>
            </span>
          </div>
          <div class="main-container161">
            <span class="main-text259">', '</span>
          </div>
          <div class="main-container162">
            <span class="main-text260">Робочі дні</span>
          </div>
          <div class="main-container163">
            <span class="main-text261">
              <span>Середньо</span>
              <br />
              <span>добове</span>
            </span>
          </div>
        </div>');
        $graph2 = array();
        $graph1 = array();
        $x = 0;
        while ($row = mysqli_fetch_array($answer)) {
          echo '<div class="main-container143">';
          $temp = array($row[1], '', 'Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень');
          for ($j = 0; $j < 8; $j++) {
            echo $text[$j];
            echo $temp[$j];
          }
          echo $text[8];
          echo '<div class="main-container164">
          ';
          $averyear = 0;
          $count = 0;
          if ($row[4] == 0) {
            $days = 0;
            $aver = 0;
            $min = 100000;
          }
          else {
            $sql1 = "SELECT days FROM days_in_month WHERE month = $row[2] and year = $row[1]";
            $answer1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
            $row1 = mysqli_fetch_array($answer1);
            $aver = (round($row[4]/$row1[0], 2));
            $days = $row1[0];
            $min = $aver;
            $count++;
            $averyear += $aver;
          }
          $summ2 = $row[4];
          array_push($graph1, [$x, $aver]);
          
          $minmonth = $row[2];
          $max = $aver;
          $maxmonth = $row[2];
          echo '<div class="main-container166">
          <div class="main-container167">
            <span class="main-text268">'.$row[4].'</span>
          </div>
          <div class="main-container168">
                <span class="main-text269">'.$days.'</span>
              </div>
          <div class="main-container169">
                <span class="main-text270">'.$aver.'</span>
              </div>';
              for ($i = 1; $i < 6; $i++) {
                $row = mysqli_fetch_array($answer);
                if ($row[4] == 0) {
                  $days = 0;
                  $aver = 0;
                }
                else {
                  $sql1 = "SELECT days FROM days_in_month WHERE month = $row[2] and year = $row[1]";
                  $answer1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
                  $row1 = mysqli_fetch_array($answer1);
                  $aver = (round($row[4]/$row1[0], 2));
                  $days = $row1[0];
                  $count++;
                  $averyear += $aver;
                }
                if (($aver < $min) and $aver != 0) {
                  $min = $aver;
                  $minmonth = $row[2];
                }
                if ($aver > $max) {
                  $max = $aver;
                  $maxmonth = $row[2];
                }
                $summ2 += $row[4];
                array_push($graph1, [$x, $aver]);
                echo '
          <div class="main-container167">
            <span class="main-text268">'.$row[4].'</span>
          </div>
          <div class="main-container168">
                <span class="main-text269">'.$days.'</span>
              </div>
          <div class="main-container169">
                <span class="main-text270">'.$aver.'</span>
              </div>';
              }
              echo "</div></div>";
            $temp = array('Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень');
            for ($i = 2; $i < 8; $i++) {
              echo $text[$i];
              echo $temp[$i - 2];
            }
            echo $text[8];
            $summ2 += $row[4];
            array_push($graph1, [$x, $aver]);
            $row = mysqli_fetch_array($answer);
            if ($row[4] == 0) {
              $days = 0;
              $aver = 0;
            }
            else {
              $sql1 = "SELECT days FROM days_in_month WHERE month = $row[2] and year = $row[1]";
              $answer1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
              $row1 = mysqli_fetch_array($answer1);
              $aver = (round($row[4]/$row1[0], 2));
              $days = $row1[0];
              $count++;
              $averyear += $aver;
            }
          echo '<div class="main-container164">
          ';
          if ($row[4] == 0) {
            $days = 0;
            $aver = 0;
          }
          else {
            $aver = (round($row[4]/$row1[0], 2));
            $days = $row1[0];
            $count++;
            $averyear += $aver;
          }
                if  (($aver < $min) and $aver != 0) {
                  $min = $aver;
                  $minmonth = $row[2];
                }
                if ($aver > $max) {
                  $max = $aver;
                  $maxmonth = $row[2];
                }
          echo '<div class="main-container166">
          <div class="main-container167">
            <span class="main-text268">'.$row[4].'</span>
          </div>
          <div class="main-container168">
                <span class="main-text269">'.$days.'</span>
              </div>
          <div class="main-container169">
                <span class="main-text270">'.$aver.'</span>
              </div>';
              for ($i = 1; $i < 6; $i++) {
                $row = mysqli_fetch_array($answer);
                if ($row[4] == 0) {
                  $days = 0;
                  $aver = 0;
                }
                else {
                  $sql1 = "SELECT days FROM days_in_month WHERE month = $row[2] and year = $row[1]";
                  $answer1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
                  $row1 = mysqli_fetch_array($answer1);
                  $aver = (round($row[4]/$row1[0], 2));
                  $days = $row1[0];
                  $count++;
                  $averyear += $aver;
                }
                if  (($aver < $min) and $aver != 0) {
                  $min = $aver;
                  $minmonth = $row[2];
                }
                if ($aver > $max) {
                  $max = $aver;
                  $maxmonth = $row[2];
                }
                $summ2 += $row[4];
                array_push($graph1, [$x, $aver]);
                echo '<div class="main-container167">
            <span class="main-text268">'.$row[4].'</span>
          </div>
          <div class="main-container168">
                <span class="main-text269">'.$days.'</span>
              </div>
          <div class="main-container169">
                <span class="main-text270">'.$aver.'</span>
              </div>';
              }
              echo "</div>";
            echo "</div></div>";
            echo '<div class="main-container227">
            <span class="main-text349">Середнє за рік</span>
            <div class="main-container228">
              <div class="main-container229">
                <span class="main-text350">
                  <span>Середнє</span>
                  <br />
                  <span>за рік</span>
                  <br />
                </span>
              </div>
              <div class="main-container230">
                <span class="main-text355">Min</span>
              </div>
              <div class="main-container231">
                <span class="main-text356">Місяць</span>
              </div>
              <div class="main-container232">
                <span class="main-text357">
                  <span>Max</span>
                  <br />
                </span>
              </div>
              <div class="main-container233">
                <span class="main-text360">Місяць</span>
              </div>
              <div class="main-container234">
                <span class="main-text361">Коефіцієнт нерівності</span>
              </div>
            </div>
            <div class="main-container235">
              <div class="main-container236">
                <span class="main-text362">
                  <span>'.(round($averyear / $count, 3)).'</span>
                  <br />
                </span>
              </div>
              <div class="main-container237">
                <div class="main-container238">
                  <span class="main-text365">'.$min.'</span>
                </div>
                <div class="main-container239">
                  <span class="main-text366">'.$minmonth.'</span>
                </div>
                <div class="main-container240">
                  <span class="main-text367">'.$max.'</span>
                </div>
                <div class="main-container241">
                  <span class="main-text368">'.$maxmonth.'</span>
                </div>
                <div class="main-container242">
                  <span class="main-text369">'.(round(($min/$max), 3)).'</span>
                </div>
              </div>
            </div>
          </div>';
          $sql2 = "SELECT price FROM resources WHERE id = $row[3]";
          $answer2 = mysqli_query($con, $sql2) or die (mysqli_error($con));
          $row2 = mysqli_fetch_array($answer2);
          array_push($graph2, $summ2 * $row2[0]);
          $x++;
        }
        // echo '<span>Графік витрат по ресурсам:</span>
        // <div id="graph1" style="width: 900px; height: 600px;" ></div>
        // <button id="downloadPdfBtn1" style="margin: 20px;" class="button">Завантажити PDF</button>';
        // if ($year1 == "all") {
        //   echo '<span>Графік грошових витрат по рокам:</span>
        //   <div id="graph2" style="width: 900px; height: 600px;"></div>
        //   <button id="downloadPdfBtn2" style="margin: 20px;" class="button">Завантажити PDF</button>';
        // }
        }




        if (isset($_REQUEST["selectgraph"])) {
          $pokaznik = $_REQUEST["pokaznik"];
          $type1 = $_REQUEST["type1"];
          $year1 = $_REQUEST["year1"];
          $graph = 0;
          
          if ($year1 == "all") {
            // echo '<span>Графік грошових витрат по рокам:</span>
            // <div id="graph2" style="width: 900px; height: 600px;"></div>
            // <button id="downloadPdfBtn2" style="margin: 20px;" class="button">Завантажити PDF</button>';
            $sql = "SELECT * FROM resourсу_quantity WHERE str_el = $type1 AND resource = $pokaznik";
          }
          else {
            $graph = 1;
            $sql = "SELECT * FROM resourсу_quantity WHERE str_el = $type1 AND year = $year1 AND resource = $pokaznik";
          }
          $answer = mysqli_query($con, $sql) or die (mysqli_error($con));
          
        $graph2 = array();
        $graph1 = array();
        $x = 0;
        while ($row = mysqli_fetch_array($answer)) {
          $temp = array('1', 'Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень');
          
          $averyear = 0;
          $count = 0;
          if ($row[4] == 0) {
            $days = 0;
            $aver = 0;
            $min = 100000;
          }
          else {
            $sql1 = "SELECT days FROM days_in_month WHERE month = $row[2] and year = $row[1]";
            $answer1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
            $row1 = mysqli_fetch_array($answer1);
            $aver = (round($row[4]/$row1[0], 2));
            $days = $row1[0];
            $min = $aver;
            $count++;
            $averyear += $aver;
          }
          $summ2 = $row[4];
          array_push($graph1, [$x, $aver]);
          
          $minmonth = $row[2];
          $max = $aver;
          $maxmonth = $row[2];
          
              for ($i = 1; $i < 6; $i++) {
                $row = mysqli_fetch_array($answer);
                if ($row[4] == 0) {
                  $days = 0;
                  $aver = 0;
                }
                else {
                  $sql1 = "SELECT days FROM days_in_month WHERE month = $row[2] and year = $row[1]";
                  $answer1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
                  $row1 = mysqli_fetch_array($answer1);
                  $aver = (round($row[4]/$row1[0], 2));
                  $days = $row1[0];
                  $count++;
                  $averyear += $aver;
                }
                if (($aver < $min) and $aver != 0) {
                  $min = $aver;
                  $minmonth = $row[2];
                }
                if ($aver > $max) {
                  $max = $aver;
                  $maxmonth = $row[2];
                }
                $summ2 += $row[4];
                array_push($graph1, [$x, $aver]);
                
              }
              
            $temp = array('2', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень');
            $summ2 += $row[4];
            array_push($graph1, [$x, $aver]);
            $row = mysqli_fetch_array($answer);
            if ($row[4] == 0) {
              $days = 0;
              $aver = 0;
            }
            else {
              $sql1 = "SELECT days FROM days_in_month WHERE month = $row[2] and year = $row[1]";
              $answer1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
              $row1 = mysqli_fetch_array($answer1);
              $aver = (round($row[4]/$row1[0], 2));
              $days = $row1[0];
              $count++;
              $averyear += $aver;
            }
          
          if ($row[4] == 0) {
            $days = 0;
            $aver = 0;
          }
          else {
            $aver = (round($row[4]/$row1[0], 2));
            $days = $row1[0];
            $count++;
            $averyear += $aver;
          }
                if  (($aver < $min) and $aver != 0) {
                  $min = $aver;
                  $minmonth = $row[2];
                }
                if ($aver > $max) {
                  $max = $aver;
                  $maxmonth = $row[2];
                }
          
              for ($i = 1; $i < 6; $i++) {
                $row = mysqli_fetch_array($answer);
                if ($row[4] == 0) {
                  $days = 0;
                  $aver = 0;
                }
                else {
                  $sql1 = "SELECT days FROM days_in_month WHERE month = $row[2] and year = $row[1]";
                  $answer1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
                  $row1 = mysqli_fetch_array($answer1);
                  $aver = (round($row[4]/$row1[0], 2));
                  $days = $row1[0];
                  $count++;
                  $averyear += $aver;
                }
                if  (($aver < $min) and $aver != 0) {
                  $min = $aver;
                  $minmonth = $row[2];
                }
                if ($aver > $max) {
                  $max = $aver;
                  $maxmonth = $row[2];
                }
                $summ2 += $row[4];
                array_push($graph1, [$x, $aver]);
                
              }
              
          $sql2 = "SELECT price FROM resources WHERE id = $row[3]";
          $answer2 = mysqli_query($con, $sql2) or die (mysqli_error($con));
          $row2 = mysqli_fetch_array($answer2);
          array_push($graph2, $summ2 * $row2[0]);
          $x++;
        }
        echo '<span>Графік витрат по ресурсам:</span>
        <div id="graph1" style="width: 900px; height: 600px;" ></div>
        <button id="downloadPdfBtn1" style="margin: 20px;" class="button">Завантажити PDF</button>';
        if ($year1 == "all") {
          echo '<span>Графік грошових витрат по рокам:</span>
          <div id="graph2" style="width: 900px; height: 600px;"></div>
          <button id="downloadPdfBtn2" style="margin: 20px;" class="button">Завантажити PDF</button>';
        }
        }

        if (isset($_REQUEST["select4"])) {
          $pie = 0;
          $type1 = $_REQUEST["type1"];
          $year1 = $_REQUEST["year1"];
          if ($year1 == "all") {
            $pie = 1;
            $sql = "SELECT * FROM resourсу_quantity WHERE str_el = $type1 ORDER BY year, resource, month";
            echo '<div class="blocks-container">';
            for ($i = 1; $i < 11; $i++) {
               echo '<div class="newblock"><span>Енергоресурс за '.($i+2012).':</span>
        <div id="pie'.$i.'" style="width: 800px; height: 600px;" ></div></div>';
            }
            echo '</div>';
          }
          else {
            $sql = "SELECT * FROM resourсу_quantity WHERE str_el = $type1 AND year = $year1";
            echo '<span>Енергоресурс за   '.$year1.':</span>
        <div id="graph2" style="width: 800px; height: 600px;" ></div>';
          }
          $answer = mysqli_query($con, $sql) or die (mysqli_error($con));
          $summs = array();
          $s = 0;
          while ($row = mysqli_fetch_array($answer)) {
            $s = $row[4];
            // echo "Початок:".$s." ";
            for ($i = 0; $i <11; $i++) {
              $row = mysqli_fetch_array($answer);
              $s += $row[4];
              // echo $s." ";
            }
            $sql1 = "SELECT * FROM resources WHERE id = $row[3]";
            $answer1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
            $row1 = mysqli_fetch_array($answer1);
            array_push($summs, [$row1[1], ($s * $row1[3])]);
          }
          //echo var_export($summs);
        }

        if (isset($_REQUEST["select5"])) {
          $elem = $_REQUEST["elem"];
          $comment = $_REQUEST["comment"];
          $pokaz = $_REQUEST["pokaz"];
          $year2 = $_REQUEST["year2"];
          if ($year2 != 0 and $year2 != NULL) {
            $temp = $year2;
          }
          else {
            $temp = "all";
          }
          $sql0 = "INSERT comments(str_el, type, resource, year, comment) VALUES ('$elem', 'Res. amount', $pokaz, '$temp', '$comment');";
          mysqli_query($con, $sql0);
          echo '<span class="main-text">Записано. Можете повернутися назад до діаграм.</span>';
        }

        if (isset($_REQUEST["select6"])) {
          $elem = $_REQUEST["elem2"];
          $comment = $_REQUEST["comment2"];
          $pokaz = $_REQUEST["pokaz2"];
          $year3 = $_REQUEST["year3"];
          if ($year3 != 0 and $year3 != NULL) {
            $temp = $year3;
          }
          else {
            $temp = "all";
          }
          $sql0 = "INSERT comments(str_el, type, resource, year, comment) VALUES ('$elem', 'Money amount', $pokaz, '$temp', '$comment');";
          mysqli_query($con, $sql0);
          echo '<span class="main-text">Записано. Можете повернутися назад до діаграм.</span>';
        }

        if (isset($_REQUEST["select7"])) {
          $elem = $_REQUEST["elem3"];
          $comment = $_REQUEST["comment3"];
          $pokaz = $_REQUEST["pokaz3"];
          $year4 = $_REQUEST["year4"];
          if ($year4 != 0 and $year4 != NULL) {
            $temp = $year4;
          }
          else {
            $temp = "all";
          }
          $sql0 = "INSERT comments(str_el, type, resource, year, comment) VALUES ('$elem', 'Energy balance', $pokaz, '$temp', '$comment');";
          mysqli_query($con, $sql0);
          echo '<span class="main-text">Записано. Можете повернутися назад до діаграм.</span>';
        }

        if (isset($_REQUEST["select8"])) {
          echo '<div class="main-container245">
          <div class="main-container246">
            <div class="main-container247"><span>ID</span></div>
            <div class="main-container248"><span>Підрозділ</span></div>
            <div class="main-container249"><span>Тип</span></div>
            <div class="main-container250"><span>Ресурс</span></div>
            <div class="main-container251"><span>Рік</span></div>
            <div class="main-container252"><span>Коментар</span></div>
          </div>
        ';
          $sql = "SELECT * from comments;";
          $answer = mysqli_query($con, $sql) or die (mysqli_error($con));
          while ($row = mysqli_fetch_array($answer)) {

            echo '<div class="main-container246">
            <div class="main-container247"><span>'.$row[0].'</span></div>
            <div class="main-container248"><span>'.$row[1].'</span></div>
            <div class="main-container249"><span>'.$row[2].'</span></div>
            <div class="main-container250"><span>'.$row[3].'</span></div>
            <div class="main-container251"><span>'.$row[4].'</span></div>
            <div class="main-container252"><span>'.$row[5].'</span></div>
          </div>
        ';
          }
          echo '</div>';
        }

        if (isset($_REQUEST["selectind"])) {
          $pokaznik = $_REQUEST["pokaznik"];
          $type1 = $_REQUEST["type1"];
          $year1 = $_REQUEST["year1"];
          $this1 = 1;
          if ($type1 == "all" AND $year1 == "all") {
            $sql = "SELECT * FROM resourсу_quantity WHERE resource = $pokaznik order by year, month, str_el;";
            $this1 = 10;
          }
          elseif ($type1 == "all") {
            $sql = "SELECT * FROM resourсу_quantity WHERE resource = $pokaznik AND year = $year1 order by month, str_el;";
            $this1 = 10;
          }
          elseif ($year1 == "all") {
            $sql = "SELECT * FROM resourсу_quantity WHERE str_el = $type1 AND resource = $pokaznik";
          }
          else {
            $sql = "SELECT * FROM resourсу_quantity WHERE str_el = $type1 AND year = $year1 AND resource = $pokaznik";
          }
          $answer = mysqli_query($con, $sql) or die (mysqli_error($con));
          //$sql = "SELECT * FROM resourсу_quantity resource = 1 order by year, month, str_el;";
          
          echo '<span class="main-text034">
          Показник (конкретний ресурс: к-сть ел-ен. і т.д.)
        </span>
        <div class="main-container036">
              
              <div class="main-container037">
              <div class="main-container054"><span class="main-text053">Рік</span></div>
              <div class="main-container054"><span class="main-text053">Місяць</span></div>
              <div class="main-container054" style="width: 150px;"><span class="main-text053">Підрозділ</span></div>
              <div class="main-container054" style="width: 150px;"><span class="main-text053">Ресурс</span></div>
              <div class="main-container054"><span class="main-text053">Площа, м2</span></div>
              <div class="main-container054"><span class="main-text053">Витрати, грн</span></div>
              <div class="main-container054"><span class="main-text053">Індикатор</span></div>';
            echo "</div>";

          while($row = mysqli_fetch_array($answer)) {
              echo '<div class="main-container051">
                <div class="main-container054">
                  <span class="main-text053">
                    <span>'.$row[1].'</span>
                    <br />
                  </span>
                </div><div class="main-container053">';
                  $sql1 = "SELECT * FROM objects WHERE id = $row[0]";
                  $answer1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
                  $row1 = mysqli_fetch_array($answer1);
                  $sql2 = "SELECT * FROM resources WHERE id = $row[3]";
                  $answer2 = mysqli_query($con, $sql2) or die (mysqli_error($con));
                  $row2 = mysqli_fetch_array($answer2);
                  echo "<div class='main-container054'><span class='main-text053'>".$row[2]."</span></div>";
                  echo "<div class='main-container054' style='width: 150px;'><span class='main-text053'>".$row1[1]."</span></div>";
                  echo "<div class='main-container054' style='width: 150px;'><span class='main-text053'>".$row2[1]."</span></div>";
                  echo "<div class='main-container054'><span class='main-text053'>".$row1[2]."</span></div>";
                  echo "<div class='main-container054'><span class='main-text053'>".$row[4]."</span></div>";
                  echo "<div class='main-container054'><span class='main-text053'>".($row[4] / $row1[2])."</span></div>";
                  
                echo "</div>";
            echo "</div>";
            }
            echo "</div>";
            
      }

      if (isset($_REQUEST["selectco"])) {
        $sql = "SELECT * FROM resourсу_quantity where resource = 8 order by year, month;";
        $answer = mysqli_query($con, $sql) or die (mysqli_error($con));
        
        
        echo '<span class="main-text034">
      </span>
      <div class="main-container036">
            <div class="main-container037">
            <div class="main-containerspec"><span class="main-text053">Рік</span></div>
            <div class="main-containerspec"><span class="main-text053">Місяць</span></div>
            <div class="main-containerspec"><span class="main-text053">Підрозділ</span></div>
            <div class="main-containerspec"><span class="main-text053">Ресурс</span></div>
            <div class="main-containerspec"><span class="main-text053">Спожито</span></div>
            <div class="main-containerspec"><span class="main-text053">Вироблено</span></div>
            <div class="main-containerspec"><span class="main-text053">Індикатор питомої енергоємності</span></div>
            <div class="main-containerspec"><span class="main-text053">Викиди CO2</span></div>
            <div class="main-containerspec"><span class="main-text053">Індикатор питомих викидів</span></div>';
          echo "</div>";

        while($row = mysqli_fetch_array($answer)) {
            echo '<div class="main-container051">
              <div class="main-containerspec">
                <span class="main-text053">
                  <span>'.$row[1].'</span>
                  <br />
                </span>
              </div><div class="main-container053">';
                $sql1 = "SELECT * FROM objects WHERE id = $row[0]";
                $answer1 = mysqli_query($con, $sql1) or die (mysqli_error($con));
                $row1 = mysqli_fetch_array($answer1);

                $sql2 = "SELECT * FROM resourсу_quantity where resource = 1 and year = $row[1] and month = $row[2] and str_el = 1;";
                $answer2 = mysqli_query($con, $sql2) or die (mysqli_error($con));
                $row2 = mysqli_fetch_array($answer2);

                $sql3 = "SELECT * FROM resourсу_quantity where resource = 9 and year = $row[1] and month = $row[2] and str_el = 1;";
                $answer3 = mysqli_query($con, $sql3) or die (mysqli_error($con));
                $row3 = mysqli_fetch_array($answer3);
                $monthsInUkrainian = array(
                  1 => 'Січень',
                  2 => 'Лютий',
                  3 => 'Березень',
                  4 => 'Квітень',
                  5 => 'Травень',
                  6 => 'Червень',
                  7 => 'Липень',
                  8 => 'Серпень',
                  9 => 'Вересень',
                  10 => 'Жовтень',
                  11 => 'Листопад',
                  12 => 'Грудень'
              );
                echo "<div class='main-containerspec'><span class='main-text053'>".$monthsInUkrainian[$row3[2]]."</span></div>";
                echo "<div class='main-containerspec'><span class='main-text053'>".$row1[1]."</span></div>";
                echo "<div class='main-containerspec'><span class='main-text053'>Електроенергія</span></div>";
                echo "<div class='main-containerspec'><span class='main-text053'>".$row2[4]."</span></div>";
                echo "<div class='main-containerspec'><span class='main-text053'>".$row[4]."</span></div>";
                echo "<div class='main-containerspec'><span class='main-text053'>".(round($row2[4] / $row[4], 2))."</span></div>";
                echo "<div class='main-containerspec'><span class='main-text053'>".$row3[4]."</span></div>";
                echo "<div class='main-containerspec'><span class='main-text053'>".(round($row3[4] / $row[4], 2))."</span></div>";
                
              echo "</div>";
          echo "</div>";
          }
          echo "</div>";
          
    }

        


        ?>
        </div>
      <script type="text/javascript">
      google.charts.load('current', {
        'packages':['corechart'],
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawPie);

      function drawPie() {
        forcomm3.style.display = "block";
        var is = <?php echo $pie ?>;
        if (is == 1) {
          <?php
          if ($pie == 1) {
            echo "var options = {
            };
            ";
            for ($j = 1; $j <11; $j++) {
            echo "var data".$j." = google.visualization.arrayToDataTable([
            ['resource', 'number'],";
              for ($i = 0; $i <7; $i++) {  
                  echo "['".$summs[($i + ($j-1)*7)][0]."', ".$summs[($i + ($j-1)*7)][1]."],";  
                 }
            echo "]);
        var chart".$j." = new google.visualization.PieChart(document.getElementById('pie".$j."'));
        chart".$j.".draw(data".$j.", options);
            "; 
          }
          }
          else {

          }
          ?>
        }
        else {
          var data = google.visualization.arrayToDataTable([
          ['resource', 'number'],
          <?php  
            for ($i = 0; $i <7; $i++) {  
                echo "['".$summs[$i][0]."', ".$summs[$i][1]."],";  
               }  
          ?>
          ]);
        var options = {
        };
			var tempch = new google.visualization.PieChart(document.getElementById("graph2"));
			tempch.draw(data, options);
        }
      }
    </script>

<script type="text/javascript">
  google.charts.load('current', {
        'packages':['corechart'],
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawGraph2);

      function drawGraph2() {
        // select5.style.display = "block";
        // comment.style.display = "block";
        forcomm.style.display = "block";
        var data1 = new google.visualization.DataTable();
        data1.addColumn('number', 'month');
        <?php
        if ($graph == true) {
          echo "data1.addColumn('number', 'year'); ";
        }
        else {
          // echo 'forcomm2.style.display = "block";';
          for ($i = 2013; $i <2023; $i++) {
            echo "data1.addColumn('number', '".$i."'); ";
          }
        }
        ?>
        data1.addRows([
          <?php
          $temp = 0;
            for ($i = 0; $i <12; $i++) {
              echo "[".($i + 1);
              if ($graph == true) {
                if ($graph1[($i)][1] == 0) {
                  echo ", null";
                }
                else {

                  echo ", ".$graph1[($i)][1];
                }
              }
              else {
                for ($j = 0; $j <10; $j++) {
                  if ($graph1[($j * 12 + $i)][1] == 0) {
                    echo ", null";
                  }
                  else {
  
                    echo ", ".$graph1[($j * 12 + $i)][1];
                  }
                  }
              }
              echo "], ";
          }
            ?>
        ]);
        var options1 = {
			    interpolateNulls: false,
          title: 'Графік витрат по ресурсам:',
        };
      var tempch1 = new google.visualization.LineChart(document.getElementById("graph1"));
      google.visualization.events.addListener(tempch1, 'ready', function () {
            document.getElementById('downloadPdfBtn1').addEventListener('click', function () {
                // Створюємо новий об'єкт jsPDF
                window.jsPDF = window.jspdf.jsPDF;
                var pdf = new jsPDF();

                // Отримуємо URL зображення графіка
                var chartImageURL = tempch1.getImageURI();

                // Додаємо зображення у PDF
                pdf.addImage(chartImageURL, 'PNG', 10, 10, 180, 100);

                // Завантажуємо PDF файл
                pdf.save('graph.pdf');
            });
        });
			tempch1.draw(data1, options1);
      var is = <?php echo $graph ?>;
      if (is == 0) {
        var data = google.visualization.arrayToDataTable([
             ['month', 'гривні'],
            <?php
            if ($graph == true) {
              echo "['2013',1],";
            }
            else {
              for ($i = 0; $i <10; $i++) {
                echo "['".($i+ 2013)."',".($graph2[$i])."],";
              }
            }
            ?>],
			);
			var options = {
        title: 'Графік фінансових витрат по рокам',
        };
			var chart = new google.visualization.LineChart(document.getElementById("graph2"));

      google.visualization.events.addListener(chart, 'ready', function () {
            document.getElementById('downloadPdfBtn2').addEventListener('click', function () {
                // Створюємо новий об'єкт jsPDF
                window.jsPDF = window.jspdf.jsPDF;
                var pdf = new jsPDF();

                // Отримуємо URL зображення графіка
                var chartImageURL = chart.getImageURI();

                // Додаємо зображення у PDF
                pdf.addImage(chartImageURL, 'PNG', 10, 10, 180, 100);

                // Завантажуємо PDF файл
                pdf.save('graph.pdf');
            });
        });


        chart.draw(data, options);
      }
      }

      // // Функція для завантаження графіку у вигляді PDF
      // function downloadPdf() {
      //   console.log("fds")
      //   // Створюємо новий об'єкт jsPDF
      //   window.jsPDF = window.jspdf.jsPDF;
      //   var pdf = new jsPDF();

      //   // Отримуємо зображення графіку у форматі Data URL
      //   var can = document.getElementById("graph1");
      //   var graphImage = can[0].toDataURL("image/png");

      //   // Додаємо зображення у PDF
      //   pdf.addImage(graphImage, 'PNG', 10, 10, 180, 100); // Параметри: зображення, формат, x, y, ширина, висота

      //   // Завантажуємо PDF файл
      //   pdf.save('graph.pdf');
      // }

      // // Додаємо обробник кліку на кнопці
      // document.getElementById('downloadPdfBtn').addEventListener('click', downloadPdf);

      // document.getElementById('downloadPdfBtn').addEventListener('click', function() {
      //   console.log("fds")
      //   // Отримуємо елемент, який потрібно конвертувати в PDF
      //   var element = document.getElementById('graph1');

      //   // Запускаємо функцію для створення PDF
      //   html2pdf(element);
      // });

      // document.getElementById('downloadPdfBtn').addEventListener('click', function() {
      //   // Отримуємо елемент, який потрібно конвертувати в PDF
      //   var element = document.getElementById('graph1');

      //   // Запускаємо html2canvas для знімання зображення елемента
      //   html2canvas(element).then(function(canvas) {
      //     // Створюємо новий об'єкт jsPDF
      //     window.jsPDF = window.jspdf.jsPDF;
      //     var pdf = new jsPDF();

      //     // Додаємо зображення у PDF
      //     pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 10, 10, 180, 100); // Параметри: зображення, формат, x, y, ширина, висота

      //     // Завантажуємо PDF файл
      //     pdf.save('graph.pdf');
      //   });
      // });

      
    </script>

<script>
    // При завантаженні сторінки встановити вкладку збережену в локальному сховищі
    window.onload = function () {
        var urlParams = new URLSearchParams(window.location.search);
        var selectedTab = urlParams.get('tab');
        if (selectedTab) {
            showTab(selectedTab);
        }
    };

    function showTab(tabId) {
        // Знайдемо всі елементи з класом "tab-content" і приховаємо їх
        var tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(function (tabContent) {
            tabContent.classList.remove('active');
        });

        // Показати вміст вкладки з відповідним ID
        document.getElementById(tabId).classList.add('active');

        // Зберегти вибір вкладки в локальному сховищі
        localStorage.setItem('selectedTab', tabId);

        // Оновити URL, додаючи параметр "tab"
        var urlParams = new URLSearchParams(window.location.search);
        urlParams.set('tab', tabId);
        var newUrl = window.location.pathname + '?' + urlParams.toString();
        window.history.pushState({}, '', newUrl);
    }
</script>
          
      </div>
    </div>
    <script
      data-section-id="header"
      src="https://unpkg.com/@teleporthq/teleport-custom-scripts"
    ></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  </body>
</html>