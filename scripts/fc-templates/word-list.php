<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Word</th>
            <th>Score</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($_VIEW_DATA['words'] as $s) {
        echo 
            "<tr data-toggle='tooltip' data-placement='top' title='$s->MEANING'>" .
                "<td>" . $s->ID   . "</td>" .
                "<td>" . $s->WORD . "</td>" .
                "<td>" .
                    "<font color='green'>" . $s->CORRECT_COUNT ."</font>" . 
                    " - " . 
                    "<font color='red'>" . $s->WRONG_COUNT . "</font>" . 
                "</td>" .
                "<td>" . 
                    "<a class='btn btn-primary' href='/word-edit.php?id=$s->ID' role='button'>" . 
                        "<i class='bi bi-pencil'></i>" .
                    "</a>" .
                    "<form method='post'  class='form-check form-check-inline'>" . 
                        "<input  type='hidden' name='xssToken' value='" . $_VIEW_DATA['xss-token'] . "'  />" .
                        "<input  type='hidden' name='wordId' value='$s->ID'  />" .
                        "<button type='submit' name='remove' value='true' class='btn btn-danger'>" . 
                            "<i class='bi bi-trash'></i>" .
                        "</button>" .
                    "</form>" .
                "</td>" .
            "</tr>";
    }
    ?>
    </tbody>
</table>