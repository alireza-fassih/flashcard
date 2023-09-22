<?php



function createNewSession($db) {
    if ( !$db->query("INSERT INTO FC_SESSION( CREATEDATE, IS_DONE ) VALUES ( now(), 0 )") ) {
        return -1;
    }    
    return  $db->insert_id;
}



function fillSessionWithWords($db, $sid) {
    $id = intval($sid);
    if ( !$db->query("INSERT INTO FC_SESSION_WORD( SESSION_ID, WORD_ID ) SELECT $id, ID FROM FC_WORD ORDER BY RAND()") ) {
        return -1;
    } 
    return $db->affected_rows;
}


function listAllNotDoneSession($mysqli) {
    $sql = "SELECT * FROM FC_SESSION WHERE IS_DONE=0";
    $sessions = array();
    if ($result = $mysqli->query($sql)) {
        while($obj = $result->fetch_object()){
            $sessions[] = $obj;
        }

    }
    $result->close();
    return $sessions;
}



function getToWordOfSession($mysqli, $sid) {
    $sql = "SELECT * FROM `FC_SESSION_WORD` WHERE `SESSION_ID`=" . intval($sid) . " ORDER BY `ID` LIMIT 1";
    $fsw = null;
    if ($result = $mysqli->query($sql)) {
        while($obj = $result->fetch_object()){
            $fsw = $obj;
        }
    }
    $result->close();

    if($fsw == null) {
        return array(
            "info" => null,
            "word" => null
        );
    }
    
    return array(
        "info" => $fsw,
        "word" => loadWordById($mysqli, $fsw->WORD_ID )
    );
}

function removeWordFromSession($mysqli, $sid) {
    $sql = "DELETE FROM `FC_SESSION_WORD` WHERE `ID`=" . intval($sid);
    $mysqli->query($sql);
}

function removeSession($mysqli, $sid) {
    $sql = "DELETE FROM `FC_SESSION` WHERE `ID`=" . intval($sid);
    $mysqli->query($sql);
}



function sessions_count_remining_words($sid) {
    global $DB;
    $sql = "SELECT COUNT(`ID`) as WC FROM `FC_SESSION_WORD` WHERE `SESSION_ID`=?";
    $stmt = $DB->prepare($sql); 
    $stmt->bind_param("i", $sid);
    $stmt->execute();
    $result = $stmt->get_result();

    $r = $result->fetch_assoc()['WC'];
    $stmt->close();
    $result->close();
    return $r;
}