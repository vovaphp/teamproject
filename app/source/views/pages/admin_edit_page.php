<h2>Edit article</h2>
<form class="create-edit-form" action="<?= \core\Route::url('admin', 'editarticle') ?>" method="post"
      enctype="multipart/form-data">

    <label for="title">Title:</label>
    <input type="text" name="title" required id="title" value="<?= $article['title'] ?>">

    <label for="text">Text:</label>
    <textarea name="text" id="text"><?= $article['text'] ?></textarea>

    <div>
        <img class="preview-image" src="<?= $article['image'] ?>" alt="image">
    </div>

    <label for="file">Change image (if it is needed):</label>
    <input type="file" name="imageFile" id="file" accept="image/*">

    <input type="hidden" name="id" value="<?= $article['id'] ?>">
    <input type="hidden" name="newImageFile" value="<?= $article['image'] ?>">

    <div>
        <input class="submit" type="submit" value="Save">
    </div>

</form>
