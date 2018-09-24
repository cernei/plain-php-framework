<a href="<?= href('vacancies.create') ?>" class="btn btn-success my-2">Create</a>

<?php if ($items): ?>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Title</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><a href="<?= href('vacancies.show', $item->id) ?>"><?= $item->title ?></a></td>
                    <td>$<?= $item->salary ?></td>
                    <td>
                        <a href="<?= href('vacancies.edit', $item->id) ?>" class="btn btn-info btn-sm ">Edit</a>
                        <input type="button" class="btn btn-danger btn-sm" value="Delete"
                               onClick="javascript: deleteItem('<?= href('vacancies.destroy', $item->id) ?>')">

                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <script>
        function deleteItem(url) {

            var form = document.querySelector("#delete-item");
            form.action = url;
            if (window.confirm("Are you sure?")) {
                form.submit();
            }
        }
    </script>
    <form id="delete-item" action="" method="POST">
        <input type="hidden" name="_method" value="DELETE">
    </form>
<?php else: ?>
    <div class="d-block my-5 mx-auto w-25"><h4>Nothing to show...</h4></div>
<?php endif; ?>



