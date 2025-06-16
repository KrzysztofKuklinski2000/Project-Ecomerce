<?php 
    $order = $params['data']['order'];
    $products = $params['data']['products'];
?>
<!-- component -->
<div class="w-full justify-center mx-auto my-6 flex gap-12">

    <div class="w-1/2 bg-white p-3 rounded-md">
        <br>
        <h1 class="text-xl">Dane Zamówienia:</h1>
        <div class="flex justify-between items-center mt-4">
            <div>
                <h4 class="text-gray-600 text-sm">Wartość zamówienia: </h4>
                <span class="mt-2 text-sm text-sm text-emerald-500"><?= $order['total_price'] ?></span>
            </div>
            <div>
                <h4 class="text-gray-600 text-sm">Status: </h4>
                <span class="mt-2 text-sm text-sm p-1 text-white rounded-md
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
                <span class="mt-2 text-sm text-sm p-1 text-white rounded-md
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
        <div class="flex justify-between items-center mt-6">
            <div>
                <h4 class="text-gray-600 text-sm">Zamówienie złozone: </h4>
                <span class="mt-2 text-sm text-sm text-emerald-500"><?= $order['created_at'] ?></span>
            </div>
            <div>
                <form action="/?module=order&page=delete" method="POST">
                    <input type="hidden" name="id" value="<?= $order['id'] ?>">
                    <input type="submit" value="Usuń zamówienie" class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600 cursor-pointer">
                </form>
            </div>
        </div>
    </div>
</div>