<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DataSeeder extends Seeder
{
    public function run(): void
    {
        ini_set('memory_limit', '2G'); // tambah limit memori

        $faker = Faker::create();

        // Bisa dikurangi untuk development cepat
        $authorsCount   = 1000;
        $categoriesCount = 3000;
        $booksCount     = 100000;
        $ratingsCount   = 500000;

        /** ==============================
         *  1. AUTHORS
         *  ============================== */
        $this->command->info('Seeding authors...');
        foreach (range(1, ceil($authorsCount / 1000)) as $batch) {
            $data = [];
            for ($i = 0; $i < 1000 && (($batch - 1) * 1000 + $i) < $authorsCount; $i++) {
                $data[] = [
                    'name' => $faker->name,
                    'bio'  => $faker->sentence(12),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('authors')->insert($data);
        }

        /** ==============================
         *  2. CATEGORIES
         *  ============================== */
        $this->command->info('Seeding categories...');
        foreach (range(1, ceil($categoriesCount / 1000)) as $batch) {
            $data = [];
            for ($i = 0; $i < 1000 && (($batch - 1) * 1000 + $i) < $categoriesCount; $i++) {
                $data[] = [
                    'name' => ucfirst($faker->words(2, true)) . ' Category',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('categories')->insert($data);
        }

        /** ==============================
         *  3. BOOKS
         *  ============================== */
        $this->command->info('Seeding books...');
        $authorIds   = DB::table('authors')->pluck('id')->toArray();
        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        foreach (range(1, ceil($booksCount / 1000)) as $batch) {
            $data = [];
            for ($i = 0; $i < 1000 && (($batch - 1) * 1000 + $i) < $booksCount; $i++) {
                $data[] = [
                    'title' => $faker->sentence(3),
                    'author_id' => $faker->randomElement($authorIds),
                    'category_id' => $faker->randomElement($categoryIds),
                    'description' => $faker->paragraph(2),
                    'published_at' => $faker->dateTimeBetween('-10 years', 'now'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('books')->insert($data);
            unset($data);
        }

        /** ==============================
         *  4. RATINGS
         *  ============================== */
        $this->command->info('Seeding ratings...');
        $totalBooks = DB::table('books')->count();
        $chunkSize = 2000;
        $now = Carbon::now();

        for ($i = 0; $i < $ratingsCount; $i += $chunkSize) {
            $ratings = [];
            for ($j = 0; $j < $chunkSize && ($i + $j) < $ratingsCount; $j++) {
                $ratings[] = [
                    'book_id' => rand(1, $totalBooks),
                    'voter_name' => $faker->name,
                    'score' => $faker->numberBetween(1, 10),
                    'created_at' => $now->copy()->subSeconds(rand(0, 1000000))->toDateTimeString(),
                    'updated_at' => $now->toDateTimeString(),
                ];
            }
            DB::table('ratings')->insert($ratings);
            unset($ratings);
        }

        $this->command->info('All seeding complete!');
    }
}
