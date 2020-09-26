<?php
declare(strict_types=1);

namespace Iam\Service;

use Authentication\IdentityInterface;
use Cake\Http\ServerRequest;
use Cake\ORM\Query;
use Iam\Model\Entity\AccessToken;

interface AccessTokenManagerServiceInterface
{
    public function getAll() : Query;

    public function getAllForUser(IdentityInterface $user) : Query;

    public function getTokenWithUser(int $id) : AccessToken;

    public function store(ServerRequest $request, IdentityInterface $user) : ?AccessToken;
}