<?php

namespace really4you\Xingwen\Contracts;

/**
 * Interface StrategyInterface.
 */
interface StrategyInterface
{
    /**
     * Apply the strategy
     *
     * @return mixed
     */
    public function send();
}