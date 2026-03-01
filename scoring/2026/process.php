<?php

require_once("common.php");


$db = new DatabaseContext("lightboxreg");

echo "New scoring software - 100% Database driven\n";

// Setup name mapping
$nameMapping = array(
    "Jon Kovar" => "Jonathan Kovar",
    "Johnathan Kovar" => "Jonathan Kovar",
    "Finn Kovar" => "Finnegan Kovar",
    "Chistopher Baerman" => "Christopher Baerman",
    "A. Lundquist" => "A. Lundquist",
    "F. Groft" => "F. Groft",
    "X. Sheetz" => "Xesca Sheetz",
    "G. Sheetz" => "Gideon Sheetz",
    "A. Sheetz" => "Althea Sheetz",
    "D. Emerson" => "D. Emerson",
    "T. Wood" => "Tommy Wood",
    "E. Wood" => "Ella Wood",
    "P. Rizzo" => "Parker Rizzo",
    "L. Rizzo" => "Lillian Rizzo",
    "J. Klene" => "Jack Klene",
    "M. Klene" => "McKenna Klene",
    "E. Popham" => "Evelyn Popham",
    "Thomas Raffio" => "Tom Raffio",
    "Nicholas Gosling" => "Nick Gosling"
    );


// Initialize
$rsu = new RunSignup();
//$rsu->login("steve.delahunty@gmail.com", "MageNovus99!!");
//var_dump($rsu);
//exit(0);

$recalcFinishers = false;

// Do we delete everything?
if ($recalcFinishers == true) {
    $q = "delete from series_participants_winterblast";
    $db->query($q);
}

// Race #1: (Race)  173357: Fit for the Holidays 37 Day Challenge
// (Event)  1068935: 11/28/2025 07:00 - Fit For The Holidays 1 miler
// (Event)  1068936: 11/28/2025 07:00 - Fit for The Holidays 5k
// (Event)  1068937: 11/28/2025 07:00 - Fit For the Holiday 30 min/day challenge
$raceName = 'Fit for the Holidays 37 Day Challenge';
$raceId = 173357;

$eventName = 'Fit For The Holidays 1 miler';
$eventId = 1068935;
$rsetId = 0; //  doesn't matter.
if ($recalcFinishers == true) {
    processEntrants($db, "FitfortheHolidays.csv", $eventName, 'M', 1000, "race1");
    processEntrants($db, "FitfortheHolidays.csv", $eventName, 'F', 1000, "race1");
}

$eventName = 'Fit for The Holidays 5k';
$eventId = 1068936;
if ($recalcFinishers == true) {
    processEntrants($db, "FitfortheHolidays.csv", $eventName, 'M', 1000, "race1");
    processEntrants($db, "FitfortheHolidays.csv", $eventName, 'F', 1000, "race1");
}

$eventName = 'Fit For the Holiday 30 min/day challenge';
$eventId = 1068937;
if ($recalcFinishers == true) {
    processEntrants($db, "FitfortheHolidays.csv", $eventName, 'M', 1000, "race1");
    processEntrants($db, "FitfortheHolidays.csv", $eventName, 'F', 1000, "race1");
}

// Race #2: (Race)  138320: NH Corn Hole Biathlon Race
// Event: (Event)  1054829: 11/30/2025 10:00 - NH Corn Hole Biathlon 2.5 miler
// Reset Set: (Result Set): 612898: 2.5 miler Overall Results
$raceName = 'NH Corn Hole Biathlon Race';
$raceId = 138320;
$eventName = 'NH Corn Hole Biathlon 2.5 miler';
$eventId = 1054829;
$rsetId = 612898;
if ($recalcFinishers == true) {
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'M', 1000, "race2");
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'F', 1000, "race2");
}

// Now the 5 miler...
// Race #2.5: (Race)  138320: NH Corn Hole Biathlon Race
// Event: (Event)  1054830: 11/30/2025 10:00 - NH Corn Hole Biathlon 5 miler
// Reset Set: (Result Set): 612899: 5 miler Overall Results
$raceName = 'NH Corn Hole Biathlon Race';
$raceId = 138320;
$eventName = 'NH Corn Hole Biathlon 5 miler';
$eventId = 1054830;
$rsetId = 612899;
if ($recalcFinishers == true) {
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'M', 1000, "race2");
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'F', 1000, "race2");
}

