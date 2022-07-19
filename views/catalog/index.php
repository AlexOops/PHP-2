<h2>Каталог товаров</h2>
<?php foreach ($products as $product) : ?>
    <div class="products">
        <img src="/img/<?= $product['img'] ?>" alt="<?= $product['img'] ?>" width="150px" height="150px">
        <a href="/?c=product&a=product&id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
        <p>price: <?= $product['price'] ?> </p>
        <button>Buy</button>
    </div>
<?php endforeach; ?>

<a href="/?c=product&a=catalog&page=<?= $page ?>">ЕЩЕ</a>