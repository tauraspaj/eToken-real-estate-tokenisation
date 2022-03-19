App = {
    load: async () => {
        // Load app
        await App.loadWeb3();
        await App.loadAccount();
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
    }
}

$(() => {
    $(window).on('load', () => {
        App.load()
    })
})
