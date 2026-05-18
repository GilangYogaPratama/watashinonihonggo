<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bunpo;

class BunpoSeeder extends Seeder
{
    public function run(): void
    {
        Bunpo::truncate();

        $bunpos = [
            ['category' => 'Modul 1', 'pattern' => '1. ～んです', 'meaning' => 'Penekanan', 'example' => 'どうして{遅|おく}れたんですか。 (Kenapa terlambat?)'],
            ['category' => 'Modul 1', 'pattern' => '2. ～いただけませんか', 'meaning' => '"Bisakah Anda... Untuk saya"', 'example' => '{手伝|てつだ}っていただけませんか。 (Bisakah Anda membantu saya?)'],
            ['category' => 'Modul 1', 'pattern' => '3. ～たらいいです', 'meaning' => 'Sebaiknya', 'example' => 'どうしたらいいですか。 (Sebaiknya bagaimana?)'],
            ['category' => 'Modul 1', 'pattern' => '4. Potensial (Bisa)', 'meaning' => "I: 待ちます → 待てます\nII: 見ます → 見られます\nIII: します → できます", 'example' => '{日本語|にほんご}が{話|はな}せます。 (Bisa berbicara bahasa Jepang.)'],
            ['category' => 'Modul 1', 'pattern' => '5. 見えます / 聞こえます', 'meaning' => '"Terlihat" / "Terdengar"', 'example' => '{山|やま}が{見|み}えます。 (Gunung terlihat.)'],
            ['category' => 'Modul 1', 'pattern' => '6. できます', 'meaning' => '"Bisa", Selesai, dibuat dll', 'example' => 'スーパーができました。 (Supermarket telah selesai dibangun.)'],
            ['category' => 'Modul 1', 'pattern' => '7. しか / だけ', 'meaning' => "しか: hanya (-)\nだけ: hanya (+)", 'example' => 'ひらがなしか{読|よ}めません。 (Hanya bisa baca hiragana.)'],
            ['category' => 'Modul 1', 'pattern' => '8. では / には / からは', 'meaning' => 'Penegasan tempat/keberadaan', 'example' => 'この{部屋|へや}ではタバコを{吸|す}わないでください。 (Di ruangan INI tolong jangan merokok.)'],
            ['category' => 'Modul 1', 'pattern' => '9. ～ながら', 'meaning' => '"Sambil"', 'example' => 'テレビを{見|み}ながら{食事|しょくじ}します。 (Makan sambil menonton TV.)'],
            ['category' => 'Modul 1', 'pattern' => '10. ～ています', 'meaning' => 'Rutinitas / kejadian sampai sekarang', 'example' => '{私|わたし}は{東京|とうきょう}に{住|す}んでいます。 (Saya tinggal di Tokyo.)'],
            
            ['category' => 'Modul 2', 'pattern' => '11. ～し、～し', 'meaning' => 'Dan juga (kelebihan/alasan)', 'example' => 'この{店|みせ}は{安|やす}いし、いいし... (Toko ini murah, bagus, ...)'],
            ['category' => 'Modul 2', 'pattern' => '12. ～それで', 'meaning' => '"...karena itu makanya"', 'example' => '{雨|あめ}が{降|ふ}りました。それで{行|い}きませんでした。 (Hujan turun. Karena itu saya tidak pergi.)'],
            ['category' => 'Modul 2', 'pattern' => '13. ～ときは', 'meaning' => 'Penekanan suatu kondisi', 'example' => '{子|こ}どものときは、よく{遊|あそ}びました。 (Saat masih anak-anak, saya sering bermain.)'],
            ['category' => 'Modul 2', 'pattern' => '14. ～てしまいました / てしまいます', 'meaning' => 'Belum selesai / aksi akan dilakukan', 'example' => 'パスポートを{忘|わす}れてしまいました。 (Saya terlanjur melupakan paspor.)'],
            ['category' => 'Modul 2', 'pattern' => '15. それ / その / そう', 'meaning' => 'Kata tunjuk kalimat sebelumnya', 'example' => '{明日|あした}テストがあります。それは{難|むずか}しいです。 (Besok ada tes. Itu sulit.)'],
            ['category' => 'Modul 2', 'pattern' => '16. ありました', 'meaning' => 'Menunjukkan ada (terpampang/waktu)', 'example' => 'あそこにポスターがありました。 (Di sana (tadi) ada poster.)'],
            ['category' => 'Modul 2', 'pattern' => '17. どこかで / どこかに', 'meaning' => 'Suatu tempat / entah di mana', 'example' => 'どこかに{鍵|かぎ}を{落|お}としました。 (Menjatuhkan kunci entah di mana.)'],
            ['category' => 'Modul 2', 'pattern' => '18. k.kerja てあります', 'meaning' => 'Di...kan (Keadaan sengaja)', 'example' => '{机|つくえ}の{上|うえ}に{本|ほん}が{置|お}いてあります。 (Buku diletakkan di atas meja.)'],
            ['category' => 'Modul 2', 'pattern' => '19. k.kerja ておきます', 'meaning' => 'Terlebih dahulu', 'example' => 'パーティーの{前|まえ}に、{部屋|へや}を{掃除|そうじ}しておきます。 (Sebelum pesta, bersihkan kamar terlebih dahulu.)'],
            ['category' => 'Modul 2', 'pattern' => '20. ～ています', 'meaning' => 'Masih berlangsung', 'example' => 'まだ{雨|あめ}が{降|ふ}っています。 (Hujan masih turun.)'],

            ['category' => 'Modul 3', 'pattern' => '21. とか', 'meaning' => 'Memberikan contoh', 'example' => 'りんごとかみかんとか{買|か}います。 (Membeli apel, jeruk, dll.)'],
            ['category' => 'Modul 3', 'pattern' => '22. Maksud / Ajakan', 'meaning' => "I: 作ります → 作ろう\nII: 食べます → 食べよう\nIII: します → しよう; 来ます → 来よう", 'example' => '{一緒|いっしょ}に{行|い}こう。 (Ayo pergi bersama.)'],
            ['category' => 'Modul 3', 'pattern' => '23. ～と思います / と思っています', 'meaning' => 'Baru saja bermaksud / Sudah berniat => "Saya pikir"', 'example' => '{日本|にほん}へ{行|い}こうと{思|おも}っています。 (Saya berniat pergi ke Jepang.)'],
            ['category' => 'Modul 3', 'pattern' => '24. つもりです', 'meaning' => 'Berniat (Lebih yakin / pasti dari と思っています)', 'example' => '{大学|だいがく}に{入|はい}るつもりです。 (Saya berniat/pasti masuk universitas.)'],
            ['category' => 'Modul 3', 'pattern' => '25. よていです', 'meaning' => 'Rencananya', 'example' => '{来週|らいしゅう}、{出張|しゅっちょう}する{予定|よてい}です。 (Rencananya saya akan dinas minggu depan.)'],
            ['category' => 'Modul 3', 'pattern' => '26. まだ ～ていません / ～ません', 'meaning' => 'Sudah ada niat tapi belum / Belum ada niat', 'example' => 'まだ{書|か}いていません。 (Saya masih belum menulisnya.)'],
            ['category' => 'Modul 3', 'pattern' => '27. ～ほうがいいです', 'meaning' => '"Sebaiknya"', 'example' => '{病院|びょういん}へ{行|い}ったほうがいいです。 (Sebaiknya pergi ke rumah sakit.)'],
            ['category' => 'Modul 3', 'pattern' => '28. でしょう', 'meaning' => 'Mungkin / sepertinya (kemungkinan tinggi)', 'example' => '{明日|あした}は{雨|あめ}が{降|ふ}るでしょう。 (Besok mungkin hujan.)'],
            ['category' => 'Modul 3', 'pattern' => '29. かもしれません', 'meaning' => 'Mungkin / bisa jadi (kemungkinan rendah)', 'example' => '{午後|ごご}から{雨|あめ}が{降|ふ}るかもしれません。 (Mungkin siang hari akan hujan.)'],
            ['category' => 'Modul 3', 'pattern' => '30. bilangan で', 'meaning' => 'Batas jumlah', 'example' => '{三百円|さんびゃくえん}で{買|か}えますか。 (Apakah bisa dibeli dengan batas jumlah 300 yen?)'],

            ['category' => 'Modul 4', 'pattern' => '31. Perintah', 'meaning' => "I: 書きます → 書け (い->え)\nII: 見ます → 見ろ (ます->ろ)\nIII: します → しろ; 来ます → こい", 'example' => '{早|はや}く{寝|ね}ろ。 (Cepat tidur!)'],
            ['category' => 'Modul 4', 'pattern' => '32. Larangan', 'meaning' => '行くな (k.kerja kamus + な)', 'example' => 'ここに{入|はい}るな。 (Jangan masuk ke sini!)'],
            ['category' => 'Modul 4', 'pattern' => '33. k.biasa という意味です', 'meaning' => 'Menjelaskan maksud', 'example' => '「{立|た}入禁止|ちいりきんし}」は{入|はい}るなという{意味|いみ}です。 (Artinya dilarang masuk.)'],
            ['category' => 'Modul 4', 'pattern' => '34. k.biasa と言っていました', 'meaning' => 'Menyatakan pesan dari orang lain', 'example' => '{彼|かれ}は{明日|あした}{休|やす}むと{言|い}っていました。 (Dia berkata besok dia akan libur.)'],
            ['category' => 'Modul 4', 'pattern' => '35. ～と伝えていただけませんか', 'meaning' => 'Permintaan untuk menyampaikan pesan', 'example' => '{遅|おく}れると{伝|つた}えていただけませんか。 (Bisakah tolong sampaikan saya terlambat?)'],
            ['category' => 'Modul 4', 'pattern' => '36. ～とおりに', 'meaning' => 'Sesuai dengan (k.kerja た / k.benda の)', 'example' => '{説明書|せつめいしょ}のとおりに作ります。 (Membuat sesuai dengan buku petunjuk.)'],
            ['category' => 'Modul 4', 'pattern' => '37. ～た後で / ～の後で', 'meaning' => 'Setelah...', 'example' => '{食事|しょくじ}の{後|あと}で、{薬|くすり}を{飲|の}みます。 (Setelah makan, minum obat.)'],
            ['category' => 'Modul 4', 'pattern' => '38. Syarat (Kalau)', 'meaning' => "I: 読めば, II: 見れば, III: すれば/くれば\nNegatif: なければ. Sifat い: ければ. Sifat な/Benda: なら\n～と (Otomatis), ～たら (Kalau sudah)", 'example' => '{安|やす}ければ、{買|か}います。 (Kalau murah, saya beli.)'],
            ['category' => 'Modul 4', 'pattern' => '39. ～ために / ～ように', 'meaning' => 'Supaya... / Untuk...', 'example' => '{合格|ごうかく}するために{勉強|べんきょう}します。 (Belajar supaya lulus.)'],
            ['category' => 'Modul 4', 'pattern' => '40. ～ようになります', 'meaning' => 'Menjadi bisa', 'example' => '{泳|およ}げるようになりました。 (Sekarang saya menjadi bisa berenang.)'],

            ['category' => 'Modul 5', 'pattern' => '41. ～ようにします', 'meaning' => 'Saya usahakan', 'example' => '{毎日|まいにち}{運動|うんどう}するようにします。 (Saya usahakan berolahraga setiap hari.)'],
            ['category' => 'Modul 5', 'pattern' => '42. Pasif', 'meaning' => "I: 読まれる (い->あれる)\nII: 食べられる (ます->られる)\nIII: される / こられる", 'example' => '{先生|せんせい}に{褒|ほめ}られました。 (Saya dipuji oleh guru.)'],
            ['category' => 'Modul 5', 'pattern' => '43. のは / のが', 'meaning' => 'Sebagai kata benda (k.kerja biasa + の)', 'example' => '{音楽|おんがく}を{聞|き}くのが{好|す}きです。 (Mendengarkan musik adalah kesukaan saya.)'],
            ['category' => 'Modul 5', 'pattern' => '44. ～て、～で', 'meaning' => '"Karena" (k.kerja, k.sifat, k.benda)', 'example' => '{ニュース|にゅーす}を{聞|き}いて、びっくりしました。 (Saya kaget karena mendengar berita.)'],
            ['category' => 'Modul 5', 'pattern' => '45. ～ので', 'meaning' => 'Karena (menjelaskan alasan)', 'example' => '{用事|ようじ}があるので、{帰|かえ}ります。 (Karena ada urusan, saya pulang.)'],
            ['category' => 'Modul 5', 'pattern' => '46. ～途中で', 'meaning' => 'Di tengah-tengah (aktivitas)', 'example' => '{会社|かいしゃ}へ{行|い}く{途中|とちゅう}で、{事故|じこ}がありました。 (Di tengah jalan ke kantor, ada kecelakaan.)'],
            ['category' => 'Modul 5', 'pattern' => '47. ～か', 'meaning' => 'Menambahkan pertanyaan', 'example' => 'いつ{終|お}わるか、わかりません。 (Saya tidak tahu kapan akan selesainya.)'],
            ['category' => 'Modul 5', 'pattern' => '48. ～かどうか', 'meaning' => 'Apakah... atau tidak', 'example' => '{行|い}くかどうか、まだわかりません。 (Belum tahu apakah akan pergi atau tidak.)'],
            ['category' => 'Modul 5', 'pattern' => '49. ～てみます', 'meaning' => 'Mencoba', 'example' => 'このシャツを{着|き}てみます。 (Saya mencoba memakai kemeja ini.)'],
            ['category' => 'Modul 5', 'pattern' => '50. ～さ', 'meaning' => 'Mengubah k.sifat ke k.benda (高い → 高さ)', 'example' => 'あの{山|やま}の{高|たか}さはどれくらいですか。 (Ketinggian gunung itu kira-kira berapa?)'],

            ['category' => 'Modul 6', 'pattern' => '51. いただきました', 'meaning' => '"Saya mendapat..." (dari posisi lebih tinggi)', 'example' => '{社長|しゃちょう}にお{土産|みやげ}をいただきました。 (Mendapat oleh-oleh dari direktur.)'],
            ['category' => 'Modul 6', 'pattern' => '52. くださいます', 'meaning' => '"Saya diberi..." (oleh posisi lebih tinggi)', 'example' => '{部長|ぶちょう}が{本|ほん}をくださいました。 (Kepala bagian memberi saya buku.)'],
            ['category' => 'Modul 6', 'pattern' => '53. やります', 'meaning' => 'Memberikan (ke orang lebih rendah/hewan)', 'example' => '{犬|いぬ}にえさをやりました。 (Memberi makan pada anjing.)'],
            ['category' => 'Modul 6', 'pattern' => '54. ～ために', 'meaning' => 'Demi, untuk (tujuan/keinginan)', 'example' => '{家|いえ}を{買|か}うために、{貯金|ちょきん}しています。 (Menabung demi membeli rumah.)'],
            ['category' => 'Modul 6', 'pattern' => '55. ～のに', 'meaning' => 'Untuk (kegunaan, fungsi, biaya)', 'example' => 'このはさみは{紙|かみ}を{切|き}るのに{使|つか}います。 (Gunting ini digunakan untuk memotong kertas.)'],
            ['category' => 'Modul 6', 'pattern' => '56. ～そうです', 'meaning' => '"Kayaknya/Kelihatannya" (ます hilang, い hilang, な hilang)', 'example' => 'このケーキは{美味|おい}しそうです。 (Kue ini kelihatannya enak.)'],
            ['category' => 'Modul 6', 'pattern' => '57. ～て来ます', 'meaning' => 'Pergi dan kembali lagi', 'example' => 'ちょっと{手|て}を{洗|あら}って{来|き}ます。 (Saya mau pergi cuci tangan sebentar.)'],
            ['category' => 'Modul 6', 'pattern' => '58. ～すぎます', 'meaning' => '"Terlalu" (ます, い, な hilang)', 'example' => 'このシャツは{大|おお}きすぎます。 (Kemeja ini terlalu besar.)'],
            ['category' => 'Modul 6', 'pattern' => '59. ～やすい / ～にくい', 'meaning' => '"Mudah di..." / "Susah di..."', 'example' => 'この{薬|くすり}は{飲|の}みやすいです。 (Obat ini mudah diminum.)'],
            ['category' => 'Modul 6', 'pattern' => '60. ～くする / ～にする', 'meaning' => 'Mengubah fungsi sifat (掃除する → 綺麗にする)', 'example' => '{音|おと}を{大|おお}きくします。 (Membesarkan suaranya.)'],

            ['category' => 'Modul 7', 'pattern' => '61. ～場合は', 'meaning' => 'Apabila (sesuatu di luar dugaan/tidak puas)', 'example' => '{遅|おく}れる{場合|ばあい}は、{連絡|れんらく}してください。 (Apabila terlambat, tolong hubungi.)'],
            ['category' => 'Modul 7', 'pattern' => '62. ～のに', 'meaning' => 'Padahal (k.kerja biasa, k.sifat, k.benda + な)', 'example' => '{約束|やくそく}をしたのに、{彼|かれ}は{来|き}ませんでした。 (Padahal sudah janji, dia tidak datang.)'],
            ['category' => 'Modul 7', 'pattern' => '63. ～ところ', 'meaning' => '"Akan, sedang, baru saja"', 'example' => '今から{出|で}かけるところです。 (Baru saja mau keluar sekarang.)'],
            ['category' => 'Modul 7', 'pattern' => '64. ～ばかり', 'meaning' => '"Baru, baru saja" (sudah agak lama dibanding たった今)', 'example' => '{先月|せんげつ}、{日本|にほん}へ{来|き}たばかりです。 (Baru saja datang ke Jepang bulan lalu.)'],
            ['category' => 'Modul 7', 'pattern' => '65. ～はず', 'meaning' => 'Seharusnya (k.kerja biasa, k.sifat + な, k.benda + の)', 'example' => '{彼|かれ}は{今日|きょう}{来|く}るはずです。 (Dia seharusnya datang hari ini.)'],
            ['category' => 'Modul 7', 'pattern' => '66. ～そうです', 'meaning' => "Katanya: k.kerja biasa + そうです\nKelihatannya: k.kerja (ます potong) + そうです", 'example' => '{明日|あした}は{雨|あめ}が{降|ふ}るそうです。 (Katanya besok akan hujan.)'],
            ['category' => 'Modul 7', 'pattern' => '67. ～ようです', 'meaning' => 'Sepertinya / kayaknya (berdasarkan pendengaran/penglihatan)', 'example' => 'となりの{部屋|へや}に{誰|だれ}かいるようです。 (Sepertinya ada orang di kamar sebelah.)'],
            ['category' => 'Modul 7', 'pattern' => '68. Kausatif (Menyuruh)', 'meaning' => "I: 読む → 読ませる\nII: 食べる → 食べさせる\nIII: する → させる; 来る → こさせる", 'example' => '{子供|こども}に{野菜|やさい}を{食|た}べさせます。 (Menyuruh anak makan sayur.)'],
            ['category' => 'Modul 7', 'pattern' => '69. ～させていただけませんか', 'meaning' => '"Mohon izinkan saya..."', 'example' => 'ここで{写真|しゃしん}を{撮|と}らせていただけませんか。 (Mohon izinkan saya mengambil foto di sini.)'],
            ['category' => 'Modul 7', 'pattern' => '70. ～ていただけませんか', 'meaning' => '"Bisakah Anda... untuk saya"', 'example' => '{塩|しお}を{取|と}っていただけませんか。 (Bisakah tolong ambilkan garam untuk saya?)'],
        ];

        foreach ($bunpos as $bunpo) {
            Bunpo::create($bunpo);
        }
    }
}
