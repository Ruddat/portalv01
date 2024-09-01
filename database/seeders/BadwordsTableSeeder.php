<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BadwordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $badwords = [
            'abuse', 'idiot', 'moron', 'stupid', 'dumb', 'fool', 'jerk', 'loser', 'asshole', 'bastard',
            'bitch', 'damn', 'douchebag', 'fuck', 'shit', 'crap', 'hell', 'whore', 'slut', 'piss',
            'screw', 'scumbag', 'dick', 'prick', 'pussy', 'retard', 'scum', 'twat', 'wanker', 'arsehole',
            'balls', 'bollocks', 'bugger', 'cock', 'cunt', 'darn', 'git', 'knob', 'minger', 'piss off',
            'plonker', 'shag', 'shite', 'slag', 'tits', 'toss', 'twit', 'wank', 'bloody', 'blimey',
            'bollocks', 'chav', 'crikey', 'dodgy', 'muppet', 'numpty', 'prat', 'sod', 'tosser', 'berk',
            'bint', 'clunge', 'cobblers', 'git', 'hooligan', 'nutter', 'pecker', 'pillock', 'ponce', 'scrubber',
            'skank', 'slapper', 'snatch', 'sodding', 'spacker', 'swine', 'twonk', 'wazzock', 'whinge', 'yob',
            'arse', 'barmy', 'bellend', 'berk', 'bint', 'blighter', 'bollocks', 'chuff', 'crap', 'git',
            'gobshite', 'minge', 'muppet', 'nonce', 'numpty', 'pillock', 'plonker', 'prat', 'piss', 'sod',
            'tart', 'tosser', 'twat', 'wank', 'wazzock', 'wee', 'arse', 'arsehole', 'bastard', 'bugger',
            'cunt', 'damn', 'feck', 'freak', 'git', 'gob', 'nob', 'pillock', 'shag', 'shit',
            'slag', 'tits', 'twat', 'wank', 'wanker', 'yobbo', 'arse', 'bollocks', 'bugger', 'damn',
            'feck', 'piss', 'sod', 'twat', 'wank', 'wanker', 'ass', 'bitch', 'bollocks', 'crap',
            'damn', 'feck', 'fuck', 'gob', 'knob', 'piss', 'prick', 'shit', 'slag', 'twat',
            'wank', 'wanker', 'bastard', 'bugger', 'feck', 'minger', 'minge', 'plonker', 'shag', 'shit',
            'tart', 'twat', 'wanker', 'arse', 'bint', 'clunge', 'cobblers', 'git', 'hooligan', 'nutter',
            'pecker', 'pillock', 'ponce', 'scrubber', 'skank', 'slapper', 'snatch', 'sodding', 'spacker', 'swine',
            'twonk', 'wazzock', 'whinge', 'yob', 'arse', 'barmy', 'bellend', 'berk', 'bint', 'blighter',
            'bollocks', 'chuff', 'crap', 'git', 'gobshite', 'minge', 'muppet', 'nonce', 'numpty', 'pillock',
            'plonker', 'prat', 'piss', 'sod', 'tart', 'tosser', 'twat', 'wank', 'wazzock', 'wee',
            'arse', 'arsehole', 'bastard', 'bugger', 'cunt', 'damn', 'feck', 'freak', 'git', 'gob',
            'nob', 'pillock', 'shag', 'shit', 'slag', 'tits', 'twat', 'wank', 'wanker', 'yobbo',
            'arse', 'bollocks', 'bugger', 'damn', 'feck', 'piss', 'sod', 'twat', 'wank', 'wanker'
            // Fügen Sie hier weitere Badwörter hinzu, um die Liste zu vervollständigen
        ];

        // Entfernen von Duplikaten
        $badwords = array_unique($badwords);

        foreach ($badwords as $word) {
            DB::table('mod_admin_badwords')->insert([
                'word' => $word,
                'count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
