const PropertyFactory = artifacts.require("PropertyFactory");
const ERC20TokenFactory = artifacts.require("ERC20TokenFactory");
const Exchange = artifacts.require("Exchange");

module.exports = function(deployer) {
  deployer.deploy(PropertyFactory);
  deployer.deploy(ERC20TokenFactory);
  deployer.deploy(Exchange);
};
