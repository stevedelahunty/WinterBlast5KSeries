<?php

require_once("common.php");


$db = new DatabaseContext("lightboxreg");

echo "New scoring software - 100% Database driven\n";

// Setup name mapping
$nameMapping = array(
    "Jon Kovar" => "Jonathan Kovar",
//    "T. Wood" => "Tommy Wood",
//    "P. Rizzo" => "Parker Rizzo",
//    "L. Rizzo" => "Lillian Rizzo",
//    "J. Klene" => "Jack Klene",
//    "M. Klene" => "McKenna Klene",
//    "E. Popham" => "Evelyn Popham",
    "Thomas Raffio" => "Tom Raffio"
    );


$seriesEventName = "BringOnTheHeat 2025";
$q = "select * from series where name='".$seriesEventName."'";
echo $q."\n";

$row = $db->singleRowQuery($q);
if ($row == null) {
    echo "Series event name not found! Creating it...\n";
    $q = "insert into series (name) values ('".$seriesEventName."')";
    $db->query($q);
    $q = "select * from series where name='".$seriesEventName."'";
    $row = $db->singleRowQuery($q);
    if ($row == null) {
        echo "Oops. Series was never created!\n";
        return;
    }
}

$id = $row['id'];
$seriesId = $id;


$rsu = new RunSignup();
$rsu->login("steve.delahunty@gmail.com", "MageNovus99!!");
$raceName = 'Judy “Jutz” George 5k';
$raceId = $rsu->findRace($raceName);
var_dump($raceId);
if ($raceId == 0) {
    echo "Race not found: ".$raceName."\n";
    return;
}
return;

$events = $rsu->getAllEvents($raceId);
//var_dump($events);
$event5K = 956678;

$sets = $rsu->getAllResultSets($raceId, $event5K);
//var_dump($sets);
$resultSet5K = 541258;
$resultSet5KName = "5k Overall Results";
echo "Race ID = ".$raceId."\n";
echo "Event ID for the 5K = ".$event5K."\n";
echo "Result Set for the 5K = ".$resultSet5K."\n";
echo "Result Set Name for the 5K = ".$resultSet5KName."\n";

$results = $rsu->getRaceResults($raceId, $event5K, $resultSet5KName);
var_dump($results);

return;

// First race as the Judy "Jutz" race.
$raceId = 178088;

// Get the info...

echo "Series event name found. ID=".$row['id'].". Getting races...\n";
return;



$id = $row['id'];
$seriesId = $id;

// Delete all scoring previous scoring....
$q = "delete from series_participants where seriesId=".$seriesId;
$db->query($q);



$q = "select * from series_events where seriesId='".$id."'";
$results = $db->query($q);
if ($results == null) {
    echo "No races found\n";
    return;
}
echo $results->rowCount()." races found\n";
$counter=0;
foreach ($results as $row) {
    echo "Race: ".$row['raceName']."   Source=".$row['source']."  Alg=".$row['alg']."  RSet=".$row['resultsSetName']."\n";
    if ($row['source'] == "runsignup") {
        runsignupRace($row);
    } else if ($row['source'] == "iresults") {
        iresultsRace($row);
    }
    //if (++$counter > 4)
     //   exit(0);
}
calculateTotals($db);
calculateTotals($db);
echo "Generating the table...\n";
generateTable($db, "leaderboard2", "M");
generateTable($db, "leaderboard2", "F");

generateTable2($db, "hopkinton", "M");
generateTable2($db, "hopkinton", "F");
return;

function checkForMappedName($name, $nameMapping) {
    foreach ($nameMapping as $origName=>$newName) {
        if ($name == $origName) return($newName);
    }
    return($name);
}

