<?=form_open('vacancies.update', ['id' => $item->id])?>
    <?php include('../app/views/vacancies/form_body.php'); ?>
    <input type="submit" value="Save" class="btn btn-info">
</form>
