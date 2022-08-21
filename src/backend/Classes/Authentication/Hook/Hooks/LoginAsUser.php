<?php

namespace Espo\Modules\LoginAsUser\Classes\Authentication\Hook\Hooks;

use Espo\Core\Api\Request;
use Espo\Core\Authentication\AuthenticationData;
use Espo\Core\Authentication\Hook\OnResult;
use Espo\Core\Authentication\Result;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Utils\Log;
use Espo\Entities\User;
use Espo\ORM\EntityManager;

class LoginAsUser implements OnResult
{
    private User $user;
    private EntityManager $entityManager;
    private Log $log;

    public function __construct(
        User $user,
        EntityManager $entityManager,
        Log $log
    ) {
        $this->user = $user;
        $this->entityManager = $entityManager;
        $this->log = $log;
    }

    /**
     * @throws Forbidden
     */
    public function process(Result $result, AuthenticationData $data, Request $request): void
    {
        $user = $result->getUser();
        $loginAsUserId = $request->getCookieParam('login-as-user-id');

        if ($loginAsUserId === null) {
            return;
        }

        if (!$user->isAdmin()) {
            $this->log->warning('Trying to login as user by non-admin user.', [
                'userId' => $user->getId(),
                'loginAsUserId' => $loginAsUserId,
            ]);

            throw new Forbidden('Insufficient permissions for logging in as other users.');
        }

        $loginAsUser = $this->entityManager->getEntity('User', $loginAsUserId);

        if (!$loginAsUser) {
            $this->log->warning('Trying to login as user that does not exist.', [
                'userId' => $user->getId(),
                'loginAsUserId' => $loginAsUserId,
            ]);

            throw new Forbidden('User does not exist.');
        }

        $this->user->reset();
        $this->user->set($loginAsUser->getValueMap());
    }
}
