<?php
/**
 * Created by PhpStorm.
 * User: Nyx
 * Date: 20.10.2018
 * Time: 16:22
 */

namespace Repository;

use Entity\User;

/**
 * Class UserRepository
 * @package Repository
 * @method static User get(int $id)
 * @method static void save(User $user)
 * @method static void update(User $user)
 * @method static void delete(User $user)
 */
class UserRepository extends CRUDRepository{}