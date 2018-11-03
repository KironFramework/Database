<?php

namespace Xirion\Bags;

use Xirion\Bags\Exceptions\BagException;
use Xirion\Bags\Interfaces\BagInterface;
use Xirion\Bags\Traits\BagArrayTrait;
use Xirion\Bags\Traits\BagTrait;

/**
 * This type of bag can only contain specific numerics
 *
 * Class NumberBag
 * @package Kiron\Bags
 *
 * @since 1.0.0
 */
class NumberBag implements BagInterface, \ArrayAccess
{
    use BagTrait;
    use BagArrayTrait;

    /**
     * @param $id
     * @param $value
     * @return mixed|void
     * @throws BagException
     * @throws Exceptions\BagNotFoundException
     *
     * @since 1.0.0
     */
    public function set($id, $value) {
        if(is_numeric($value))  {
            $this->setKey($id, $value);
        } else {
            throw new BagException('[Kiron\Bags\NumberBag: set] the specified $value is not an object');
        }
    }

    /**
     * @param array $ids
     * @param array $values
     * @return mixed|void
     * @throws BagException
     * @throws Exceptions\BagNotFoundException
     *
     * @since 1.0.0
     */
    public function sets(array $ids, array $values) {
        if(count($ids) === count($values)) {
            foreach ($ids as $key => $id) {
                $this->set($id, $values[$key]);
            }
        } else {
            throw new BagException('[Kiron\Bags\StringBag: sets] The count of $ids and $values is not equal');
        }
    }
}