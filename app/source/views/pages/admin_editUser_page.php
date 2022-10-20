<h2>Edit user</h2>
<form method="post" action="<?=core\Route::url('admin', 'editUserSave') ?>">
    <label for="title">Login</label>
    <input type="text" name="login" required id="login" value="<?= $user['login']?>">
    <label for="text">E-mail</label>
    <input type="text" name="e-mail" required id="e-mail" value="<?= $user['e-mail']?>">
    <input type="hidden" name="id" id="id" value="<?= $user['id']?>">
    <input type="submit" value="Save"/>
</form>