<?php


class Word {
    public $world;
    public $meaning;
    public $createDate;
    public $wrongCount;
    public $correctCount;
}



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




