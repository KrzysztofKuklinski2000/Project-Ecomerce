<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/pagedone@1.2.2/src/css/pagedone.css " rel="stylesheet"/>

    <style> 
        .message {
            width:100%;
            height:50px;
            background:#0275d8;
            display:flex;
            justify-content: center;
            align-items:center;
            color:#fff;
        }

    </style>
</head>
<body>
    <header>
       <?php if($message['messageTop'] ?? null): ?>
            <div class="message">
                <h1><?php echo $message['messageTop'] ?></h1>
                <div id="closeMessage">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>    
            </div>
       <?php endif;?>

        <?php $params['page'] != 'sign_up' && $params['page'] != 'sign_in' ? include_once "components/navigation.php" : ""?> 
        
        <?php $params['page'] == 'start' ? include_once "components/header.php" : ''?>
        <?php $params['page'] == 'start' ? include_once "components/category.php" : ''?>
        
    </header>
    
    <main>
        <?php $params['page'] != 'start' ? include_once $params['page'] . ".php" : '' ?>
    </main>
    

    <?php $params['page'] != 'sign_up' && $params['page'] != 'sign_in' ? include_once "components/footer.php" : ""?>


<script src="/node_modules/alpinejs/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/pagedone@1.2.2/src/js/pagedone.js"></script>
<script>
    let messageDiv = document.querySelector(".message");
    let closeMessage = document.getElementById("closeMessage");

    closeMessage.addEventListener('click', ()=> {
        messageDiv.style.display="none";
    }, false)
</script>
</body>
</html>

