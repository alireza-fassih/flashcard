<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?= $topWord['word']->WORD ?></h5>
        <p class="card-text">
            correct count: <?= $topWord['word']->CORRECT_COUNT ?>
            -
            wrong count: <?= $topWord['word']->WRONG_COUNT ?>
        </p>
        <p class="card-text" id="meaning" style="display:none";>
            <?= nl2br($topWord['word']->MEANING) ?>
        </p>
    </div>

    <div class="card-body">
        <a href="#" class=" btn btn-primary btn-lg" onclick="$('#meaning').toggle();">show meaning</a>
    </div>

    <div class="card-body">
        <form method="post">
            <input  type="hidden" name="remining" value="<?= $_VIEW_DATA['remining'] ?>"  />
            <input  type="hidden" name="word" value="<?= $topWord['word']->ID ?>" />
            <input  type="hidden" name="ws" value="<?= $topWord['info']->ID ?>" /> 
            <input  type="hidden"  name="xssToken" value="<?= $xssToken ?>"/>
            <button type="submit" class="btn btn-success btn-lg" name="ok" value="true" >ok</button>
            <button type="submit" class="btn btn-danger btn-lg" name="no" value="true" >no</button>
        </form>
    </div>
</div>