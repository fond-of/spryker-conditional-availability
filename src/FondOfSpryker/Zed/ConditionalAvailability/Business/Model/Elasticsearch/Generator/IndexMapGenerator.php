<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\ConditionalAvailability\Business\Model\Elasticsearch\Generator;

use Spryker\Zed\Search\Business\Model\Elasticsearch\Generator\IndexMapGenerator as SprykerIndexMapGenerator;

class IndexMapGenerator extends SprykerIndexMapGenerator
{
    /**
     * @param string $targetDirectory
     * @param int $permissionMode
     */
    public function __construct(string $targetDirectory, int $permissionMode)
    {
        parent::__construct($targetDirectory, $permissionMode);

        /** @var \Twig\Loader\FilesystemLoader $loader */
        $loader = $this->twig->getLoader();
        $loader->setPaths([__DIR__ . self::TWIG_TEMPLATES_LOCATION]);
    }
}
