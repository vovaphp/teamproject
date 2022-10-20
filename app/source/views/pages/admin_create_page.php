<h2>Create article</h2>
<form class="create-edit-form" action="<?= \core\Route::url('admin','admin', 'createArticle') ?>" method="post" enctype="multipart/form-data">
    <label for="title">Title:</label>
    <input type="text" name="title" required id="title">

    <label for="text">Text:</label>
    <textarea name="text" id="text"  rows="10" placeholder="Введите сообщение"> </textarea>

    <label for="file">Добавить изображение:</label>
    <input type="file" name="imageFile" id="file" accept="image/*">

    
    <div>
        <input class="submit" type="submit" value="Create">
    </div>
</form>
