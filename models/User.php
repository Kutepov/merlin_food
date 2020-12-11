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
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    private $id;
    private $role;

    public function __construct($id, $is_admin)
    {
        $this->id = $id;
        $this->role = (bool) $is_admin ? self::ROLE_ADMIN : self::ROLE_USER;
    }
    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
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
        return new self($token->getClaim('uid'), $token->getClaim('is_admin'));
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
