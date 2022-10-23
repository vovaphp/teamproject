<h2>Edit article</h2>

<div id="create-edit-errors">
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error):?>
            - <?=$error?><br>
        <?php endforeach;?>
    <?php endif;?>
</div>

<form class="create-edit-form" action="<?= \core\Route::url('adminarticle', 'update') ?>" method="post"
      enctype="multipart/form-data">

    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?= $article['title'] ?>">

    <label for="text">Text:</label>
    <textarea name="text" id="text"><?= $article['text'] ?></textarea>

    <div>
        <img class="preview-image" src="<?= $article['image'] ?>" alt="image">
    </div>

    <label for="file">Change image (if it is needed):</label>
    <input type="file" name="imageFile" id="file" accept="image/*">

    <input type="hidden" name="articleId" value="<?= $article['id'] ?>">
    <input type="hidden" name="newImageFile" value="<?= $article['image'] ?>">

    <input type="submit" value="Save">

</form>
