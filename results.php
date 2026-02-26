<section id="standings" class="the-results section-bg">
    <div class="container">
        <div class="section-title">
            <h2>Current Standings</h2>
            <span>Next and final race is Hopkinton Race #3</span>
            <p></p>
        </div>
<?php

//echo "Ooops, looks like a wrong file was uploaded. Please check back later...<br>";
//return;

$showStandings = true;

if (isset($_REQUEST['standings']) == true) {
  $showStandings = true;
} else {


}
echo "<div id=results style='width: 100%; heightt: 800px;'>";
if ($showStandings == true) {

  $tabs = array(
    array("linkName" => "M", "text" => "Men Overall"),
    array("linkName" => "F", "text" => "Women Overall"),
//    array("linkName" => "BM", "text" => "Men's Best 4"),
//    array("linkName" => "BF", "text" => "Women's Best 4"),
  );
  
  echo "<ul class='nav nav-tabs'>";
  if (isset($_REQUEST['tab']) == true) {
    $tabName = $_REQUEST['tab'];
  } else {
    $tabName = "M"; // default
  }
  
  foreach ($tabs as $tab) {
    echo "<li class='nav-item'>\n";
    echo "  <a class='nav-link ";
    if ($tabName == $tab['linkName'])
      echo " active";
    echo "' aria-current='page' ";
    echo "  href='?standings&tab=".$tab['linkName']."#results'>";
    echo $tab['text'];
    echo "   </a>";
    echo "</li>";
  
  }
  echo "</ul>";

    if ($tabName == "M" || $tabName == "F") {
        $pageName = "scoring/2026/leaderboard_" . $tabName . ".html";
    }
    else if ($tabName == "BM" || $tabName == "BF") {
      if ($tabName == "BM")
          $pageName = "scoring/2026/best_M.html";
        else
          $pageName = "scoring/2026/best_F.html";
    }
//  echo $pageName;
  if (file_exists(getcwd()."/".$pageName)) {
//    echo "<a href=".$pageName.">Print - ".$pageName."</a>";
    require_once($pageName);
  } else {
    echo "Page missing: ".$pageName."<br>";
    require_once("missing.php");
  }
}


//require_once("scoring/standings_M.html");
?>


    </div>
</section><!-- End Results Section -->