<?php

use Illuminate\Database\Seeder;
use App\Perusahaan;
use App\Jenis;
use App\Paket;
use App\Categori;
use App\Blog;
use App\ImageGallery;
use App\Teammember;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perusahaan = Perusahaan::create([
        	'about' => 'Weddings are significant events in people’s lives and as such, couples are often willing to spend considerable amount of money to ensure that their weddings are well-organized. Wedding planners are often used by couples who work long hours and have little spare time available for sourcing and managing wedding venues.',
        	'cover' => 'aed0769762bbe3ced0deb4428401d78f.jpg',
        	'cover2' => 'aed0769762bbe3ced0deb4428401d78f.jpg',
        	'cover3' => 'aed0769762bbe3ced0deb4428401d78f.jpg'
        	]);

        $jenis = Jenis::create([
            'nama' => 'Gold'
            ]);

        $jenis2 = Jenis::create([
            'nama' => 'Silver'
            ]);

        $jenis3 = Jenis::create([
            'nama' => 'Bronze'
            ]);

        $paket = Paket::create([
            'nama' => 'LUXURY',
            'jenis_id' => '1',
            'isi' => '<!DOCTYPE html>
                      <html>
                      <head>
                      </head>
                      <body>
                      <ul>
                      <li>Costume</li>
                      <li>Cathering</li>
                      <li>Dekorasi</li>
                      </ul>
                      </body>
                      </html>',
            'harga' => '2000000',
            'cover' => '6a400f3ed4324657b20498355e117b98.jpg'
            ]);

        $categori = Categori::create([
            'nama' => 'Healty'
            ]);

        $categori2 = Categori::create([
            'nama' => 'Lifestyle'
            ]);

        $categori3 = Categori::create([
            'nama' => 'Tips & Trick'
            ]);

        $blog = Blog::create([
          'judul' => 'Menjaga Diri',
          'categoris_id' => '3',
          'about' => '<!DOCTYPE html>
                              <html>
                              <head>
                              </head>
                              <body>
                              <p>&nbsp; &nbsp; &nbsp; &nbsp; Di saatada seseorang yang ingin mencelakai anda apa yang harus anda lakukan?? disini saya akan                             memberitahu cara mengatasi orang tersebut :</p>
                              <ul>
                              <li>Jika orang tersebut membawa senjata tajam diusahakan anda harus berlari.</li>
                              <li>jika anda terjebak di jalan buntu anda harus membawa apa saja yg ada di dekat anda seperti : batu, kayu atau apa kek yang bisa anda                               gunakan untuk melawan orang tersebut.</li>
                              </ul>
                              <p>&nbsp; &nbsp; &nbsp; &nbsp;Sekian tips &amp; trick dari saya semoga bermanfaatbila ada kesalahan mohon di maafkan karena saya juga                             manusia yang memiliki banyak kesalahan begitu pun anda karena yang sempurna hanya ALLAH SWT. Sekian dan terimakasih</p>
                              </body>
                              </html>',
            'cover' => '1d012a8ffd3f0581d2826b3a7776b3f0.jpg'
            ]);

        $imagegallery = ImageGallery::create([
          'image' => '1521161311.jpg'
          ]);

        $imagegallery2 = ImageGallery::create([
          'image' => '1521161316.jpg'
          ]);

        $imagegallery3 = ImageGallery::create([
          'image' => '1521161321.jpg'
          ]);

        $imagegallery4 = ImageGallery::create([
          'image' => '1521161326.jpg'
          ]);

        $imagegallery5 = ImageGallery::create([
          'image' => '1521161608.jpg'
          ]);

        $imagegallery6 = ImageGallery::create([
          'image' => '1521161616.jpg'
          ]);

        $imagegallery7 = ImageGallery::create([
          'image' => '1521161653.jpg'
          ]);

        $imagegallery8 = ImageGallery::create([
          'image' => '1521161661.jpg'
          ]);

        $teammember = Teammember::create([
          'nama' => 'Didin',
          'jabatan' => 'Chef',
          'cover' => '605f03d963f76d58c786280bda930e30.jpg'
          ]);
    }
}
