<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 06/10/2018
 * Time: 18:10
 */

namespace Xirion\Bags;

use Xirion\Bags\Exceptions\BagException;
use Xirion\Bags\Exceptions\BagNotFoundException;
use Xirion\Bags\Interfaces\BagInterface;
use Xirion\Bags\Traits\BagArrayTrait;
use Xirion\Bags\Traits\BagTrait;

/**
 * This type of bag can contain all type of values
 *
 * Class MixedBag
 * @package Kiron\Bags
 *
 * @since 1.0.0
 */
class MixedBag implements BagInterface, \ArrayAccess
{
    use BagTrait;
    use BagArrayTrait;

    /**
     * @param $id
     * @param $value
     * @return mixed|void
     * @throws BagNotFoundException
     * @throws BagException
     *
     * @since 1.0.0
     */
    public function set($id, $value) {
        if(!is_null($value) && isset($value))  {
            $this->setKey($id, $value);
        } else {
            throw new BagException('[Kiron\Bags\MixedBag: set] the specified $value is not set or is null');
        }
    }

    /**
     * @param array $ids
     * @param array $values
     * @return mixed|void
     * @throws BagException
     * @throws BagNotFoundException
     *
     * @since 1.0.0
     */
    public function sets(array $ids, array $values) {
        if(count($ids) === count($values)) {
            foreach ($ids as $key => $id) {
                $this->set($id, $values[$key]);
            }
        } else {
            throw new BagException('[Kiron\Bags\MixedBag: sets] The count of $ids and $values is not equal');
        }
    }
}