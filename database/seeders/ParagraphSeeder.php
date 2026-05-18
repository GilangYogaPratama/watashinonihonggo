<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paragraph;

class ParagraphSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paragraph::truncate();

        Paragraph::create([
            'title' => '私の町の一年 (Satu Tahun di Kota Saya)',
            'content_html' => '私の<span class="highlight-noun"><ruby>町<rt>まち</rt></ruby></span>は、<span class="highlight-adj-na"><ruby>静<rt>しず</rt></ruby>か</span>ですが、とても<span class="highlight-adj-i"><ruby>美<rt>うつく</rt>し</ruby>い</span>ところです。<span class="highlight-noun"><ruby>春<rt>はる</rt></ruby></span>になると、たくさんの<span class="highlight-noun"><ruby>桜<rt>さくら</rt></ruby>の<ruby>花<rt>はな</rt></ruby></span>が<span class="highlight-verb"><ruby>咲<rt>さ</rt></ruby>いて</span>、<span class="highlight-adj-na"><ruby>綺麗<rt>きれい</rt></ruby></span>になります。<span class="highlight-noun"><ruby>夏<rt>なつ</rt></ruby></span>には、<span class="highlight-adj-i"><ruby>暑<rt>あつ</rt></ruby>い</span><span class="highlight-noun"><ruby>日<rt>ひ</rt></ruby></span>が<span class="highlight-verb"><ruby>続<rt>つづ</rt></ruby>きます</span>が、みんなで<span class="highlight-noun"><ruby>海<rt>うみ</rt></ruby></span>へ<span class="highlight-verb"><ruby>行<rt>い</rt></ruby>って</span><span class="highlight-verb"><ruby>泳<rt>およ</rt></ruby>ぎます</span>。<span class="highlight-noun"><ruby>秋<rt>あき</rt></ruby></span>は<span class="highlight-noun"><ruby>山<rt>やま</rt></ruby></span>が<span class="highlight-noun"><ruby>赤<rt>あか</rt></ruby></span>や<span class="highlight-noun"><ruby>黄色<rt>きいろ</rt></ruby></span>に<span class="highlight-verb"><ruby>変<rt>か</rt></ruby>わって</span>、とても<span class="highlight-adj-i"><ruby>綺麗<rt>きれい</rt></ruby></span>です。<span class="highlight-noun"><ruby>冬<rt>ふゆ</rt></ruby></span>は<span class="highlight-adj-i"><ruby>寒<rt>さむ</rt></ruby>く</span>なりますが、ときどき<span class="highlight-noun"><ruby>雪<rt>ゆき</rt></ruby></span>が<span class="highlight-verb"><ruby>降<rt>ふる</rt></ruby><span class="highlight-bunpo">ことがあります</span></span>。<span class="highlight-noun"><ruby>雪<rt>ゆき</rt></ruby>の<ruby>日<rt>ひ</rt></ruby></span>に、<span class="highlight-noun"><ruby>子供<rt>こども</rt></ruby>たち</span>は<span class="highlight-noun"><ruby>公園<rt>こうえん</rt></ruby></span>で<span class="highlight-verb"><ruby>遊<rt>あそ</rt></ruby>ぶ<span class="highlight-bunpo">のが好きです</span></span>。',
            'translation' => 'Kota saya tenang, tetapi tempat yang sangat indah. Ketika musim semi tiba, banyak bunga sakura mekar, dan suasananya menjadi cantik. Pada musim panas, hari-hari yang panas terus berlanjut, tetapi kami semua pergi ke laut untuk berenang. Di musim gugur, gunung-gunung berubah warna menjadi merah dan kuning, sangat indah. Di musim dingin udaranya menjadi dingin, tetapi terkadang salju bisa turun. Pada hari bersalju, anak-anak suka bermain di taman.',
            'questions' => [
                [
                    'question_text' => '筆者の町はどんな町ですか。',
                    'options' => [
                        '静かですが、とても美しい町',
                        'にぎやかで、うるさい町',
                        '一年中、雪が降る町',
                        '地下鉄の駅に近い町'
                    ],
                    'correct_index' => 0,
                    'explanation' => '本文の最初に「私の町は、静かですが、とても美しいところです」と書いてあります。'
                ],
                [
                    'question_text' => '夏には、みんなでどこへ行きますか。',
                    'options' => [
                        '公園へ桜を見に行きます',
                        '高い山へ行きます',
                        '海へ行って泳ぎます',
                        '雪だるまを作ります'
                    ],
                    'correct_index' => 2,
                    'explanation' => '「夏には」の文に「みんなで海へ行って泳ぎます」と書いてあります。'
                ],
                [
                    'question_text' => '雪の日に、子供たちはどこで遊ぶのが好きですか。',
                    'options' => [
                        '暖かい部屋の中',
                        '公園',
                        '海の近く',
                        '学校の図書館'
                    ],
                    'correct_index' => 1,
                    'explanation' => '最後の文に「雪の日に、子供たちは公園で遊ぶのが好きです」と書いてあります。'
                ]
            ]
        ]);

        Paragraph::create([
            'title' => '日曜日の予定 (Rencana Hari Minggu)',
            'content_html' => '<span class="highlight-noun"><ruby>日曜日<rt>にちようび</rt></ruby></span>に、私は<span class="highlight-noun"><ruby>友達<rt>ともだち</rt></ruby></span>と<span class="highlight-noun"><ruby>映画<rt>えいが</rt></ruby></span>を<span class="highlight-verb"><ruby>見<rt>み</rt></ruby>に<span class="highlight-bunpo">行くことにしました</span></span>。<span class="highlight-noun"><ruby>午前中<rt>ごぜんちゅう</rt></ruby></span>は、<span class="highlight-noun"><ruby>部屋<rt>へや</rt></ruby></span>を<span class="highlight-verb"><ruby>掃除<rt>そうじ</rt></ruby>して</span>、<span class="highlight-noun"><ruby>日本語<rt>にほんご</rt></ruby></span>の<span class="highlight-noun"><ruby>宿題<rt>しゅくだい</rt></ruby></span>を<span class="highlight-verb"><ruby>終<rt>お</rt></ruby>わらせる<span class="highlight-bunpo">つもりです</span></span>。<span class="highlight-noun"><ruby>午後<rt>ごご</rt></ruby></span>の<span class="highlight-noun"><ruby>二時<rt>にじ</rt></ruby></span>に、<span class="highlight-noun"><ruby>駅<rt>えき</rt></ruby></span>で<span class="highlight-noun"><ruby>友達<rt>ともだち</rt></ruby></span>と<span class="highlight-verb"><ruby>会<rt>あ</rt></ruby>う<span class="highlight-bunpo">予定です</span></span>。<span class="highlight-adj-i"><ruby>新<rt>あたら</rt>しい</ruby></span><span class="highlight-noun"><ruby>映画館<rt>えいがかん</rt></ruby></span>は、とても<span class="highlight-adj-na"><ruby>有名<rt>ゆうめい</rt></ruby></span>で、<span class="highlight-adj-i"><ruby>広<rt>ひろ</rt>い</ruby></span>です。<span class="highlight-noun"><ruby>映画<rt>えいが</rt></ruby></span>を<span class="highlight-verb"><ruby>見<rt>み</rt></ruby>た</span><span class="highlight-bunpo">あとで</span>、<span class="highlight-adj-i"><ruby>美味<rt>おい</rt>しい</ruby></span><span class="highlight-noun">ラーメン</span>を<span class="highlight-verb"><ruby>食<rt>た</rt></ruby>べながら</span>、日本語で<span class="highlight-verb"><ruby>話<rt>はな</rt></ruby>しましょう</span>。<span class="highlight-noun"><ruby>夜<rt>よる</rt></ruby></span>は<span class="highlight-adj-i"><ruby>遅<rt>おそ</rt>く</ruby></span>ならないように、<span class="highlight-noun"><ruby>八時<rt>はちじ</rt></ruby></span>には<span class="highlight-noun"><ruby>家<rt>うち</rt></ruby></span>へ<span class="highlight-verb"><ruby>帰<rt>かえ</rt></ruby>る<span class="highlight-bunpo">はずです</span></span>。',
            'translation' => 'Pada hari Minggu, saya memutuskan untuk pergi menonton film bersama teman saya. Di pagi hari, saya berniat membersihkan kamar dan menyelesaikan pekerjaan rumah bahasa Jepang saya. Di sore hari pukul dua, rencananya saya akan bertemu dengan teman saya di stasiun. Bioskop baru itu sangat terkenal dan luas. Setelah menonton film, mari kita berbicara dalam bahasa Jepang sambil makan ramen yang lezat. Agar tidak kemalaman, saya seharusnya sudah pulang ke rumah pada jam delapan malam.',
            'questions' => [
                [
                    'question_text' => '筆者は午前中に何をしますか。',
                    'options' => [
                        '新しい本を買いに行きます',
                        '部屋を掃除して、宿題を終わらせます',
                        '映画館で映画を見ます',
                        '美味しいラーメンを作ります'
                    ],
                    'correct_index' => 1,
                    'explanation' => '本文に「午前中は、部屋を掃除して、日本語の宿題を終わらせるつもりです」と書いてあります。'
                ],
                [
                    'question_text' => '筆者は何時にどこで友達と会う予定ですか。',
                    'options' => [
                        '午後の二時に、駅で会います',
                        '朝の八時に、映画館で会います',
                        '夜の八時に、ラーメン屋で会います',
                        '昼の十二時に、図書館で会います'
                    ],
                    'correct_index' => 0,
                    'explanation' => '本文に「午後の二時に、駅で友達と会う予定です」と書いてあります。'
                ],
                [
                    'question_text' => '筆者はどうして八時に家へ帰るはずですか。',
                    'options' => [
                        '映画が八時から始まるからです',
                        'ラーメン屋が八時に閉まるからです',
                        '夜は遅くならないようにするためです',
                        '友達が日本語のクラスに行くからです'
                    ],
                    'correct_index' => 2,
                    'explanation' => '本文に「夜は遅くならないように、八時には家へ帰るはずです」と書いてあります。'
                ]
            ]
        ]);

        Paragraph::create([
            'title' => '健康的な生活 (Gaya Hidup Sehat)',
            'content_html' => '<span class="highlight-noun"><ruby>健康<rt>けんこう</rt></ruby>的</span>な<span class="highlight-noun"><ruby>生活<rt>せいかつ</rt></ruby></span>を<span class="highlight-verb"><ruby>送<rt>おく</rt></ruby>る</span><span class="highlight-bunpo">ためには</span>、<span class="highlight-adj-i"><ruby>良<rt>よ</rt>い</ruby></span><span class="highlight-noun"><ruby>習慣<rt>しゅうかん</rt></ruby></span>を<span class="highlight-verb"><ruby>持<rt>も</rt></ruby>つ<span class="highlight-bunpo">ことが大切です</span></span>。<span class="highlight-noun"><ruby>毎日<rt>まいにち</rt></ruby></span>、<span class="highlight-noun"><ruby>野菜<rt>やさい</rt></ruby></span>や<span class="highlight-noun"><ruby>果物<rt>くだもの</rt></ruby></span>を<span class="highlight-verb"><ruby>食<rt>た</rt></ruby>べた</span><span class="highlight-bunpo">ほうがいいです</span>。また、<span class="highlight-noun"><ruby>水<rt>みず</rt></ruby></span>をたくさん<span class="highlight-verb"><ruby>飲<rt>の</rt></ruby>む<span class="highlight-bunpo">ようにしてください</span></span>。<span class="highlight-noun"><ruby>運動<rt>うんどう</rt></ruby></span>も<span class="highlight-adj-na"><ruby>必要<rt>ひつよう</rt></ruby></span>です。<span class="highlight-noun"><ruby>一週間に三回<rt>いっしゅうかんにさんかい</rt></ruby></span>は<span class="highlight-verb"><ruby>走<rt>はし</rt>ったり</span>、<span class="highlight-verb"><ruby>泳<rt>およ</rt>いだり<span class="highlight-bunpo">します</span></span>。<span class="highlight-noun"><ruby>睡眠<rt>すいみん</rt></ruby></span>もとても<span class="highlight-adj-na"><ruby>大切<rt>たいせつ</rt></ruby></span>です。<span class="highlight-noun"><ruby>夜<rt>よる</rt></ruby></span>は<span class="highlight-noun"><ruby>八時間<rt>はちじかん</rt></ruby></span><span class="highlight-verb"><ruby>眠<rt>ねむ</rt></ruby>る<span class="highlight-bunpo">ようにしましょう</span></span>。<span class="highlight-adj-i"><ruby>忙<rt>いそが</rt>しく</span>ても、自分の<span class="highlight-noun"><ruby>体<rt>からだ</rt></ruby></span>を<span class="highlight-verb"><ruby>休<rt>やす</rt></ruby>める</span>のをおろそかにしては<span class="highlight-verb">いけません</span>。',
            'translation' => 'Untuk menjalani kehidupan yang sehat, memiliki kebiasaan baik adalah hal yang penting. Sebaiknya Anda makan sayur dan buah-buahan setiap hari. Selain itu, tolong usahakan untuk meminum air yang banyak. Olahraga juga sangat diperlukan. Setidaknya tiga kali dalam seminggu, lakukan aktivitas seperti berlari atau berenang. Tidur juga sangat penting. Di malam hari, mari kita usahakan untuk tidur selama delapan jam. Meskipun sibuk, Anda tidak boleh lalai untuk mengistirahatkan tubuh Anda.',
            'questions' => [
                [
                    'question_text' => '毎日、何を食べたほうがいいですか。',
                    'options' => [
                        'ご飯と水',
                        '野菜や果物',
                        '揚げ物',
                        '甘いジュース'
                    ],
                    'correct_index' => 1,
                    'explanation' => '本文に「毎日、野菜や果物を食べたほうがいいです」と書いてあります。'
                ],
                [
                    'question_text' => '一週間に何回くらい運動しますか。',
                    'options' => [
                        '三回くらい',
                        '月に一回くらい',
                        '毎日',
                        '医者に言われた時だけ'
                    ],
                    'correct_index' => 0,
                    'explanation' => '本文に「一週間に三回は走ったり、泳いだりします」と書いてあります。'
                ],
                [
                    'question_text' => '夜は何時間眠るようにしますか。',
                    'options' => [
                        '六時間',
                        '八時間',
                        '十時間',
                        '仕事が終わるまで'
                    ],
                    'correct_index' => 1,
                    'explanation' => '本文に「夜は八時間眠るようにしましょう」と書いてあります。'
                ]
            ]
        ]);
    }
}
