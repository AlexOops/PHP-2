<h2>Отзывы</h2>
<?php foreach ($feedbacks as $feedback): ?>
    <div class="feedbacks">
        <p><b><?= $feedback['name'] ?></b>:<?= $feedback['feedback'] ?></p>
        <!--        <a href="/oneproduct/edit/?id=--><? //= $id_product ?><!--&id_feedback=-->
        <? //= $feedback['id'] ?><!--">[edit]</a>-->
        <!--        <a href="/oneproduct/delete/?id=--><? //= $id_product ?><!--&id_feedback=-->
        <? //= $feedback['id'] ?><!--">[X]</a></p>-->
    </div>

<?php endforeach; ?>