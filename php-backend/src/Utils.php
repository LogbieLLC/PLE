<?php

declare(strict_types=1);

namespace PLEPHP;

/**
 * Normalize a PLE ID by converting to uppercase and trimming whitespace
 *
 * @param string $pleId The PLE ID to normalize
 * @return string The normalized PLE ID
 */
function normalizeId(string $pleId): string
{
    return strtoupper(trim($pleId));
}
