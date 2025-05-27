<?php 
    $order = $params['data']['order'];
    $user = $params['data']['user'];
    $address = $params['data']['address'];
    $products = $params['data']['products'];
?>
<!-- component -->
<div class="w-full mx-auto my-6 flex gap-12">
    <div class="w-1/2 bg-white p-3 rounded-md">
        <div class="sm:flex sm:justify-between">
            <div class="flex items-center">
                <img class="h-12 w-12 rounded-full" src="https://lh3.googleusercontent.com/a-/AOh14Gi0DgItGDTATTFV6lPiVrqtja6RZ_qrY91zg42o-g" alt="">
                <div class="ml-2">
                    <h3 class="text-lg text-gray-800 font-medium"><?= $user['name'] ?></h3>
                    <span class="text-gray-600"><?= $user['email'] ?></span>
                </div>
            </div>
        </div>
        <br>
        <h1 class="text-xl">Dane Adresowe:</h1>
        <div class="flex justify-between items-center mt-4">
            <div>
                <h4 class="text-gray-600 text-sm">Imię</h4>
                <span class="mt-2 text-sm text-sm text-gray-800"><?= $address['firstname'] ?></span>
            </div>
            <div>
                <h4 class="text-gray-600 text-sm">Nazwisko</h4>
                <span class="mt-2 text-sm text-sm text-gray-800"><?= $address['lastname'] ?></span>
            </div>
            <div>
                <h4 class="text-gray-600 text-sm">Ulica</h4>
                <span class="mt-2 text-sm text-sm text-gray-800"><?= $address['street'] ?></span>
            </div>
        </div>
        <div class="flex justify-between items-center mt-4">
            <div>
                <h4 class="text-gray-600 text-sm">Miasto</h4>
                <span class="mt-2 text-sm text-sm text-gray-800"><?= $address['city'] ?></span>
            </div>
            <div>
                <h4 class="text-gray-600 text-sm">Numer Budynku</h4>
                <span class="mt-2 text-sm text-sm text-gray-800"><?= $address['building_number'] ?></span>
            </div>
            <div>
                <h4 class="text-gray-600 text-sm">Kod Pocztowy</h4>
                <span class="mt-2 text-sm text-sm text-gray-800"><?= $address['postal_code'] ?></span>
            </div>
        </div>
    </div>

    <div class="w-1/2 bg-white p-3 rounded-md"
        <br>
        <h1 class="text-xl">Dane Zamówienia:</h1>
        <div class="flex justify-between items-center mt-4">
            <div>
                <h4 class="text-gray-600 text-sm">Wartość zamówienia: </h4>
                <span class="mt-2 text-sm text-sm text-emerald-500"><?= $order['total_price'] ?></span>
            </div>
            <div>
                <h4 class="text-gray-600 text-sm">Status: </h4>
                <span class="mt-2 text-sm text-sm p-1 text-white
                <?php
                    if($order['status'] === 'completed'){
                        echo "bg-emerald-500";
                    }elseif($order['status'] === 'pending'){
                        echo "bg-amber-500";
                    }else {
                        echo "bg-red-500";
                    }
                ?>">
                <?= $order['status'] ?></span>
            </div>
            <div>
                <h4 class="text-gray-600 text-sm">Status płatności: </h4>
                <span class="mt-2 text-sm text-sm p-1 text-white
                <?php
                    if($order['payment_status'] === 'completed'){
                        echo "bg-emerald-500";
                    }elseif($order['payment_status'] === 'pending'){
                        echo "bg-amber-500";
                    }else {
                        echo "bg-red-500";
                    }
                ?>">
                <?= $order['payment_status'] ?></span>
            </div>
        </div>
        <div class="flex justify-between items-center mt-4">
            <div>
                <h4 class="text-gray-600 text-sm">Zamówienie złozone: </h4>
                <span class="mt-2 text-sm text-sm text-emerald-500"><?= $order['created_at'] ?></span>
            </div>
        </div>
    </div>

</div>
<div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
    <table class="w-full text-left table-auto min-w-max">
        <thead>
        <tr class="border-b border-slate-300 bg-slate-50">
            <th class="p-4 text-sm font-normal leading-none text-slate-500">Produkt</th>
            <th class="p-4 text-sm font-normal leading-none text-slate-500">Nazwa</th>
            <th class="p-4 text-sm font-normal leading-none text-slate-500">Ilość</th>
            <th class="p-4 text-sm font-normal leading-none text-slate-500">Cena za produkt</th>
            <th class="p-4 text-sm font-normal leading-none text-slate-500">Wartość produtków</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($products as $product): ?>
        <tr class="hover:bg-slate-50">
            <td class="p-4 border-b border-slate-200 py-5">
            <img src="public/images/products/<?= $product['image_url'] ?>" alt="Product 1" class="w-16 h-16 object-cover rounded" />
            </td>
            <td class="p-4 border-b border-slate-200 py-5">
            <p class="block font-semibold text-sm text-slate-800"><?= $product['name'] ?></p>
            </td>
            <td class="p-4 border-b border-slate-200 py-5">
            <p class="text-sm text-slate-500"><?= $product['quantity'] ?></p>
            </td>
            <td class="p-4 border-b border-slate-200 py-5">
            <p class="text-sm text-slate-500"><?= $product['price'] ?></p>
            </td>
            <td class="p-4 border-b border-slate-200 py-5">
            <p class="text-sm text-slate-500"><?= (int) $product['quantity'] * (int) $product['price'] ?></p>
            </td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>