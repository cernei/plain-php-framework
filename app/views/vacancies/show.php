<h1>
    <?= htmlspecialchars($item->title) ?>
</h1>
Salary: <span><?= $item->salary ?></span>
<div>
    <?= htmlspecialchars($item->content) ?>
</div>
<div>
    <?php if (Auth::check()) : ?>
        <?php if (isset($apply)) : ?>
            <button type="button" class="btn btn-success" disabled>Already applied</button>
        <?php elseif (Auth::getUser()->type == 1): ?>
            <a href="<?= href('replies.store', $item->id) ?>" class="btn btn-success">Apply</a>
        <?php endif; ?>
    <?php endif; ?>
</div>