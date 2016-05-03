Laravel-5-amazon-mws-persistent
============
Forked from https://github.com/przemekperon/amazon-mws-laravel.git

Updted this repo when I was trying to complete a spark project that required persistent database settings

Also, I have implemented Auth_Token required by amazon

==========
A PHP package to connect to Amazon's Merchant Web Services (MWS) in an object-oriented manner, with a focus on intuitive usage.

This is __NOT__ for Amazon Web Services (AWS) - Cloud Computing Services.

## Installation

1. `composer require zaffar-saffee/Laravel-5-amazon-mws-persistent`

2. add the service provider to the providers array in config/app.php:
```
Zaffar\AmazonMws\ServiceProvider::class,
```

There's no facades to add in config/app.php

## Persistent settings
I used anlutro/laravel-settings  for persistent settings as the project gives easily configureable option for saving settings per users
Please consult docs for anlutro/laravel-settings for more information 
```php
    Setting::set("storeName","mystore"); // this will be key for store config, you pass this as an option in setstore() 
    Setting::set("authToken",""); // required back from 
    Setting::set("merchantId","");  
    Setting::set("marketplaceId","");  
    Setting::set("keyId","");  
    Setting::set("secretKey","");  
    Setting::set("amazonServiceUrl","https://mws.amazonservices.com/");  // set to valid node
    Setting::set("muteLog","false");  //dev purpose, make it true on production
```  
Please see Service Provider and Amazon Core to see how I converted it to Peron's file format configurations
Planning it to modify it further             



## Usage
Usage is as exactly as of original author (przemekperon/amazon-mws-laravel)

All of the technical details required by the API are handled behind the scenes,
so users can easily build code for sending requests to Amazon
without having to jump hurdles such as parameter URL formatting and token management.
 
The general work flow for using one of the objects is this:

1. Create an object for the task you need to perform.
2. Load it up with parameters, depending on the object, using *set____* methods.
3. Submit the request to Amazon. The methods to do this are usually named *fetch____* or *submit____* and have no parameters.
4. Reference the returned data, whether as single values or in bulk, using *get____* methods.
5. Monitor the performance of the library using the built-in logging system.

Note that if you want to act on more than one Amazon store, you will need a separate object for each store.

Also note that the objects perform best when they are not treated as reusable. Otherwise, you may end up grabbing old response data if a new request fails.

## Example Usage

Here are a couple of examples of the library in use.
All of the technical details required by the API are handled behind the scenes,
so users can easily build code for sending requests to Amazon
without having to jump hurdles such as parameter URL formatting and token management. 

Here is an example of a function used to get all warehouse-fulfilled orders from Amazon updated in the past 24 hours:
```php
use Zaffar\AmazonMws\AmazonOrderList;

function getAmazonOrders() {
    $amz = new AmazonOrderList("myStore"); //store name matches the array key in the config file
    $amz->setLimits('Modified', "- 24 hours");
    $amz->setFulfillmentChannelFilter("MFN"); //no Amazon-fulfilled orders
    $amz->setOrderStatusFilter(
        array("Unshipped", "PartiallyShipped", "Canceled", "Unfulfillable")
        ); //no shipped or pending
    $amz->setUseToken(); //Amazon sends orders 100 at a time, but we want them all
    $amz->fetchOrders();
    return $amz->getList();
}
```
This example shows a function used to send a previously-created XML feed to Amazon to update Inventory numbers:
```php
use Zaffar\AmazonMws\AmazonOrderList;

function sendInventoryFeed($feed) {
    $amz = new AmazonFeed("myStore"); //store name matches the array key in the config file
    $amz->setFeedType("_POST_INVENTORY_AVAILABILITY_DATA_"); //feed types listed in documentation
    $amz->setFeedContent($feed);
    $amz->submitFeed();
    return $amz->getResponse();
}
```
