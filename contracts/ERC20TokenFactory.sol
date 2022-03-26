// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import "./Ownable.sol";
import "./SafeMath.sol";
import "./Context.sol";
import "./ERC20.sol";

contract ERC20TokenFactory is Context{
    event ERC20TokenCreated(address tokenAddress);

    function deployNewERC20Token(
        string calldata name,
        string calldata symbol,
        uint256 initialSupply
    ) public returns (address) {
        ERC20 t = new ERC20(
            name,
            symbol,
            initialSupply,
            msg.sender
        );
        emit ERC20TokenCreated(address(t));

        return address(t);
    }


}