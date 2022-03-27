<?php
namespace Deployer;

require 'recipe/symfony.php';

set('console_options', function () {
    return '--no-interaction --env={{symfony_env}}';
});

task('deploy:vendors', function () {
    if (!commandExist('unzip')) {
        writeln('<comment>To speed up composer installation setup "unzip" command with PHP zip extension https://goo.gl/sxzFcD</comment>');
    }

    run('cd {{release_path}}/app && wget https://getcomposer.org/download/2.2.6/composer.phar -O composer.phar');
    run('cd {{release_path}}/app && {{bin/php}} composer.phar {{composer_options}} --no-cache');
});

task('prepare', function () {
    set('repository', 'https://github.com/ejjoj/sdiwpil-app.git');
    set('allow_anonymous_stats', false);
    set('ssh_type', 'native');
    set('ssh_multiplexing', true);
    set('writable_mode', 'chmod');
    set('dump_assets', false);
    set('branch', runLocally('git rev-parse --abbrev-ref HEAD'));

    $defaults = [
        'shared_files' => ['.env'],
        'shared_dirs' => [
            'var/logs',
            'var/sessions',
        ],
        'writable_dirs' => ['var'],
        'clear_paths' => [],
        'bin/node' => 'node',
        'bin/npm' => 'npm',
        'bin/yarn' => 'yarn',
        'fastcgi_pass' => 'unix:/run/php/php7.4-fpm.sock',
        'nginx_config_dst_filename' => '', // TODO
        'bin_dir' => 'bin',
        'var_dir' => 'var',
        'bin/console' => '{{release_path}}app/bin/console',
        'server_name' => '192.168.0.66',
        'parameters' => [
            'branch' => '{{branch}}',
            'router.request_context.host' => '{{server_name}}',
            'router.request_context.base_url' => '',
            'asset.request_context.base_path' => '%router.request_context.base_url%',
            'asset.request_context.secure' => true,
        ],
    ];

    foreach ($defaults as $key => $value) {
        set($key, $value);
    }
})
    ->desc('Update configuration')
    ->once();

task('configure:database:migration', function () {
    run('{{bin/console}} doctrine:migrations:migrate --allow-no-migration');
})
    ->desc('Database migrations');

task('deploy:assets:install', function () {
    run('{{bin/php}} {{bin/console}} assets:install {{console_options}} {{release_path}}/public');
})
    ->desc('Install bundle assets');

task('configure:database:cache_clear', function () {
    run('{{bin/php}} {{bin/console}} doctrine:cache:clear-metadata {{console_options}}');
    run('{{bin/php}} {{bin/console}} doctrine:cache:clear-query {{console_options}}');
    run('{{bin/php}} {{bin/console}} doctrine:cache:clear-result {{console_options}}');
})
    ->desc('Database cache clear');

task('configure:webpack', function () {
    invoke('prepare');

    run('{{bin/console}} fos:js-routing:dump --format=json --target={{release_path}}/app/public/js/fos_js_routes.json');
    run('cd {{release_path}} && {{bin/yarn}} install --production');
    run('cd {{release_path}} && {{bin/npm}} run-script build');
})
    ->desc('Configure webpack');

task('configure:cache:clear', function () {
    run('{{bin/php}} {{bin/console}} cache:clear {{console_options}} --no-warmup');
})
    ->desc('Clear cache');

task('configure:cache:warmup', function () {
    run('{{bin/php}} {{bin/console}} cache:warmup {{console_options}}');
})
    ->desc('Warm up cache');

after('deploy:failed', 'deploy:unlock');
