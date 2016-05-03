<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-12 at 13:17:14.
 */
class AmazonFulfillmentOrderCreatorTest extends PHPUnit_Framework_TestCase {

    /**
     * @var AmazonFulfillmentOrderCreator
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        resetLog();
        $this->object = new AmazonFulfillmentOrderCreator('testStore', true, null, __DIR__.'/../../test-config.php');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function testSetFulfillmentOrderId(){
        $this->assertFalse($this->object->setFulfillmentOrderId(null)); //can't be nothing
        $this->assertFalse($this->object->setFulfillmentOrderId(5)); //can't be an int
        $this->assertNull($this->object->setFulfillmentOrderId('123ABC'));
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('SellerFulfillmentOrderId',$o);
        $this->assertEquals('123ABC',$o['SellerFulfillmentOrderId']);
    }
    
    public function testSetDisplayableOrderId(){
        $this->assertFalse($this->object->setDisplayableOrderId(null)); //can't be nothing
        $this->assertFalse($this->object->setDisplayableOrderId(5)); //can't be an int
        $this->assertNull($this->object->setDisplayableOrderId('ABC123'));
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('DisplayableOrderId',$o);
        $this->assertEquals('ABC123',$o['DisplayableOrderId']);
    }
    
    public function testSetDate(){
        $this->assertFalse($this->object->setDate(null)); //can't be nothing
        $this->assertFalse($this->object->setDate(5)); //can't be an int
        $this->assertNull($this->object->setDate('-1 min'));
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('DisplayableOrderDateTime',$o);
    }
    
    public function testSetComment(){
        $this->assertFalse($this->object->setComment(null)); //can't be nothing
        $this->assertFalse($this->object->setComment(5)); //can't be an int
        $this->assertNull($this->object->setComment('A comment.'));
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('DisplayableOrderComment',$o);
        $this->assertEquals('A comment.',$o['DisplayableOrderComment']);
    }
    
    public function testSetShippingSpeed(){
        $this->assertFalse($this->object->setShippingSpeed(null)); //can't be nothing
        $this->assertFalse($this->object->setShippingSpeed(5)); //can't be an int
        $this->assertFalse($this->object->setShippingSpeed('wrong')); //not a valid value
        $this->assertNull($this->object->setShippingSpeed('Standard'));
        $this->assertNull($this->object->setShippingSpeed('Expedited'));
        $this->assertNull($this->object->setShippingSpeed('Priority'));
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('ShippingSpeedCategory',$o);
        $this->assertEquals('Priority',$o['ShippingSpeedCategory']);
        
        $check = parseLog();
        $this->assertEquals('Tried to set shipping status to invalid value',$check[1]);
        
    }
    
    public function testSetFulfillmentPolicy(){
        $this->assertFalse($this->object->setFulfillmentPolicy(null)); //can't be nothing
        $this->assertFalse($this->object->setFulfillmentPolicy(5)); //can't be an int
        $this->assertFalse($this->object->setFulfillmentPolicy('wrong')); //not a valid value
        $this->assertNull($this->object->setFulfillmentPolicy('FillOrKill'));
        $this->assertNull($this->object->setFulfillmentPolicy('FillAll'));
        $this->assertNull($this->object->setFulfillmentPolicy('FillAllAvailable'));
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('FulfillmentPolicy',$o);
        $this->assertEquals('FillAllAvailable',$o['FulfillmentPolicy']);
        
        $check = parseLog();
        $this->assertEquals('Tried to set fulfillment policy to invalid value',$check[1]);
        
    }
    
    public function testSetFulfillmentMethod(){
        $this->assertFalse($this->object->setFulfillmentMethod(null)); //can't be nothing
        $this->assertFalse($this->object->setFulfillmentMethod(5)); //can't be an int
        $this->assertFalse($this->object->setFulfillmentMethod('wrong')); //not a valid value
        $this->assertNull($this->object->setFulfillmentMethod('Consumer'));
        $this->assertNull($this->object->setFulfillmentMethod('Removal'));
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('FulfillmentMethod',$o);
        $this->assertEquals('Removal',$o['FulfillmentMethod']);
        
        $check = parseLog();
        $this->assertEquals('Tried to set fulfillment method to invalid value',$check[1]);
        
    }
    
    public function testSetAddress(){
        $this->assertFalse($this->object->setAddress(null)); //can't be nothing
        $this->assertFalse($this->object->setAddress('address')); //can't be a string
        $this->assertFalse($this->object->setAddress(array())); //can't be empty
        
        $check = parseLog();
        $this->assertEquals('Tried to set address to invalid values',$check[1]);
        $this->assertEquals('Tried to set address to invalid values',$check[2]);
        $this->assertEquals('Tried to set address to invalid values',$check[3]);
        
        $a1 = array();
        $a1['Name'] = 'Name';
        $a1['Line1'] = 'Line1';
        $a1['Line2'] = 'Line2';
        $a1['Line3'] = 'Line3';
        $a1['DistrictOrCounty'] = 'DistrictOrCounty';
        $a1['City'] = 'City';
        $a1['StateOrProvinceCode'] = 'StateOrProvinceCode';
        $a1['CountryCode'] = 'CountryCode';
        $a1['PostalCode'] = 'PostalCode';
        $a1['PhoneNumber'] = 'PhoneNumber';
        
        $this->assertNull($this->object->setAddress($a1));
        
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('DestinationAddress.Name',$o);
        $this->assertEquals('Name',$o['DestinationAddress.Name']);
        $this->assertArrayHasKey('DestinationAddress.Line1',$o);
        $this->assertEquals('Line1',$o['DestinationAddress.Line1']);
        $this->assertArrayHasKey('DestinationAddress.Line2',$o);
        $this->assertEquals('Line2',$o['DestinationAddress.Line2']);
        $this->assertArrayHasKey('DestinationAddress.Line3',$o);
        $this->assertEquals('Line3',$o['DestinationAddress.Line3']);
        $this->assertArrayHasKey('DestinationAddress.DistrictOrCounty',$o);
        $this->assertEquals('DistrictOrCounty',$o['DestinationAddress.DistrictOrCounty']);
        $this->assertArrayHasKey('DestinationAddress.City',$o);
        $this->assertEquals('City',$o['DestinationAddress.City']);
        $this->assertArrayHasKey('DestinationAddress.StateOrProvinceCode',$o);
        $this->assertEquals('StateOrProvinceCode',$o['DestinationAddress.StateOrProvinceCode']);
        $this->assertArrayHasKey('DestinationAddress.CountryCode',$o);
        $this->assertEquals('CountryCode',$o['DestinationAddress.CountryCode']);
        $this->assertArrayHasKey('DestinationAddress.PostalCode',$o);
        $this->assertEquals('PostalCode',$o['DestinationAddress.PostalCode']);
        $this->assertArrayHasKey('DestinationAddress.PhoneNumber',$o);
        $this->assertEquals('PhoneNumber',$o['DestinationAddress.PhoneNumber']);
        
        $a2 = array();
        $a2['Name'] = 'Name2';
        $a2['Line1'] = 'Line1-2';
        $a2['City'] = 'City2';
        $a2['StateOrProvinceCode'] = 'StateOrProvinceCode2';
        $a2['CountryCode'] = 'CountryCode2';
        $a2['PostalCode'] = 'PostalCode2';
        
        $this->assertNull($this->object->setAddress($a2)); //testing reset
        
        $o2 = $this->object->getOptions();
        $this->assertArrayHasKey('DestinationAddress.Name',$o2);
        $this->assertEquals('Name2',$o2['DestinationAddress.Name']);
        $this->assertNull($o2['DestinationAddress.Line2']);
        $this->assertNull($o2['DestinationAddress.Line3']);
        $this->assertNull($o2['DestinationAddress.DistrictOrCounty']);
        $this->assertNull($o2['DestinationAddress.PhoneNumber']);
        
    }
    
    public function testSetEmails(){
        $this->assertFalse($this->object->setEmails(null)); //can't be nothing
        $this->assertFalse($this->object->setEmails(5)); //can't be an int
        
        $emails = array('test@test.com','test@test.co.uk','test.dude@test.co.jp');
        $this->assertNull($this->object->setEmails($emails));
        
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('NotificationEmailList.member.1',$o);
        $this->assertEquals('test@test.com',$o['NotificationEmailList.member.1']);
        $this->assertArrayHasKey('NotificationEmailList.member.2',$o);
        $this->assertEquals('test@test.co.uk',$o['NotificationEmailList.member.2']);
        $this->assertArrayHasKey('NotificationEmailList.member.3',$o);
        $this->assertEquals('test.dude@test.co.jp',$o['NotificationEmailList.member.3']);
        
        $this->assertNull($this->object->setEmails('just_one@testtwo.net')); //will cause reset
        $o2 = $this->object->getOptions();
        $this->assertArrayHasKey('NotificationEmailList.member.1',$o2);
        $this->assertEquals('just_one@testtwo.net',$o2['NotificationEmailList.member.1']);
        $this->assertArrayNotHasKey('NotificationEmailList.member.2',$o2);
        $this->assertArrayNotHasKey('NotificationEmailList.member.3',$o2);
        
        $this->object->resetEmails();
        $o3 = $this->object->getOptions();
        $this->assertArrayNotHasKey('NotificationEmailList.member.1',$o3);
    }
    
    public function testSetItems(){
        $this->assertFalse($this->object->setItems(null)); //can't be nothing
        $this->assertFalse($this->object->setItems('item')); //can't be a string
        $this->assertFalse($this->object->setItems(array())); //can't be empty
        
        $break = array();
        $break[0]['Bork'] = 'bork bork';
        
        $this->assertFalse($this->object->setItems($break)); //missing seller sku
        
        $break[0]['SellerSKU'] = 'some sku';
        
        $this->assertFalse($this->object->setItems($break)); //missing item id
        
        $break[0]['SellerFulfillmentOrderItemId'] = 'some ID';
        
        $this->assertFalse($this->object->setItems($break)); //missing quantity
        
        $check = parseLog();
        $this->assertEquals('Tried to set Items to invalid values',$check[1]);
        $this->assertEquals('Tried to set Items to invalid values',$check[2]);
        $this->assertEquals('Tried to set Items to invalid values',$check[3]);
        $this->assertEquals('Tried to set Items with invalid array',$check[4]);
        $this->assertEquals('Tried to set Items with invalid array',$check[5]);
        $this->assertEquals('Tried to set Items with invalid array',$check[6]);
        
        $i = array();
        $i[0]['SellerSKU'] = 'SellerSKU';
        $i[0]['SellerFulfillmentOrderItemId'] = 'SellerFulfillmentOrderItemId';
        $i[0]['Quantity'] = 'Quantity';
        $i[0]['GiftMessage'] = 'GiftMessage';
        $i[0]['Comment'] = 'Comment';
        $i[0]['FulfillmentNetworkSKU'] = 'FulfillmentNetworkSKU';
        $i[0]['OrderItemDisposition'] = 'OrderItemDisposition';
        $i[0]['PerUnitDeclaredValue']['CurrencyCode'] = 'USD';
        $i[0]['PerUnitDeclaredValue']['Value'] = '9.99';
        $i[1]['SellerSKU'] = 'SellerSKU2';
        $i[1]['SellerFulfillmentOrderItemId'] = 'SellerFulfillmentOrderItemId2';
        $i[1]['Quantity'] = 'Quantity2';
        
        $this->assertNull($this->object->setItems($i));
        
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('Items.member.1.SellerSKU',$o);
        $this->assertEquals('SellerSKU',$o['Items.member.1.SellerSKU']);
        $this->assertArrayHasKey('Items.member.1.SellerFulfillmentOrderItemId',$o);
        $this->assertEquals('SellerFulfillmentOrderItemId',$o['Items.member.1.SellerFulfillmentOrderItemId']);
        $this->assertArrayHasKey('Items.member.1.Quantity',$o);
        $this->assertEquals('Quantity',$o['Items.member.1.Quantity']);
        $this->assertArrayHasKey('Items.member.1.GiftMessage',$o);
        $this->assertEquals('GiftMessage',$o['Items.member.1.GiftMessage']);
        $this->assertArrayHasKey('Items.member.1.DisplayableComment',$o);
        $this->assertEquals('Comment',$o['Items.member.1.DisplayableComment']);
        $this->assertArrayHasKey('Items.member.1.FulfillmentNetworkSKU',$o);
        $this->assertEquals('FulfillmentNetworkSKU',$o['Items.member.1.FulfillmentNetworkSKU']);
        $this->assertArrayHasKey('Items.member.1.OrderItemDisposition',$o);
        $this->assertEquals('OrderItemDisposition',$o['Items.member.1.OrderItemDisposition']);
        $this->assertArrayHasKey('Items.member.1.PerUnitDeclaredValue.CurrencyCode',$o);
        $this->assertEquals('USD',$o['Items.member.1.PerUnitDeclaredValue.CurrencyCode']);
        $this->assertArrayHasKey('Items.member.1.PerUnitDeclaredValue.Value',$o);
        $this->assertEquals('9.99',$o['Items.member.1.PerUnitDeclaredValue.Value']);
        $this->assertArrayHasKey('Items.member.2.SellerSKU',$o);
        $this->assertEquals('SellerSKU2',$o['Items.member.2.SellerSKU']);
        $this->assertArrayHasKey('Items.member.2.SellerFulfillmentOrderItemId',$o);
        $this->assertEquals('SellerFulfillmentOrderItemId2',$o['Items.member.2.SellerFulfillmentOrderItemId']);
        $this->assertArrayHasKey('Items.member.2.Quantity',$o);
        $this->assertEquals('Quantity2',$o['Items.member.2.Quantity']);
        
        $i2 = array();
        $i2[0]['SellerSKU'] = 'NewSellerSKU';
        $i2[0]['SellerFulfillmentOrderItemId'] = 'NewSellerFulfillmentOrderItemId';
        $i2[0]['Quantity'] = 'NewQuantity';
        
        $this->assertNull($this->object->setItems($i2)); //will cause reset
        
        $o2 = $this->object->getOptions();
        $this->assertArrayHasKey('Items.member.1.SellerSKU',$o2);
        $this->assertEquals('NewSellerSKU',$o2['Items.member.1.SellerSKU']);
        $this->assertArrayHasKey('Items.member.1.SellerFulfillmentOrderItemId',$o2);
        $this->assertEquals('NewSellerFulfillmentOrderItemId',$o2['Items.member.1.SellerFulfillmentOrderItemId']);
        $this->assertArrayHasKey('Items.member.1.Quantity',$o2);
        $this->assertEquals('NewQuantity',$o2['Items.member.1.Quantity']);
        $this->assertArrayNotHasKey('Items.member.1.GiftMessage',$o2);
        $this->assertArrayNotHasKey('Items.member.1.DisplayableComment',$o2);
        $this->assertArrayNotHasKey('Items.member.1.FulfillmentNetworkSKU',$o2);
        $this->assertArrayNotHasKey('Items.member.1.OrderItemDisposition',$o2);
        $this->assertArrayNotHasKey('Items.member.1.PerUnitDeclaredValue.CurrencyCode',$o2);
        $this->assertArrayNotHasKey('Items.member.1.PerUnitDeclaredValue.Value',$o2);
        $this->assertArrayNotHasKey('Items.member.2.SellerSKU',$o2);
        $this->assertArrayNotHasKey('Items.member.2.SellerFulfillmentOrderItemId',$o2);
        $this->assertArrayNotHasKey('Items.member.2.Quantity',$o2);
    }
    
    public function testCreateOrder(){
        resetLog();
        $this->object->setMock(true,array(503,200));
        
        $this->assertFalse($this->object->createOrder()); //no Seller Fulfillment Order ID set yet
        
        $this->object->setFulfillmentOrderId('123ABC');
        $this->assertFalse($this->object->createOrder()); //no Displayable Order ID set yet
        
        $this->object->setDisplayableOrderId('ABC123');
        $this->assertFalse($this->object->createOrder()); //no Date set yet
        
        $this->object->setDate('-1 min');
        $this->assertFalse($this->object->createOrder()); //no Displayable Order Comment set yet
        
        $this->object->setComment('A comment.');
        $this->assertFalse($this->object->createOrder()); //no Shipping Speed Category set yet
        
        $this->object->setShippingSpeed('Standard');
        $this->assertFalse($this->object->createOrder()); //no Destination Address set yet
        
        $a = array();
        $a['Name'] = 'Name';
        $a['Line1'] = 'Line1';
        $a['City'] = 'City';
        $a['StateOrProvinceCode'] = 'StateOrProvinceCode';
        $a['CountryCode'] = 'CountryCode';
        $a['PostalCode'] = 'PostalCode';
        $this->object->setAddress($a);
        $this->assertFalse($this->object->createOrder()); //no Items set yet
        
        $i = array();
        $i[0]['SellerSKU'] = 'NewSellerSKU';
        $i[0]['SellerFulfillmentOrderItemId'] = 'NewSellerFulfillmentOrderItemId';
        $i[0]['Quantity'] = 'NewQuantity';
        $this->object->setItems($i);
        
        $this->object->createOrder(); //attempt 1: oops, bad response
        $this->object->createOrder(); //attempt 2: success
        
        $check = parseLog();
        $this->assertEquals('Mock files array set.',$check[1]);
        $this->assertEquals('Seller Fulfillment OrderID must be set in order to create an order',$check[2]);
        $this->assertEquals('Displayable Order ID must be set in order to create an order',$check[3]);
        $this->assertEquals('Date must be set in order to create an order',$check[4]);
        $this->assertEquals('Comment must be set in order to create an order',$check[5]);
        $this->assertEquals('Shipping Speed must be set in order to create an order',$check[6]);
        $this->assertEquals('Address must be set in order to create an order',$check[7]);
        $this->assertEquals('Items must be set in order to create an order',$check[8]);
        $this->assertEquals('Returning Mock Response: 503',$check[9]);
        $this->assertEquals('Bad Response! 503 Service Unavailable: Service Unavailable - Service Unavailable',$check[10]);
        $this->assertEquals('Returning Mock Response: 200',$check[11]);
        $this->assertEquals('Successfully created Fulfillment Order 123ABC / ABC123',$check[12]);
    }
    
}

require_once('helperFunctions.php');