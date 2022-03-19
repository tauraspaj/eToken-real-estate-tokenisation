App = {
    contracts: {},
    load: async () => {
        // Load app
        await App.loadWeb3();
        await App.loadAccount();
        await App.loadContract();
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
                await ethereum.enable()
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
        // App.account = web3.currentProvider.selectedAddress;
        web3.eth.getAccounts().then(function( adr ) {
            App.account = adr[0];
        })
    },

    loadContract: async () => {
        const propertyFactory = await $.getJSON('./../build/contracts/PropertyFactory.json');
        App.contracts.PropertyFactory = TruffleContract(propertyFactory);
        App.contracts.PropertyFactory.setProvider(App.web3Provider);
        App.propertyFactory = await App.contracts.PropertyFactory.deployed();
    },

    render: async () => {
        $('#account').html(App.account);
    },

    renderProperties: async () => {
        var propertyCount = await App.propertyFactory.propertyCount();
        propertyCount = propertyCount.toNumber();

        for (let i = 0; i < propertyCount; i++) {
            const property = await App.propertyFactory.properties(i);
            const name = property.name;
            const value = property.price.toNumber();

            const owner = await App.propertyFactory.propertyToOwner(i);

            $('#show-properties').append(`
                <p>`+name+`: `+value+` and owner: `+owner+`</p>
            `)
        }
    }
}

$(() => {
    $(window).on('load', () => {
        App.load()
    })
})
