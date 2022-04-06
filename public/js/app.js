App = {
    contracts: {},
    load: async () => {
        // Load app
        await App.loadWeb3();
        await App.loadAccount();
        await App.loadContracts();
        await App.render();
        await App.renderProperties();
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

        // const erc20TokenFactory = await $.getJSON('./../build/contracts/ERC20TokenFactory.json');
        // App.contracts.ERC20TokenFactory = TruffleContract(erc20TokenFactory);
        // App.contracts.ERC20TokenFactory.setProvider(App.web3Provider);
        // App.erc20TokenFactory = await App.contracts.ERC20TokenFactory.deployed();
    },

    render: async () => {
        $('#account').html(App.account);
    },

    renderProperties: async () => {
        var propertyCount = await App.propertyFactory.propertyCount();
        propertyCount = propertyCount.toNumber();

        for (let i = 0; i < propertyCount; i++) {
            const property = await App.propertyFactory.properties(i);
            console.log(property);
            const name = property.name;
            const value = property.price.toNumber();
            const tokenAddress = property.tokenAddress;

            const owner = await App.propertyFactory.propertyToOwner(i);

            $('#show-properties').append(`
                <div class="bg-red-50">
                    <p class="font-bold">Property Name: <span class="font-normal">`+name+`</span>, Value: <span class="font-normal">`+value+`</span></p>
                    <p class="font-bold">Owner: <span class="font-normal">`+owner+`</span></p>
                    <p class="font-bold">Token: <span class="font-normal">`+tokenAddress+`</span></p>
                </div>
            `)
        }
    },

    createProperty: async (_propertyAddress, _postcode, _nBedrooms, _nShowers, _images, _price, _monthlyRent, _nTokens, _tokenSymbol) => {
        await App.propertyFactory.createProperty(_propertyAddress, _postcode, _nBedrooms, _nShowers, _images, _price, _monthlyRent, _nTokens, _tokenSymbol, {from: App.account});
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
        const _image1 = $('[name="_image1"]').val();
        const _image2 = $('[name="_image2"]').val();
        const _image3 = $('[name="_image3"]').val();
        const _image4 = $('[name="_image4"]').val();
        var _images = [_image1, _image2, _image3, _image4];
        
        App.createProperty(_propertyAddress, _postcode, _nBedrooms, _nShowers, _images, _price, _monthlyRent, _nTokens, _tokenSymbol)
    })

})
