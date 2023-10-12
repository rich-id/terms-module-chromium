<?php

declare(strict_types=1);

namespace RichId\TermsModuleChromiumBundle\Infrastructure\DependencyInjection;

use RichCongress\BundleToolbox\Configuration\AbstractConfiguration;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

class Configuration extends AbstractConfiguration
{
    public const CONFIG_NODE = 'rich_id_terms_module_chromium';

    protected function buildConfig(NodeBuilder $nodeBuilder): void
    {
        $this->chromeBinary($nodeBuilder);
        $this->chromeCustomFlags($nodeBuilder);
    }

    protected function chromeBinary(NodeBuilder $nodeBuilder): void
    {
        $nodeBuilder
            ->scalarNode('chrome_binary')
            ->defaultValue('chromium');
    }

    protected function chromeCustomFlags(NodeBuilder $nodeBuilder): void
    {
        $nodeBuilder
            ->arrayNode('chrome_custom_flags')
            ->example(['--no-sandbox', '--disable-setuid-sandbox', '--disable-dev-shm-usage'])
            ->defaultValue(['--no-sandbox', '--disable-setuid-sandbox', '--disable-dev-shm-usage'])
            ->scalarPrototype();
    }
}
