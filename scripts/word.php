<?php


function saveNewWord($db, $word, $meaning) {
    $w = $db->real_escape_string($word);
    $m = $db->real_escape_string($meaning);
    $stmt = $db->prepare("INSERT INTO FC_WORD( WORD, MEANING, CREATEDATE, CORRECT_COUNT, WRONG_COUNT) VALUES (?, ?, now(), 0, 0)"); 
    $stmt->bind_param('ss', $w, $m);
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
    $w = $DB->real_escape_string($word);
    $m = $DB->real_escape_string($meaning);
    $stmt = $DB->prepare("UPDATE `FC_WORD` SET `WORD`=?, `MEANING`=? WHERE `ID`=?"); 
    $stmt->bind_param('ssi', $w, $m, $wordId);
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