<style>
    @layer utilities {
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  }
</style>

  <div class="h-screen bg-gray-100 pt-20">
    <h1 class="mb-10 text-center text-2xl font-bold">Koszyk</h1>
      <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
        <div class="rounded-lg md:w-2/3">
          <?php foreach($params['content'] as $content): ?>
            <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
              <img src="public/images/products/<?php echo $content['productImageUrl'] ?>" alt="product-image" class="w-auto h-20 sm:h-7  rounded-lg sm:w-40" />
              <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                <div class="mt-5 sm:mt-0">
                  <h2 class="text-lg font-bold text-gray-900">
                    <?php echo $content['productName'];?>
                  </h2>
                  <p class="mt-1 text-xs text-gray-700">
                  <div class="w-[50px]">
                    <form action="/?page=shopping_cart" method="POST">
                    <input name="cartId" type="hidden" value="<?php echo $content['id'] ?>"/>
                        <button type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                          </svg>
                      </button>
                    </form>
                  </div>
                  </p>
                </div>
                <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                  <div class="flex items-center border-gray-100">
                    <input name="quantity<?php echo $content["id"]?>" class="quantity h-8 w-8 border bg-white text-center text-xs outline-none" type="number" value="<?php echo $content['quantity'] ?>" min="1" />
                  </div>
                  <div class="flex items-center space-x-4">
                    <p class="text-sm"><?php echo $content['productPrice'] ?>zł</p>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        
        <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
          <div class="mb-2 flex justify-between">
            <p class="text-gray-700">Cena: </p>
            <p class="text-gray-700">3200zł</p>
          </div>
          <div class="flex justify-between">
            <p class="text-gray-700">Dostawa:</p>
            <p class="text-gray-700">0zł</p>
          </div>
          <hr class="my-4" />
          <div class="flex justify-between">
            <p class="text-lg font-bold">Razem</p>
            <div class="">
              <p class="mb-1 text-lg font-bold"><?php echo $params['total_amount']?>zł</p>
              <p class="text-sm text-gray-700">z VAT</p>
            </div>
          </div>
          <button type="submit" class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">Zapłać</button>
        </div>
      </div>
  </div>