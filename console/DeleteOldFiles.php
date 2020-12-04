<?php namespace Observatby\FileSharingOnCdn\Console;

use Illuminate\Console\Command;
use Observatby\FileSharingOnCdn\Models\Link;
use Symfony\Component\Console\Input\InputArgument;

class DeleteOldFiles extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'filesharingoncdn:deleteoldfiles';

    /**
     * @var string The console command description.
     */
    protected $description = 'Delete links and files that were created/updated more than N days ago';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $days = $this->argument('days');
        $links = Link::where('updated_at', '<=', new \DateTimeImmutable("now - $days days"))
            ->get();
        $this->info(sprintf("Found %s links", $links->count()));

        $cnt = 0;
        foreach ($links as $link) {
            $link->delete();
            $cnt++;
        }
        $this->info(sprintf("Deleted %s links", $cnt));
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['days', InputArgument::REQUIRED, 'more than "days" days ago'],
        ];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