// Race #4: (Race)  172769: The Great Gingerbread Run Run As Fast As You can 5k! (12/21 @10am)
// Event: (Event)  1020748: 12/21/2025 10:00 - The Great Gingerbread Run Run As fast As You Can 5K
// Reset Set: (Result Set): 615134: 5K Overall Results
$raceName = 'The Great Gingerbread Run Run As Fast As You can 5k!';
$raceId = 172769;
$eventName = 'The Great Gingerbread Run Run As fast As You Can 5K';
$eventId = 1020748;
$rsetId = 615134;
if ($recalcFinishers == true) {
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'M', 1000, "race3");
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'F', 1000, "race3");
}

// Race #5: (Race)  173314: Hopkinton 5k Series Race #1 1/18 @ 9 am
// Event: (Event)  1059202: 1/18/2026 09:00 - Hopkinton Winter Series 5k Race#1
// Result Set: 622238: 5k Race#1 Overall Results
$raceName = 'Hopkinton 5k Series Race #1 1/18 @ 9 am';
$raceId = 173314;
$eventName = 'Hopkinton Winter Series 5k Race#1';
$eventId = 1059202;
$rsetId = 622238;
if ($recalcFinishers == true) {
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'M', 1000, "race4");
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'F', 1000, "race4");
}

// Race #6: (Race)  157507: Hopkinton Winter 5k  Race 2, 2/1 @ 9:00 am)
// Event: (Event)  1059354: 2/1/2026 09:00 - Hopkinton Winter Series 5k (9am)
// (Result Set): 624758: Overall Results
$raceName = 'Hopkinton 5k Series Race #2 2/1 @ 9 am';
$raceId = 157507;
$eventName = 'Hopkinton Winter Series 5k Race#2';
$eventId = 1059354;
$rsetId = 624758;
if ($recalcFinishers == true) {
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'M', 1000, "race5");
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'F', 1000, "race5");
}

// Race #7: (Race)  193215: Love On the Run 5k !
// (Event)  1059753: 2/14/2026 09:00 - Love on The Run 5k!
// (Result Set): 626785: Overall Results
$raceName = 'Love On the Run 5k';
$raceId = 193215;
$eventName = 'Love on The Run 5k!';
$eventId = 1059753;
$rsetId = 626785;
if ($recalcFinishers == true) {
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'M', 1000, "race6");
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'F', 1000, "race6");
}

// Race #8: (Race)  194455: Hopkinton Winter Series Race 3
// (Event)  1069680: 3/1/2026 09:00 - Hopkinton Winter 5k 3
// (Result Set): 628859: Overall Results
$raceName = 'Hopkinton Winter Series Race 3';
$raceId = 194455;
$eventName = '';
$eventId = 1069680;
$rsetId = 628859;
if (true) {
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'M', 1000, "race7");
    processRunSignupRace($db, "finishers", $raceId, $eventId, $rsetId, 'F', 1000, "race7");
}


// Total things up...
calculateTotals($db);

// Generate the main table
generateTable($db, "leaderboard", "M");
generateTable($db, "leaderboard", "F");

// Calculate the hopkinton tables

calculateHopkintonBest($db, 'M');
calculateHopkintonBest($db, 'F');

generateTable2($db, "hopkinton", "M");
generateTable2($db, "hopkinton", "F");






//calculateBest($db, 'M', 4);
//calculateBest($db, 'F', 4);

//generateBestTable($db, "best", "M");
//generateBestTable($db, "best", "F");

return;






function calculateHopkintonBest($db, $sex) {
    $minRaces = 3;
    echo "Calculating best 3 out of 4 for Hopkinton races...\n";
    $q = "select * from series_participants_winterblast where ";
    $q .= " sex='".$sex."'";

    $results = $db->query($q);
    echo "Number of entries to process = ".$results->rowCount()."\n";
    foreach ($results as $row) {
        $points = array();

        $points["Hop1"] = $row['race4Points'];
        $points["Hop2"] = $row['race5Points'];
        $points["Love"] = $row['race6Points'];
        $points["Hop3"] = $row['race7Points'];
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
        //echo "Best = ".$best."\n";
        //echo "BestText = ".$bestText."\n";
        $q = "update series_participants_winterblast set bestPoints2=".$best.", bestText2='".$bestText."' ";
        $q .= " where id=".$row['id'];
        $db->query($q);
        //echo $q."\n";
//        exit(0);
    }

}

