<div class="flex items-center justify-center">
    <form id="form" action="/?module=category&page=store" method="POST" class=" w-3/5 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="block text-gray-700 font-bold mb-2 text-xl text-center">Dodaj Kategorie Produktu</h1>
        <br>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nazwa
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="name" id="name" type="text" placeholder="Nazwa kategorii" required>
        </div>

        <div class="flex items-center justify-between">
            <button id="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"type="submit">
                <i class="fa-solid fa-pencil"></i> Stwórz
            </button>
        </div>
    </form>
</div>