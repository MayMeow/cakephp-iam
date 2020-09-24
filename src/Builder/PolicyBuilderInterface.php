<?php
declare(strict_types=1);

namespace Iam\Builder;

interface PolicyBuilderInterface
{
    public function getName() : string;

    public function getNormalizedName() : string;
}