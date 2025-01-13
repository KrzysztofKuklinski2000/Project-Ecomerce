<section class="bg-white ">
    <div class="container px-6 py-10 mx-auto text-center">
        <h1 class="mx-auto rounded-lg text-2xl">OKNA</h1>

        <p class="mx-auto mt-4 rounded-lg ">Wszystkie okna znajedziesz poniżej</p>

        <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 sm:grid-cols-2 xl:grid-cols-4 lg:grid-cols-3">
            <?php foreach ($params['content'] ?? [] as $content): ?>
                <a href="/?page=product_details&id=<?php echo $content['id'] ?>">
                    <div class="w-full">
                        <div class="flex flex-col items-center justify-center w-full max-w-sm mx-auto">
                            <div class="w-full h-64 bg-gray-300 bg-center bg-cover rounded-lg shadow-md" style="background-image: url(public/images/products/<?php echo $content['image_url'] ?>)"></div>

                            <div class="w-48 -mt-10 overflow-hidden bg-white rounded-lg shadow-lg md:w-56 ">
                                <h3 class="py-2 font-bold tracking-wide text-center text-gray-800 uppercase "><?php echo $content['name']?></h3>

                                <div class="flex items-center justify-between px-3 py-2 bg-gray-200 ">
                                    <span class="font-bold text-gray-800 "><?php echo $content['price']?>zł</span> 
                                    <button class="px-2 py-1 text-xs font-semibold text-white uppercase transition-colors duration-300 transform bg-gray-800 rounded hover:bg-gray-700  focus:bg-gray-700 focus:outline-none">Do Koszyka</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>