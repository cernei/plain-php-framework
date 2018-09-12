<?php if ($items): ?>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Vacancy</th>
                <th>Salary</th>
                <th>Candidate</th>
            </tr>
            <?php foreach ($items as $item): ?>

                    <tr>
                        <?php if ($item->vacancy): ?>
                            <td><a href="<?=href('vacancies.show', $item->vacancy_id )?>"><?=htmlspecialchars($item->vacancy->title)?></a></td>
                            <td>$<?=$item->vacancy->salary?></td>
                        <?php else: ?>
                            <td>deleted</td>
                            <td>---</td>
                        <?php endif; ?>
                        <td><?=$item->candidate->email?></td>
                    </tr>

            <?php endforeach; ?>
        </table>
    </div>
<?php else: ?>
    <div class="d-block my-5 mx-auto w-25"><h4>Nothing to show...</h4></div>
<?php endif; ?>