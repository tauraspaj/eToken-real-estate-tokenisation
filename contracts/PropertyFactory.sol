// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

// We need to take an ERC 20 token contract
// We need to have a contract that will store a property and erc20. 

import "./Ownable.sol";
import "./SafeMath.sol";
import "./Context.sol";
import "./ERC20TokenFactory.sol";

contract PropertyFactory is Context, Ownable {
    using SafeMath for uint256;
    using SafeMath32 for uint32;
    using SafeMath16 for uint16;

    uint public propertyCount = 0;

    struct Property {
        string name;
        uint price;
        address tokenAddress;
    }

    ERC20TokenFactory tokenFactory = new ERC20TokenFactory();

    Property[] public properties;
    mapping (uint => address) public propertyToOwner;
    event PropertyCreated(
        uint id, 
        string name,
        uint price,
        address tokenAddress
    );

    constructor() {
        // createProperty("Initial property", 156000);
    }

    function _createProperty(string memory _name, uint _price) internal {
        address tokenAddress = tokenFactory.deployNewERC20Token("Name", "SMB", 10000);
        properties.push( Property(_name, _price, tokenAddress) );
        uint id = properties.length - 1;
        propertyToOwner[id] = _msgSender();
        emit PropertyCreated(id, _name, _price, tokenAddress);
        propertyCount++;
    }

    function createProperty(string memory _name, uint _price) public {
        _createProperty(_name, _price);
    }
}
