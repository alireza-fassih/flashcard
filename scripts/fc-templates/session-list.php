<form method="post" >
    <input type="hidden"  name="xssToken" value="<?= $_VIEW_DATA['xss-token'] ?>"/>
    <button type="submit" name="create" value="true" >new sesstion</button>
</form>


<br />

<table>
    <tr>
        <th>Id</th>
        <th>Create date</th>
        <th>action</th>
    </tr>

    <?php

    foreach($_VIEW_DATA['sessions'] as $s) {
        echo 
            "<tr>" .
                "<td>" . $s->ID ."</td>" .
                "<td>" . $s->CREATEDATE ."</td>" .
                "<td>" .
                    "<a href='/session-review.php?id=$s->ID'>Go to Session</a>" . 
                "</td>" .
            "</tr>";
    }

    ?>
</table>