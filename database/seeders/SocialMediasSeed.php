<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SocialMediasSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();

        SocialMedia::truncate();

        Schema::enableForeignKeyConstraints();

        $socialMedias = [
            ['id' => 1, 'name' => 'WhatsApp', 'icon'=> '../../socialMedias/whatsapp.png', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'name' => 'Facebook', 'icon'=> '../../socialMedias/face.png', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 3, 'name' => 'Github', 'icon'=> '../../socialMedias/github.png', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 4, 'name' => 'Gmail', 'icon'=> '../../socialMedias/gmail.png', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 5, 'name' => 'Instagram', 'icon'=> '../../socialMedias/insta.png', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 6, 'name' => 'Linkedin', 'icon'=> '../../socialMedias/lnk.png', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];

        DB::table('social_medias')->insert($socialMedias);
    }
}
