<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 06/10/2018
 * Time: 18:00
 */

namespace Xirion\Bags\Traits;

use Xirion\Bags\Exceptions\BagNotFoundException;

/**
 * Main trait of bags who contain: has, get, gets, delete, deletes, setKey functions
 *
 * Trait BagTrait
 * @package Kiron\Bags\Traits
 *
 * @since 1.0.0
 */
trait BagTrait
{

    /**
     * @param $id
     * @return bool
     *
     * @since 1.0.0
     */
    public function has($id) {
        return isset($this->$id);
    }

    /**
     * @param $id
     * @return mixed
     * @throws BagNotFoundException
     *
     * @since 1.0.0
     */
    public function get($id) {
        if($this->has($id)) {
            return $this->$id;
        } else {
            throw new BagNotFoundException('[Kiron\Bags\BagTrait: get] Requested id ('.$id.') is not set');
        }
    }

    /**
     * @param array $ids
     * @return array
     * @throws BagNotFoundException
     *
     * @since 1.0.0
     */
    public function gets(array $ids) {
        $return = [];
        foreach ($ids as $id)
        {
            $return[] = $this->get($id);
        }
        return $return;
    }

    /**
     * @param $id
     * @throws BagNotFoundException
     *
     * @since 1.0.0
     */
    public function delete($id) {
        if($this->has($id)) {
            unset($this->$id);
        } else {
            throw new BagNotFoundException('[Kiron\Bags\BagTrait: delete] Requested id ('.$id. ') is not set');
        }
    }

    /**
     * @param array $ids
     * @throws BagNotFoundException
     *
     * @since 1.0.0
     */
    public function deletes(array $ids)
    {
        foreach ($ids as $id) {
            $this->delete($id);
        }
    }

    /**
     * @param $id
     * @param $value
     * @throws BagNotFoundException
     *
     * @since 1.0.0
     */
    public function setKey($id, $value) {
        $this->$id = $value;
    }
}