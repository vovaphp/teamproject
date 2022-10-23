<div class="userForm">
    <h2>Authorisation</h2>
    <form action="<?= \core\Route::url('adminusers', 'signIn') ?>" method="post">
        <label for="login">Login</label>
        <input type="text" name="login" id="login" required placeholder="login">
        <label for="pass">Password</label>
        <input type="password" name="password" id="pass" required placeholder="password">
        <input type="submit" value="Sign-in">
    </form>
</div>