function calculateBest($db, $sex, $minRaces) {
    echo "Calculating best ".$minRaces." for everone.....\n";
//    $q = "select * from series_participants where totalRaces1 >= ".$minRaces;
    $q = "select * from series_participants_winterblast where ";
    $q .= " sex='".$sex."'";

    $results = $db->query($q);
    echo "Number of entries to process = ".$results->rowCount()."\n";
    foreach ($results as $row) {
        $points = array();

        $points["Fit"] = $row['race1Points'];
        $points["Corn"] = $row['race2Points'];
        $points["Ginger"] = $row['race3Points'];
        $points["Hop1"] = $row['race4Points'];
        $points["Hop2"] = $row['race5Points'];
        $points["Love"] = $row['race6Points'];
        $points["Hop3"] = $row['race7Points'];
//        $points["JoeKasper"] = $row['race4Points'];
//        $points["Jenny"] = $row['race5Points'];
//        $points["Hope"] = $row['race6Points'];
//        $points["D.A.R.E"] = $row['race7Points'];
//        $points["TomWalton5"] = $row['race8Points'];
//        $points["TomWalton10"] = $row['race9Points'];
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
        $q = "update series_participants_winterblast set bestPoints=".$best.", bestText='".$bestText."' ";
        $q .= " where id=".$row['id'];
        $db->query($q);
        echo $q."\n";
        exit(0);
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
//            echo $idx++.") bib=".$finisher->bib." ".$finisher->first_name." ".$finisher->last_name."\n";
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

function processEntrants($db, $filename, $eventName, $sex, $maxPoints, $raceName) {
    global $nameMapping;

    echo "---- Processing entrants from file ".$filename." for event ".$eventName.", gender=".$sex."\n";
    $file = fopen($filename, "r");
    $header = fgetcsv($file);
  //  var_dump($header);
    $firstNameCol = 0;
    $lastNameCol = 1;
    $cityCol = 2;
    $stateCol = 3;
    $sexCol = 4;
    $ageCol = 5;
    $eventCol = 6;

    while (feof($file) == false) {
        $row = fgetcsv($file);
//        var_dump($row);
        if ($row == false) continue;
        if (trim($row[$eventCol]) != $eventName) continue;
        if (trim($row[$sexCol]) != $sex) continue;

        $fullName = trim($row[$firstNameCol])." ".trim($row[$lastNameCol]);
        $fullName = checkForMappedName($fullName, $nameMapping);
        $age = trim($row[$ageCol]);
        $netTime = "";
        $seconds = 0;
        dbStore($db, $raceName."Points", $raceName."Time", $fullName, $sex, $age, 0, $netTime, $seconds, $maxPoints);
    }

}


function processRunSignupRace($db, $eventType, $raceId, $eventId, $rsetId, $sex, $maxPoints, $raceName) {
    global $nameMapping;
    global $rsu;
    echo "--------\nProcessing RunSignup race: ".$raceName.", Sex=".$sex."   MaxPoints = ".$maxPoints."\n";
    $bestTime = 0;

    if ($eventType == "entrants") {
        $participants = $rsu->getAllParticipants($raceId, $eventId);
        foreach ($participants as $p) {
            if ($p->user->gender != $sex) continue;
            $fullName = $p->user->first_name." ".$p->user->last_name;
            $fullName = checkForMappedName($fullName, $nameMapping);
            //echo "Virtual person: ".$fullName . "\n";
            $age = 0;
            $place = 0;
            $netTime = "";
            $seconds = 0;
            $points = $maxPoints;
            dbStore($db, $raceName."Points", $raceName."Time", $fullName, $p->user->gender, $age, $place, $netTime, $seconds, $points);
        }
        return;
    }
    echo "Getting results...\n";
    $results = $rsu->getRaceResultsById($raceId, $eventId, $rsetId);
    $idx = 1;

    // Need to get full names of kids under 13
    if (false) {
        foreach ($results as $finisher) {
            //echo $idx++ . ") bib=" . $finisher->bib . " " . $finisher->first_name . " " . $finisher->last_name . "\n";
            foreach ($participants as $p) {
                if ($p->bib_num == $finisher->bib) {
                    //echo "FOUND IT!  Name=" . $p->user->first_name . " " . $p->user->last_name . "\n";
                    $finisher->first_name = $p->user->first_name;
                    $finisher->last_name = $p->user->last_name;
                }
            }
        }
    }

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
        //echo "Best time = ".$bestTime."\n";
        if ($bestTime == 0) return;
        //echo "max points = ".$maxPoints."\n";
        //echo "seconds = ".$seconds."\n";
        if ($seconds == 0) continue;

        $points = ($bestTime/$seconds)*$maxPoints;
        $points = round($points, 2);

        //echo $place.": ".$fullName." ".$netTime."   ".$seconds."   Points=".$points."\n";
        dbStore($db, $raceName."Points", $raceName."Time", $fullName, $sex, $age, $place, $netTime, $seconds, $points);
    }
}

function dbStore($db, $pointsField, $timeField, $name, $sex, $age, $place, $time, $seconds, $points)
{
    //echo $name . "   " . $place . "   " . $time . " - " . $seconds . "   Points = " . $points . "\n";
    $name = urlencode($name);
    $q = "select * from series_participants_winterblast where participantName='" . $name . "'";
    //echo $q."\n";
    $row = $db->singleRowQuery($q);
    //    echo $q."\n";
    if ($row != NULL) {
  //      echo "Updating ".$name."\n";
        $q = "update series_participants_winterblast set " . $pointsField . "='" . $points . "'";
        $q .= ", ".$timeField . "='" . $time . "'";
        $q .= " where id=" . $row['id'];
        $db->query($q);
 //       echo $name . " - " . $q . "\n";
    } else {
//        echo "Inserting ".$name."\n";
        $q = "insert into series_participants_winterblast(participantName, " . $pointsField . ", ".$timeField.", sex, age) values (";
        $q .= "  '" . $name . "' ";
        $q .= ", '" . $points . "' ";
        $q .= ", '" . $time . "' ";
        $q .= ", '" . $sex . "' ";
        $q .= ", '" . $age . "' ";
        $q .= ")";
        $db->query($q);
//        echo $q . "\n";
//        exit(0);
    }
}

function calculateTotals($db) {
    global $ageGroups;

    echo "Calculating totals for everyone.....\n";

    $q = "select * from series_participants_winterblast";

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


        $q = "update series_participants_winterblast set totalPoints1=".$totalPoints1.", totalRaces1=".$totalRaces1." ";
        $q .= ", totalPoints2=".$totalPoints2.", totalRaces2=".$totalRaces2." ";
        $q .= " where id=".$row['id'];
        $db->query($q);
        //echo $q."\n";
    }

}


