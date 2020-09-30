<?php
declare(strict_types=1);

namespace Iam\Service;

use Authentication\IdentityInterface;
use Cake\Http\ServerRequest;
use Cake\ORM\Query;
use Iam\Model\Entity\AccessToken;

interface AccessTokenManagerServiceInterface
{
    /**
     * @return Query
     */
    public function getAll() : Query;

    /**
     * @param IdentityInterface $user
     * @return Query
     */
    public function getAllForUser(IdentityInterface $user) : Query;

    /**
     * @param int $id
     * @return AccessToken
     */
    public function getTokenWithUser(int $id) : AccessToken;

    /**
     * @param ServerRequest $request
     * @param IdentityInterface $user
     * @return AccessToken|null
     */
    public function store(ServerRequest $request, IdentityInterface $user) : ?AccessToken;
}
