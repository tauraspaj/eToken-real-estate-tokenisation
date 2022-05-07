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
    <title>eToken</title>
    <!-- FAV ICON -->
    <link rel="shortcut icon" href="./images/favicon.ico">
    <!-- CSS -->
    <link href="./css/dist.css" rel="stylesheet">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="overflow-x-hidden font-roboto bg-gray-50">
    <!-- Header section -->
    <header>
        <div class="h-[520px] md:h-[600px] w-screen bg-[#03070F] overflow-hidden grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5">
            <div class="relative md:col-span-2 lg:col-span-3 pr-8">
                <div class="absolute top-16 md:top-20 w-full h-[1px] bg-white opacity-25 z-[5]"></div>
                <div class="absolute left-16 md:left-20 w-[1px] h-full bg-white opacity-25 z-[5]"></div>
                <!-- <div class="absolute top-8 left-16 w-60 h-60 bg-[#353A43] rounded-full filter blur-3xl z-[5]"></div> -->
                
                <!-- Logo and nav -->
                <div class="flex items-center justify-between ml-20 mt-4 md:ml-28 md:mt-10">
                    <a class="text-gray-50 font-bold text-3xl" href="./index.php" title="Home">eToken<span class="text-orange-600">.</span></a>
                    <nav class="hidden md:block space-x-8">
                        <a href="./marketplace.php" class="text-gray-300 transition hover:text-orange-600" title="Go to marketplace">Marketplace</a>
                        <a href="./faq.php" class="text-gray-300 transition hover:text-orange-600" title="Go to FAQ page">FAQ</a>
                        <a href="./contact.php" class="text-gray-300 transition hover:text-orange-600" title="Go to contact page">Contact</a>
                    </nav>
                    
                    <!-- Burger menu -->
                    <div id="burger-menu" class="md:hidden text-gray-50 border p-1 transition hover:text-orange-600 focus:text-orange-600 hover:border-orange-600 focus:border-orange-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </div>
                </div>

                <!-- Welcome text and search-->
                <div class="ml-20 md:ml-28 mt-20 max-w-2xl">
                    <p class="text-white text-2xl md:text-6xl font-bold">A new way to buy and sell property<span class="text-orange-600">.</span></p>
                    <p class="text-white md:text-3xl font-light mt-4">Welcome to the new age.</p>

                    <!-- Search -->
                    <div class="flex flex-col mt-16">
                        <div class="flex">
                            <p class="bg-gray-200 text-sm md:text-base flex border items-center font-medium text-orange-600 rounded-t py-2 px-4">
                                Search for property
                            </p>
                        </div>
                        <input type="text" class="outline-none bg-gray-100 text-sm md:text-base rounded-b rounded-r border-2 px-4 text-gray-900 py-2 transition focus:border-orange-600" placeholder="Enter property location...">
    
                    </div>
                </div>

                <!-- Mobile navbar -->
                <div id="mobile-overlay" class="w-screen h-screen fixed inset-0 z-40 hidden">
                    <div id="mobile-nav" class="bg-gray-100 h-1/2">
                        <div class="flex justify-center items-center container mx-auto">
                            <!-- Invisible element -->
                            <div class="flex-1"></div>
                            <!-- Logo -->
                            <a href="./index.php" class="flex-1 flex flex-col text-center my-6" title="eToken">
                                <p class="text-gray-900 font-bold text-3xl">eToken<span class="text-orange-600">.</span></p>
                            </a>
                            <!-- Close button -->
                            <div class="flex-1 flex justify-end mr-6">
                                <button id="close-mobile-overlay" class="border text-gray-900 p-1 hover:text-orange-600 focus:text-orange-600 hover:border-orange-600 focus:border-orange-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <a href="./marketplace.php" class="text-gray-900 text-lg py-2 transition hover:text-orange-600 focus:text-orange-600" title="Marketplace">Marketplace</a>
                            <a href="./faq.php" class="text-gray-900 text-lg py-2 transition hover:text-orange-600 focus:text-orange-600" title="FAQ">FAQ</a>
                            <a href="./contact.php" class="text-gray-900 text-lg py-2 transition hover:text-orange-600 focus:text-orange-600" title="Contact">Contact</a>
                        </div>

                        <!-- Faint logo -->
                        <div class="flex justify-center items-center">
                            <p class="text-gray-900 [font-size:100px] -mt-6 font-black -rotate-3 opacity-5">eToken</p>
                        </div>
                    </div>

                    <div id="mobile-curtain" class="w-full h-full bg-black opacity-50 absolute"></div>
                </div>

            </div>

            <!-- Image -->
            <div class="hidden md:block w-full h-full bg-cover bg-center lg:col-span-2" style="background-image: url('./img/image-2.jpg')">
            </div>
        </div>
    </header>

    <!-- Latest property for sale -->
    <section class="container mx-auto px-4">
        <!-- Title -->
        <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:justify-between py-20">
            <div class="flex items-center space-x-6">
                <svg class="w-12 h-12 text-orange-600 flex-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <h1 class="font-black text-gray-900 text-3xl whitespace-nowrap">Latest property <br> for sale</h1>
            </div>
            <div class="max-w-4xl">
                <p class="text-gray-500 md:pl-10">We have many properties available for you to invest in right now! Simply go through our options, find the one you like and buy its tokens. Tokens will be accredited to your account instantly.</p>
            </div>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <a class="bg-white rounded-3xl group h-80 border shadow flex flex-col overflow-hidden" href="" title="">
                <!-- Image -->
                <div class="w-full h-3/5 bg-cover bg-center rounded-t-3xl border-b transition group-hover:scale-110" style="background-image: url('./img/image-2.jpg')">
                </div>
                <!-- Info -->
                <div>
                    <div class="p-4 border-b">
                        <p class="text-gray-900 font-bold text-xl whitespace-nowrap">Estimated income: 12%</p>
                        <p class="text-gray-400 text-sm whitespace-nowrap truncate">51 St. John Street, Wimbledon, United Kingdom</p>
                    </div>
                    <!-- Room information -->
                    <div class="grid grid-cols-3">
                        <div class="flex flex-col border-r justify-center items-center p-2">
                            <div class="flex space-x-2 items-center">
                                <i class="fa-solid fa-bed text-sm text-orange-600"></i>
                                <p class="font-semibold text-gray-900">3</p>
                            </div>
                            <p class="text-gray-500 text-sm">Bedrooms</p>
                        </div>
                        <div class="flex flex-col border-r justify-center items-center p-2">
                            <div class="flex space-x-2 items-center">
                                <i class="fa-solid fa-bath text-sm text-orange-600"></i>
                                <p class="font-semibold text-gray-900">2</p>
                            </div>
                            <p class="text-gray-500 text-sm">Bathrooms</p>
                        </div>
                        <div class="flex flex-col border-r justify-center items-center p-2">
                            <div class="flex space-x-2 items-center">
                                <i class="fa-regular fa-folder text-sm text-orange-600"></i>
                                <p class="font-semibold text-gray-900">3600m<sup>2</sup></p>
                            </div>
                            <p class="text-gray-500 text-sm">Living area</p>
                        </div>
                    </div>
                </div>
            </a>
            <a class="bg-white rounded-3xl group h-80 border shadow flex flex-col overflow-hidden" href="" title="">
                <!-- Image -->
                <div class="w-full h-3/5 bg-cover bg-center rounded-t-3xl border-b transition group-hover:scale-110" style="background-image: url('./img/image-2.jpg')">
                </div>
                <!-- Info -->
                <div>
                    <div class="p-4 border-b">
                        <p class="text-gray-900 font-bold text-xl whitespace-nowrap">Estimated income: 12%</p>
                        <p class="text-gray-400 text-sm whitespace-nowrap truncate">51 St. John Street, Wimbledon, United Kingdom</p>
                    </div>
                    <!-- Room information -->
                    <div class="grid grid-cols-3">
                        <div class="flex flex-col border-r justify-center items-center p-2">
                            <div class="flex space-x-2 items-center">
                                <i class="fa-solid fa-bed text-sm text-orange-600"></i>
                                <p class="font-semibold text-gray-900">3</p>
                            </div>
                            <p class="text-gray-500 text-sm">Bedrooms</p>
                        </div>
                        <div class="flex flex-col border-r justify-center items-center p-2">
                            <div class="flex space-x-2 items-center">
                                <i class="fa-solid fa-bath text-sm text-orange-600"></i>
                                <p class="font-semibold text-gray-900">2</p>
                            </div>
                            <p class="text-gray-500 text-sm">Bathrooms</p>
                        </div>
                        <div class="flex flex-col border-r justify-center items-center p-2">
                            <div class="flex space-x-2 items-center">
                                <i class="fa-regular fa-folder text-sm text-orange-600"></i>
                                <p class="font-semibold text-gray-900">3600m<sup>2</sup></p>
                            </div>
                            <p class="text-gray-500 text-sm">Living area</p>
                        </div>
                    </div>
                </div>
            </a>
            <a class="bg-white rounded-3xl group h-80 border shadow flex flex-col overflow-hidden" href="" title="">
                <!-- Image -->
                <div class="w-full h-3/5 bg-cover bg-center rounded-t-3xl border-b transition group-hover:scale-110" style="background-image: url('./img/image-2.jpg')">
                </div>
                <!-- Info -->
                <div>
                    <div class="p-4 border-b">
                        <p class="text-gray-900 font-bold text-xl whitespace-nowrap">Estimated income: 12%</p>
                        <p class="text-gray-400 text-sm whitespace-nowrap truncate">51 St. John Street, Wimbledon, United Kingdom</p>
                    </div>
                    <!-- Room information -->
                    <div class="grid grid-cols-3">
                        <div class="flex flex-col border-r justify-center items-center p-2">
                            <div class="flex space-x-2 items-center">
                                <i class="fa-solid fa-bed text-sm text-orange-600"></i>
                                <p class="font-semibold text-gray-900">3</p>
                            </div>
                            <p class="text-gray-500 text-sm">Bedrooms</p>
                        </div>
                        <div class="flex flex-col border-r justify-center items-center p-2">
                            <div class="flex space-x-2 items-center">
                                <i class="fa-solid fa-bath text-sm text-orange-600"></i>
                                <p class="font-semibold text-gray-900">2</p>
                            </div>
                            <p class="text-gray-500 text-sm">Bathrooms</p>
                        </div>
                        <div class="flex flex-col border-r justify-center items-center p-2">
                            <div class="flex space-x-2 items-center">
                                <i class="fa-regular fa-folder text-sm text-orange-600"></i>
                                <p class="font-semibold text-gray-900">3600m<sup>2</sup></p>
                            </div>
                            <p class="text-gray-500 text-sm">Living area</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- See all button -->
        <div class="flex justify-center py-16 ">
            <a href="" class="flex space-x-2 group items-center pb-2 transition" title="Go to marketplace">
                <svg class="w-5 h-5 text-orange-600 transition group-hover:rotate-[360deg]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="font-medium text-gray-500 text-sm transition group-hover:text-orange-600">See all...</p>
            </a>
        </div>
    </section>

    <!-- Explanation section -->
    <section class="bg-[#03070F]">
        <div class="container mx-auto px-4">
            <!-- Title -->
            <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:justify-between py-20">
                <div class="flex items-center space-x-6">
                    <h1 class="font-black text-gray-50 text-3xl whitespace-nowrap">Grow your digital <br>portfolio</h1>
                </div>
                <div class="max-w-4xl">
                    <p class="text-gray-400 md:pl-10">Real estate is one of the best investments to have in your portfolio and doing that has never been easier! Investing in real estate always required to have a large starting sum, but that's no longer the case as you can buy a fraction of a proeprty.</p>
                </div>
            </div>

            <!-- Grid of benefits -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
                <div class="flex">
                    <svg class="w-12 h-12 text-orange-600 flex-none mr-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="text-gray-50 font-medium">Unique Tokens</p>
                        <p class="text-gray-400 mt-4">Each tokenised property will be associated with a unique ERC-20 contract, which means that no two properties can have the same tokens - they are all unique!</p>
                    </div>
                </div>
                <div class="flex">
                    <svg class="w-12 h-12 text-orange-600 flex-none mr-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>

                    <div>
                        <p class="text-gray-50 font-medium">Diversify your portfolio</p>
                        <p class="text-gray-400 mt-4">Investing in real estate has never been easier. You no longer need to have a large amount of money saved up. You can now buy tokens that represent fractional ownership, and also cost a fraction of the property value!</p>
                    </div>
                </div>
                <div class="flex">
                    <svg class="w-12 h-12 text-orange-600 flex-none mr-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <div>
                        <p class="text-gray-50 font-medium">Blockchain functionality</p>
                        <p class="text-gray-400 mt-4">All transactions performed on this platform are stored on the blockchain, meaning they are public and accessible by everyone. The goal is to create a transparent and decentralised trading platform.</p>
                    </div>
                </div>
                <div class="flex">
                    <svg class="w-12 h-12 text-orange-600 flex-none mr-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <div>
                        <p class="text-gray-50 font-medium">Smart contracts</p>
                        <p class="text-gray-400 mt-4">All ownerships are established through smart contracts, meaning ownerships are immutable and unchangeable. Your tokens will only belong to you!</p>
                    </div>
                </div>
            </div>

            <!-- FAQ button -->
            <div class="flex justify-center py-16 ">
                <a href="" class="flex space-x-2 group items-center pb-2 transition" title="Go to FAQ page">
                    <svg class="w-5 h-5 text-orange-600 transition group-hover:rotate-[360deg]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="font-medium text-gray-500 text-sm transition group-hover:text-orange-600">Want to learn more? Check out our FAQ page!</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-50 py-20 space-y-2">
        
        <!-- Social media -->
        <div class="flex items-center justify-center space-x-2">
            <a class="w-12 h-12 border-2 rounded-full flex justify-center items-center group transition hover:border-orange-600 hover:rotate-[360deg]" href="" title="Go to Facebook page">
                <i class="fa-brands fa-facebook-f text-2xl text-gray-600 transition group-hover:text-orange-600"></i>
            </a>
            <a class="w-12 h-12 border-2 rounded-full flex justify-center items-center group transition hover:border-orange-600 hover:rotate-[360deg]" href="" title="Go to Instagram page">
                <i class="fa-brands fa-instagram text-2xl text-gray-600 transition group-hover:text-orange-600"></i>
            </a>
            <a class="w-12 h-12 border-2 rounded-full flex justify-center items-center group transition hover:border-orange-600 hover:rotate-[360deg]" href="" title="Go to LinkedIn page">
                <i class="fa-brands fa-linkedin-in text-2xl text-gray-600 transition group-hover:text-orange-600"></i>
            </a>
        </div>

        <div class="text-center pt-8">
            <h1 class="font-bold text-gray-900 text-lg">eToken<span class="text-orange-600">.</span></h1>
        </div>

        <div class="flex justify-center items-center space-x-1">
            <a href="./index.php" class="text-orange-600 font-medium transition hover:text-orange-600" title="Home">Home</a>
            <p class="text-orange-600">/</p>
            <a href="./marketplace.php" class="text-gray-900 font-medium transition hover:text-orange-600" title="Go to marketplace">Marketplace</a>
            <p class="text-orange-600">/</p>
            <a href="./faq.php" class="text-gray-900 font-medium transition hover:text-orange-600" title="Go to FAQ page">FAQ</a>
            <p class="text-orange-600">/</p>
            <a href="./contact.php" class="text-gray-900 font-medium transition hover:text-orange-600" title="Go to contact page">Contact</a>
        </div>

        <div class="text-center">
            <h6 class="text-gray-500 text-sm">@ 2022 Tauras Pajuodis</h6>
        </div>

    </footer>




    <!-- <p id="account">Assd</p>
    
    <div class="flex flex-col space-y-4 mb-4" id="show-properties"></div>

    <input class="border bg-gray-50" type="text" id="new_name">
    <input class="border bg-gray-50" type="text" id="new_price">
    <button class="bg-sky-500 text-white px-4 font-semibold uppercase text-sm py-1" id="new_property">Create property</button> -->

    <!-- Truffle Contract -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@truffle/contract@4.3.5/dist/truffle-contract.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@truffle/contract@4.5.1/index.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@truffle/contract@4.5.1/dist/truffle-contract.js"></script>
    <!-- Web3 -->
    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JS Scripts -->
    <script type="text/javascript" src="js/app.js"></script> 
</body>
</html>