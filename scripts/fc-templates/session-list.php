<form method="post" >
    <input type="hidden"  name="xssToken" value="<?= $_VIEW_DATA['xss-token'] ?>"/>
    <div class="form-group">
        <button class="btn btn-success" type="submit" name="create" value="true" >new sesstion</button>
    </div>
</form>

<table class="table">
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
                    "<a class='btn btn-primary' role='button' href='/session-review.php?id=$s->ID'>" . 
                        "<i class='bi bi-book'></i>" . 
                    "</a>" . 
                "</td>" .
            "</tr>";
    }

    ?>
</table>