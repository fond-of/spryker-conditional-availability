<?php

namespace FondOfSpryker\Zed\ConditionalAvailability\Business\Model;

use Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer;

class ConditionalAvailabilityPluginExecutor implements ConditionalAvailabilityPluginExecutorInterface
{
    /**
     * @var array
     */
    protected $conditionalAvailabilityPostSavePlugins;

    /**
     * @var array|\FondOfSpryker\Zed\ConditionalAvailabilityExtension\Dependency\Plugin\ConditionalAvailabilityHydrationPluginInterface[]
     */
    protected $conditionalAvailabilityHydrationPlugins;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailabilityExtension\Dependency\Plugin\ConditionalAvailabilityPostSavePluginInterface[] $conditionalAvailabilityPostSavePlugins
     * @param \FondOfSpryker\Zed\ConditionalAvailabilityExtension\Dependency\Plugin\ConditionalAvailabilityHydrationPluginInterface[] $conditionalAvailabilityHydrationPlugins
     */
    public function __construct(
        array $conditionalAvailabilityPostSavePlugins,
        array $conditionalAvailabilityHydrationPlugins
    ) {
        $this->conditionalAvailabilityPostSavePlugins = $conditionalAvailabilityPostSavePlugins;
        $this->conditionalAvailabilityHydrationPlugins = $conditionalAvailabilityHydrationPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function executePostSavePlugins(
        ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
    ): ConditionalAvailabilityResponseTransfer {
        foreach ($this->conditionalAvailabilityPostSavePlugins as $conditionalAvailabilityPostSavePlugin) {
            $conditionalAvailabilityResponseTransfer = $conditionalAvailabilityPostSavePlugin
                ->postSave($conditionalAvailabilityResponseTransfer);
        }

        return $conditionalAvailabilityResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityResponseTransfer
     */
    public function executeHydrationPlugins(
        ConditionalAvailabilityResponseTransfer $conditionalAvailabilityResponseTransfer
    ): ConditionalAvailabilityResponseTransfer {
        foreach ($this->conditionalAvailabilityHydrationPlugins as $conditionalAvailabilityHydrationPlugin) {
            $conditionalAvailabilityResponseTransfer = $conditionalAvailabilityHydrationPlugin
                ->hydrate($conditionalAvailabilityResponseTransfer);
        }

        return $conditionalAvailabilityResponseTransfer;
    }
}
