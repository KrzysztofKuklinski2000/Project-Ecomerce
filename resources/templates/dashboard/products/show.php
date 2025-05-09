<?php
    $product = $params['product'];
    $categories = $params['categories'];
?>
<div class="mx-auto mt-11 w-80 transform overflow-hidden rounded-lg bg-white shadow-md duration-300 hover:scale-105 hover:shadow-lg">
  <img class="w-full object-cover object-center" src="public/images/products/<?= $product['image_url'] ?>" alt="Product Image" />
  <div class="p-4">
    <h2 class="mb-2 text-lg font-medium  text-gray-900"><?= $product['name'] ?></h2>
    <p class="mb-2 text-base  text-gray-700"><?= $product['description'] ?></p>
    <div class="flex items-center">
      <p class="mr-2 text-lg font-semibold text-gray-900 "><?= $product['price'] ?>PLN</p>
      <p class="text-base  font-medium text-gray-900"><?= $product['size'] ?></p>
      <p class="ml-auto text-base font-medium text-green-500"><?= $product['stock'] ?>szt</p>
    </div>
    <div class="flex items-center">
      <p class="text-base  font-medium text-gray-500 "><?= $product['created_at'] ?></p>
      <p class="ml-auto text-base font-medium text-green-500"><?= $categories[$product['category_id']-1]['name'] ?></p>
    </div>
  </div>
</div>