<?php

namespace Deployer;

use RuntimeException;

task('prepare:verify-branch',
    function () {
        $gitUpdateIndex = exec('git update-index --refresh');
        if ($gitUpdateIndex) {
            throw new RuntimeException(
                'You have the uncommitted changes.'
                . ' Please ensure they are pushed to the repository.'
            );
        }

        $gitHashLocal = exec('git rev-parse HEAD');
        $gitHashOrigin = exec('git rev-parse origin/$(git branch --show-current)');
        if ($gitHashLocal !== $gitHashOrigin) {
            throw new RuntimeException(
                'Your local branch and the origin are different.'
                . ' Please ensure all the changes are fetched from and pushed to the repository.'
            );
        }
    }
)
    ->desc('Check if your local branch and the origin are the same');
