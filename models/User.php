<?php

namespace app\models;

use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 *
 * @property integer $id
 * @property bool $is_admin
 */
class User implements IdentityInterface
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';

    private $id;
    private $role;
    private $is_bought = false;

    public function __construct($id, $roles, $is_bought = false)
    {
        $this->id = $id;
        $this->role = (bool) in_array(self::ROLE_ADMIN, $roles) ? self::ROLE_ADMIN : self::ROLE_USER;
        $this->is_bought = $is_bought;
    }
    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role == self::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isBought(): bool
    {
        return $this->is_bought;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     * @param \Lcobucci\JWT\Token $token
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return new self(
            $token->getClaim('uuid'),
            $token->getClaim('roles'),
            isset($token->getClaims()['is_bought']) ? $token->getClaim('is_bought') : false
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    public function getRole()
    {
        return $this->role;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return null;
    }
}
