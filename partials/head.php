<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/styles/style.css">
    <!-- <script src="./scripts/vue.js"></script> -->
    <script src="./scripts/vue.min.js"></script>
    <script src="./scripts/axios.min.js"></script>
    <title>The Guitar King</title>
</head>
<body>
<div id="app">
    <?php 
    include 'navbar.php'; 
    // $path = 'http://localhost:1337';
    $path = 'https://guitar-webshop-cms.herokuapp.com';
    ?>  
        <template v-if="show">
            <backdrop @click.native="show = false"></backdrop>
            <cart :cart="cart" @close="show = false"></cart>
        </template>
       
    <div class="page">

