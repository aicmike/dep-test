<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'application');

// Project repository
set('repository', 'git@github.com:aicmike/dep-test.git');

// [Optional] Allocate tty for git clone. Default value is false.
//set('git_tty', true);

// Shared files/dirs between deploys
set('shared_files', ['upload/1.txt']);
set('shared_dirs', ['upload_dir']);

// Writable dirs by web server
set('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('nevermike.ru')
	->user('nevermike')
    ->set('deploy_path', '~/{{application}}');


// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');


//host('nevermike.ru')
//	->user('nevermike')
//	->stage('production')
//	->set('deploy_path', '/home/n/nevermike');
//
//set('shared_files', ['shared/1.txt']);
//
//task('test', function () {
//	writeln('Hello world');
//});
//
//task('pwd', function () {
//	$result = run('pwd');
//	writeln("Current dir: $result");
//});