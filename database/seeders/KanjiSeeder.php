<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Kanji;

class KanjiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = base_path('KanjiN4.csv');
        if (!file_exists($filePath)) {
            $this->command->error("File KanjiN4.csv tidak ditemukan!");
            return;
        }

        Kanji::truncate();

        $file = fopen($filePath, "r");
        
        // Handle BOM UTF-8
        $bom = fread($file, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($file);
        }

        $rowCount = 0;
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            // CSV: Kanji, Onyomi, Kunyomi, Arti
            // Skip header if first column contains "kanji" or is not a single character kanji
            if ($rowCount === 0 && str_contains(strtolower($data[0]), 'kanji')) {
                $rowCount++;
                continue;
            }

            Kanji::create([
                'kanji' => $data[0] ?? '',
                'onyomi' => $data[1] ?? null,
                'kunyomi' => $data[2] ?? null,
                'arti' => $data[3] ?? '',
            ]);
            $rowCount++;
        }

        fclose($file);
        $this->command->info("Berhasil mengimpor " . ($rowCount > 0 ? $rowCount - 1 : 0) . " data Kanji!");
    }
}
