const PropertyFactory = artifacts.require('PropertyFactory');
const ERC20 = artifacts.require('ERC20');

require('chai')

contract('PropertyFactory', ([deployer]) => {
    let pf;

    before(async () => {
        pf = await PropertyFactory.deployed();
    })

    describe('Property Factory deployment', async() => {
        it('Contract constructor executed by deploying a single property', async() => {
            const propertyCount = await pf.propertyCount();
            assert.equal(propertyCount.toNumber(), 1);
        })
    })

    describe('createProperty()', async() => {
        let property;

        before(async () => {
            await pf.createProperty("32 Madeup Road, UK", "MD2 RD8", 51, 4, ["https://i.gyazo.com/74ae883a4cae6657d9d52c26a315d46d.png", "https://i.gyazo.com/8fbb7e2bc4531633db182e9a8fe5a635.png", "https://i.gyazo.com/74ae883a4cae6657d9d52c26a315d46d.png", "https://i.gyazo.com/74ae883a4cae6657d9d52c26a315d46d.png"], 560000, 3000, web3.utils.toWei('1000000', 'ether'), "TKN");
            property = await pf.properties(1);
        })
        
        it('PropertyCount incremented by 1', async() => {
            const propertyCount2 = await pf.propertyCount();
            assert.equal(propertyCount2.toNumber(), 2);
        })

        it('Property added to the properties array correctly', async() => {
            assert.equal(property.propertyAddress, '32 Madeup Road, UK')
            assert.equal(property.postcode, 'MD2 RD8')
            assert.equal(property.nBedrooms.toNumber(), 51)
            assert.equal(property.nShowers.toNumber(), 4)
            assert.equal(property.price.toNumber(), 560000)
            assert.equal(property.monthlyRent.toNumber(), 3000)
        })
    })

    describe('ERC20 token deployment', async() => {
        let token;

        before(async () => {
            const property = await pf.properties(1);
            const tokenAddress = property.tokenAddress;
            token = await ERC20.at(tokenAddress)
        })

        it('Token has correct symbol', async() => {
            let symbol = await token.symbol();
            assert.equal(symbol, 'TKN')
        })
        it('Token has correct total supply', async() => {
            let totalSupply = await token.totalSupply();
            assert.equal(totalSupply, web3.utils.toWei('1000000', 'ether'))
        })
        it('All tokens accredited to the initial owner', async() => {
            let balance = await token.balanceOf(deployer)
            assert.equal(balance, web3.utils.toWei('1000000', 'ether'))
        })
    })
})