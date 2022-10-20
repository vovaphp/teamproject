<h3>Authorisation</h3>
<form action="<?= \core\Route::url('admin', 'signIn') ?>" method="post">
    <input type="text" name="login" required placeholder="login">
    <input type="password" name="password" required placeholder="password">
    <input type="submit" value="Sign-in">
</form>