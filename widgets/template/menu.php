<div class="container">
    <nav class="nav nav-menu">
        <a class="nav-link active" href="/">Всё меню</a>
        <? foreach ($data as $cat) { ?>
        <a class="nav-link" href="#"><?=$cat['browser_name']?></a>
        <? } ?>
    </nav>
</div>