<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDB extends Command
{
    protected $signature = 'db:create-bookstore';
    protected $description = 'Create the bookstore database';

    public function handle()
    {
        // Temporarily switch to 'postgres' database to create a new database
        config(['database.connections.pgsql.database' => 'postgres']);

        $databaseName = 'bookstore';

        // Check if the database exists
        $exists = DB::select("SELECT 1 FROM pg_database WHERE datname = ?", [$databaseName]);

        if (empty($exists)) {
            // Create the database
            DB::statement("CREATE DATABASE \"{$databaseName}\"");
            $this->info("Database '{$databaseName}' created successfully.");
        } else {
            $this->info("Database '{$databaseName}' already exists.");
        }

        // Restore original database connection from the .env file
        config(['database.connections.pgsql.database' => env('DB_DATABASE')]);
    }
}
