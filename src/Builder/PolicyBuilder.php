<?php
declare(strict_types=1);

namespace Iam\Builder;

use Cake\Utility\Text;
use RuntimeException;

class PolicyBuilder implements PolicyBuilderInterface
{
    protected $prefix;

    protected $plugin;

    protected $controller;
    
    protected $action;

    public function __construct(?string $prefix, ?string $plugin, string $controller, string $action)
    {
        $this->prefix = $prefix;
        $this->plugin = $plugin;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function getNormalizedName()
    {
        $policy_string = "app.policy/";

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

        return strtoupper(Text::slug($policy_string, [
            'replacement' => '_',
            'preserve' => ":/@"
        ]));
    }
}