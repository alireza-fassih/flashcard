<?php
    $onEdit = isset($_VIEW_DATA['word']);
?>
<form method="post">
    <div class="form-group">
        <label for="word">Word</label>
        <input type="text" class="form-control" name="word" id="word"
            value="<?php echo $onEdit ? $_VIEW_DATA['word']->WORD : "" ?>" />
    </div>
    <div class="form-group">
        <label for="meaning">Meaning</label>
        <textarea class="form-control" id="meaning" name="meaning"  rows="4" cols="50"><?php echo $onEdit ? $_VIEW_DATA['word']->MEANING : "" ?></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" ><?php echo $onEdit ? "Edit" : "Save" ?></button>
    </div>
</form>