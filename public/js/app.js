App = {
    contracts: {},
    load: async () => {
        // Load app
        await App.loadWeb3();
        await App.loadAccount();
        await App.loadContracts();
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

        const exchange = await $.getJSON('./../build/contracts/Exchange.json');
        App.contracts.Exchange = TruffleContract(exchange);
        App.contracts.Exchange.setProvider(App.web3Provider);
        App.exchange = await App.contracts.Exchange.deployed();
    },

    renderMarketplace: async () => {
        // Find number of total properties
        var propertyCount = await App.propertyFactory.propertyCount();
        propertyCount = propertyCount.toNumber();

        // Loop through each property and display it
        for (let i = 0; i < propertyCount; i++) {
            const property = await App.propertyFactory.properties(i);

            const images = await App.propertyFactory.getImages(i);

            const monthlyRent = property.monthlyRent.toNumber();
            const propertyAddress = property.propertyAddress;
            const value = property.price.toNumber();

            // Get total supply of a token
            const token = await App.contracts.ERC20.at(property.tokenAddress);
            let totalSupply = await token.totalSupply();
            totalSupply = parseFloat(web3.utils.fromWei(totalSupply.toString(), 'ether'))

            let tokensOnSale = await token.balanceOf(App.exchange.address);
            tokensOnSale = parseFloat(web3.utils.fromWei(tokensOnSale.toString(), 'ether'))

            // Find profit per token and round it to 2 d.p.
            const profitPerToken = (monthlyRent/totalSupply).toFixed(5)

            const nBedrooms = property.nBedrooms.toNumber();
            const nShowers = property.nShowers.toNumber();
   
            const owner = await App.propertyFactory.propertyToOwner(i);

            $('#marketplace').prepend(`
                <a href="./property.php?id=`+i+`" class="bg-white rounded-3xl group h-96 border shadow flex flex-col overflow-hidden cursor-pointer" href="" title="">
                    <!-- Image -->
                    <div class="w-full h-3/5 overflow-hidden rounded-t-3xl">
                        <div class="w-full h-full bg-cover bg-center border-b transition group-hover:scale-110" style="background-image: url('`+images[0]+`')">
                        </div>
                    </div>
                    <!-- Info -->
                    <div>
                        <div class="p-4 border-b">
                            <p class="text-gray-900 font-bold text-xl whitespace-nowrap">Rent per token: $`+profitPerToken+`</p>
                            <p class="text-gray-400 text-sm whitespace-nowrap truncate mb-4">`+propertyAddress+`</p>
                            <div class="rounded bg-green-500 text-white inline-block text-sm px-2 py-1 ">Value: <span class="font-medium">$`+value.toLocaleString('en-US')+`</span></div>
                            <div class="rounded bg-green-500 text-white inline-block text-sm px-2 py-1 ">Token on sale: <span class="font-medium">`+tokensOnSale.toLocaleString('en-US')+`</span></div>
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
                                    <i class="fa-brands fa-bitcoin text-orange-600"></i>
                                    <p class="font-semibold text-gray-900">$`+monthlyRent.toLocaleString('en-US')+`</p>
                                </div>
                                <p class="text-gray-500 text-sm">Monthly rent</p>
                            </div>
                        </div>
                    </div>
                </a>
            `)
        }
    },

    createProperty: async (_propertyAddress, _postcode, _nBedrooms, _nShowers, _images, _price, _monthlyRent, _nTokens, _tokenSymbol) => {
        let _tokensInWei = web3.utils.toWei(_nTokens.toString(), 'ether')

        await App.propertyFactory.createProperty(_propertyAddress, _postcode, _nBedrooms, _nShowers, _images, _price, _monthlyRent, _tokensInWei, _tokenSymbol, {from: App.account});
        window.location.reload();
    },

    renderProfile: async () => {
        // Find number of total properties
        var propertyCount = await App.propertyFactory.propertyCount();
        propertyCount = propertyCount.toNumber();
        
        // Loop through each property and find if the user is owner. Check if it owns any tokens of that property
        for (let i = 0; i < propertyCount; i++) {
            let thisOwner = await App.propertyFactory.propertyToOwner(i);
            const property = await App.propertyFactory.properties(i);

            const monthlyRent = property.monthlyRent.toNumber();
            const propertyAddress = property.propertyAddress;
            const value = property.price.toNumber();

            // Get total supply of a token
            const token = await App.contracts.ERC20.at(property.tokenAddress);
            let totalSupply = await token.totalSupply();
            totalSupply = parseFloat(web3.utils.fromWei(totalSupply.toString(), 'ether'))
            
            // Find profit per token and round it to 2 d.p.
            const profitPerToken = monthlyRent/totalSupply

            const nBedrooms = property.nBedrooms.toNumber();
            const nShowers = property.nShowers.toNumber();

            // Add to table if the user is owner
            if (thisOwner.toUpperCase() == App.account.toUpperCase()) {
                $('#owned-properties').append(`
                    <tr class="border-t">
                        <td class="py-2 text-center whitespace-nowrap px-2">`+propertyAddress+`</td>
                        <td class="py-2 text-center whitespace-nowrap px-2">$`+monthlyRent.toLocaleString('en-US')+`</td>
                        <td class="py-2 text-center whitespace-nowrap px-2">`+totalSupply.toLocaleString('en-US')+`</td>
                        <td class="py-2 text-center whitespace-nowrap px-2">$`+value.toLocaleString('en-US')+`</td>
                        <td class="py-2 text-center whitespace-nowrap px-2"><a href="./property.php?id=`+i+`" class="transition hover:text-orange-600">View</a></td>
                    </tr>
                `)
            }

            let balance = await token.balanceOf(App.account)
            balance = parseFloat(web3.utils.fromWei(balance.toString(), 'ether'))

            let valueOfTokens = (value/totalSupply)*balance;
            
            if (balance > 0) {
                $('#owned-tokens').append(`
                    <tr class="border-t">
                        <td class="py-2 text-center whitespace-nowrap px-2">`+propertyAddress+`</td>
                        <td class="py-2 text-center whitespace-nowrap px-2">`+balance.toLocaleString('en-US')+`</td>
                        <td class="py-2 text-center whitespace-nowrap px-2">$`+valueOfTokens.toLocaleString('en-US')+`</td>
                        <td class="py-2 text-center whitespace-nowrap px-2">$`+(profitPerToken*balance).toLocaleString('en-US')+`</td>
                        <td class="py-2 text-center whitespace-nowrap px-2"><a href="./property.php?id=`+i+`" class="transition hover:text-orange-600">View</a></td>
                    </tr>
                `)
            }
        }
        
    },

    renderProperty: async (propertyId) => {
        const property = await App.propertyFactory.properties(propertyId);
        const images = await App.propertyFactory.getImages(propertyId);
        const monthlyRent = property.monthlyRent.toNumber();
        const propertyAddress = property.propertyAddress;
        const postcode = property.postcode;
        const price = property.price.toNumber();
        let ethRate = await getEthRate()
        let priceInEth = price/ethRate;

        // Get total supply of a token
        const token = await App.contracts.ERC20.at(property.tokenAddress);
        
        // Render property owners and their balances
        App.renderPropertyOwners(token);

        let totalSupply = await token.totalSupply();
        totalSupply = parseFloat(web3.utils.fromWei(totalSupply.toString(), 'ether'))

        // Find profit per token and round it to 2 d.p.
        const profitPerToken = monthlyRent/totalSupply
        const singleTokenPrice = price/totalSupply
        const nBedrooms = property.nBedrooms.toNumber();
        const nShowers = property.nShowers.toNumber();

        $('#tokenAddress').html(property.tokenAddress)

        $('#singlePropertyDisplay').html(`
            <div>
                <!-- Image -->
                <div class="w-full h-96 bg-cover bg-center shadow rounded-lg" style="background-image: url('`+images[0]+`')">
                </div>
                <div class="flex flex-col lg:flex-row shadow -mt-16 mx-6">
                    <div class="bg-orange-700 p-8 rounded-l">
                        <p class="text-4xl font-bold text-gray-50">$`+price.toLocaleString('en-US')+`</p>
                        <p class="text-sm text-gray-50">= `+priceInEth.toFixed(5).toLocaleString('en-US')+` ETH</p>
                        <p class="text-sm text-gray-300">`+propertyAddress+`</p>
                        <p class="text-sm text-gray-300 uppercase">`+postcode+`</p>
                    </div>
                    <div class="flex-auto flex flex-row lg:flex-col bg-gray-900 bg-opacity-95 rounded-r">
                        <!-- Top row -->
                        <div class="flex-1 flex flex-col lg:flex-row">
                            <div class="flex-1 flex justify-center items-center flex-col space-y-1 border-b border-r border-gray-700 p-2">
                                <i class="fa-solid fa-bed text-sm text-center text-gray-50"></i>
                                <p class="text-gray-50 uppercase text-sm text-center">`+nBedrooms+` Bedrooms</p>
                            </div>
                            <div class="flex-1 flex justify-center items-center flex-col space-y-1 border-b border-r border-gray-700 p-2">
                                <i class="fa-solid fa-bath text-sm text-center text-gray-50"></i>
                                <p class="text-gray-50 uppercase text-sm text-center">`+nShowers+` Bathrooms</p>
                            </div>
                            <div class="flex-1 flex justify-center items-center flex-col space-y-1 border-b border-r lg:border-r-0 border-gray-700 p-2">
                                <i class="fa-solid fa-dollar-sign text-sm text-center text-gray-50"></i>
                                <p class="text-gray-50 uppercase text-sm text-center">$`+monthlyRent+` Rent</p>
                            </div>
                        </div>
                        <!-- Bottom Row -->
                        <div class="flex-1 flex flex-col lg:flex-row">
                            <div class="flex-1 flex justify-center items-center flex-col space-y-1 border-b lg:border-b-0 border-gray-700 lg:border-r p-2">
                                <p class="text-gray-50 uppercase text-sm text-center">`+totalSupply.toLocaleString('en-US')+`</p>
                                <p class="text-gray-50 uppercase text-sm text-center">Token supply</p>
                            </div>
                            <div class="flex-1 flex justify-center items-center flex-col space-y-1 border-b lg:border-b-0 border-gray-700 lg:border-r p-2">
                                <p class="text-gray-50 uppercase text-sm text-center">$`+singleTokenPrice.toFixed(5)+`</p>
                                <p class="text-gray-50 uppercase text-sm text-center">Single Token Price</p>
                            </div>
                            <div class="flex-1 flex justify-center items-center flex-col space-y-1 p-2">
                                <p class="text-gray-50 uppercase text-sm text-center">$`+profitPerToken.toFixed(5)+`</p>
                                <p class="text-gray-50 uppercase text-sm text-center">Rent Per Token</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        `)

        App.renderBalances(property, token);
        App.renderExchange(token, property.tokenAddress, property);

        // Hide 'Simulate rent' button if not the owner
        const owner = await App.propertyFactory.propertyToOwner(propertyId)
        if (owner.toUpperCase() != App.account.toUpperCase()) {
            $('#simulateRentPayment').hide();
        }
    },

    renderBalances: async (property, token) => {
        let ethBalance = await web3.eth.getBalance(App.account);
        ethBalance = parseFloat(web3.utils.fromWei(ethBalance, "ether"))
        $('#ethBalance').html(ethBalance.toLocaleString('en-US'))

        const tokenSymbol = await token.symbol();
        $('[id="tokenSymbol"]').html(tokenSymbol)

        let tokensOnSale = await token.balanceOf(App.exchange.address)
        $('#tokensOnSale').html(parseFloat(web3.utils.fromWei(tokensOnSale.toString(), "ether")).toLocaleString('en-US'))

        token.balanceOf(App.account, function(err, result) {
            if (err) {
                console.log('Error getting token balance');
            } else {
                const tokenBalance = web3.utils.fromWei(result.toString(), "ether");
                $('#tokenBalance').html(parseFloat(tokenBalance).toLocaleString('en-US'))
            }
        })

        let totalSupply = await token.totalSupply();
        totalSupply = parseFloat(web3.utils.fromWei(totalSupply.toString(), 'ether'))

        let ethRate = await getEthRate();
        let priceInEth = property.price/ethRate;
        // Calculate conversion rate for this property
        let rate = calculateRate(totalSupply, priceInEth)

        $('[id="displayRate"]').html('1 ETH = ' + rate.toLocaleString('en-US') + ' ' + tokenSymbol)
        
        $('#buyInput').on('input', function() {
            let output = parseFloat($(this).val())*rate;
            if (output == 0 || $(this).val() == "" || isNaN(output)){
                $('#buyOutput').val(0)
            } else {
                $('#buyOutput').val(output.toFixed(5))
            }
        })

        $('#sellInput').on('input', function() {
            let output = parseFloat($(this).val())/rate;
            if (output == 0 || $(this).val() == "" || isNaN(output)){
                $('#sellOutput').val(0)
            } else {
                $('#sellOutput').val(output.toFixed(5))
            }
        })
        
    },

    renderExchange: async (token, tokenAddress, property) => {
        console.log("Exchange address: "+App.exchange.address);
        $('#sellTokens').on('click', async () => {
            // Sell input is the number of tokens to sell
            let sellInput = $('#sellInput').val();
            // Sell output is amount of ether to receive
            let sellOutput = $('#sellOutput').val();
            // Approve
            await token.approve(App.exchange.address, web3.utils.toWei(sellInput.toString(), "ether"), {from: App.account});

            // Execute sell
            const result = await App.exchange.sellTokens(tokenAddress, web3.utils.toWei(sellInput.toString(), "ether"), web3.utils.toWei(sellOutput.toString(), "ether"), {from: App.account});
            
            App.renderBalances(property, token);
            $('#buyInput, #buyOutput, #sellInput, #sellOutput').val("");
            // alert("You have successfully sold " + sellInput + " tokens!")
        })

        $('#buyTokens').on('click', async () => {
            let buyInput = $('#buyInput').val(); // How much ETH is paid
            let buyOutput = $('#buyOutput').val(); // How many tokens should be received

            // Execute buy
            const result = await App.exchange.buyTokens(tokenAddress, web3.utils.toWei(buyOutput.toString(), "ether"), {from: App.account, value: web3.utils.toWei(buyInput.toString(), "ether")})

            App.renderBalances(property, token);
            $('#buyInput, #buyOutput, #sellInput, #sellOutput').val("");
            // alert("You have successfully bought " + buyAmount + " tokens!")
        })
    },

    renderPropertyOwners: async (token) => {
        // let test = await token.returnOwner(0);
        let test = await token.ownersCount;

        token.ownersCount(async function(err, res) {
            let ownersCount = parseInt(res);
            for(let i = 0; i < ownersCount; i++) {
                let acc = await token.returnOwner(i);
                let balance = await token.balanceOf(acc);
                $('#displayBalances').append(`
                    <div class="border-t p-4">
                        <p class="text-gray-500 text-xs md:text-sm">`+acc+`</p>
                        <p class="text-gray-500 text-xs md:text-sm"> Balance: <span class="font-medium">`+parseFloat(web3.utils.fromWei(balance.toString(), "ether")).toLocaleString('en-US')+`</span></p>
                    </div>
                `)
            }
        })
    }

}