function runsignupRace($row) {
    global $db, $nameMapping;

    $raceName = trim($row['raceName']);
    $raceNumber = trim($row['raceNumber']);
    echo "RunSignup Race: name=(".$raceName.")\n";
    $rsu = new RunSignup();
    if ($rsu->login("steve.delahunty@gmail.com", "MageNovus99!!") == false) {
        echo "Unable to log into RunSignup.\n";
        return;
    }
    echo "Okay, Successfully logged into RunSignup...\n";
    echo "Hello ".$rsu->fullName."\n";

    // For the algorithm 'entered', give them points if we see them entered
    if ($row['alg'] == "entered") {
        $participants = $rsu->getAllParticipants($row['raceId'], $row['eventId']);
        if ($participants == null) {
            echo "Oops, can't get participants?!?\n";
            echo "Last error = ".$rsu->lastErrorMessage."\n";
            exit(0);
        }
        echo "List of Participants...Total = ".count($participants)."\n";
        $place = 1;
        $seconds = 0;
        $points = $row['maxPoints'];
        foreach ($participants as $participant) {
            //echo $participant->user->first_name." ".$participant->user->last_name." Sex=".$participant->user->gender."  Age=".$participant->age."\n";
            $fullName = trim($participant->user->first_name)." ".trim($participant->user->last_name);
            $fullName = checkForMappedName($fullName, $nameMapping);

            $sex = $participant->user->gender;
            $age = $participant->age;
            $netTime = "";
            dbStore($db, "race".$raceNumber."Points","race".$raceNumber."Time", $fullName, $sex, $age, $place, $netTime, $seconds, $points);
            $place++;
        }
    }
    else if ($row['alg'] == "place") {
        // We need to get all the results for this results set....
        echo "Getting all results for ".$row['raceName']."\n";
        $results = $rsu->getRaceResults($row['raceId'], $row['eventId'], $row['resultsSetName']);
        /*
         * RSU will not give us the complete names of kids under 13 so grab the list of participant
         * (which does provide the full name), use the bib # to find the full name of the participant
         * and replace it.
         */
        $participants = $rsu->getAllParticipants($row['raceId'], $row['eventId']);
        $idx=1;
        foreach ($results as $finisher) {
            echo $idx++.") bib=".$finisher->bib." ".$finisher->first_name." ".$finisher->last_name."\n";
            foreach ($participants as $p) {
//                var_dump($p);
//                exit(0);
                if ($p->bib_num == $finisher->bib) {
//                    echo "FOUND IT!  Name=".$p->user->first_name." ".$p->user->last_name."\n";
                    $finisher->first_name = $p->user->first_name;
                    $finisher->last_name = $p->user->last_name;
                }
            }
        }
        processRunSignupRace($db, $results, 'M', $row['maxPoints'], "race".$row['raceNumber']);
        processRunSignupRace($db, $results, 'F', $row['maxPoints'], "race".$row['raceNumber']);
    }

    return;
}

function iresultsRace($row) {
    global $db;
    echo "iResults Race!!! Race ID = ".$row['raceId']." MaxPoints=".$row['maxPoints']."\n";
    $q = "select * from iresults where id=".$row['raceId']."\n";
    $iresultsRow = $db->singleRowQuery($q);
    $eventId = $iresultsRow['event_id'];
    $raceName = $iresultsRow['race_name'];
    echo "EventId = ".$eventId.", RaceName = ".$raceName."\n";


    $q = "select * from iresults_results where event_id=".$eventId." and race_name='".$raceName."' ";
    $q .= " and sex='M' ";
    $q .= " order by overall_place";
    $results = $db->query($q);
    echo "Number of results records = ".$results->rowCount()."\n";
    processiResultsRace($db, $results, 'M', $row['maxPoints'], "race".$row['raceNumber']);

    $q = "select * from iresults_results where event_id=".$eventId." and race_name='".$raceName."' ";
    $q .= " and sex='F' ";
    $q .= " order by overall_place";
    $results = $db->query($q);
    echo "Number of results records = ".$results->rowCount()."\n";

    processiResultsRace($db, $results, 'F', $row['maxPoints'], "race".$row['raceNumber']);

//    var_dump($iresultsRow);
}

function processiResultsRace($db, $results, $sex, $maxPoints, $raceName) {
    global $nameMapping;
    echo "--------\nProcessing race: ".$raceName.", Sex=".$sex."   MaxPoints = ".$maxPoints."\n";
    $bestTime = 0;
    foreach ($results as $row) {
        $place = $row['overall_place'];
        $netTime = $row['net_time'];
        $age = $row['age'];
        $seconds = getSeconds($netTime);
        $fullName = $row['first_name']." ".$row['last_name'];
        $fullName = checkForMappedName($fullName, $nameMapping);

        if ($bestTime == 0) {
            $bestTime = $seconds;
        }
        echo "Best time = ".$bestTime."\n";

        $points = ($bestTime/$seconds)*$maxPoints;
        $points = round($points, 2);

        echo $place.": ".$fullName." ".$netTime."   ".$seconds."   Points=".$points."\n";
        dbStore($db, $raceName."Points", $raceName."Time",$fullName, $sex, $age, $place, $netTime, $seconds, $points);
    }
}

