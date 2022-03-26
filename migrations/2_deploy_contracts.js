const PropertyFactory = artifacts.require("PropertyFactory");
const ERC20TokenFactory = artifacts.require("ERC20TokenFactory");

module.exports = function(deployer) {
  deployer.deploy(PropertyFactory);
  deployer.deploy(ERC20TokenFactory);
};
