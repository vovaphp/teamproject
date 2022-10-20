<h2>Edit article</h2>
<form class="create-edit-form" action="<?= \core\Route::url('admin','admin', 'editarticle') ?>" method="post" enctype="multipart/form-data">
    <?php if (!empty($options)): ?>

        <label for="title">Title:</label>
        <input type="text" name="title" required id="title" value="<?= $title ?>">

        <label for="text">Text:</label>
        <textarea name="text" id="text" rows="15"><?= $text ?></textarea>

        <div>
            <img height="100px" src="<?= $imagePath ?>" alt="image">
        </div>

        <label for="file">Заменить изображение (необязательно):</label>
        <input type="file" name="imageFile" id="file" accept="image/*">

        <input type="hidden" name="id" value="<?=$id?>">
        <input type="hidden" name="newImageFile" value="<?= $imagePath?>">

        <div>
            <input class="submit" type="submit" value="Save">
        </div>

    <?php endif; ?>
</form>
