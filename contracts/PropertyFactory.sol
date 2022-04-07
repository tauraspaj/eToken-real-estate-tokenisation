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
        uint16 livingArea;
        string[4] images;
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
        createProperty("32 Madeup Road, UK", "MD2 RD8", 51, 4, 3200, ["https://i.gyazo.com/74ae883a4cae6657d9d52c26a315d46d.png", "https://i.gyazo.com/8fbb7e2bc4531633db182e9a8fe5a635.png", "https://i.gyazo.com/74ae883a4cae6657d9d52c26a315d46d.png", "https://i.gyazo.com/74ae883a4cae6657d9d52c26a315d46d.png"], 162000, 2500, 10000, "TKN");
    }

    function _createProperty(string memory _propertyAddress, string memory _postcode, uint16 _nBedrooms, uint16 _nShowers, uint16 _livingArea, string[4] memory _images, uint _price, uint _monthlyRent, uint _nTokens, string memory _tokenSymbol, address owner) internal {
        // Generate ERC20 token on this property
        address tokenAddress = tokenFactory.deployNewERC20Token(_propertyAddress, _tokenSymbol, _nTokens, owner);

        // Push property into the array
        properties.push( Property(_propertyAddress, _postcode, _nBedrooms, _nShowers, _livingArea, _images, _price, _monthlyRent, tokenAddress) );
        uint id = properties.length - 1;

        // Assign property ownerhip
        propertyToOwner[id] = _msgSender();

        // Emit event
        emit PropertyCreated(id, tokenAddress);
        propertyCount++;
    }

    function getImages(uint id) external view returns (string[4] memory image) {
        return properties[id].images;
    }

    function createProperty(string memory _propertyAddress, string memory _postcode, uint16 _nBedrooms, uint16 _nShowers, uint16 _livingArea, string[4] memory _images, uint _price, uint _monthlyRent, uint _nTokens, string memory _tokenSymbol) public {
        _createProperty(_propertyAddress, _postcode, _nBedrooms, _nShowers, _livingArea, _images, _price, _monthlyRent, _nTokens, _tokenSymbol, _msgSender());
    }
}
