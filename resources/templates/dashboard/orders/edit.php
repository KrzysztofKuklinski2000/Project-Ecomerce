<?php 
    $order = $params['data']['order'];
    $address = $params['data']['address'];
    $products = $params['data']['products'];
?>
<div class="flex items-center justify-center">
    <form id="form" action="/?module=order&page=update" method="POST" class=" w-3/5 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <input type="hidden" name="id" value = "<?= $order['id'] ?>">
        <h1 class="block text-gray-700 font-bold mb-2 text-xl text-center">Edytujesz Zamówienie nr: <?= $order['id'] ?> </h1>
        <br>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                Status
            </label>
            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="processing" <?= $order['status']==='processing' ? 'selected' : ''?>>Processing</option>
                <option value="pending" <?= $order['status']==='pending' ? 'selected' : ''?>>Pending</option>
                <option value="shipped" <?= $order['status']==='shipped' ? 'selected' : ''?>>Shipped</option>
                <option value="cancelled" <?= $order['status']==='cancelled' ? 'selected' : ''?>>Cancelled</option>
                <option value="completed" <?= $order['status']==='completed' ? 'selected' : ''?>>Completed</option>
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="payment_status">
                Status płatności
            </label>
            <select name="payment_status" id="payment_status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="pending" <?= $order['payment_status']==='pending' ? 'selected' : ''?>>Pending</option>
                <option value="cancelled" <?= $order['payment_status']==='cancelled' ? 'selected' : ''?>>Cancelled</option>
                <option value="completed" <?= $order['payment_status']==='completed' ? 'selected' : ''?>>Completed</option>
            </select>
        </div>
        <h1 class="text-xl py-2">Dane Adresowe</h1>
        <input type="hidden" name="addressId" value="<?= $address['id'] ?>">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                Imię
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="firstname" id="firstname" type="text" value="<?= $address['firstname'] ?>" placeholder="Imię" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                Nazwisko
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="lastname" id="lastname" type="text" value="<?= $address['lastname'] ?>" placeholder="Nazwisko" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="street">
                Ulica
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="street" id="street" type="text" value="<?= $address['street'] ?>" placeholder="Ilość produktu" required>      
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="city">
                Miasto
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="city" id="city" type="text" value="<?= $address['city'] ?>">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="building_number">
                Numer budynku
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="building_number" id="building_number" type="text" value="<?= $address['building_number'] ?>">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="postal_code">
                Kod Pocztowy
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="postal_code" id="postal_code" type="text" value="<?= $address['postal_code'] ?>">
        </div>

        <h1 class="text-xl py-2">Produkty</h1>

        <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
            <table class="w-full text-left table-auto min-w-max">
                <thead>
                    <tr class="border-b border-slate-300 bg-slate-50">
                        <th class="p-4 text-sm font-normal leading-none text-slate-500">Produkt</th>
                        <th class="p-4 text-sm font-normal leading-none text-slate-500">Nazwa</th>
                        <th class="p-4 text-sm font-normal leading-none text-slate-500">Ilość</th>
                        <th class="p-4 text-sm font-normal leading-none text-slate-500"></th>
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
                                <input class="w-[50px] bg-slate-100 p-1 rounded" type="number" value="<?= $product['quantity'] ?>" name="quantity[<?= $product['id'] ?>]">
                            </td>
                            <td class="p-4 border-b border-slate-200 py-5">
                                <a href="/?module=order&page=deleteProductFromOrder&orderProduct=<?= $product['orderItemId'] ?>" type="button" class="text-slate-500 hover:text-slate-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between mt-10">
            <button id="submit"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                <i class="fa-solid fa-pencil"></i> Zapisz
            </button>
        </div>
    </form>
</div>