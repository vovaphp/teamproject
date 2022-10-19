<h2>Edit user</h2>
<form method="post" action="<?=core\Route::url('admin', 'editSave') ?>">
    <label for="title">Login</label>
    <input type="text" name="title" required id="title" value="<?= $user['login']?>">
    <label for="text">E-mail</label>
    <input type="text" name="title" required id="title" value="<?= $user['e-mail']?>">
    <input type="hidden" name="id" id="id" value="<?= $user['id']?>">
    <input type="submit" value="Save"/>
</form>