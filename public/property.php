<?php
$activePage = 'property';
include_once './header.php';
?>

<section class="container mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-2 gap-16">
    <div id="singlePropertyDisplay" class="flex flex-col space-y-4">
        <!-- Filled via js -->
    </div>
    
    <div id="exchange" class="flex flex-col">
        <div>
            <p id="showBuy" class="text-sm font-medium text-orange-600 uppercase tracking-wide px-4 py-2 border inline-block rounded-t-lg border-b-0 cursor-pointer">Buy</p>
            <p id="showSell" class="text-sm font-medium text-gray-500 uppercase tracking-wide px-4 py-2 border inline-block rounded-t-lg border-b-0 cursor-pointer">Sell</p>
        </div>
        <div id="buyTokensWindow" data-display="true" class="border rounded-b rounded-r p-4 flex flex-col">
            <div class="flex items-center justify-between">
                <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Input</p>
                <p class="text-xs uppercase text-gray-500 px-2 py-1">Balance: <span id="ethBalance" class="font-semibold"></span></p>
            </div>

            <div class="flex items-center">
                <input type="text" id="buyInput" class="flex-auto border rounded-l w-full focus:outline-none transition focus:border-orange-600 px-2 py-2 text-sm font-medium">
                <p class="px-4 rounded-r font-semibold text-gray-900 bg-gray-100 border border-l-0 h-full flex items-center">ETH</p>
            </div>

            <div class="flex items-center justify-between mt-4">
                <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Output</p>
                <p class="text-xs uppercase  text-gray-500 px-2 py-1">Tokens available: <span class="font-semibold">5800</span></p>
            </div>

            <div class="flex items-center">
                <input type="text" id="buyOutput" disabled class="flex-auto border rounded-l w-full focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium">
                <p id="tokenSymbol" class="px-4 rounded-r font-semibold text-gray-900 bg-gray-100 border border-l-0 h-full flex items-center"></p>
            </div>

            <div class="flex items-center justify-between">
                <p class="text-xs uppercase text-gray-500 px-2 py-1">Exchange rate</p>
                <p class="text-xs uppercase text-gray-500 px-2 py-1"><span id="ethToTokenRate" class="font-semibold"></span> per token</p>
            </div>

            <button class="mt-4 py-2 rounded bg-green-500 text-white font-semibold transition hover:bg-green-600">BUY</button>
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
                <p class="text-xs uppercase text-gray-500 px-2 py-1"><span id="tokenToEthRate" class="font-semibold"></span> per ETH</p>
            </div>

            <button class="mt-4 py-2 rounded bg-red-500 text-white font-semibold transition hover:bg-red-600">SELL</button>
        </div>
    </div>
</section>

<!-- Border between market and footer -->
<div class="border-b"></div>

<?php 
include_once './footer.php';
?>