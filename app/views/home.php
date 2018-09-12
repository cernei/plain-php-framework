<?php if ($items): ?>
    <?php foreach ($items as $item): ?>
        <div class="card my-2">
            <div class="card-body">
                <h5 class="card-title"><a href="<?=href('vacancies.show', $item->id)?>"><?=htmlspecialchars($item->title)?></a></h5>
                <p class="card-text">Salary: $<?=$item->salary?></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="d-block my-5 mx-auto w-25"><h4>Nothing to show...</h4></div>
<?php endif; ?>
