<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kotoba;

class KotobaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = base_path('KotobaN4.csv');
        if (!file_exists($filePath)) {
            $this->command->error("File KotobaN4.csv tidak ditemukan!");
            return;
        }

        // Matikan pengamanan sementara
        Kotoba::truncate();

        $file = fopen($filePath, "r");
        
        // Handle BOM (Byte Order Mark) UTF-8
        $bom = fread($file, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($file);
        }

        $rowCount = 0;
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            // CSV: Bab, Japanese, Kanji, Arti Indonesia
            // Lewati header jika ada
            if ($rowCount === 0 && (str_contains(strtolower($data[0]), 'bab') || !is_numeric($data[0]))) {
                $rowCount++;
                continue;
            }

            Kotoba::create([
                'bab' => $data[0] ?? null,
                'japanese' => $data[1] ?? '',
                'kanji' => $data[2] ?? null,
                'arti_indonesia' => $data[3] ?? '',
            ]);
            $rowCount++;
        }

        fclose($file);
        
        $this->command->info("Berhasil mengimpor " . ($rowCount > 0 ? $rowCount - 1 : 0) . " data Kotoba!");
    }
}
