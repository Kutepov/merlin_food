<?php

namespace app\components;

use yii\filters\AccessRule as CommonAccessRule;

class AccessRule extends CommonAccessRule {

    /**
     * {@inheritdoc}
     */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            } elseif (!$user->getIsGuest() && $role === $user->identity->getRole()) {
                return true;
            }
        }

        return false;
    }
}