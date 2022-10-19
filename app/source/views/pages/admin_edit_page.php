<h2>Edit article</h2>
<form class="create-edit-form" action="<?= \core\Route::url('admin', 'editarticle') ?>" method="post">
    <?php if (!empty($options)): ?>

        <label for="title">Title:</label>
        <input type="text" name="title" required id="title" value="<?= $title ?>">

        <label for="text">Text:</label>
        <textarea name="text" id="text" rows="15"><?= $text ?></textarea>

        <label for="file">Добавить изображение:</label>
        <input type="file" name="imageFile" id="file" accept="image/*">

        <input type="hidden" name="id" value="<?=$id?>">

        <div>
            <input class="submit" type="submit" value="Save">
        </div>

    <?php endif; ?>
</form>
