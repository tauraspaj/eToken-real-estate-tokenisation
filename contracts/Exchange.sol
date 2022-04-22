// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import "./PropertyFactory.sol";
import "./SafeMath.sol";
import "./ERC20.sol";


contract Exchange is PropertyFactory{
    using SafeMath for uint256;
    using SafeMath32 for uint32;
    using SafeMath16 for uint16;

    event TokensPurchased(
        address account,
        address token,
        uint amount
    );

    event TokensSold(
        address account,
        address token,
        uint amount
    );

    // Pay eth into this contract
    function increaseExchangeBalance() payable public onlyOwner(){}

    function sellTokens(address tokenAddress, uint _tokenAmount, uint _etherAmount) public{
        ERC20 token = ERC20(tokenAddress);

        // Make sure user has enough tokens to sell
        require(token.balanceOf(msg.sender) >= _tokenAmount, "You do not have that many tokens in your wallet!");

        // Make sure Exchange has enough ether
        require(address(this).balance >= _etherAmount, "There is not enough money in the Exchange wallet address!");

        token.transferFrom(msg.sender, address(this), _tokenAmount);

        payable(msg.sender).transfer(_etherAmount);

        // Emit an event
        emit TokensSold(msg.sender, tokenAddress, _tokenAmount);
    }

    function buyTokens(address tokenAddress, uint _tokenAmount) payable public {
        ERC20 token = ERC20(tokenAddress);

        require(token.balanceOf(address(this)) >= _tokenAmount, "There are not that many tokens for sale!");
        token.transfer(msg.sender, _tokenAmount);

        // Emit an event
        emit TokensPurchased(msg.sender, tokenAddress, _tokenAmount);
    }
}
