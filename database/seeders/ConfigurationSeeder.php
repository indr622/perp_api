<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\System\ConfigurationModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('DELETE FROM configurations');

        DB::table('configurations')->insert([
            'config_id' => "101",
            'config_group' => 'identitas',
            'config_key' => 'NAMA_PT',
            'config_value' => 'NAMA PT',
        ]);



        DB::table('configurations')->insert([
            'config_id' => "105",
            'config_group' => 'identitas',
            'config_key' => 'LOGO',
            'config_value' => '{realpath:"",relativepath:""}',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "201",
            'config_group' => 'basic',
            'config_key' => 'DEFAULT_TA',
            'config_value' => date('Y'),
        ]);


        DB::table('configurations')->insert([
            'config_id' => "701",
            'config_group' => 'report',
            'config_key' => 'HEADER_1',
            'config_value' => '',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "702",
            'config_group' => 'report',
            'config_key' => 'HEADER_2',
            'config_value' => '',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "703",
            'config_group' => 'report',
            'config_key' => 'HEADER_3',
            'config_value' => '',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "704",
            'config_group' => 'report',
            'config_key' => 'HEADER_4',
            'config_value' => '',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "705",
            'config_group' => 'report',
            'config_key' => 'HEADER_ADDRESS',
            'config_value' => '',
        ]);

        // theme
        DB::table('configurations')->insert([
            'config_id' => "801",
            'config_group' => 'theme',
            'config_key' => 'V_SYSTEM_BAR_CSS_CLASS',
            'config_value' => 'green lighten-2 white--text',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "802",
            'config_group' => 'theme',
            'config_key' => 'V_APP_BAR_NAV_ICON_CSS_CLASS',
            'config_value' => 'grey--text',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "803",
            'config_group' => 'theme',
            'config_key' => 'V_NAVIGATION_DRAWER_CSS_CLASS',
            'config_value' => 'accent-2',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "808",
            'config_group' => 'theme',
            'config_key' => 'V_NAVIGATION_DRAWER_COLOR',
            'config_value' => '#1A237E',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "804",
            'config_group' => 'theme',
            'config_key' => 'V_LIST_ITEM_BOARD_CSS_CLASS',
            'config_value' => 'warning',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "805",
            'config_group' => 'theme',
            'config_key' => 'V_LIST_ITEM_BOARD_COLOR',
            'config_value' => 'white',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "806",
            'config_group' => 'theme',
            'config_key' => 'V_LIST_ITEM_ACTIVE_CSS_CLASS',
            'config_value' => 'green darken-1',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "807",
            'config_group' => 'theme',
            'config_key' => 'COLOR_DASHBOARD',
            'config_value' => json_encode([
                'master' => '#2ed573',
                'order' => '#2ed573',
                'production' => '#1e90ff',
                'purchase' => '#3742fa',
                'inventory' => '#a4b0be',
                'sales' => '#ff7f50',

            ]),

        ]);

        //server
        DB::table('configurations')->insert([
            'config_id' => "910",
            'config_group' => 'server',
            'config_key' => 'EMAIL_MHS_ISVALID',
            'config_value' => '1',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "901",
            'config_group' => 'server',
            'config_key' => 'CAPTCHA_SITE_KEY',
            'config_value' => 'yubi',
        ]);

        DB::table('configurations')->insert([
            'config_id' => "902",
            'config_group' => 'server',
            'config_key' => 'CAPTCHA_PRIVATE_KEY',
            'config_value' => 'yubi',
        ]);

        ConfigurationModel::toCache();
    }
}
