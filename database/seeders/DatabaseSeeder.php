<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Muhammad Ikhsanudin',
            'role' => 'user',
            'email' => 'ikhsan@gmail.com',
            'password' => bcrypt('ikhsan123'),

        ]);
        User::create([
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@yatnosbike.com',
            'password' => bcrypt('admin123'),

        ]);
        User::create([
            'name' => 'Seller',
            'role' => 'seller',
            'email' => 'seller@yatnosbike.com',
            'password' => bcrypt('seller123'),

        ]);

        Product::create([
            'name' => 'MTB S-Works Epic',
            'description' => 'Didesain ulang dengan fokus pada transfer daya yang efisien dan kinerja penanganan yang lebih baik, rangka S-Works Epic memiliki fitur segitiga belakang yang 15 persen lebih kaku untuk memanfaatkan sepenuhnya platform mengayuh yang disetel dengan balapan BRAIN. Jadwal lay-up khusus dan penggunaan FACT 12m Carbon rak paling atas kami menghemat berat namun selangkah lebih maju daripada teman stabilnya, sementara pièce de résistance hadir dalam bentuk tautan kejut serat karbon, 
            digabungkan untuk mencukur total lebih dari 100 gram dari kerangka S-works generasi sebelumnya—bukan tugas yang mudah            
            Dipasangkan dengan sempurna dengan shock belakang Brain untuk kinerja suspensi paling seimbang pada Epic, garpu S-Works Position-Sensitive Brain mendapat manfaat dari sasis SID SL Ultimate RockShox yang ramping, meningkatkan kekakuan ujung depan dan presisi penanganan saat menjaga gram di teluk.',
            'image' => '1654222692_P.jpg',
            'category' => 'sepeda',
            'price' => 3000000,
            'stock' => 100,
            'sold' => 0,
            'rate' => 0
        ]);
    }
}
