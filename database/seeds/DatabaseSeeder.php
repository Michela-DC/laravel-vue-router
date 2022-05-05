<?php

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
        $this->call([
            UserSeeder::class,
            TagSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            //devo usare questo ordine così quando lancia i seeder del post ha già tags e categories popolati, 
            //quindi gli id di categories possono essere inseriti nella tabella posts e riesce a recuperare gli id dei tag di cui fa l'attach
        ]);
    }
}
