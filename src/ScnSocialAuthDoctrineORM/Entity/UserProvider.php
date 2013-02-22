<?php
namespace ScnSocialAuthDoctrineORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use ScnSocialAuth\Entity\UserProviderInterface;

/** @ORM\Entity @ORM\Table(name="user_provider") */
class UserProvider implements UserProviderInterface
{
    /** @ORM\Id @ORM\Column(type="integer",name="user_id") */
    protected $userId;

    /** @ORM\Id @ORM\Column(type="string",length=50,name="provider_id") */
    protected $providerId;

    /** @ORM\Column(type="string") */
    protected $provider;

    /**
     * @return the $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param  integer      $userId
     * @return UserProvider
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return the $providerId
     */
    public function getProviderId()
    {
        return $this->providerId;
    }

    /**
     * @param  integer      $providerId
     * @return UserProvider
     */
    public function setProviderId($providerId)
    {
        $this->providerId = $providerId;

        return $this;
    }

    /**
     * @return the $provider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param  string       $provider
     * @return UserProvider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }
}