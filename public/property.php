<?php
$activePage = 'property';
include_once './header.php';
?>

<section class="container mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-2 gap-16 relative">
    <div id="singlePropertyDisplay" class="flex flex-col space-y-4">
        <!-- Filled via js -->
    </div>
    
    <div id="exchange" class="flex flex-col">
        <div class="border rounded p-4 flex justify-center items-center mb-8">
            <p class="text-gray-500 text-xs md:text-sm text-center">Token<br> <span class="font-medium text-gray-900" id="tokenAddress"></span></p>
        </div>
        <div>
            <p id="showBuy" class="text-sm font-medium text-orange-600 uppercase tracking-wide px-4 py-2 border inline-block rounded-t-lg border-b-0 cursor-pointer">Buy</p>
            <p id="showSell" class="text-sm font-medium text-gray-500 uppercase tracking-wide px-4 py-2 border inline-block rounded-t-lg border-b-0 cursor-pointer">Sell</p>
        </div>
        <div id="buyTokensWindow" data-display="true" class="border rounded-b rounded-r p-4 flex flex-col">
            <div class="flex items-center justify-between">
                <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Input</p>
                <p class="text-xs uppercase text-gray-500 px-2 py-1">Balance: <span id="ethBalance" class="font-semibold"></span> ETH</p>
            </div>

            <div class="flex items-center">
                <input type="text" id="buyInput" class="flex-auto border rounded-l w-full focus:outline-none transition focus:border-orange-600 px-2 py-2 text-sm font-medium">
                <p class="px-4 rounded-r font-semibold text-gray-900 bg-gray-100 border border-l-0 h-full flex items-center">ETH</p>
            </div>

            <div class="flex items-center justify-between mt-4">
                <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Output</p>
                <p class="text-xs uppercase  text-gray-500 px-2 py-1">Tokens available: <span id="tokensOnSale" class="font-semibold"></span></p>
            </div>

            <div class="flex items-center">
                <input type="text" id="buyOutput" disabled class="flex-auto border rounded-l w-full focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium">
                <p id="tokenSymbol" class="px-4 rounded-r font-semibold text-gray-900 bg-gray-100 border border-l-0 h-full flex items-center"></p>
            </div>

            <div class="flex items-center justify-between">
                <p class="text-xs uppercase text-gray-500 px-2 py-1">Exchange rate</p>
                <p class="text-xs uppercase text-gray-500 px-2 py-1"><span id="displayRate" class="font-semibold"></span></p>
            </div>

            <button id="buyTokens" class="mt-4 py-2 rounded bg-green-500 text-white font-semibold transition hover:bg-green-600">BUY</button>
        </div>

        <div id="sellTokensWindow" data-display="false" class="border rounded-b rounded-r p-4 flex flex-col hidden">
            <div class="flex items-center justify-between">
                <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Input</p>
                <p class="text-xs uppercase text-gray-500 px-2 py-1">Balance: <span id="tokenBalance" class="font-semibold">98.125152</span></p>
            </div>

            <div class="flex items-center">
                <input type="text" id="sellInput" class="flex-auto border rounded-l w-full focus:outline-none transition focus:border-orange-600 px-2 py-2 text-sm font-medium">
                <p id="tokenSymbol" class="px-4 rounded-r font-semibold text-gray-900 bg-gray-100 border border-l-0 h-full flex items-center"></p>
            </div>

            <div class="flex items-center justify-between mt-4">
                <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Output</p>
            </div>

            <div class="flex items-center">
                <input type="text" id="sellOutput" disabled class="flex-auto border rounded-l w-full focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium">
                <p class="px-4 rounded-r font-semibold text-gray-900 bg-gray-100 border border-l-0 h-full flex items-center">ETH</p>
            </div>

            <div class="flex items-center justify-between">
                <p class="text-xs uppercase text-gray-500 px-2 py-1">Exchange rate</p>
                <p class="text-xs uppercase text-gray-500 px-2 py-1"><span id="displayRate" class="font-semibold"></span></p>
            </div>

            <button id="sellTokens" class="mt-4 py-2 rounded bg-red-500 text-white font-semibold transition hover:bg-red-600">SELL</button>
        </div>

        <div id="displayBalances" class="border rounded flex flex-col mt-8">
            <p class="uppercase text-gray-500 text-xs md:text-sm p-4">Balances</p>
        </div>
    </div>

    <div id="simulateRentPayment" class="fixed rounded-full bg-green-500 px-4 py-2 bottom-6 right-6 transition hover:bg-green-700 cursor-pointer flex justify-center items-center transform hover:scale-110" title="Simulate rent payment">
        <svg class="w-6 h-6 md:w-10 md:h-10 text-gray-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        <p class="text-gray-50 text-sm md:text-lg font-medium">SIMULATE RENT PAYMENT</p>
    </div>
</section>

<!-- Border between market and footer -->
<div class="border-b"></div>

<?php 
include_once './footer.php';
?>