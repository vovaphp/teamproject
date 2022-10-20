<h2 class="userForm">Authorisation</h2>
<form class="userForm" action="<?= \core\Route::url('index','index', 'signIn') ?>" method="post">
    <input class="userForm" type="text" name="login" required placeholder="login">
    <input class="userForm" type="password" name="password" required placeholder="password">
    <input class="userForm" type="submit" value="Sign-in">
</form>