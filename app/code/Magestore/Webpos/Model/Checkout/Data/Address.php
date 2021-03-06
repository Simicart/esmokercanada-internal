<?php

/**
 *  Copyright © 2018 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\Webpos\Model\Checkout\Data;

/**
 * 
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Address extends \Magento\Customer\Model\Data\Address implements \Magestore\Webpos\Api\Data\Checkout\AddressInterface
{
    /**
     * Get id
     *
     * @return int|null
     */
    public function getId(){
        return $this->_get(self::KEY_ID);
    }

    /**
     * Get region
     *
     * @return \Magento\Customer\Api\Data\RegionInterface
     */
    public function getRegion(){
        return $this->_get(self::KEY_REGION);
    }

    /**
     * Get region ID
     *
     * @return int
     */
    public function getRegionId(){
        return $this->_get(self::KEY_REGION_ID);
    }

    /**
     * Get country id
     *
     * @return string|null
     */
    public function getCountryId(){
        return $this->_get(self::KEY_COUNTRY_ID);
    }

    /**
     * Get street
     *
     * @return string[]|null
     */
    public function getStreet(){
        return $this->_get(self::KEY_STREET);
    }

    /**
     * Get company
     *
     * @return string|null
     */
    public function getCompany(){
        return $this->_get(self::KEY_COMPANY);
    }

    /**
     * Get telephone number
     *
     * @return string|null
     */
    public function getTelephone(){
        return $this->_get(self::KEY_TELEPHONE);
    }

    /**
     * Get fax number
     *
     * @return string|null
     */
    public function getFax(){
        return $this->_get(self::KEY_FAX);
    }

    /**
     * Get postcode
     *
     * @return string|null
     */
    public function getPostcode(){
        return $this->_get(self::KEY_POSTCODE);
    }

    /**
     * Get city name
     *
     * @return string|null
     */
    public function getCity(){
        return $this->_get(self::KEY_CITY);
    }

    /**
     * Get first name
     *
     * @return string|null
     */
    public function getFirstname()
    {
        return $this->_get(self::KEY_FIRSTNAME);
    }

    /**
     * Get last name
     *
     * @return string|null
     */
    public function getLastname(){
        return $this->_get(self::KEY_LASTNAME);
    }

    /**
     * Get middle name
     *
     * @return string|null
     */
    public function getMiddlename()
    {
        return $this->_get(self::KEY_MIDDLENAME);
    }

    /**
     * Get prefix
     *
     * @return string|null
     */
    public function getPrefix(){
        return $this->_get(self::KEY_PREFIX);
    }

    /**
     * Get suffix
     *
     * @return string|null
     */
    public function getSuffix(){
        return $this->_get(self::KEY_SUFFIX);
    }

    /**
     * Get Vat id
     *
     * @return string|null
     */
    public function getVatId(){
        return $this->_get(self::KEY_VAT_ID);
    }

    /**
     * Get customer id
     *
     * @return string|null
     */
    public function getCustomerId(){
        return $this->_get(self::KEY_CUSTOMER_ID);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id){
        return $this->setData(self::KEY_ID, $id);
    }

    /**
     * Set customer ID
     *
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId($customerId){
        return $this->setData(self::KEY_CUSTOMER_ID, $customerId);
    }

    /**
     * Set region
     *
     * @param \Magento\Customer\Api\Data\RegionInterface $region
     * @return $this
     */
    public function setRegion(\Magento\Customer\Api\Data\RegionInterface $region = null){
        return $this->setData(self::KEY_REGION, $region);
    }

    /**
     * Set region ID
     *
     * @param int $regionId
     * @return $this
     */
    public function setRegionId($regionId){
        return $this->setData(self::KEY_REGION_ID, $regionId);
    }

    /**
     * Set country id
     *
     * @param string $countryId
     * @return $this
     */
    public function setCountryId($countryId)
    {
        return $this->setData(self::KEY_COUNTRY_ID, $countryId);
    }

    /**
     * Set street
     *
     * @param string[] $street
     * @return $this
     */
    public function setStreet(array $street)
    {
        return $this->setData(self::KEY_STREET, $street);
    }

    /**
     * Set company
     *
     * @param string $company
     * @return $this
     */
    public function setCompany($company)
    {
        return $this->setData(self::KEY_COMPANY, $company);
    }

    /**
     * Set telephone number
     *
     * @param string $telephone
     * @return $this
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::KEY_TELEPHONE, $telephone);
    }

    /**
     * Set fax number
     *
     * @param string $fax
     * @return $this
     */
    public function setFax($fax)
    {
        return $this->setData(self::KEY_FAX, $fax);
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return $this
     */
    public function setPostcode($postcode)
    {
        return $this->setData(self::KEY_POSTCODE, $postcode);
    }

    /**
     * Set city name
     *
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        return $this->setData(self::KEY_CITY, $city);
    }

    /**
     * Set first name
     *
     * @param string $firstName
     * @return $this
     */
    public function setFirstname($firstName)
    {
        return $this->setData(self::KEY_FIRSTNAME, $firstName);
    }

    /**
     * Set last name
     *
     * @param string $lastName
     * @return $this
     */
    public function setLastname($lastName)
    {
        return $this->setData(self::KEY_LASTNAME, $lastName);
    }

    /**
     * Set middle name
     *
     * @param string $middleName
     * @return $this
     */
    public function setMiddlename($middleName)
    {
        return $this->setData(self::KEY_MIDDLENAME, $middleName);
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        return $this->setData(self::KEY_PREFIX, $prefix);
    }

    /**
     * Set suffix
     *
     * @param string $suffix
     * @return $this
     */
    public function setSuffix($suffix)
    {
        return $this->setData(self::KEY_SUFFIX, $suffix);
    }

    /**
     * Set Vat id
     *
     * @param string $vatId
     * @return $this
     */
    public function setVatId($vatId)
    {
        return $this->setData(self::KEY_VAT_ID, $vatId);
    }

    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function getAddressType(){
        return $this->getData(self::KEY_TYPE);
    }

    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function setAddressType($type){
        return $this->setData(self::KEY_TYPE, $type);
    }
    
    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function getEmail(){
        return $this->getData(self::KEY_EMAIL);
    }

    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function setEmail($email){
        return $this->setData(self::KEY_EMAIL, $email);
    }
    
    /**
     * Set if this address is default shipping address.
     *
     * @param bool $isDefaultShipping
     * @return $this
     */
    public function setIsDefaultShipping($isDefaultShipping)
    {
        return $this->setData(self::DEFAULT_SHIPPING, $isDefaultShipping);
    }

    /**
     * Set if this address is default billing address
     *
     * @param bool $isDefaultBilling
     * @return $this
     */
    public function setIsDefaultBilling($isDefaultBilling)
    {
        return $this->setData(self::DEFAULT_BILLING, $isDefaultBilling);
    }
    
        /**
     * Get if this address is default shipping address.
     *
     * @return bool|null
     */
    public function isDefaultShipping()
    {
        return $this->_get(self::DEFAULT_SHIPPING);
    }

    /**
     * Get if this address is default billing address
     *
     * @return bool|null
     */
    public function isDefaultBilling()
    {
        return $this->_get(self::DEFAULT_BILLING);
    }
    
    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function getData($key = false){
        if($key){
            return $this->_get($key);
        }else{
            $keys = [
                self::KEY_ID,self::KEY_CUSTOMER_ID,self::KEY_REGION,self::KEY_REGION_ID,self::KEY_COUNTRY_ID,self::KEY_STREET,
                self::KEY_COMPANY,self::KEY_TELEPHONE,self::KEY_FAX,self::KEY_POSTCODE,self::KEY_CITY,self::KEY_FIRSTNAME,
                self::KEY_LASTNAME,self::KEY_MIDDLENAME,self::KEY_PREFIX,self::KEY_SUFFIX,self::KEY_VAT_ID,
                self::KEY_EMAIL,self::DEFAULT_BILLING,self::DEFAULT_SHIPPING,
            ];
            $data = [];
            if(count($keys) > 0){
                foreach ($keys as $KEY){
                    $data[$KEY] = $this->_get($KEY);
                }
            }
            return $data;
        }
    }
    
    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function setAddressData($data){
        if(is_array($data)){
            $keys = [
                self::KEY_ID,self::KEY_CUSTOMER_ID,self::KEY_REGION,self::KEY_REGION_ID,self::KEY_COUNTRY_ID,self::KEY_STREET,
                self::KEY_COMPANY,self::KEY_TELEPHONE,self::KEY_FAX,self::KEY_POSTCODE,self::KEY_CITY,self::KEY_FIRSTNAME,
                self::KEY_LASTNAME,self::KEY_MIDDLENAME,self::KEY_PREFIX,self::KEY_SUFFIX,self::KEY_VAT_ID,
                self::KEY_EMAIL,self::DEFAULT_BILLING,self::DEFAULT_SHIPPING,
            ];
            if(count($keys) > 0){
                foreach ($keys as $KEY){
                    if(!isset($data[$KEY])){
                        continue;
                    }
                    $this->setData($KEY, $data[$KEY]);
                }
            }
            return $this;
        }
    }
}