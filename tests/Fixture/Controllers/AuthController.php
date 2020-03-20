<?php

namespace Zapheus\Bridge\Symfony\Fixture\Controllers;

/**
 * Auth Controller
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class AuthController
{
    /**
     * @var \Zapheus\Bridge\Symfony\Fixture\Controllers\RoleController $role
     */
    protected $role;

    /**
     * Initializes the controller instance.
     *
     * @param \Zapheus\Bridge\Symfony\Fixture\Controllers\RoleController $role
     */
    public function __construct(RoleController $role)
    {
        $this->role = $role;
    }
}
