<h2>Create article</h2>

<div id="create-edit-errors">
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error):?>
            - <?=$error?><br>
        <?php endforeach;?>
    <?php endif;?>
</div>

<form class="create-edit-form" action="<?= \core\Route::url('adminarticle', 'store') ?>" method="post" enctype="multipart/form-data">

    <label for="title">Title:</label>
    <input type="text" name="title" id="title">

    <label for="text">Text:</label>
    <textarea name="text" id="text"  placeholder="Введите сообщение"></textarea>

    <label for="file">Choose image file:</label>
    <input type="file" name="imageFile" id="file" accept="image/*">

    <input type="submit" value="Create">

</form>

