<?php 
    $category = $params['category'];
    $message = $params['message'];
?>


<div class="w-full justify-center mx-auto my-6 flex gap-12">
    <div class="w-1/2 bg-white p-3 rounded-md">
        <br>
        <h1 class="text-xl">Kategoria: <?= $category['name'] ?></h1>
        <h1>Stworzona: <?= $category['created_at'] ?></h1>
        <h1 class="text-red-500 uppercase"><?= $message ?></h1>
        <br>
        <?php if(!$message): ?>
        <form action="/?module=category&page=delete" method="POST">
            <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <input type="submit" value="Usuń zamówienie" class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600 cursor-pointer">
        </form>
        <?php endif; ?>
    </div>
</div>