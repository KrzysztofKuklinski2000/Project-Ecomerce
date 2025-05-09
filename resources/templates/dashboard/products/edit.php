<?php
    $product = $params['product'];
    $categories = $params['categories'];
?>
<div class="flex items-center justify-center">
    <form id="form" enctype="multipart/form-data" action="/?module=product&page=update" method="POST" class=" w-3/5 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <input type="hidden" name="id" value = "<?= $product['id'] ?>">
        <h1 class="block text-gray-700 font-bold mb-2 text-xl text-center">Edytujesz Produkt - <?= $product['name'] ?> </h1>
        <br>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nazwa
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="name" id="name" type="text" value="<?= $product['name'] ?>" placeholder="Nazwa produktu" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Opis Produktu
            </label>
            <textarea placeholder="Opis produktu" name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required><?= $product['description'] ?>
            </textarea>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="size">
                Rozmiar Produktu
            </label>
            <input 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="size" id="size" type="text" value="<?= $product['size'] ?>" placeholder="Rozmiar Produktu" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                Cena
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="price" id="price" type="number" value="<?= $product['price'] ?>" placeholder="Cena produktu" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="stock">
                Ilość
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="stock" id="stock" type="number" value="<?= $product['stock'] ?>" placeholder="Ilość produktu" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                Kategoria
            </label>
            <select name="category" id="category" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <?php foreach($categories as $category): ?>    
                    <option value="<?= $category['id'] ?>" <?= ($product['category_id'] === $category['id']) ? 'selected': ""?>>
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>       
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                Zdjęcie Produktu
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="image" id="image" type="file">
        </div>

        <div class="mb-4">
            <img class="w-1/3" src="/public/images/products/<?= $product['image_url'] ?>" alt="">
        </div>

        <div class="flex items-center justify-between">
            <button id="submit"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                <i class="fa-solid fa-pencil"></i> Zapisz
            </button>
        </div>
    </form>
</div>