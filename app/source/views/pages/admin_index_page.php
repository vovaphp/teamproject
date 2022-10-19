<table id="articles-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Text</th>
        <th>Date</th>
        <th>Author</th>
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
                        <form action="<?=\core\Route::url('admin','destroy')?>" method="post">
                            <input type="hidden" name="id" value="<?=$article['id']?>">
                            <button><img class="icons" src="/images/delete_icon.png" alt="delete"></button>
                        </form>
                        <form action="<?=\core\Route::url('admin','edit')?>" method="post">
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