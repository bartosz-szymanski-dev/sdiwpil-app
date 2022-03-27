<?php
namespace Deployer;

require 'recipe/symfony.php';

set('console_options', function () {
    return '--no-interaction --env={{symfony_env}}';
});

task('deploy', ['install', 'configure', 'link']);

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
        'shared_files' => ['app/.env'],
        'shared_dirs' => [
            'var/logs',
            'var/sessions',
        ],
        'writable_dirs' => ['var'],
        'clear_paths' => [],
        'bin/node' => 'node',
        'bin/npm' => 'npm',
        'bin/yarn' => 'yarn',
        'symfony_cli' => 'symfony',
        'fastcgi_pass' => 'unix:/run/php/php7.4-fpm.sock',
        'nginx_config_dst_filename' => '', // TODO
        'bin_dir' => 'bin',
        'var_dir' => 'var',
        'bin/console' => '{{release_path}}/app/bin/console',
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

task('configure:database:migrate', function () {
    run('{{symfony_cli}} doctrine:migrations:migrate --allow-no-migration');
})
    ->desc('Database migrations');

task('deploy:assets:install', function () {
    run('{{symfony_cli}} assets:install {{console_options}} /public');
})
    ->desc('Install bundle assets');

task('configure:database:cache_clear', function () {
    run('{{symfony_cli}} doctrine:cache:clear-metadata {{console_options}}');
    run('{{symfony_cli}} doctrine:cache:clear-query {{console_options}}');
    run('{{symfony_cli}} doctrine:cache:clear-result {{console_options}}');
})
    ->desc('Database cache clear');

task('configure:webpack', function () {
    invoke('prepare');

    run('{{symofny_cli}} fos:js-routing:dump --format=json --target={{release_path}}/app/public/js/fos_js_routes.json');
    run('cd {{release_path}} && {{bin/yarn}} install --production');
    run('cd {{release_path}} && {{bin/npm}} run-script build');
})
    ->desc('Configure webpack');

task('configure:cache:clear', function () {
    run('{{bin/php}} {{symfony_cli}} cache:clear {{console_options}} --no-warmup');
})
    ->desc('Clear cache');

task('configure:cache:warmup', function () {
    run('{{bin/php}} {{symfony_cli}} cache:warmup {{console_options}}');
})
    ->desc('Warm up cache');

task('install', function () {
   invoke('prepare');

   $tasks = [
       'deploy:info',
       'deploy:prepare',
       'deploy:lock',
       'deploy:release',
       'deploy:update_code',
       'deploy:shared',
       'deploy:writable',
       'deploy:vendors',
   ];

   foreach ($tasks as $task) {
       invoke($task);
   }
})
    ->desc('Install project');

task('configure', function () {
    invoke('prepare');

    $tasks = [
        'configure:database:cache_clear',
        'configure:database:migrate',
        'deploy:assets:install',
        'configure:webpack',
        'configure:cache:clear',
        'configure:cache:warmup',
    ];

    foreach ($tasks as $task) {
        invoke($task);
    }
})
    ->desc('Configure project');

task('link', function () {
    invoke('prepare');

    $tasks = [
        'deploy:unlock',
        'cleanup',
    ];

    foreach ($tasks as $task) {
        invoke($task);
    }
})
    ->desc('Link project');

after('deploy:failed', 'deploy:unlock');
