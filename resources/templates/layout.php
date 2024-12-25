<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/pagedone@1.2.2/src/css/pagedone.css " rel="stylesheet"/>
</head>
<body>
    <header>
        <?php #include_once "components/navigation.php"; ?> 
        <!-- <?php include_once "components/header.php";?> -->
    </header>
    
    <main>
        <!-- <?php include_once "components/category.php"; ?> -->
        <!-- <?php include_once "products.php" ?> -->
        <!-- <?php include_once "shopping_card.php" ?> -->
        <!-- <?php include_once "product_details.php" ?> -->
        <!-- <?php include_once "sign_in.php" ?> -->
         <?php include_once "sign_up.php" ?>
    </main>
    

    <!-- <?php include_once "components/footer.php"; ?> -->


<script src="/node_modules/alpinejs/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/pagedone@1.2.2/src/js/pagedone.js"></script>
</body>
</html>
