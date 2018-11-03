<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 06/10/2018
 * Time: 18:09
 */

namespace Xirion\Bags;

use Xirion\Bags\Exceptions\BagException;
use Xirion\Bags\Interfaces\BagInterface;
use Xirion\Bags\Traits\BagArrayTrait;
use Xirion\Bags\Traits\BagTrait;

/**
 * This type of bag can only contain Objects
 *
 * Class ObjectBag
 * @package Kiron\Bags
 *
 * @since 1.0.0
 */
class ObjectBag implements BagInterface, \ArrayAccess
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
        if(is_object($value))  {
            $this->setKey($id, $value);
        } else {
            throw new BagException('[Kiron\Bags\ObjectBag: set] the specified $value is not an object');
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
            throw new BagException('[Kiron\Bags\ObjectBag: sets] The count of $ids and $values is not equal');
        }
    }
}