function generateTable($db, $prefix, $sex) {

    echo "Generating table #1 (full series)\n";

    $q = "select * from series_participants_winterblast where sex='".$sex."' and totalRaces1 > 0 ";
    $q .= " order by totalPoints1 desc";
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
    $html .= "<th scope='col' align=left>CornHole</th>";
    $html .= "<th scope='col' align=left>Gbread</th>";
    $html .= "<th scope='col' align=left>Hop1</th>";
    $html .= "<th scope='col' align=left>Hop2</th>";
    $html .= "<th scope='col' align=left>Love</th>";
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
        $html .= "<td style='".$style."'>".$row['race7Points']."</td>";
//        $html .= "<td style='".$style."'>".$row['race4Points']."</td>";
//        $html .= "<td style='".$style."'>".$row['race5Points']."</td>";
//        $html .= "<td style='".$style."'>".$row['race6Points']."</td>";
//        $html .= "<td style='".$style."'>".$row['race7Points']."</td>";
//        $html .= "<td style='".$style."'>".$row['race8Points']."</td>";
//        $html .= "<td style='".$style."'>".$row['race9Points']."</td>";
        $html .= "</tr>";
    }
    $html .= "</table>";
    file_put_contents($prefix."_".$sex.".html", $html);

}

function generateTable2($db, $prefix, $sex) {
    echo "Generating table #2 (Hopkinton)\n";

    $q = "select * from series_participants_winterblast where sex='".$sex."' and totalRaces2 > 0 order by totalPoints2 desc";
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
    $html .= "<th scope='col' align=left>Love</th>";
    $html .= "<th scope='col' align=left>Hop3</th>";
    $html .= "<th scope='col' align=left>Best 3 out of 4</th>";
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
        $html .= "<td style='".$style."'>".$row['race7Points']."</td>";
        $html .= "<td style='".$style."'>".$row['bestText2']."</td>";
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




