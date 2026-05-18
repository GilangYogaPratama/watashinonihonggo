<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paragraph;
use App\Models\Kotoba;

class ParagraphController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query('mode') === 'dynamic') {
            $dynamicParagraph = $this->generateDynamicParagraph();
            // Prepend the dynamic paragraph so it shows up as FEED_01
            $paragraphs = collect([$dynamicParagraph])->merge(Paragraph::all());
        } else {
            $paragraphs = Paragraph::all();
        }
        
        return view('reading', compact('paragraphs'));
    }

    private function generateDynamicParagraph()
    {
        // Define grammatical pools to query from the DB
        $placeWords = ['えき', 'スーパー', 'えいがかん', 'こうえん', 'としょかん', 'まち', 'うみ', 'やま', 'だいがく', 'かいしゃ'];
        $vehicleWords = ['くるま', 'でんしゃ', 'ちかてつ', 'バス', 'ひこうき', 'じてんしゃ', 'タクシー'];
        $foodWords = ['パン', 'ごはん', 'にく', 'さかな', 'やさい', 'くだもの', 'ラーメン', 'すし'];
        $verbWords = ['たべます', 'のみます', 'みます', 'かいます', 'よみます', 'べんきょうします', 'あそびます'];
        $adjIWords = ['おいしい', 'おおきい', 'ちいさい', 'あたらしい', 'ふるい', 'たかい', 'やすい', 'あつい', 'さむい', 'たのしい'];
        $adjNaWords = ['きれい', 'しずか', 'にぎやか', 'ゆうめい', 'べんり', 'げんき', 'ひま'];

        // Helper to get random Kotoba from DB
        $getRand = function($pool) {
            $k = Kotoba::whereIn('japanese', $pool)->inRandomOrder()->first();
            if (!$k) {
                // Fallback if not found in DB
                return (object)['japanese' => $pool[array_rand($pool)], 'kanji' => '—', 'arti_indonesia' => $pool[0]];
            }
            return $k;
        };

        // Fetch our random words
        $place = $getRand($placeWords);
        $vehicle = $getRand($vehicleWords);
        $food = $getRand($foodWords);
        $actionVerb = $getRand($verbWords);
        $adjI = $getRand($adjIWords);
        $adjNa = $getRand($adjNaWords);

        // HTML formatting helper (adds Ruby and color classes)
        $fmt = function($k, $class) {
            $word = ($k->kanji && $k->kanji !== '—' && $k->kanji !== '-') ? "<ruby>{$k->kanji}<rt>{$k->japanese}</rt></ruby>" : $k->japanese;
            return "<span class=\"{$class}\">{$word}</span>";
        };

        $htmlPlace = $fmt($place, 'highlight-noun');
        $htmlVehicle = $fmt($vehicle, 'highlight-noun');
        $htmlFood = $fmt($food, 'highlight-noun');
        $htmlVerb = $fmt($actionVerb, 'highlight-verb');
        $htmlAdjI = $fmt($adjI, 'highlight-adj-i');
        $htmlAdjNa = $fmt($adjNa, 'highlight-adj-na');
        
        $htmlIkimashita = "<span class=\"highlight-verb\"><ruby>行<rt>い</rt></ruby>きました</span>";
        $htmlSoshite = "<span class=\"highlight-bunpo\">そして</span>";
        $htmlKara = "<span class=\"highlight-bunpo\">から</span>";

        // Construct Story HTML
        $contentHtml = "昨日の朝、私は{$htmlVehicle}で{$htmlAdjNa}な{$htmlPlace}へ{$htmlIkimashita}。{$htmlPlace}はとても{$htmlAdjI}です。{$htmlSoshite}、そこで{$htmlFood}を{$htmlVerb}。とても楽しかったです。";

        // Construct Translation
        $indPlace = strtolower($place->arti_indonesia);
        $indVehicle = strtolower($vehicle->arti_indonesia);
        $indFood = strtolower($food->arti_indonesia);
        $indVerb = strtolower($actionVerb->arti_indonesia);
        $indAdjI = strtolower($adjI->arti_indonesia);
        $indAdjNa = strtolower($adjNa->arti_indonesia);

        $translation = "Kemarin pagi, saya pergi ke {$indPlace} yang {$indAdjNa} menggunakan {$indVehicle}. {$place->arti_indonesia} tersebut sangat {$indAdjI}. Kemudian, di sana saya {$indVerb} {$indFood}. Sangat menyenangkan.";

        // Procedural Questions (In Japanese)
        
        // Helper to get 3 unique distractors that are not the correct answer
        $getDistractors = function($pool, $correctWord) {
            $filtered = array_filter($pool, function($w) use ($correctWord) { return $w !== $correctWord; });
            shuffle($filtered);
            return array_slice($filtered, 0, 3);
        };

        $placeDistractors = $getDistractors($placeWords, $place->japanese);
        $vehicleDistractors = $getDistractors($vehicleWords, $vehicle->japanese);
        
        $questions = [
            [
                'question_text' => "昨日の朝、筆者はどこへ行きましたか。",
                'options' => [
                    "{$place->japanese}へ行きました",
                    "{$placeDistractors[0]}へ行きました",
                    "{$placeDistractors[1]}へ行きました",
                    "{$placeDistractors[2]}へ行きました"
                ],
                'correct_index' => 0,
                'explanation' => "本文には「{$place->japanese}へ行きました」と書いてあります。"
            ],
            [
                'question_text' => "筆者は何でそこへ行きましたか。",
                'options' => [
                    "{$vehicle->japanese}で行きました",
                    "{$vehicleDistractors[0]}で行きました",
                    "{$vehicleDistractors[1]}で行きました",
                    "{$vehicleDistractors[2]}で行きました"
                ],
                'correct_index' => 0,
                'explanation' => "本文には「{$vehicle->japanese}で...行きました」と書いてあります。"
            ],
            [
                'question_text' => "筆者はそこで何をしましたか。",
                'options' => [
                    "古い友達に会いました",
                    "{$food->japanese}を{$actionVerb->japanese}",
                    "朝早く走りました",
                    "よく寝ました"
                ],
                'correct_index' => 1,
                'explanation' => "本文には「{$food->japanese}を{$actionVerb->japanese}」と書いてあります。"
            ]
        ];

        // Shuffle options to ensure correct index isn't always 0 or 1
        foreach ($questions as &$q) {
            $correctOpt = $q['options'][$q['correct_index']];
            $opts = $q['options'];
            shuffle($opts);
            $q['options'] = $opts;
            $q['correct_index'] = array_search($correctOpt, $opts);
        }

        return new Paragraph([
            'title' => 'DYNAMIC: 昨日の出来事 (Sesi Acak)',
            'content_html' => $contentHtml,
            'translation' => $translation,
            'questions' => $questions
        ]);
    }
}
