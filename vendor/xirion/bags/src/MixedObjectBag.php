<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07/10/2018
 * Time: 08:28
 */

namespace Xirion\Bags;

use Xirion\Bags\Exceptions\BagException;
use Xirion\Bags\Exceptions\BagNotFoundException;
use Xirion\Bags\Interfaces\BagInterface;
use Xirion\Bags\Traits\BagArrayTrait;
use Xirion\Bags\Traits\BagTrait;

/**
 * This type of bag can contain only Objects and Callables
 *
 * Class MixedObjectBag
 * @package Kiron\Bags
 *
 * @since 1.0.0
 */
class MixedObjectBag implements BagInterface, \ArrayAccess
{

    use BagTrait;
    use BagArrayTrait;

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
            throw new BagException('[Kiron\Bags\MixedObjectBag: sets] The count of $ids and $values is not equal');
        }
    }

    /**
     * @param $id
     * @param $value
     * @return mixed|void
     * @throws BagException
     * @throws BagNotFoundException
     *
     * @since 1.0.0
     */
    public function set($id, $value) {
        if(is_object($value) || is_callable($value))  {
            $this->setKey($id, $value);
        } else {
            throw new BagException('[Kiron\Bags\MixedObjectBag: set] the specified $value is not an object');
        }
    }

}