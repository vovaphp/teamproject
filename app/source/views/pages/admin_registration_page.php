<h3>Registration</h3>
<form action="<?=  \core\Route::url('admin', 'saveUser')?>" method="post">
    <input type="text" name="login" required placeholder="login">
    <input type="text" name="e-mail" required placeholder="e-mail">
    <input type="password" name="password" required placeholder="password">
    <input type="password" name="passRepeat" required placeholder="passRepeat">
    <input type="submit" value="Create account">
</form>