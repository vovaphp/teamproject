<div class="userForm">
    <h2>Registration</h2>
    <form action="<?=  \core\Route::url('admin', 'saveUser')?>" method="post" novalidate>
        <label for="login">Login</label>
        <input type="text" name="login" id="login" placeholder="login">
        <label for="e-mail">E-mail</label>
        <input type="text" name="e-mail" id="e-mail" placeholder="e-mail">
        <label for="pass">Password</label>
        <input type="password" name="password" id="pass" placeholder="password">
        <label for="passRpt">Password repeat</label>
        <input type="password" name="passRepeat" id="passRpt" placeholder="passRepeat">
        <input type="submit" value="Create account">
    </form>
    <div id="validation"></div>
    <?php if($page == 'admin_registration'): ?>
        <script src="/js/validation_script.js"></script>
    <?php endif;?>
</div>