<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bunpo;

class BunpoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bunpos = [
            // 1. BENTUK DASAR & PERUBAHAN KATA
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～んです / ～のです', 'meaning' => 'menjelaskan alasan, menekankan', 'example' => 'どうして{遅|おく}れたんですか。(Mengapa kamu terlambat?)'],
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～と思います', 'meaning' => 'saya pikir...', 'example' => '{明日|あした}は{雨|あめ}が{降|ふ}ると{思|おも}います。(Saya pikir besok akan hujan.)'],
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～と言います', 'meaning' => 'katanya... / disebut...', 'example' => '{彼|かれ}は{明日|あした}{来|こ}ないと{言|い}っていました。(Dia bilang dia tidak akan datang besok.)'],
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～すぎます', 'meaning' => 'terlalu...', 'example' => 'このカレーは{辛|から}すぎます。(Kari ini terlalu pedas.)'],
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～やすいです / ～にくいです', 'meaning' => 'mudah... / sulit...', 'example' => 'このペンは{書|か}きやすいです。(Pulpen ini mudah digunakan untuk menulis.)'],
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～ようになります', 'meaning' => 'menjadi bisa / terbiasa...', 'example' => '{日本語|にほんご}が{話|はな}せるようになりました。(Saya menjadi bisa berbicara bahasa Jepang.)'],
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～ようにします', 'meaning' => 'berusaha untuk...', 'example' => '{毎日|まいにち}{野菜|やさい}を{食|た}べるようにしています。(Saya berusaha makan sayur setiap hari.)'],
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～ことになります', 'meaning' => 'diputuskan bahwa...', 'example' => '{来月|らいげつ}、{日本|にほん}へ{行|い}くことになりました。(Telah diputuskan bahwa bulan depan saya akan pergi ke Jepang.)'],
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～ことにします', 'meaning' => 'memutuskan untuk...', 'example' => '{今日|きょう}からタバコを{辞|や}めることにしました。(Mulai hari ini saya memutuskan untuk berhenti merokok.)'],
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～てみます', 'meaning' => 'mencoba...', 'example' => 'この{靴|くつ}を{履|は}いてみます。(Saya akan mencoba memakai sepatu ini.)'],
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～ばかりです', 'meaning' => 'hanya...', 'example' => '{彼|かれ}はゲームばかりしています。(Dia hanya bermain game saja.)'],
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～しか～ません', 'meaning' => 'tidak selain...', 'example' => '{財布|さいふ}に{百円|ひゃくえん}しかありません。(Di dompet hanya ada 100 yen.)'],
            ['category' => '1. Bentuk Dasar & Perubahan Kata', 'pattern' => '～まだ～ていません', 'meaning' => 'masih belum...', 'example' => 'まだ{晩ご飯|ばんごはん}を{食|た}べていません。(Saya masih belum makan malam.)'],

            // 2. PERMISSION & LARANGAN
            ['category' => '2. Permission & Larangan', 'pattern' => '～てもいいです', 'meaning' => 'boleh...', 'example' => '{写真|しゃしん}を{撮|と}ってもいいですか。(Bolehkah mengambil foto?)'],
            ['category' => '2. Permission & Larangan', 'pattern' => '～てはいけません / ～ちゃいけません', 'meaning' => 'tidak boleh...', 'example' => 'ここでタバコを{吸|す}ってはいけません。(Tidak boleh merokok di sini.)'],
            ['category' => '2. Permission & Larangan', 'pattern' => '～なくてもいいです', 'meaning' => 'tidak perlu...', 'example' => '{明日|あした}、{学校|がっこう}へ{来|こ}なくてもいいです。(Besok tidak perlu datang ke sekolah.)'],
            ['category' => '2. Permission & Larangan', 'pattern' => '～なければなりません', 'meaning' => 'harus...', 'example' => '{宿題|しゅくだい}をしなければなりません。(Harus mengerjakan PR.)'],
            ['category' => '2. Permission & Larangan', 'pattern' => '～なくちゃ / ～なきゃ', 'meaning' => '(harus) versi santai', 'example' => '{早|はや}く{行|い}かなくちゃ。(Harus cepat-cepat pergi.)'],

            // 3. KEINGINAN & HARAPAN
            ['category' => '3. Keinginan & Harapan', 'pattern' => '～たいです', 'meaning' => 'ingin...', 'example' => '{日本|にほん}へ{行|い}きたいです。(Saya ingin pergi ke Jepang.)'],
            ['category' => '3. Keinginan & Harapan', 'pattern' => '～たがります', 'meaning' => 'kelihatannya ingin...', 'example' => '{子供|こども}がお{菓子|かし}を{食|た}べたがっています。(Anak itu kelihatannya ingin makan kue.)'],

            // 4. PENGALAMAN & KONDISI
            ['category' => '4. Pengalaman & Kondisi', 'pattern' => '～たことがあります', 'meaning' => 'pernah...', 'example' => '{富士山|ふじさん}に{登|のぼ}ったことがあります。(Saya pernah mendaki Gunung Fuji.)'],
            ['category' => '4. Pengalaman & Kondisi', 'pattern' => '～ています', 'meaning' => 'sedang / kebiasaan / keadaan', 'example' => '{私|わたし}は{東京|とうきょう}に{住|す}んでいます。(Saya tinggal di Tokyo.)'],
            ['category' => '4. Pengalaman & Kondisi', 'pattern' => '～てしまいます', 'meaning' => 'terlanjur / selesai', 'example' => 'ケーキを{全部|ぜんぶ}{食|た}べてしまいました。(Saya sudah menghabiskan semua kuenya.)'],
            ['category' => '4. Pengalaman & Kondisi', 'pattern' => '～ておきます', 'meaning' => 'mempersiapkan sebelumnya', 'example' => 'パーティーの{前|まえ}に、{部屋|へや}を{掃除|そうじ}しておきます。(Sebelum pesta, saya membersihkan kamar terlebih dahulu.)'],

            // 5. MEMBERI & MENERIMA
            ['category' => '5. Memberi & Menerima', 'pattern' => '～てあげます', 'meaning' => 'melakukan untuk orang lain', 'example' => '{妹|いもうと}に{本|ほん}を{買|か}ってあげました。(Saya membelikan buku untuk adik perempuan.)'],
            ['category' => '5. Memberi & Menerima', 'pattern' => '～てもらいます', 'meaning' => 'menerima bantuan', 'example' => '{友達|ともだち}に{手伝|てつだ}ってもらいました。(Saya dibantu oleh teman.)'],
            ['category' => '5. Memberi & Menerima', 'pattern' => '～てくれます', 'meaning' => 'orang lain melakukan untuk saya', 'example' => '{先生|せんせい}が{日本語|にほんご}を{教|おし}えてくれました。(Guru mengajarkan bahasa Jepang kepada saya.)'],

            // 6. DUGAAN & KEMUNGKINAN
            ['category' => '6. Dugaan & Kemungkinan', 'pattern' => '～でしょう', 'meaning' => 'mungkin...', 'example' => '{明日|あした}は{晴|は}れるでしょう。(Besok mungkin akan cerah.)'],
            ['category' => '6. Dugaan & Kemungkinan', 'pattern' => '～かもしれません', 'meaning' => 'mungkin saja...', 'example' => '{午後|ごご}から{雨|あめ}が{降|ふ}るかもしれません。(Mungkin sore hari akan turun hujan.)'],
            ['category' => '6. Dugaan & Kemungkinan', 'pattern' => '～そうです (1)', 'meaning' => 'kelihatannya... (visual)', 'example' => 'このケーキは{美味|おい}しそうです。(Kue ini kelihatannya enak.)'],
            ['category' => '6. Dugaan & Kemungkinan', 'pattern' => '～そうです (2)', 'meaning' => 'katanya... (informasi)', 'example' => '{明日|あした}は{寒|さむ}くなるそうです。(Katanya besok akan menjadi dingin.)'],

            // 7. PERBANDINGAN & SARAN
            ['category' => '7. Perbandingan & Saran', 'pattern' => '～ほうがいいです', 'meaning' => 'sebaiknya...', 'example' => '{薬|くすり}を{飲|の}んだほうがいいですよ。(Sebaiknya kamu minum obat.)'],
            ['category' => '7. Perbandingan & Saran', 'pattern' => '～より', 'meaning' => 'daripada...', 'example' => '{車|くるま}より{電車|でんしゃ}のほうが{速|はや}いです。(Kereta lebih cepat daripada mobil.)'],
            ['category' => '7. Perbandingan & Saran', 'pattern' => '～ほど', 'meaning' => 'semakin...', 'example' => '{日本語|にほんご}は{勉強|べんきょう}するほど{面白|おもしろ}くなります。(Bahasa Jepang semakin dipelajari semakin menarik.)'],

            // 8. TUJUAN & ALASAN
            ['category' => '8. Tujuan & Alasan', 'pattern' => '～ために', 'meaning' => 'untuk...', 'example' => '{家族|かぞく}のために{働|はたら}きます。(Saya bekerja untuk keluarga.)'],
            ['category' => '8. Tujuan & Alasan', 'pattern' => '～ように', 'meaning' => 'agar...', 'example' => '{忘|わす}れないように、メモをします。(Saya membuat catatan agar tidak lupa.)'],
            ['category' => '8. Tujuan & Alasan', 'pattern' => '～ので', 'meaning' => 'karena... (lebih halus)', 'example' => '{用事|ようじ}があるので、{早|はや}く{帰|かえ}ります。(Karena ada urusan, saya pulang lebih awal.)'],
            ['category' => '8. Tujuan & Alasan', 'pattern' => '～から', 'meaning' => 'karena...', 'example' => '{暑|あつ}いから、{窓|まど}を{開|あ}けてください。(Karena panas, tolong buka jendela.)'],

            // 9. KONDISI / PENGANDAIAN
            ['category' => '9. Kondisi / Pengandaian', 'pattern' => '～たら', 'meaning' => 'kalau...', 'example' => '{雨|あめ}が{降|ふ}ったら、{行|い}きません。(Kalau hujan turun, saya tidak pergi.)'],
            ['category' => '9. Kondisi / Pengandaian', 'pattern' => '～なら', 'meaning' => 'kalau memang...', 'example' => 'パソコンを{買|か}うなら、あの{店|みせ}がいいですよ。(Kalau memang mau beli komputer, toko itu bagus lho.)'],
            ['category' => '9. Kondisi / Pengandaian', 'pattern' => '～ば', 'meaning' => 'jika...', 'example' => '{天気|てんき}が{良|よ}ければ、{海|うみ}へ{行|い}きます。(Jika cuacanya bagus, saya akan pergi ke laut.)'],

            // 10. URUTAN & AKTIVITAS BERSAMAAN
            ['category' => '10. Urutan & Aktivitas Bersamaan', 'pattern' => '～ながら', 'meaning' => 'sambil...', 'example' => '{音楽|おんがく}を{聴|き}きながら{勉強|べんきょう}します。(Saya belajar sambil mendengarkan musik.)'],
            ['category' => '10. Urutan & Aktivitas Bersamaan', 'pattern' => '～前に', 'meaning' => 'sebelum...', 'example' => '{寝|ね}る{前|まえ}に、{本|ほん}を{読|よ}みます。(Sebelum tidur, saya membaca buku.)'],
            ['category' => '10. Urutan & Aktivitas Bersamaan', 'pattern' => '～後で', 'meaning' => 'setelah...', 'example' => '{仕事|しごと}の{後|あと}で、{飲|の}みに{行|い}きましょう。(Setelah bekerja, ayo pergi minum.)'],

            // 11. DAFTAR & CONTOH
            ['category' => '11. Daftar & Contoh', 'pattern' => '～たり～たりします', 'meaning' => 'kadang... kadang...', 'example' => '{休|やす}みの{日|ひ}は、{本|ほん}を{読|よ}んだり、{映画|えいが}を{見|み}たりします。(Pada hari libur, kadang membaca buku, kadang menonton film.)'],
            ['category' => '11. Daftar & Contoh', 'pattern' => '～し', 'meaning' => 'dan juga...', 'example' => 'このレストランは{安|やす}いし、{美味|おい}しいです。(Restoran ini murah, dan juga enak.)'],

            // 12. PASIF & KAUSATIF DASAR
            ['category' => '12. Pasif & Kausatif Dasar', 'pattern' => '～（に）～られます', 'meaning' => 'dikenai tindakan (Passive)', 'example' => '{私|わたし}は{先生|せんせい}に{褒|ほめ}られました。(Saya dipuji oleh guru.)'],
            ['category' => '12. Pasif & Kausatif Dasar', 'pattern' => '～させます', 'meaning' => 'menyuruh / membiarkan (Causative)', 'example' => '{母|はは}は{妹|いもうと}に{手伝|てつだ}わせました。(Ibu menyuruh adik perempuan membantu.)'],

            // 13. KEHARUSAN & DUGAAN LAIN
            ['category' => '13. Keharusan & Dugaan Lain', 'pattern' => '～はずです', 'meaning' => 'seharusnya...', 'example' => '{彼|かれ}は{今日|きょう}{来|く}るはずです。(Dia seharusnya datang hari ini.)'],
            ['category' => '13. Keharusan & Dugaan Lain', 'pattern' => '～予定です', 'meaning' => 'rencana...', 'example' => '{来週|らいしゅう}、{旅行|りょこう}に{行|い}く{予定|よてい}です。(Rencananya saya akan pergi liburan minggu depan.)'],
        ];

        foreach ($bunpos as $bunpo) {
            Bunpo::create($bunpo);
        }
    }
}