function processRunSignupRace($db, $results, $sex, $maxPoints, $raceName) {
    global $nameMapping;
    echo "--------\nProcessing RunSignup race: ".$raceName.", Sex=".$sex."   MaxPoints = ".$maxPoints."\n";
    $bestTime = 0;
    foreach ($results as $finisher) {
        if ($finisher->gender != $sex) continue;
        $place = $finisher->place;
        $netTime = $finisher->chip_time;
        $age = $finisher->age;
        $seconds = getSeconds($finisher->chip_time);
        //var_dump($finisher);

        $fullName = $finisher->first_name." ".$finisher->last_name;
        $fullName = checkForMappedName($fullName, $nameMapping);
        if ($finisher->last_name == "Wood") {
            //var_dump($finisher);
        }
        if ($bestTime == 0) {
            $bestTime = $seconds;
        }
        echo "Best time = ".$bestTime."\n";
        if ($bestTime == 0) return;
        echo "max points = ".$maxPoints."\n";
        echo "seconds = ".$seconds."\n";
        if ($seconds == 0) continue;

        $points = ($bestTime/$seconds)*$maxPoints;
        $points = round($points, 2);

        echo $place.": ".$fullName." ".$netTime."   ".$seconds."   Points=".$points."\n";
        dbStore($db, $raceName."Points", $raceName."Time", $fullName, $sex, $age, $place, $netTime, $seconds, $points);
    }
}

function dbStore($db, $pointsField, $timeField, $name, $sex, $age, $place, $time, $seconds, $points)
{
    global $seriesId;

    //echo $name . "   " . $place . "   " . $time . " - " . $seconds . "   Points = " . $points . "\n";
    $name = urlencode($name);
    $q = "select * from series_participants where participantName='" . $name . "'";
    $row = $db->singleRowQuery($q);
    //    echo $q."\n";
    if ($row != NULL) {
        //echo "Updating ".$name."\n";
        $q = "update series_participants set " . $pointsField . "='" . $points . "'";
        $q .= ", ".$timeField . "='" . $time . "'";
        $q .= " where id=" . $row['id'];
        $db->query($q);
        echo $name . " - " . $q . "\n";
    } else {
        echo "Inserting ".$name."\n";
        $q = "insert into series_participants(seriesId, participantName, " . $pointsField . ", ".$timeField.", sex, age) values (";
        $q .= " '" . $seriesId . "' ";
        $q .= ", '" . $name . "' ";
        $q .= ", '" . $points . "' ";
        $q .= ", '" . $time . "' ";
        $q .= ", '" . $sex . "' ";
        $q .= ", '" . $age . "' ";
        $q .= ")";
        $db->query($q);
        echo $q . "\n";
    }
}

function calculateTotals($db) {
    global $seriesId;
    global $ageGroups;

    $q = "select * from series_participants where seriesId=".$seriesId;

    $results = $db->query($q);
    $maxRaces = 10;
    foreach ($results as $row) {
        $totalPoints1 = 0;
        $totalRaces1 = 0;
        for ($i=0; $i<$maxRaces; $i++) {
            $points = $row['race'.($i+1)."Points"];
            if ($points > 0) $totalRaces1++;
            $totalPoints1 += $points;
        }

        //  Check on the Hopkinton race.
        $totalPoints2=0;
        $totalRaces2 = 0;

        $points = $row['race4'."Points"];
        $totalPoints2 += $points;
        if ($points > 0) $totalRaces2++;

        $points = $row['race5'."Points"];
        $totalPoints2 += $points;
        if ($points > 0) $totalRaces2++;

        $points = $row['race6'."Points"];
        $totalPoints2 += $points;
        if ($points > 0) $totalRaces2++;

        $q = "update series_participants set totalPoints1=".$totalPoints1.", totalRaces1=".$totalRaces1." ";
        $q .= ", totalPoints2=".$totalPoints2.", totalRaces2=".$totalRaces2." ";
        $q .= " where id=".$row['id']." and seriesId=".$seriesId;
        $db->query($q);
        //echo $q."\n";
    }

    /*
     * Go through the entire list again and set their place and their division name.
     */
    $q = "select * from series_participants where seriesId=".$seriesId;
    $q .= " and sex='M' ";
    $q .= " order by totalPoints1 desc";
    $results = $db->query($q);
    $place = 1;
    foreach ($results as $row) {
        $divName = "undefined";
        foreach ($ageGroups as $group) {
            if ($group[2] != 'M') continue;
            if ($row['age'] >= $group[0] && $row['age'] <= $group[1]) {
                $divName = $group['3'];
                break;
            }
        }
        $q = "update series_participants set ";
        $q .= " overallPlace1=".$place." ";
        $q .= " ,division='".$divName."' ";
        $q .= " where id=".$row['id'];
        $db->query($q);
        $place++;
    }

    /*
     * Go through the entire list again and set their place and their division name.
     */
    $q = "select * from series_participants where seriesId=".$seriesId;
    $q .= " and sex='F' ";
    $q .= " order by totalPoints1 desc";
    $results = $db->query($q);
    $place = 1;
    foreach ($results as $row) {
        $divName = "undefined";
        foreach ($ageGroups as $group) {
            if ($group[2] != 'F') continue;
            if ($row['age'] >= $group[0] && $row['age'] <= $group[1]) {
                $divName = $group['3'];
                break;
            }
        }
        $q = "update series_participants set ";
        $q .= " overallPlace1=".$place." ";
        $q .= " ,division='".$divName."' ";
        $q .= " where id=".$row['id'];
        $db->query($q);
        $place++;
    }


    // Go through the entire list and set their place based on points.
}

