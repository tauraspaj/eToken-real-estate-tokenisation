<?php
$activePage = 'profile';
include_once './header.php';
?>

<!-- Properties owned -->
<section class="container mx-auto px-4 pt-16 pb-8 flex flex-col">
    <div>
        <p class="text-sm font-medium text-orange-600 uppercase tracking-wide px-4 py-2 border inline-block rounded-t-lg border-b-0">Owned properties</p>
    </div>
    <div class="border rounded-b rounded-r overflow-x-auto min-w-full">
        <table class="w-full">
            <thead>
                <tr class="uppercase text-sm">
                    <th class="py-4 px-2 whitespace-nowrap">Address</th>
                    <th class="py-4 px-2 whitespace-nowrap">Monthly Rent</th>
                    <th class="py-4 px-2 whitespace-nowrap">Tokens Total Supply</th>
                    <th class="py-4 px-2 whitespace-nowrap">Value</th>
                    <th class="py-4 px-2 whitespace-nowrap">View</th>
                </tr>
            </thead>
            <tbody id="owned-properties">
                <!-- This is filled via js -->
            </tbody>
        </table>
    </div>
</section>

<!-- Tokens owned -->
<section class="container mx-auto px-4 pt-8 pb-16 flex flex-col">
    <div>
        <p class="text-sm font-medium text-orange-600 uppercase tracking-wide px-4 py-2 border inline-block rounded-t-lg border-b-0">Owned tokens</p>
    </div>
    <div class="border rounded-b rounded-r overflow-x-auto overflow-y-hidden min-w-full">
        <table class="w-full">
            <thead>
                <tr class="uppercase text-sm">
                    <th class="py-4 px-2 whitespace-nowrap">Address</th>
                    <th class="py-4 px-2 whitespace-nowrap">Token Balance</th>
                    <th class="py-4 px-2 whitespace-nowrap">Token Value</th>
                    <th class="py-4 px-2 whitespace-nowrap">Monthly Income</th>
                    <th class="py-4 px-2 whitespace-nowrap">View</th>
                </tr>
            </thead>
            <tbody id="owned-tokens">
                <tr class="border-t">
                    <!-- This is filled via js -->
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Border between profile and footer -->
<div class="border-b"></div>

<?php 
include_once './footer.php';
?>