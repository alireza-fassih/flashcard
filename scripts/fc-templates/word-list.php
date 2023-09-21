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
                    "<button type='button' class='btn btn-danger'>" . 
                        "<i class='bi bi-trash'></i>" .
                    "</button>" .
                "</td>" .
            "</tr>";
    }
    ?>
    </tbody>
</table>