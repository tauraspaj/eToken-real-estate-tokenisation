App = {
    contracts: {},
    load: async () => {
        // Load app
        await App.loadWeb3();
        await App.loadAccount();
        await App.loadContracts();
        await App.render();
        await App.renderMarketplace();
    },

    loadWeb3: async () => {
        if (typeof web3 !== 'undefined') {
            App.web3Provider = window.ethereum
            web3 = new Web3(window.ethereum)
        } else {
            window.alert("Please connect to Metamask.")
        }
        // Modern dapp browsers...
        if (window.ethereum) {
            window.web3 = new Web3(ethereum)
            try {
                // Request account access if needed
                // await ethereum.enable()
                await eth_requestAccounts()
                // Acccounts now exposed
                web3.eth.sendTransaction({/* ... */})
            } catch (error) {
                // User denied account access...
            }
        }
        // Legacy dapp browsers...
        else if (window.web3) {
            App.web3Provider = window.ethereum
            window.web3 = new Web3(window.ethereum)
            // Acccounts always exposed
            web3.eth.sendTransaction({/* ... */})
        }
        // Non-dapp browsers...
        else {
            console.log('Non-Ethereum browser detected. You should consider trying MetaMask!')
        }
    },

    loadAccount: async () => {
        const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
        if (accounts.length != 0) {
            App.account = accounts[0];

            // Process only start and finish of the address
            var display = App.account.substr(0,4).concat('...'+App.account.substr(-4,4))
            $('#account-display').text(display);
            $('#mob-account-display').text(display);
        }

        // Detect changes in the wallet and reload page
        window.ethereum.on('accountsChanged', function (accounts) {
            window.location.reload();
        })
        window.ethereum.on('chainChanged', function (networkId) {
            window.location.reload();
        })
    },

    loadContracts: async () => {
        const propertyFactory = await $.getJSON('./../build/contracts/PropertyFactory.json');
        App.contracts.PropertyFactory = TruffleContract(propertyFactory);
        App.contracts.PropertyFactory.setProvider(App.web3Provider);
        App.propertyFactory = await App.contracts.PropertyFactory.deployed();

        const erc20 = await $.getJSON('./../build/contracts/ERC20.json');
        App.contracts.ERC20 = TruffleContract(erc20);
        App.contracts.ERC20.setProvider(App.web3Provider);

        // const erc20TokenFactory = await $.getJSON('./../build/contracts/ERC20TokenFactory.json');
        // App.contracts.ERC20TokenFactory = TruffleContract(erc20TokenFactory);
        // App.contracts.ERC20TokenFactory.setProvider(App.web3Provider);
        // App.erc20TokenFactory = await App.contracts.ERC20TokenFactory.deployed();
    },

    render: async () => {
        $('#account').html(App.account);
    },

    renderMarketplace: async () => {
        // Find number of total properties
        var propertyCount = await App.propertyFactory.propertyCount();
        propertyCount = propertyCount.toNumber();

        // const contract = await Test.at(address);

        // Loop through each property and display it
        for (let i = 0; i < propertyCount; i++) {
            const property = await App.propertyFactory.properties(i);
            console.log(property);

            const images = await App.propertyFactory.getImages(i);

            const monthlyRent = property.monthlyRent.toNumber();
            const propertyAddress = property.propertyAddress;
            const value = property.price.toNumber();

            // Get total supply of a token
            const token = await App.contracts.ERC20.at(property.tokenAddress);
            let totalSupply = await token.totalSupply();
            totalSupply = totalSupply.toNumber();
            // Find profit per token and round it to 2 d.p.
            const profitPerToken = Math.round((monthlyRent/totalSupply)*100)/100;

            const nBedrooms = property.nBedrooms.toNumber();
            const nShowers = property.nShowers.toNumber();
            const livingArea = property.livingArea.toNumber();
   
            const owner = await App.propertyFactory.propertyToOwner(i);

            $('#marketplace').prepend(`
                <a href="./property.php?id=`+i+`" class="bg-white rounded-3xl group h-96 border shadow flex flex-col overflow-hidden cursor-pointer" href="" title="">
                    <!-- Image -->
                    <div class="w-full h-3/5 overflow-hidden">
                        <div class="w-full h-full bg-cover bg-center rounded-t-3xl border-b transition group-hover:scale-110" style="background-image: url('`+images[0]+`')">
                        </div>
                    </div>
                    <!-- Info -->
                    <div>
                        <div class="p-4 border-b">
                            <p class="text-gray-900 font-bold text-xl whitespace-nowrap">Rent per token: $`+profitPerToken+`</p>
                            <p class="text-gray-400 text-sm whitespace-nowrap truncate mb-4">`+propertyAddress+`</p>
                            <div class="rounded bg-green-500 text-white inline-block text-sm px-2 py-1 ">Value: <span class="font-medium">$`+value+`</span></div>
                            <div class="rounded bg-green-500 text-white inline-block text-sm px-2 py-1 ">Tokens left: <span class="font-medium">250000</span></div>
                        </div>
                        <!-- Room information -->
                        <div class="grid grid-cols-3">
                            <div class="flex flex-col border-r justify-center items-center p-2">
                                <div class="flex space-x-2 items-center">
                                    <i class="fa-solid fa-bed text-sm text-orange-600"></i>
                                    <p class="font-semibold text-gray-900">`+nBedrooms+`</p>
                                </div>
                                <p class="text-gray-500 text-sm">Bedrooms</p>
                            </div>
                            <div class="flex flex-col border-r justify-center items-center p-2">
                                <div class="flex space-x-2 items-center">
                                    <i class="fa-solid fa-bath text-sm text-orange-600"></i>
                                    <p class="font-semibold text-gray-900">`+nShowers+`</p>
                                </div>
                                <p class="text-gray-500 text-sm">Bathrooms</p>
                            </div>
                            <div class="flex flex-col border-r justify-center items-center p-2">
                                <div class="flex space-x-2 items-center">
                                    <i class="fa-regular fa-folder text-sm text-orange-600"></i>
                                    <p class="font-semibold text-gray-900">`+livingArea+`m<sup>2</sup></p>
                                </div>
                                <p class="text-gray-500 text-sm">Living area</p>
                            </div>
                        </div>
                    </div>
                </a>
            `)
        }
    },

    createProperty: async (_propertyAddress, _postcode, _nBedrooms, _nShowers, _livingArea, _images, _price, _monthlyRent, _nTokens, _tokenSymbol) => {
        await App.propertyFactory.createProperty(_propertyAddress, _postcode, _nBedrooms, _nShowers, _livingArea, _images, _price, _monthlyRent, _nTokens, _tokenSymbol, {from: App.account});
        window.location.reload();
    },

}

