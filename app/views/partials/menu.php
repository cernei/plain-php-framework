<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm justify-content-between">
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="<?=href('home.index')?>">Home</a>
        <?php if (Auth::check() && Auth::getUser()->type == 2): ?>
            <a class="p-2 text-dark" href="<?=href('vacancies.index')?>">My Vacancies</a>
            <a class="p-2 text-dark" href="<?=href('replies.index')?>">Replies</a>
        <?php endif; ?>
    </nav>
    <div>
        <?php if (Auth::check()): ?>
            <span class="px-2"><b><?=Auth::getUser()->email?></b></span>
            <a class="btn btn-outline-primary" href="<?=href('home.logout')?>">Log out</a>
        <?php else: ?>
            <a class="btn btn-outline-primary" href="<?=href('home.login')?>">Log in</a>
        <?php endif; ?>
    </div>

</div>