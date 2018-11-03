<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 06/10/2018
 * Time: 18:07
 */

namespace Xirion\Bags\Exceptions;

use Xirion\Bags\Interfaces\BagExceptionNotFoundInterface;
use \Exception;

/**
 * Exception to throw when the specified $id is not set
 *
 * Class BagNotFoundException
 * @package Kiron\Bags\Exceptions
 */
class BagNotFoundException extends Exception implements BagExceptionNotFoundInterface
{
}