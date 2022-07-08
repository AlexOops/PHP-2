<h2>Каталог товаров</h2>
<?php foreach ($products as $product) : ?>
    <div>
        <img src="../public/img/<?= $product->img ?>" alt="<?= $product->img ?>">
        <a href="/?c=product&a=product&id=<?= $product->id ?>"><?= $product->name ?></a>
        <p>price: <?= $product->price ?> </p>
        <button>Buy</button>
    </div>
<?php endforeach; ?>
