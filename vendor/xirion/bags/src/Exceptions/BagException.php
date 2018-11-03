<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 06/10/2018
 * Time: 18:05
 */

namespace Xirion\Bags\Exceptions;

use Xirion\Bags\Interfaces\BagExceptionInterface;
use \Exception;

/**
 * Main BagException
 *
 * Class BagException
 * @package Kiron\Bags\Exceptions
 */
class BagException extends Exception implements BagExceptionInterface
{
}