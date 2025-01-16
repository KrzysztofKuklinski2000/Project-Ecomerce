<style>
    @layer utilities {
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  }
</style>

<section class="py-24 relative">
        <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
            <form action="/?page=order" method="POST">
            <div class="w-full flex-col justify-center items-center gap-4 inline-flex">
                <h2 class="text-center text-gray-900 text-4xl font-bold font-manrope leading-normal">Dane do Wysyłki</h2>
                <br>
            </div>
            <div class="lg:my-14 my-8 grid lg:grid-cols-2 grid-cols-1 gap-8">
                <div class="w-full flex-col justify-start items-start gap-6 inline-flex">
                    <div class="w-full flex-col justify-start items-start gap-8 flex">
                        <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                            <label for="" class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">Ulica
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7" fill="none">
                                    <path d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z" fill="#EF4444"/>
                                </svg>
                            </label>
                            <input name="street" type="text" class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-lg font-normal leading-relaxed px-5 py-3 rounded-lg shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] border border-gray-200 justify-start items-center gap-2 inline-flex" placeholder="Ulica">
                        </div>
                        <div class="w-full justify-start items-start gap-7 flex sm:flex-row flex-col">
                            <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                                <label for="" class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">Imię
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7" fill="none">
                                        <path d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z" fill="#EF4444"/>
                                    </svg>
                                </label>
                                <input name="firstname" type="text" class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-lg font-normal leading-relaxed px-5 py-3 rounded-lg shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] border border-gray-200 justify-start items-center gap-2 inline-flex" placeholder="Imię">
                            </div>
                            <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                                <label for="" class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">Nazwisko
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7" fill="none">
                                        <path d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z" fill="#EF4444"/>
                                    </svg>
                                </label>
                                <input name="lastname" type="text" class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-lg font-normal leading-relaxed px-5 py-3 rounded-lg shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] border border-gray-200 justify-start items-center gap-2 inline-flex" placeholder="Nazwisko">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex-col justify-start items-start gap-6 inline-flex">
                    <div class="w-full flex-col justify-start items-start gap-8 flex">
                        <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                            <label for="" class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">Miasto
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7" fill="none">
                                    <path d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z" fill="#EF4444"/>
                                </svg>
                            </label>
                            <input name="city" type="text" class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-lg font-normal leading-relaxed px-5 py-3 rounded-lg shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] border border-gray-200 justify-start items-center gap-2 inline-flex" placeholder="Miasto">
                        </div>
                        <div class="w-full justify-start items-start gap-7 flex sm:flex-row flex-col">
                            <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                                <label for="" class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">Kod Pocztowy
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7" fill="none">
                                        <path d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z" fill="#EF4444"/>
                                    </svg>
                                </label>
                                <input name="postal_code" type="text" class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-lg font-normal leading-relaxed px-5 py-3 rounded-lg shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] border border-gray-200 justify-start items-center gap-2 inline-flex" placeholder="Kod Pocztowy">
                            </div>
                            <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                                <label for="" class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">Numer Budynku
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7" fill="none">
                                        <path d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z" fill="#EF4444"/>
                                    </svg>
                                </label>
                                <input name="bulidng_number" type="text" class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-lg font-normal leading-relaxed px-5 py-3 rounded-lg shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] border border-gray-200 justify-start items-center gap-2 inline-flex" placeholder="Numer Budynku">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <button class="mx-auto sm:w-fit w-1/2 px-7 py-3 bg-indigo-600 hover:bg-indigo-700 transition-all duration-700 ease-in-out rounded-xl shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] justify-center items-center flex">
                <span class="px-2 text-center text-white text-lg font-semibold leading-8">Zapłać</span>
            </button>
        </form>
        </div>
    </section>


<div class="h-screen bg-gray-100 pt-20">
    <h1 class="mb-10 text-center text-2xl font-bold">Zamawiane Produkty</h1>
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
                </div>
                <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
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
        </div>
      </div>
  </div>



    
                                            