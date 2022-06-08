// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import "./PropertyFactory.sol";

contract PropertyHelper is PropertyFactory {
    modifier onlyOwnerOf(uint _propertyId) {
        require(_msgSender() == propertyToOwner[_propertyId]);
        _;
    }

    // function changePropertyName(uint _propertyId, string calldata _newName) external onlyOwnerOf(_propertyId) {
    //     properties[_propertyId].name = _newName;
    // }
}
