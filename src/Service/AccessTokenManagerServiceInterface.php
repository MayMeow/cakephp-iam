<?php
declare(strict_types=1);

namespace Iam\Service;

use Authentication\IdentityInterface;
use Cake\Http\ServerRequest;
use Iam\Model\Entity\AccessToken;

interface AccessTokenManagerServiceInterface
{
    public function store(ServerRequest $request, IdentityInterface $user) : ?AccessToken;
}