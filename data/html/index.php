<?php

    require_once ('classes/DB.php');

    $db = new Neo4 ('config.php');

    $result = $db->getNumFriends ();

    foreach ($result->getRecords() as $record) {           
        $formato = 'person name is %s and has %d friends <br>';
        $nfriends = count($record->value('friends'));

        echo sprintf($formato, $record->value('n.name'), $nfriends);
    }
?>