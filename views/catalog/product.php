<div class="product">
    <p class="product__name"><?= $product->name ?></p>
    <img src="/img/<?= $product->img ?>" alt="<?= $product->img ?>" width="150" height="150">
    <p class="product__descr"><?= $product->description ?></p>
    <p class="product__price">price: <?= $product->price ?></p>
    <button>Buy</button>
</div>
