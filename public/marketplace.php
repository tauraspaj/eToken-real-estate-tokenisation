<?php
$activePage = 'marketplace';
include_once './header.php';
?>

<!-- Floating button to add a new property -->
<div id="open-tokenisation-modal" class="absolute w-20 h-20 rounded-full bg-green-500 bottom-6 right-6 transition hover:bg-green-700 cursor-pointer flex justify-center items-center transform hover:scale-110" title="Tokenise a property">
    <svg class="w-12 h-12 text-gray-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
</div>

<!-- Add new property overlay -->
<div id="tokenisation-modal" class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center p-4 text-gray-900 hidden">
    <div class="w-[720px] bg-gray-50 shadow flex flex-col p-4 rounded-lg">
        <h1 class="font-bold border-b uppercase text-sm text-orange-600">Tokenisation details</h1>
        <form>
            <div class="grid grid-cols-2 gap-4 pt-2">
                <div class="">
                    <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Number of tokens<span class="text-red-500">*</span></p>
                    <input type="text" name="_nTokens" required spellcheck="false" class="border rounded w-full max-w-sm focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium" placeholder="Enter number of tokens">
                </div>

                <div class="">
                    <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Token Symbol<span class="text-red-500">*</span></p>
                    <input type="text" name="_tokenSymbol" required spellcheck="false" class="border rounded w-full max-w-sm focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium" placeholder="Enter token symbol">
                </div>

                <div class="">
                    <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Price of Property<span class="text-red-500">*</span></p>
                    <input type="text" name="_price" required spellcheck="false" class="border rounded w-full max-w-sm focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium" placeholder="Enter property price">
                </div>

                <div class="">
                    <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Monthly rent<span class="text-red-500">*</span></p>
                    <input type="text" name="_monthlyRent" required spellcheck="false" class="border rounded w-full max-w-sm focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium" placeholder="Enter how much rent is paid">
                </div>
            </div>

            <h1 class="font-bold border-b uppercase text-sm text-orange-600 mt-8">Property details</h1>
            <div class="grid grid-cols-2 gap-4 pt-2">
                <div class="">
                    <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Address<span class="text-red-500">*</span></p>
                    <input type="text" name="_propertyAddress" required spellcheck="false" class="border rounded w-full max-w-sm focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium" placeholder="Enter property address">
                </div>

                <div class="">
                    <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Post Code<span class="text-red-500">*</span></p>
                    <input type="text" name="_postcode" required spellcheck="false" class="border rounded w-full max-w-sm focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium" placeholder="Enter property post code">
                </div>

                <div class="">
                    <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Number of bedrooms<span class="text-red-500">*</span></p>
                    <input type="text" name="_nBedrooms" required spellcheck="false" class="border rounded w-full max-w-sm focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium" placeholder="Enter number of bedrooms">
                </div>

                <div class="">
                    <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Number of showers<span class="text-red-500">*</span></p>
                    <input type="text" name="_nShowers" required spellcheck="false" class="border rounded w-full max-w-sm focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium" placeholder="Enter number of showers">
                </div>

                <div class="">
                    <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Image 1<span class="text-red-500">*</span></p>
                    <input type="text" name="_image1" required spellcheck="false" class="border rounded w-full max-w-sm focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium" placeholder="Enter URL of Image 1">
                </div>

                <div class="">
                    <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Image 2<span class="text-red-500">*</span></p>
                    <input type="text" name="_image2" required spellcheck="false" class="border rounded w-full max-w-sm focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium" placeholder="Enter URL of Image 2">
                </div>

                <div class="">
                    <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Image 3<span class="text-red-500">*</span></p>
                    <input type="text" name="_image3" required spellcheck="false" class="border rounded w-full max-w-sm focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium" placeholder="Enter URL of Image 3">
                </div>

                <div class="">
                    <p class="text-xs uppercase font-semibold text-gray-500 px-2 py-1">Image 4<span class="text-red-500">*</span></p>
                    <input type="text" name="_image4" required spellcheck="false" class="border rounded w-full max-w-sm focus:outline-none transition focus:ring-1 focus:ring-orange-600 px-2 py-2 text-sm font-medium" placeholder="Enter URL of Image 4">
                </div>

                <div class="col-span-2 flex justify-end items-center space-x-2 mt-4">
                    <button id="close-tokenisation-modal" type="button" class="text-gray-50 rounded bg-red-500 px-4 py-2 transition hover:bg-red-700" title="Cancel">Cancel</button>
                    <button id="submit-tokenisation" type="button" class="text-gray-50 rounded bg-green-500 px-4 py-2 transition hover:bg-green-700" title="Tokenise this property">Submit</button>
                </div>

            </div>
        </form>
        <!-- End of form -->
    </div>
    <!-- End of form design-->
</div>
<!-- End of black curtain -->

<?php 
include_once './footer.php';
?>