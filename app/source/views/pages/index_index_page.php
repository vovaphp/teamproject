<h2>All articles</h2>
        <?php if(!empty($articles)):?>
            <?php foreach ($articles as $article):?>
                <?=$article['id']?>
            <a href="<?=\core\Route::url('index','read',$article['id'])?>"><?=$article['title']?></a>
    - <?=$article['text']?><br/>
            <?php endforeach;?>
        <?php endif;?>
