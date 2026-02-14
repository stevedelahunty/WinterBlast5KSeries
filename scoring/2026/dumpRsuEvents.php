<?php

require_once("common.php");


$db = new DatabaseContext("lightboxreg");

echo "Dumping RSU Events and Results...\n";

// Connect
$rsu = new RunSignup();
$rsu->login("steve.delahunty@gmail.com", "MageNovus99!!");
$raceList = $rsu->getAllRaces();
foreach ($raceList as $race) {
    //var_dump($race);
    $raceId = $race->race_id;

    // Ignore some races
    if ($raceId == 138800) continue; // racejoy cert
    if ($raceId == 48983) continue; // Vermont City
    if ($raceId == 45837) continue; // RS Test Races
    if ($raceId == 196081) continue; // Ethan's rds cert
    if ($raceId == 207559) continue; // RS Test Races 
    if ($raceId == 54837) continue; // RS Test Races 

    $raceName = $race->name;
    echo "-----------------------------\n";
    echo "(Race)  ".$raceId.": ".$raceName."\n";
    $raceDate = $race->next_date;
    $eventList = $rsu->getAllEvents($race->race_id);
    foreach ($eventList as $eventId=>$ev) {
        $eventId = $ev['event_id'];
        echo "    (Event)  ".$ev['event_id'].": ".$ev['start_time']." - ".$ev['name']."\n";

        // Get the result sets now.
        $resultSets = $rsu->getAllResultSets($raceId, $eventId);
        foreach ($resultSets->individual_results_sets as $rset) {
//            var_dump($rset);
            echo "        (Result Set): ".$rset->individual_result_set_id.": ".$rset->individual_result_set_name."\n";
        }

        //    $rsu->dumpEventResults($db, $race->
//        var_dump($event);
        //exit(0);

        //echo "  Event: $event->name (ID: $event->id)\n";
    //    $rsu->dumpEventResults($db, $race->id, $event->id);
    }
}
echo "-----------------------------\n";
echo "Done.\n";