$(() => {
    // Load functions
    $(window).on('load', async () => {
        await App.load()
        // Check if the page loaded is a property page
        const url = window.location.href.split("/").pop();

        // Render marketplace
        if (url.includes("marketplace.php")) {
            App.renderMarketplace();
        }

        // Render profile
        if (url.includes("profile.php")) {
            App.renderProfile();
        }

        // Load single property page
        if (url.includes("property.php?id=")) {
            const propertyId = url.split("=").pop();
            App.renderProperty(propertyId);
        }
    })
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

    $('#showBuy').on('click', () => {
        $('#buyInput, #sellInput, #buyOutput, #sellOutput').val("")
        if ($('#buyTokensWindow').attr('data-display') != true) {
            $('#buyTokensWindow').removeClass('hidden')
            $('#sellTokensWindow').addClass('hidden')
            $('#buyTokensWindow').attr('display', true)
            $('#showBuy').removeClass('text-gray-500')
            $('#showBuy').addClass('text-orange-600')
            $('#showSell').removeClass('text-orange-600')
            $('#showSell').addClass('text-gray-500')
        }
    })

    $('#showSell').on('click', () => {
        if ($('#sellTokensWindow').attr('data-display') != true) {
            $('#sellTokensWindow').removeClass('hidden')
            $('#buyTokensWindow').addClass('hidden')
            $('#sellTokensWindow').attr('display', true)
            $('#showSell').removeClass('text-gray-500')
            $('#showSell').addClass('text-orange-600')
            $('#showBuy').removeClass('text-orange-600')
            $('#showBuy').addClass('text-gray-500')
        }
    })

})

let calculateRate = (totalSupply, propertyValue) => {
    return totalSupply/propertyValue;
}

let getEthRate = () => {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: 'https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=USD',
            type: 'GET',
            success: function (data) {
                resolve(data.USD)
            }
        })
    })
}