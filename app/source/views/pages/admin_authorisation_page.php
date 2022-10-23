<div class="userForm">
    <h2>Authorisation</h2>
    <form action="<?= \core\Route::url('adminuser', 'signIn') ?>" method="post">
        <label>Login</label>
        <input type="text" name="login" required placeholder="login">
        <label>Password</label>
        <input type="password" name="password" required placeholder="password">
        <input type="submit" value="Sign-in">
    </form>
</div>