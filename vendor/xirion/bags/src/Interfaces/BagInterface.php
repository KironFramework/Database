<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 06/10/2018
 * Time: 18:01
 */

namespace Xirion\Bags\Interfaces;

use Psr\Container\ContainerInterface;

/**
 * Base Bag Interface who extend ContainerInterface
 *
 * Interface BagInterface
 * @package Kiron\Bags\Interfaces
 *
 * @since 1.0.0
 */
interface BagInterface extends ContainerInterface {

    /**
     * @param $key
     * @param $value
     * @return mixed
     *
     * @since 1.0.0
     */
    public function setKey($key, $value);

}