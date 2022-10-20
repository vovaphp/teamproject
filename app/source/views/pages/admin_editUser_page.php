<h2 class="userForm">Edit user</h2>
<form class="userForm" method="post" action="<?=core\Route::url('admin', 'editUserSave') ?>">
    <label for="title">Login</label>
    <input class="userForm" type="text" name="login" required id="login" value="<?= $user['login']?>">
    <label for="text">E-mail</label>
    <input class="userForm" type="text" name="e-mail" required id="e-mail" value="<?= $user['e-mail']?>">
    <input class="userForm" type="hidden" name="id" id="id" value="<?= $user['id']?>">
    <input class="userForm" type="submit" value="Save"/>
</form>