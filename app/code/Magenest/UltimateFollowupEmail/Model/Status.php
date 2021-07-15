<?php

namespace Magenest\UltimateFollowupEmail\Model;

class Status
{
    /**
 #@+
     * Blog Status values
     */
    const STATUS_ENABLED = 1;

    const STATUS_DISABLED = 0;

    const IS_ACTIVE = 1;

    const IS_INACTIVE = 0;


    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        return [
                self::STATUS_ENABLED  => __('Enabled'),
                self::STATUS_DISABLED => __('Disabled'),
               ];
    }


    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = [
                         'value' => $index,
                         'label' => $value,
                        ];
        }

        return $result;
    }


    /**
     * Retrieve option text by option value
     *
     * @param  string $optionId
     * @return string
     */
    public function getOptionText($optionId)
    {
        $options = self::getOptionArray();

        return isset($options[$optionId]) ? $options[$optionId] : null;
    }


    /*
        * option active
     */


    public static function getOptionArrayActive()
    {
        return [
                self::IS_ACTIVE   => __('Active'),
                self::IS_INACTIVE => __('Inactive'),
               ];
    }


    public function getAllOptionactive()
    {
        $result = [];

        foreach (self::getOptionArrayActive() as $index => $value) {
            $result[] = [
                         'value' => $index,
                         'label' => $value,
                        ];
        }

        return $result;
    }


    public function getOptionTextActive($optionId)
    {
        $options = self::getOptionArrayActive();

        return isset($options[$optionId]) ? $options[$optionId] : null;
    }
}
