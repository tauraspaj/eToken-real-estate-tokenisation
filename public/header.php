<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META CHARSET -->
    <meta charset="UTF-8">
    <!-- META CHARSET -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- META VIEWPORT -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- META DESCRIPTION -->
    <meta name="description" content="Tokenise your property">
    <!-- META KEYWORDS -->
    <meta name="keywords" content="Property, tokenisation, real estate, investment, erc20, blockchain">
    <!-- META AUTHOR -->
    <meta name="author" content="Tauras Pajuodis">

    <!-- TITLE -->
    <title>MyToken <?php echo '- '.strtoupper($activePage) ?></title>
    <!-- FAV ICON -->
    <!-- <link rel="shortcut icon" href="./images/favicon.ico"> -->
    <!-- CSS -->
    <link href="./css/dist.css" rel="stylesheet">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="overflow-x-hidden font-roboto bg-gray-50">
    <!-- Header section -->
    <header class="border-b h-16">
        <div class="container mx-auto p-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="./index.php" title="Home" class="font-bold text-gray-900 text-2xl">MyToken<span class="text-orange-600">.</span></a>

            <nav class="hidden md:block flex items-center space-x-12">
                <a href="./marketplace.php" class="<?php echo ($activePage == 'marketplace') ? 'text-orange-600' : 'text-gray-900' ?> transition hover:text-orange-600" title="Go to marketplace">Marketplace</a>
                <a href="./faq.php" class="<?php echo ($activePage == 'faq') ? 'text-orange-600' : 'text-gray-900' ?> transition hover:text-orange-600" title="Go to FAQ page">FAQ</a>
                <a href="./contact.php" class="<?php echo ($activePage == 'contact') ? 'text-orange-600' : 'text-gray-900' ?> transition hover:text-orange-600" title="Go to contact page">Contact</a>
                <button id="account-display" type="button" class="border text-gray-900 rounded px-4 py-1 transition hover:text-orange-600 hover:border-orange-600">Sign in</button>
            </nav>

            <!-- Burger menu -->
            <div id="burger-menu" class="md:hidden text-gray-900 border p-1 transition hover:text-orange-600 focus:text-orange-600 hover:border-orange-600 focus:border-orange-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </div>

            <!-- Mobile navbar -->
            <div id="mobile-overlay" class="w-screen h-screen fixed inset-0 z-40 hidden">
                    <div id="mobile-nav" class="bg-gray-100 h-1/2">
                        <div class="flex justify-center items-center container mx-auto">
                            <!-- Invisible element -->
                            <div class="flex-1"></div>
                            <!-- Logo -->
                            <a href="./index.php" class="flex-1 flex flex-col text-center my-6" title="MyToken">
                                <p class="text-gray-900 font-bold text-3xl">MyToken<span class="text-orange-600">.</span></p>
                            </a>
                            <!-- Close button -->
                            <div class="flex-1 flex justify-end mr-6">
                                <button id="close-mobile-overlay" class="border text-gray-900 p-1 hover:text-orange-600 focus:text-orange-600 hover:border-orange-600 focus:border-orange-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <a href="./marketplace.php" class="<?php echo ($activePage == 'marketplace') ? 'text-orange-600' : 'text-gray-900' ?> text-lg py-2 transition hover:text-orange-600 focus:text-orange-600" title="Marketplace">Marketplace</a>
                            <a href="./faq.php" class="<?php echo ($activePage == 'faq') ? 'text-orange-600' : 'text-gray-900' ?> text-lg py-2 transition hover:text-orange-600 focus:text-orange-600" title="FAQ">FAQ</a>
                            <a href="./contact.php" class="<?php echo ($activePage == 'contact') ? 'text-orange-600' : 'text-gray-900' ?> text-lg py-2 transition hover:text-orange-600 focus:text-orange-600" title="Contact">Contact</a>
                            <button id="mob-account-display" type="button" class="border text-gray-900 rounded px-4 py-1 transition hover:text-orange-600 hover:border-orange-600 mt-2">Sign in</button>
                        </div>

                        <!-- Faint logo -->
                        <div class="flex justify-center items-center pointer-events-none">
                            <p class="text-gray-900 [font-size:100px] -mt-6 font-black -rotate-3 opacity-5">MyToken</p>
                        </div>
                    </div>

                    <div id="mobile-curtain" class="w-full h-full bg-black opacity-50 absolute"></div>
                </div>
        </div>
    </header>

    <!-- Page Title -->
    <section class="h-24 md:h-32 bg-[#03070F]">
        <div class="container mx-auto h-full p-4 flex items-center md:justify-center">
            <h1 class="uppercase text-2xl md:text-4xl font-bold text-gray-50"><?php echo strtoupper($activePage);?></h1>
        </div>
    </section>