<?php

require_once("common.php");


$db = new DatabaseContext("lightboxreg");

echo "New scoring software - 100% Database driven\n";

// Setup name mapping
$nameMapping = array(
    "Jon Kovar" => "Jonathan Kovar",
    "Finn Kovar" => "Finnegan Kovar",
    "Chistopher Baerman" => "Christopher Baerman",
//    "T. Wood" => "Tommy Wood",
//    "P. Rizzo" => "Parker Rizzo",
//    "L. Rizzo" => "Lillian Rizzo",
//    "J. Klene" => "Jack Klene",
//    "M. Klene" => "McKenna Klene",
//    "E. Popham" => "Evelyn Popham",
    "Thomas Raffio" => "Tom Raffio",
    "Nicholas Gosling" => "Nick Gosling"
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

// Initialize
$id = $row['id'];
$seriesId = $id;
$rsu = new RunSignup();
$rsu->login("steve.delahunty@gmail.com", "MageNovus99!!");

// Do we delete everything?
if (true) {
    $q = "delete from series_participants where seriesId=".$seriesId;
    $db->query($q);
}


// Find the race... (not needed all the time)

// race #1
if (true) {
    $raceName = 'Judy “Jutz” George 5k';
    $raceId = $rsu->findRace($raceName);
    $eventId = $rsu->getEventByName($raceId, 'Judy “Jutz” George 5k');
    echo "EventID = " . $eventId . "\n";
    $set = $rsu->findResultSets($raceId, $eventId, "5k Overall Results");
    echo "Reset Set ID = " . $set . "\n";

    $participants = $rsu->getAllParticipants($raceId, $eventId);
    echo "Number of participants = " . count($participants) . "\n";


    $results = $rsu->getRaceResultsById($raceId, $eventId, $set);
    $idx = 1;
    foreach ($results as $finisher) {
        echo $idx++ . ") bib=" . $finisher->bib . " " . $finisher->first_name . " " . $finisher->last_name . "\n";
        foreach ($participants as $p) {
            if ($p->bib_num == $finisher->bib) {
                echo "FOUND IT!  Name=" . $p->user->first_name . " " . $p->user->last_name . "\n";
                $finisher->first_name = $p->user->first_name;
                $finisher->last_name = $p->user->last_name;
            }
        }
    }
    processRunSignupRace($db, $results, 'M', 1000, "race1");
    processRunSignupRace($db, $results, 'F', 1000, "race1");
}


// Race #2
if (true) {
    $raceName = 'Franklin VNA and Hospice 5k Run/Walk';
    $raceId = $rsu->findRace($raceName);

    //$events = $rsu->getAllEvents($raceId);
    //var_dump($events);
    $eventId = $rsu->getEventByName($raceId, 'Franklin VNA and Hospice 5k Run/Walk');
    echo "EventID = " . $eventId . "\n";

    //$sets = $rsu->getAllResultSets($raceId, $eventId);
    //var_dump($sets);
    //return;

    $set = $rsu->findResultSets($raceId, $eventId, " 5k Run/Walk Overall Results");
    echo "Reset Set ID = " . $set . "\n";

    $participants = $rsu->getAllParticipants($raceId, $eventId);
    echo "Number of participants = " . count($participants) . "\n";


    $results = $rsu->getRaceResultsById($raceId, $eventId, $set);
    $idx = 1;
    foreach ($results as $finisher) {
        echo $idx++ . ") bib=" . $finisher->bib . " " . $finisher->first_name . " " . $finisher->last_name . "\n";
        foreach ($participants as $p) {
            if ($p->bib_num == $finisher->bib) {
                echo "FOUND IT!  Name=" . $p->user->first_name . " " . $p->user->last_name . "\n";
                $finisher->first_name = $p->user->first_name;
                $finisher->last_name = $p->user->last_name;
            }
        }
    }
    processRunSignupRace($db, $results, 'M', 1000, "race2");
    processRunSignupRace($db, $results, 'F', 1000, "race2");
}


// Race #3
if (true) {
    $raceName = 'Mother’s Day Hope 5k';
    $raceId = $rsu->findRace($raceName);

    $events = $rsu->getAllEvents($raceId);
    var_dump($events);

    $eventId = $rsu->getEventByName($raceId, 'Mothers Day Hope 5k');
    echo "EventID = " . $eventId . "\n";

    //$sets = $rsu->getAllResultSets($raceId, $eventId);
    //var_dump($sets);
    //return;

    $set = $rsu->findResultSets($raceId, $eventId, "5k Overall Results");
    echo "Reset Set ID = " . $set . "\n";

    $participants = $rsu->getAllParticipants($raceId, $eventId);
    echo "Number of participants = " . count($participants) . "\n";


    $results = $rsu->getRaceResultsById($raceId, $eventId, $set);
    $idx = 1;
    foreach ($results as $finisher) {
        echo $idx++ . ") bib=" . $finisher->bib . " " . $finisher->first_name . " " . $finisher->last_name . "\n";
        foreach ($participants as $p) {
            if ($p->bib_num == $finisher->bib) {
                echo "FOUND IT!  Name=" . $p->user->first_name . " " . $p->user->last_name . "\n";
                $finisher->first_name = $p->user->first_name;
                $finisher->last_name = $p->user->last_name;
            }
        }
    }
    processRunSignupRace($db, $results, 'M', 1000, "race3");
    processRunSignupRace($db, $results, 'F', 1000, "race3");
}

// Race #4
if (true) {
    $eventName = 'Joe Kasper Over the River and Through the Woods 5K';
    $raceName = "5k";
    $eventId = 6420;
    $q = "select * from iresults where event_id=".$eventId;
    $eventRow = $db->singleRowQuery($q);

    // Get the results now.
    $q = "select * from iresults_results where event_id=".$eventId." and race_name='".$raceName."' order by overall_place ";

    $results = $db->query($q);

    processiResultsRace($db, $results, 'M', 1000, "race4");

    $q = "select * from iresults_results where event_id=".$eventId." and race_name='".$raceName."' order by overall_place ";
    $results = $db->query($q);
	echo $q."\n";


	processiResultsRace($db, $results, 'F', 1000, "race4");
	processiResultsRace($db, $results, 'M', 1000, "race4");

}

// race #5
if (true) {
    $raceName = 'Run for Jenny: Beat Heart Disease 5k!';
    $raceId = $rsu->findRace($raceName);
    $eventId = $rsu->getEventByName($raceId, 'Run/Walk for Jenny 5k!');
    echo "EventID = " . $eventId . "\n";

    $set = $rsu->findResultSets($raceId, $eventId, "Run/Walk for Jenny 5k");
    echo "Reset Set ID = " . $set . "\n";

    $participants = $rsu->getAllParticipants($raceId, $eventId);
    echo "Number of participants = " . count($participants) . "\n";


    $results = $rsu->getRaceResultsById($raceId, $eventId, $set);
    $idx = 1;
    foreach ($results as $finisher) {
        echo $idx++ . ") bib=" . $finisher->bib . " " . $finisher->first_name . " " . $finisher->last_name . "\n";
        foreach ($participants as $p) {
            if ($p->bib_num == $finisher->bib) {
                echo "FOUND IT!  Name=" . $p->user->first_name . " " . $p->user->last_name . "\n";
                $finisher->first_name = $p->user->first_name;
                $finisher->last_name = $p->user->last_name;
            }
        }
    }
    processRunSignupRace($db, $results, 'M', 1000, "race5");
    processRunSignupRace($db, $results, 'F', 1000, "race5");
}


// Race #6
if (true) {
    $eventName = 'Heathers Hope For A Cure 5k!';
    $raceName = "5k";
    $eventId = 6503;
    $q = "select * from iresults where event_id=".$eventId;
    $eventRow = $db->singleRowQuery($q);

    // Get the Male results now.
    $q = "select * from iresults_results where event_id=".$eventId." and race_name='".$raceName."' order by overall_place ";
    $results = $db->query($q);
    processiResultsRace($db, $results, 'M', 1000, "race6");

    // And the female
    $q = "select * from iresults_results where event_id=".$eventId." and race_name='".$raceName."' order by overall_place ";
    $results = $db->query($q);
	processiResultsRace($db, $results, 'F', 1000, "race6");
}

// Race #7
if (true) {
    $eventName = 'D.A.R.E. Classic 5k';
    $raceName = "5k";
    $eventId = 6504;
    $q = "select * from iresults where event_id=".$eventId;
    $eventRow = $db->singleRowQuery($q);

    // Get the Male results now.
    $q = "select * from iresults_results where event_id=".$eventId." and race_name='".$raceName."' order by overall_place ";
    $results = $db->query($q);
    processiResultsRace($db, $results, 'M', 2000, "race7");

    // And the female
    $q = "select * from iresults_results where event_id=".$eventId." and race_name='".$raceName."' order by overall_place ";
    $results = $db->query($q);
	processiResultsRace($db, $results, 'F', 2000, "race7");
}

// Race #8
if (true) {
    $eventName = 'Celebrate Tom Walton 5k and 10k';
    $raceName = "5k";
    $eventId = 6492;
    $q = "select * from iresults where event_id=".$eventId;
    $eventRow = $db->singleRowQuery($q);

    // Get the Male results now.
    $q = "select * from iresults_results where event_id=".$eventId." and race_name='".$raceName."' order by overall_place ";
    $results = $db->query($q);
    processiResultsRace($db, $results, 'M', 2000, "race8");

    // And the female
    $q = "select * from iresults_results where event_id=".$eventId." and race_name='".$raceName."' order by overall_place ";
    $results = $db->query($q);
	processiResultsRace($db, $results, 'F', 2000, "race8");
}

// Race #9
if (true) {
    $eventName = 'Celebrate Tom Walton 5k and 10k';
    $raceName = "10k";
    $eventId = 6492;
    $q = "select * from iresults where event_id=".$eventId;
    $eventRow = $db->singleRowQuery($q);

    // Get the Male results now.
    $q = "select * from iresults_results where event_id=".$eventId." and race_name='".$raceName."' order by overall_place ";
    $results = $db->query($q);
    processiResultsRace($db, $results, 'M', 2000, "race9");

    // And the female
    $q = "select * from iresults_results where event_id=".$eventId." and race_name='".$raceName."' order by overall_place ";
    $results = $db->query($q);
	processiResultsRace($db, $results, 'F', 2000, "race9");
}


// Total things up...
calculateTotals($db);

generateTable($db, "leaderboard", "M");
generateTable($db, "leaderboard", "F");

calculateBest($db, 'M', 4);
calculateBest($db, 'F', 4);

generateBestTable($db, "best", "M");
generateBestTable($db, "best", "F");

return;






function calculateBest($db, $sex, $minRaces) {
    echo "Calculating best ".$minRaces." for everone.....\n";
//    $q = "select * from series_participants where totalRaces1 >= ".$minRaces;
    $q = "select * from series_participants where ";
    $q .= " sex='".$sex."'";

    $results = $db->query($q);
    echo "Number of entries to process = ".$results->rowCount()."\n";
    foreach ($results as $row) {
        $points = array();

        $points["Judy"] = $row['race1Points'];
        $points["VNA"] = $row['race2Points'];
        $points["Mothers"] = $row['race3Points'];
        $points["JoeKasper"] = $row['race4Points'];
        $points["Jenny"] = $row['race5Points'];
        $points["Hope"] = $row['race6Points'];
        $points["D.A.R.E"] = $row['race7Points'];
        $points["TomWalton5"] = $row['race8Points'];
        $points["TomWalton10"] = $row['race9Points'];
        arsort($points);
        // Take the top 3.
        $best = 0;
        $bestText = "";
        $count = 0;
        $comma = "";

        foreach ($points as $name=>$pt) {
            $best += $pt;
            $bestText .= $comma.trim($name)." (".$pt.")";
            if (++$count >= $minRaces) break;
            $comma=", ";
        }
        //var_dump($points);
        echo "Best = ".$best."\n";
        echo "BestText = ".$bestText."\n";
        $q = "update series_participants set bestPoints=".$best.", bestText='".$bestText."' ";
        $q .= " where id=".$row['id'];
        $db->query($q);
        echo $q."\n";
    }

}


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
    echo "--------\nProcessing iResults race: ".$raceName.", Sex=".$sex."   MaxPoints = ".$maxPoints."\n";

    $bestTime = 0;
    foreach ($results as $row) {
        if ($row['sex'] != $sex) continue;



        $place = $row['overall_place'];
        $netTime = $row['net_time'];
        $age = $row['age'];
        $seconds = getSeconds($netTime);
        $fullName = $row['first_name']." ".$row['last_name'];
        $fullName = checkForMappedName($fullName, $nameMapping);

        echo "Place=".$place.", netTime = ".$netTime."\n";

        if ($bestTime == 0) {
            $bestTime = $seconds;
        }
        echo "Best time = ".$bestTime."\n";

        $points = ($bestTime/$seconds)*$maxPoints;
        $points = round($points, 2);

        echo $place.": ".$fullName." ".$sex." ".$netTime."   ".$seconds."   Points=".$points."\n";
        dbStore($db, $raceName."Points", $raceName."Time",$fullName, $sex, $age, $place, $netTime, $seconds, $points);
    }
	echo "--- End of processing iResults race ".$raceName."\n";

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
    $q .= " and seriesId=".$seriesId;
    echo $q."\n";
    $row = $db->singleRowQuery($q);
    //    echo $q."\n";
    if ($row != NULL) {
        echo "Updating ".$name."\n";
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

        $points = $row['race7'."Points"];
        $totalPoints2 += $points;
        if ($points > 0) $totalRaces2++;

        $points = $row['race8'."Points"];
        $totalPoints2 += $points;
        if ($points > 0) $totalRaces2++;

        $points = $row['race9'."Points"];
        $totalPoints2 += $points;
        if ($points > 0) $totalRaces2++;

        $q = "update series_participants set totalPoints1=".$totalPoints1.", totalRaces1=".$totalRaces1." ";
        $q .= ", totalPoints2=".$totalPoints2.", totalRaces2=".$totalRaces2." ";
        $q .= " where id=".$row['id']." and seriesId=".$seriesId;
        $db->query($q);
        //echo $q."\n";
    }

}


