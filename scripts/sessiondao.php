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