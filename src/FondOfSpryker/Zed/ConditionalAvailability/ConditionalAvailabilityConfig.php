<?php

namespace FondOfSpryker\Zed\ConditionalAvailability;

use Spryker\Zed\Kernel\AbstractBundleConfig;

use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants as SearchConstants;

class ConditionalAvailabilityConfig extends \Spryker\Zed\Search\SearchConfig
{
    /**
     * @return string
     */
    public function getClassTargetDirectory()
    {
        return APPLICATION_SOURCE_DIR . '/Generated/Shared/ConditionalAvailability/Search/';
    }

    /**
     * @return array
     */
    public function getJsonIndexDefinitionDirectories()
    {
        $directories = [];

        $fondOfSprykerSharedGlobPattern = APPLICATION_ROOT_DIR . '/vendor/fond-of-spryker/*/src/*/Shared/*/ConditionalAvailabilityMap/';
        if (\glob($fondOfSprykerSharedGlobPattern)) {
            $directories[] = $fondOfSprykerSharedGlobPattern;
        }

        return $directories;
    }
}
