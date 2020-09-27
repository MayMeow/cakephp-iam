<?php
declare(strict_types=1);

namespace Iam\Builder;

interface PolicyStringBuilderInterface
{
    public function getName() : string;

    public function getNormalizedName() : string;
}