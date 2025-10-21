<?php

namespace Bng\Base\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('bng:publish:assets', 'Publish assets (CSS, JS, Images...)')]
class PublishAssetsCommand extends Command
{
  public function handle(): int
  {
    $this->components->info('Publishing core, packages, plugins assets...');
    $this->call('vendor:publish', ['--tag' => 'bng-public', '--force' => true]);

    $this->components->info('Published assets successfully!');

    return self::SUCCESS;
  }
}
