<h2 class="userForm">Registration</h2>
<form class="userForm" action="<?=  \core\Route::url('admin', 'saveUser')?>" method="post" novalidate>
    <input class="userForm input" type="text" name="login" placeholder="login">
    <input class="userForm input" type="text" name="e-mail" placeholder="e-mail">
    <input class="userForm input" type="password" name="password" placeholder="password">
    <input class="userForm input" type="password" name="passRepeat" placeholder="passRepeat">
    <input class="userForm input" type="submit" value="Create account">
</form>
<div id="hidden"></div>
    <?php if($page == 'admin_registration'): ?>
<script src="/js/validation_script.js"></script>
    <?php endif;?>