function generateTable($db, $prefix, $sex) {
    $q = "select * from series_participants where sex='".$sex."' and totalRaces1 > 0 order by totalPoints1 desc";
//    $q = "select * from scoring_participants where sex='".$sex."' order by totalPoints desc";
    $results = $db->query($q);
    $html = "<table class='table table-striped' width=100%>";

    $html .= "<thead>";
    $html .= "<tr>";
    $html .= "<th scope='col' align=left>Place</th>";
    $html .= "<th scope='col ' align=left>Name</th>";
    $html .= "<th scope='col' align=left>Total Points</th>";
    $html .= "<th scope='col' align=left>Total Races</th>";
    $html .= "<th scope='col' align=left>Virtual</th>";
    $html .= "<th scope='col' align=left>Cornhole</th>";
    $html .= "<th scope='col' align=left>Ginger</th>";
    $html .= "<th scope='col' align=left>Hop1</th>";
    $html .= "<th scope='col' align=left>Hop2</th>";
    $html .= "<th scope='col' align=left>Hop3</th>";
    $html .= "</tr>";
    $html .= "</thead>";
    $html .= "<tbody>";
    $place = 1;
    foreach ($results as $row) {
        $html .= "<tr>";
        $html .= "<td>".$place++."</td>";
        $html .= "<td><b>".urldecode($row['participantName'])."</b></td>";
        $html .= "<td><b>".$row['totalPoints1']."</b></td>";
        $html .= "<td>".$row['totalRaces1']."</td>";
        $style = "font-size: .8em;";
        $html .= "<td style='".$style."'>".$row['race1Points']."</td>";
        $html .= "<td style='".$style."'>".$row['race2Points']."</td>";
        $html .= "<td style='".$style."'>".$row['race3Points']."</td>";
        $html .= "<td style='".$style."'>".$row['race4Points']."</td>";
        $html .= "<td style='".$style."'>".$row['race5Points']."</td>";
        $html .= "<td style='".$style."'>".$row['race6Points']."</td>";
        $html .= "</tr>";
    }
    $html .= "</table>";
    file_put_contents($prefix."_".$sex.".html", $html);

}

function generateTable2($db, $prefix, $sex) {
    $q = "select * from series_participants where sex='".$sex."' and totalRaces2 > 0 order by totalPoints2 desc";
//    $q = "select * from scoring_participants where sex='".$sex."' order by totalPoints desc";
    $results = $db->query($q);
    $html = "<table class='table table-striped' width=100%>";

    $html .= "<thead>";
    $html .= "<tr>";
    $html .= "<th scope='col'  align=left>Place</th>";
    $html .= "<th scope='col' align=left>Name</th>";
    $html .= "<th scope='col' align=left>Total Points</th>";
    $html .= "<th scope='col' align=left>Total Races</th>";
    $html .= "<th scope='col' align=left>Hop1</th>";
    $html .= "<th scope='col' align=left>Hop2</th>";
    $html .= "<th scope='col' align=left>Hop3</th>";
    $html .= "</tr>";
    $html .= "</thead>";
    $html .= "<tbody>";
    $place = 1;
    foreach ($results as $row) {
        $html .= "<tr>";
        $html .= "<td>".$place++."</td>";
        $html .= "<td><b>".urldecode($row['participantName'])."</b></td>";
        $html .= "<td><b>".$row['totalPoints2']."</b></td>";
        $html .= "<td>".$row['totalRaces2']."</td>";
        $style = "font-size: .8em;";
        $html .= "<td style='".$style."'>".$row['race4Points']."</td>";
        $html .= "<td style='".$style."'>".$row['race5Points']."</td>";
        $html .= "<td style='".$style."'>".$row['race6Points']."</td>";
        $html .= "</tr>";
    }
    $html .= "</table>";
    file_put_contents($prefix."_".$sex.".html", $html);

}

function getSeconds($time) {
    $p = explode(":", $time);
    $seconds = 0;
    //echo "Sizeof p = ".sizeof($p)."\n";
    if (sizeof($p) == 1) {
        $seconds = intval($p[0]);
    } else if (sizeof($p) == 2) {
        $seconds = intval($p[0])*60 + intval($p[1]);
    } else if (sizeof($p) == 3) {
        $seconds = intval($p[0])*3600 + intval($p[1])*60 + intval($p[2]);
    }
    return($seconds);
}


