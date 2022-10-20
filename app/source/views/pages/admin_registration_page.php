<h2 class="userForm">Registration</h2>
<form class="userForm" action="<?=  \core\Route::url('admin', 'saveUser')?>" method="post">
    <input class="userForm" type="text" name="login" required placeholder="login">
    <input class="userForm" type="text" name="e-mail" required placeholder="e-mail">
    <input class="userForm" type="password" name="password" required placeholder="password">
    <input class="userForm" type="password" name="passRepeat" required placeholder="passRepeat">
    <input class="userForm" type="submit" value="Create account">
</form>