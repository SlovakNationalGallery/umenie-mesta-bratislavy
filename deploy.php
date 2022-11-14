<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config
set('bin/php', 'php8.1');

set(
    'repository',
    'git@github.com:SlovakNationalGallery/umenie-mesta-bratislavy.git'
);
add('shared_dirs', ['resources/fonts']);

// Hosts
host('webumenia.sk')
    ->set('hostname', 'webumenia.sk')
    ->set('remote_user', 'lab_sng')
    ->set('deploy_path', '/var/www/umenie-mesta-bratislavy')
    ->set('forward_agent', true);

// Tasks
task('build', function () {
    cd('{{release_path}}');

    run(
        'source "$HOME/.nvm/nvm.sh" && nvm use 16.16.0 && npm ci && npm run build'
    );
});

// Hooks
before('artisan:migrate', 'artisan:cache:clear');
after('deploy:vendors', 'build');
after('deploy:symlink', 'artisan:queue:restart');
after('deploy:failed', 'deploy:unlock');