$(() => {
    // Load functions
    $(window).on('load', () => App.load() )
    // Mobile menu
    $('#burger-menu, #mobile-curtain, #close-mobile-overlay').on('click', () => $('#mobile-overlay').slideToggle())
    // Display wallet address
    $('#account-display, #mob-account-display').on('click', () => App.loadAccount())
    // Toggle tokenisation modal
    $('#open-tokenisation-modal, #close-tokenisation-modal').on('click', () => $('#tokenisation-modal').toggleClass('hidden'))

    // Create new property
    $('#submit-tokenisation').on('click', () => {
        const _nTokens = $('[name="_nTokens"]').val();
        const _tokenSymbol = $('[name="_tokenSymbol"]').val();
        const _price = $('[name="_price"]').val();
        const _monthlyRent = $('[name="_monthlyRent"]').val();
        const _propertyAddress = $('[name="_propertyAddress"]').val();
        const _postcode = $('[name="_postcode"]').val();
        const _nBedrooms = $('[name="_nBedrooms"]').val();
        const _nShowers = $('[name="_nShowers"]').val();
        const _livingArea = $('[name="_livingArea"]').val();
        const _image1 = $('[name="_image1"]').val();
        const _image2 = $('[name="_image2"]').val();
        const _image3 = $('[name="_image3"]').val();
        const _image4 = $('[name="_image4"]').val();
        var _images = [_image1, _image2, _image3, _image4];
        
        App.createProperty(_propertyAddress, _postcode, _nBedrooms, _nShowers, _livingArea, _images, _price, _monthlyRent, _nTokens, _tokenSymbol)
    })

})
