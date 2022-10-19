<table id="articles-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Заголовок</th>
        <th>Содержимое</th>
        <th>Дата создания</th>
        <th>Aвтор</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $article['id'] ?></td>
                <td><?= $article['title'] ?></td>
                <td><?= $article['text'] ?></td>
                <td><?= $article['date'] ?></td>
                <td><?= $article['login'] ?></td>
                <td>
                    <div class="del-edit-btn-box">
                        <form action="<?=\core\Route::url('admin','deleteArticle')?>" method="post">
                            <input type="hidden" name="id" value="<?=$article['id']?>">
                            <button><img class="icons" src="/images/delete_icon.png" alt="delete"></button>
                        </form>
                        <form action="<?=\core\Route::url('admin','editing')?>" method="post">
                            <input type="hidden" name="id" value="<?=$article['id']?>">
                            <button><img class="icons" src="/images/edit_icon.png" alt="edit"></button>
                        </form>
                    </div>



                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>