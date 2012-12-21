<?php
namespace ScnSocialAuthDoctrineORM\Mapper;

use Doctrine\ORM\EntityManager;
use Hybrid_User_Profile;
use ScnSocialAuth\Mapper\Exception;
use ScnSocialAuth\Mapper\UserProviderInterface;
use ScnSocialAuth\Options\ModuleOptions;
use Zend\Stdlib\Hydrator\HydratorInterface;
use ZfcBase\Mapper\AbstractDbMapper;
use ZfcUser\Entity\UserInterface;

class UserProvider extends AbstractDbMapper implements UserProviderInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @param   EntityManager   $em
     * @param   ModuleOptions   $options
     */
    public function __construct(EntityManager $em, ModuleOptions $options)
    {
        $this->em      = $em;
        $this->options = $options;
    }

    /**
     * @param   string          $providerId
     * @param   string          $provider
     * @return  UserInterface
     */
    public function findUserByProviderId($providerId, $provider)
    {
        $er = $this->em->getRepository($this->options->getUserProviderEntityClass());
        $entity = $er->findOneBy(array('providerId' => $providerId, 'provider' => $provider));
        return $entity;
    }

    /**
     * @param   UserInterface       $user
     * @param   Hybrid_User_Profile $hybridUserProfile
     * @param   string              $provider
     * @param   array               $accessToken
     */
    public function linkUserToProvider(UserInterface $user, Hybrid_User_Profile $hybridUserProfile, $provider, array $accessToken = null)
    {
        $userProvider = $this->findUserByProviderId($hybridUserProfile->identifier, $provider);

        if (false != $userProvider) {
            if ($user->getId() == $userProvider->getUserId()) {
                // already linked
                return;
            }
            throw new Exception\RuntimeException('This ' . ucfirst($provider) . ' profile is already linked to another user.');
        }

        $userProvider = clone($this->getEntityPrototype());
        $userProvider->setUserId($user->getId())
                     ->setProviderId($hybridUserProfile->identifier)
                     ->setProvider($provider);
        $this->insert($userProvider);
    }

    /**
     * @param   UserInterface     $entity
     * @param   string            $tableName
     * @param   HydratorInterface $hydrator
     * @return  UserInterface
     */
    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        return $this->persist($entity);
    }

    /**
     * @param   UserInterface     $entity
     * @param   string            $tableName
     * @param   HydratorInterface $hydrator
     * @return  UserInterface
     */
    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        return $this->persist($entity);
    }

    /**
     * @param   UserInterface   $entity
     * @return  UserInterface
     */
    protected function persist($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param  UserInterface               $user
     * @param  string                      $provider
     * @return UserProviderInterface|false
     */
    public function findProviderByUser(UserInterface $user, $provider)
    {
        $er = $this->em->getRepository($this->options->getUserProviderEntityClass());
        $entity = $er->findOneBy(array('userId' => $user->getId(), 'provider' => $provider));
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

    /**
     * @param  UserInterface $user
     * @return array
     */
    public function findProvidersByUser(UserInterface $user)
    {
        $er = $this->em->getRepository($this->options->getUserProviderEntityClass());
        $entities = $er->findBy(array('userId' => $user->getId()));

        $return = array();
        foreach ($entities as $entity) {
            $return[$entity->getProvider()] = $entity;
            $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        }

        return $return;
    }
}