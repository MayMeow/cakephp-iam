<?php
declare(strict_types=1);

namespace Iam\Builder;

use Cake\Utility\Text;
use RuntimeException;

/**
 * Policy builder
 * 
 * TODO Change this to PolicyStringBuilder / PolicyStringBuilderInterface
 */
class PolicyBuilder implements PolicyBuilderInterface
{
    protected $prefix;

    protected $plugin;

    protected $controller;
    
    protected $action;

    protected $descriptor = 'App.Policy/v1/';

    public function __construct(?string $prefix, ?string $plugin, string $controller, string $action)
    {
        $this->prefix = $prefix;
        $this->plugin = $plugin;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function getName(): string
    {
        return $this->buildPolicyString();
    }

    public function getNormalizedName() :string
    {
        return strtoupper(Text::slug($this->buildPolicyString(), [
            'replacement' => '_',
            'preserve' => ":/@"
        ]));
    }

    private function buildPolicyString() : string
    {
        $policy_string = $this->descriptor;

        if ($this->controller == null || $this->action == null) {
            throw new RuntimeException('Controller and Action are requred');
        }

        if ($this->prefix != null) {
            $policy_string .= $this->prefix . "/";
        }

        if ($this->plugin != null) {
            $policy_string .= $this->plugin . "/";
        }

        $policy_string .= $this->controller. "/";
        $policy_string .= $this->action;

        return $policy_string;
    }
}