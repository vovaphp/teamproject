<h2 class="userForm">Users list</h2>
<?php if (isset($_SESSION['error'])):?>
<div id="errorDeleting">
    <?php echo $_SESSION['error'];
    unset($_SESSION['error']); ?>
</div>
<table class="userTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Login</th>
            <th>E-mail</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?=$user['id'] ?></td>
                    <td><?=$user['login'] ?></td>
                    <td><?=$user['e-mail'] ?></td>
                    <td class="action">
                        <form  action="<?= \core\Route::url('admin', 'deleteUser') ?>" method="post">
                            <input type="hidden" name="id" value="<?= $user['id']?>">
                            <button>&#128465;</button>
                        </form>
                    </td>
                    <td class="action">
                        <form action="<?= \core\Route::url('admin', 'editUser') ?>" method="post">
                            <input type="hidden" name="id" value="<?= $user['id']?>">
                            <button>&#9998;</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>