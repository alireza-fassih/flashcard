<?php


function loadUserIdForLogin($db, $username, $pass) {
    $username = $db->real_escape_string($username);
    $password = $db->real_escape_string(hash("sha256", $pass));

    $stmt = $db->prepare("SELECT ID FROM FC_USER WHERE USERNAME=? AND PASS=?"); 
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();

    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();
    return $user_id;
}



function changeUserPassword($db, $id, $current, $newPass) {
    $i = intval($id);
    $password = $db->real_escape_string(hash("sha256", $newPass));
    $cu = $db->real_escape_string(hash("sha256", $current));
    $stmt = $db->prepare("UPDATE FC_USER SET PASS=? WHERE ID=? AND PASS=?"); 
    $stmt->bind_param('sis', $password, $i, $cu);
    $stmt->execute();
    $affected = $stmt->affected_rows;
    $stmt->close();
    return $affected == 1;
}