<h2>Create article</h2>
<form class="create-edit-form" action="<?= \core\Route::url('adminarticle', 'store') ?>" method="post" enctype="multipart/form-data">

    <label for="title">Title:</label>
    <input type="text" name="title" required id="title">

    <label for="text">Text:</label>
    <textarea name="text" id="text"  rows="10" placeholder="Введите сообщение"> </textarea>

    <label for="file">Choose image file:</label>
    <input type="file" name="imageFile" id="file" accept="image/*">

    <input type="hidden" name="userId" value="<?= $_SESSION['user_id']?>">

    <input type="submit" value="Create">

</form>
