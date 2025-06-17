<?php 
    $user = $params['user'];
?>
<div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-10">
    <h2 class="text-2xl font-semibold mb-6">Użytkownik</h2>
    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
        <div class="block w-full overflow-x-auto">
            <table class="items-center bg-transparent w-full border-collapse ">
                <tbody>
                    <tr>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                            <?php echo $user['name'] ?>
                        </td>
                        <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                            <?php echo $user['email'] ?>
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                            <i class="fa-solid fa-clock text-emerald-500 mr-4"></i>
                            <?php echo $user['created_at'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<section class="max-w-5xl mx-auto px-4 py-8">
  <h2 class="text-2xl font-semibold mb-6">Historia zamówień</h2>
  <div class="flex flex-wrap gap-6">
    <?php foreach($params['data'] as $order): ?>
    <div class="space-y-6">
        <div class="border rounded-xl shadow-sm p-5 bg-white">
        <div class="flex justify-between items-start mb-4 flex-wrap gap-4">
            <div>
            <p class="text-sm text-gray-500">Zamówienie <?= $order['orderId'] ?> </p>
            <p class="text-lg font-medium">Data: <?= $order['created_at'] ?></p>
            </div>
            <div class="text-right">
            <p class="text-sm">Status: <span class="text-green-600 font-semibold"><?= $order['status'] ?></span></p>
            <p class="text-sm">Płatność: <span class="text-blue-600 font-semibold"><?= $order['payment_status'] ?></span></p>
            </div>
        </div>

        <!-- Adres dostawy -->
        <div class="bg-gray-50 p-4 rounded-md mb-4">
            <p class="font-medium mb-1">Adres dostawy:</p>
            <p class="text-sm text-gray-700"><?= $order['firstname']." ".$order['lastname'] ?></p>
            <p class="text-sm text-gray-700">ul. <?= $order['street']." ".$order['building_number'] ?></p>
            <p class="text-sm text-gray-700"><?= $order['postal_code']." ".$order['city'] ?></p>
        </div>

        <!-- Lista produktów -->
        <?php foreach($order['products'] as $product): ?>
        <div class="divide-y">
            <div class="flex items-center gap-4 py-2">
            <img src="public/images/products/<?= $product['image_url'] ?>" class="w-16 h-16 object-cover rounded-md" alt="Produkt">
            <div class="flex-1">
                <p class="font-medium"><?=$product['name'] ?></p>
                <p class="text-sm text-gray-500"><?= $product['size'] ?></p>
            </div>
            <div class="text-right">
                <p class="text-sm">Ilość: <?= $product['quantity'] ?> szt</p>
                <p class="text-sm font-medium">Cena: <?= $product['price']*$product['quantity'] ?> zł</p>
            </div>
            </div>
        </div>
        <?php endforeach ?>
        <div class="text-right mt-4">
            <p class="text-lg font-semibold">Łącznie: <?= $order['total_price'] ?> zł</p>
        </div>
        </div>
    </div>
    <?php endforeach ?>
  </div>
</section>
