<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(env('SKIP_MIGRATION') == 'true') {
            return;
        }
        $jsonFilePath = database_path('data/books.json');

        if (file_exists($jsonFilePath)) {
            $this->seedFromJSON($jsonFilePath);
        }
        $this->setSequence();
    }

    /**
     * Parse the JSON file and insert data.
     *
     * @param string $filePath
     * @return void
     */
    private function seedFromJSON($filePath)
    {
        // Read the JSON file contents
        $jsonData = file_get_contents($filePath);

        // Decode JSON to associative array
        $records = json_decode($jsonData, true);

        // Insert each record into the database
        foreach ($records as $record) {
            DB::table('books')->insert([
                'id' => $record['id'],
                'author' => $record['author'],
                'title' => $record['title'],
                'publish_date' => $record['publish_date'],
                'isbn' => $record['isbn'],
                'summary' => $record['summary'],
                'price' => $record['price'],
                'on_store' => $record['on_store'],
                'created_at' => $record['created_at'],
                'updated_at' => $record['updated_at']
            ]);
        }
    }

     /**
     * Set the sequence value for the books table.
     *
     * @return void
     */
    private function setSequence()
    {
        DB::statement("SELECT setval('books_id_seq', (SELECT MAX(id) FROM books))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
