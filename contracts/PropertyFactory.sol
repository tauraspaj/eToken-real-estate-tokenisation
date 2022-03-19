// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import "./Ownable.sol";
import "./SafeMath.sol";
import "./Context.sol";

contract PropertyFactory is Context, Ownable {
    using SafeMath for uint256;
    using SafeMath32 for uint32;
    using SafeMath16 for uint16;

    uint public propertyCount = 0;

    struct Property {
        string name;
        uint price;
    }

    Property[] public properties;

    mapping (uint => address) public propertyToOwner;

    constructor() {
        createProperty("New property", 156000);
    }

    function _createProperty(string memory _name, uint _price) internal {
        properties.push( Property(_name, _price) );
        uint id = properties.length - 1;
        propertyToOwner[id] = _msgSender();
        propertyCount++;
    }

    function createProperty(string memory _name, uint _price) public {
        _createProperty(_name, _price);
    }
}
