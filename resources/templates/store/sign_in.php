<section class="bg-white mt-20">
    <div class="container flex items-center justify-center min-h-screen px-6 mx-auto">
        <form class="w-full max-w-md" action="/?page=sign_in" method="POST">
            <a href="/">
                <div class="flex justify-center mx-auto">
                    <img class="w-auto h-7 sm:h-8" src="public/images/logo1.png" alt="">
                </div>
            </a>
            
            <div class="flex items-center justify-center mt-6">
                <a href="/?page=sign_in" class="w-1/3 pb-4 font-medium text-center text-gray-500 capitalize border-b-2 border-blue-500">
                    Zaloguj się
                </a>

                <a href="/?page=sign_up" class="w-1/3 pb-4 font-medium text-center text-gray-500 capitalize border-b">
                    Zarejestruj się 
                </a>
            </div>

            <div class="relative flex items-center mt-6">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>

                <input name="email" type="email" class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11  focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="E-mail">
            </div>

            <div class="relative flex items-center mt-4">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>

                <input name="password" type="password" class="block w-full px-10 py-3 text-gray-700 bg-white border rounded-lg focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Hasło">
            </div>

            <div class="mt-6">
                <?php if($message['loginError'] ?? null): ?>
                    <p class="w-full text-center"><?php echo $message['loginError'] ?></p>
                <?php endif?>
            
                <button class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                    Zaloguj się
                </button>
                

                <div class="mt-6 text-center ">
                    <a href="/?page=sign_up" class="text-sm text-blue-400 hover:underline">
                        Nie masz jeszcze konta?
                    </a>
                </div>
            </div>
        </form>
    </div>
</section>