function generateTable($db, $prefix, $sex) {
    global $seriesId;

    $q = "select * from series_participants where sex='".$sex."' and totalRaces1 > 0 ";
    $q .= " and seriesId=".$seriesId." order by totalPoints1 desc";
//    $q = "select * from scoring_participants where sex='".$sex."' order by totalPoints desc";
    $results = $db->query($q);
    $html = "<table class='table table-striped' width=100%>";

    $html .= "<thead>";
    $html .= "<tr>";
    $html .= "<th scope='col' align=left>Place</th>";
    $html .= "<th scope='col ' align=left>Name</th>";
    $html .= "<th scope='col' align=left>Total Points</th>";
    $html .= "<th scope='col' align=left>Total Races</th>";
    $html .= "<th scope='col' align=left>Judy</th>";
    $html .= "<th scope='col' align=left>VNA</th>";
    $html .= "<th scope='col' align=left>Mothers Day</th>";
    $html .= "<th scope='col' align=left>Joe Kasper</th>";
    $html .= "<th scope='col' align=left>Jenny</th>";
    $html .= "<th scope='col' align=left>Hope</th>";
    $html .= "<th scope='col' align=left>D.A.R.E</th>";
    $html .= "<th scope='col' align=left>Walton5k</th>";
    $html .= "<th scope='col' align=left>Walton10k</th>";
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
        $html .= "<td style='".$style."'>".$row['race7Points']."</td>";
        $html .= "<td style='".$style."'>".$row['race8Points']."</td>";
        $html .= "<td style='".$style."'>".$row['race9Points']."</td>";
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

function generateBestTable($db, $prefix, $sex) {
    $q = "select * from series_participants where sex='".$sex."' and totalRaces1 >=4 order by bestPoints desc";
//    $q = "select * from series_participants where sex='".$sex."' order by bestPoints desc";
    echo $q."\n";

    $results = $db->query($q);
    $html = "<table class='table table-striped' width=100%>";

    $html .= "<thead>";
    $html .= "<tr>";
    $html .= "<th scope='col'>Place</th>";
    $html .= "<th scope='col'>Name</th>";
    $html .= "<th scope='col'>Best 4 Points</th>";
    $html .= "<th scope='col'>Total Races</th>";
    $html .= "<th scope='col'>Races</th>";
    $html .= "</tr>";
    $html .= "</thead>";
    $html .= "<tbody>";
    $place = 1;
    foreach ($results as $row) {
        $html .= "<tr>";
        $html .= "<td>".$place++."</td>";
        $html .= "<td><b>".urldecode($row['participantName'])."</b></td>";
        $html .= "<td><b>".$row['bestPoints']."</b></td>";
        $html .= "<td>".$row['totalRaces1']."</td>";
        $html .= "<td>".$row['bestText']."</td>";
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




