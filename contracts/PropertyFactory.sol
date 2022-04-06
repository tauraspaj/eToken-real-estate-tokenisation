// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

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
        string propertyAddress;
        string postcode;
        uint16 nBedrooms;
        uint16 nShowers;
        string[] images;
        uint price;
        uint monthlyRent;
        address tokenAddress;
    }

    ERC20TokenFactory tokenFactory = new ERC20TokenFactory();

    Property[] public properties;
    mapping (uint => address) public propertyToOwner;
    event PropertyCreated(
        uint id, 
        address tokenAddress
    );

    constructor() {
    }

    function _createProperty(string memory _propertyAddress, string memory _postcode, uint16 _nBedrooms, uint16 _nShowers, string[] memory _images, uint _price, uint _monthlyRent, uint _nTokens, string memory _tokenSymbol) internal {
        // Generate ERC20 token on this property
        address tokenAddress = tokenFactory.deployNewERC20Token(_propertyAddress, _tokenSymbol, _nTokens);

        // Push property into the array
        properties.push( Property(_propertyAddress, _postcode, _nBedrooms, _nShowers, _images, _price, _monthlyRent, tokenAddress) );
        uint id = properties.length - 1;

        // Assign property ownerhip
        propertyToOwner[id] = _msgSender();

        // Emit event
        emit PropertyCreated(id, tokenAddress);
        propertyCount++;
    }

    function createProperty(string memory _propertyAddress, string memory _postcode, uint16 _nBedrooms, uint16 _nShowers, string[] memory _images, uint _price, uint _monthlyRent, uint _nTokens, string memory _tokenSymbol) public {
        _createProperty(_propertyAddress, _postcode, _nBedrooms, _nShowers, _images, _price, _monthlyRent, _nTokens, _tokenSymbol);
    }
}
