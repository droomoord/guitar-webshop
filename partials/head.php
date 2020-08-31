<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/style.css">
    <script src="./scripts/vue.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
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

