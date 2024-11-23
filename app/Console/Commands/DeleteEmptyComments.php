<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Comment;

class DeleteEmptyComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comments:delete-empty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes comments with empty content fields';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

    // Fetch comments with empty content
    $emptyComments = Comment::whereNull('content')->orWhere('content', '')->get();

    if ($emptyComments->isEmpty()) {
        $this->info('No empty comments found.');
        return Command::SUCCESS;
    }

    // Count comments to be deleted
    $count = $emptyComments->count();

    // Delete the comments
    Comment::whereNull('content')->orWhere('content', '')->delete();

    // Display success message
    $this->info("Successfully deleted {$count} empty comment(s).");

        return Command::SUCCESS;
    }
}
