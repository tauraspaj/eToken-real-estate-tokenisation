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
            
            <a href="./index.php" class="<?php echo ($activePage == 'index') ? 'text-orange-600' : 'text-gray-900' ?> font-medium transition hover:text-orange-600" title="Home">Home</a>
            <p class="text-orange-600">/</p>
            <a href="./marketplace.php" class="<?php echo ($activePage == 'marketplace') ? 'text-orange-600' : 'text-gray-900' ?> font-medium transition hover:text-orange-600" title="Go to marketplace">Marketplace</a>
            <p class="text-orange-600">/</p>
            <a href="./faq.php" class="<?php echo ($activePage == 'faq') ? 'text-orange-600' : 'text-gray-900' ?> font-medium transition hover:text-orange-600" title="Go to FAQ page">FAQ</a>
            <p class="text-orange-600">/</p>
            <a href="./contact.php" class="<?php echo ($activePage == 'contact') ? 'text-orange-600' : 'text-gray-900' ?> font-medium transition hover:text-orange-600" title="Go to contact page">Contact</a>
        </div>

        <div class="text-center">
            <h6 class="text-gray-500 text-sm">@ 2022 Tauras Pajuodis</h6>
        </div>

    </footer>
    
    <!-- Truffle Contract -->
    <script src="https://cdn.jsdelivr.net/npm/@truffle/contract@4.5.1/dist/truffle-contract.js"></script>
    <!-- Web3 -->
    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JS Scripts -->
    <script type="text/javascript" src="js/app.js"></script> 
</body>
</html>