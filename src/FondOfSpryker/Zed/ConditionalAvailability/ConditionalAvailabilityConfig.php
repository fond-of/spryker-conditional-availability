<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ConditionalAvailability;

use Spryker\Zed\Search\SearchConfig;

class ConditionalAvailabilityConfig extends SearchConfig
{
    /**
     * @return string
     */
    public function getClassTargetDirectory(): string
    {
        return APPLICATION_SOURCE_DIR . '/Generated/Shared/ConditionalAvailability/Search/';
    }

    /**
     * @return string[]
     */
    public function getJsonIndexDefinitionDirectories(): array
    {
        $directories = [];

        $fondOfSprykerSharedGlobPattern = APPLICATION_ROOT_DIR . '/vendor/fond-of-spryker/*/src/*/Shared/*/ConditionalAvailabilityMap/';
        if (\glob($fondOfSprykerSharedGlobPattern)) {
            $directories[] = $fondOfSprykerSharedGlobPattern;
        }

        return $directories;
    }
}
