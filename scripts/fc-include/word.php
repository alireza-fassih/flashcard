<?php


function saveNewWord($db, $word, $meaning) {
    $stmt = $db->prepare("INSERT INTO FC_WORD( WORD, MEANING, CREATEDATE, CORRECT_COUNT, WRONG_COUNT) VALUES (?, ?, now(), 0, 0)"); 
    $stmt->bind_param('ss', $word, $meaning);
    $stmt->execute();
    $affected = $stmt->affected_rows;
    $stmt->close();
    return $affected == 1;
}



function loadWordById($mysqli, $id) {
    $sql = "SELECT * FROM FC_WORD WHERE ID=" . intval($id);
    $word = null;
    if ($result = $mysqli->query($sql)) {
        while($obj = $result->fetch_object()){
            $word = $obj;
        }
    }
    $result->close();
    return $word;
}

function updateWordAndMeaning($wordId, $word, $meaning) {
    global $DB;
    $stmt = $DB->prepare("UPDATE `FC_WORD` SET `WORD`=?, `MEANING`=? WHERE `ID`=?"); 
    $stmt->bind_param('ssi', $word, $meaning, $wordId);
    $stmt->execute();
    $affected = $stmt->affected_rows;
    $stmt->close();
    return $affected == 1;
}


function increamentCorrectCountOfWord($mysqli, $word) {
    $sql = "UPDATE `FC_WORD` SET `CORRECT_COUNT`=`CORRECT_COUNT`+1  WHERE `ID`=" . intval($word);
    $mysqli->query($sql);
}

function increamentWrongCountOfWord($mysqli, $word) {
    $sql = "UPDATE `FC_WORD` SET `WRONG_COUNT`=`WRONG_COUNT`+1  WHERE `ID`=" . intval($word);
    $mysqli->query($sql);
}


function loadWordsPage($mysqli) {
    $sql = "SELECT * FROM FC_WORD";
    $word = array();
    if ($result = $mysqli->query($sql)) {
        while($obj = $result->fetch_object()){
            $word[] = $obj;
        }
    }
    $result->close();
    return $word;
}

function word_remove($id) {
    $r1 = executeQueryForAffectedRows("DELETE FROM `FC_SESSION_WORD` WHERE `WORD_ID`=?", "i", array(intval($id)));
    $r2 = executeQueryForAffectedRows("DELETE FROM `FC_WORD` WHERE `ID`=?", "i", array(intval($id)));

    addInfoNotification("$r1 word remove from sessions");
    addInfoNotification("$r2 word remove from db");
}