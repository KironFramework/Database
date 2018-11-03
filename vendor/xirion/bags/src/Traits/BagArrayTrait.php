<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 06/10/2018
 * Time: 18:27
 */

namespace Xirion\Bags\Traits;

use Xirion\Bags\Exceptions\BagNotFoundException;

/**
 * Optional trait who define functions of ArrayAccess Interface
 *
 * Trait BagArrayTrait
 * @package Kiron\Bags\Traits
 *
 * @since 1.0.0
 */
trait BagArrayTrait
{

    /**
     * @param $offset
     * @return mixed
     * @throws BagNotFoundException
     *
     * @since 1.0.0
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param $offset
     * @return bool
     *
     * @since 1.0.0
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @param $offset
     * @param $value
     * @return mixed
     *
     * @since 1.0.0
     */
    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    /**
     * @param $offset
     * @throws BagNotFoundException
     *
     * @since 1.0.0
     */
    public function offsetUnset($offset)
    {
        return $this->delete($offset);
    }

}