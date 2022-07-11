<h2>Корзина</h2>
<?php if (!empty($basket)): ?>
    <?php foreach ($basket as $item) : ?>
        <div class="basket">
            <p><?= $item['product_name'] ?></p>
            <img src="/img/<?= $item['img'] ?>" alt="<?= $item['product_name'] ?>" width="150">
            <p><?= $item['price'] ?> руб/сутки</p>
            <a class="button" href="">Удалить</a>
        </div>
        <br>
    <?php endforeach; ?>

<?php else: ?>
    <?= "Корзина пустая" ?>
<?php endif; ?>
