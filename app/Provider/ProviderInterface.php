<?php

namespace Rush\Provider;

interface ProviderInterface
{
    /**
     *
     */
    public function __invoke(array $args = []);
}
