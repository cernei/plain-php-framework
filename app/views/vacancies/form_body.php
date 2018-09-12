<div class="form-group">
    <label for="title">Title</label>
    <input name="title" type="text" class="form-control" id="title" placeholder="String..." value="<?=old('title', $item ?? null)?>">
</div>
<div class="form-group">
    <label for="salary">Salary ($)</label>
    <input name="salary" type="text" class="form-control" id="password" placeholder="Number..." value="<?=old('salary', $item ?? null)?>">
</div>
<div class="form-group">
    <label for="content">Content</label>
    <textarea name="content" class="form-control" id="content"><?=old('content', $item ?? null)?></textarea>
</div>

