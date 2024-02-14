<?php

namespace Database\Seeders;

use App\Models\ModAdditives;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModAdditivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $additives = [
            [
                'additive_nr' => 1,
                'additive_art' => 'Farbstoffe E100-E180',
                'additive_title' => 'mit Farbstoff',
                'additive_description' => 'Fanta, CocaCola, CocaCola light, Fassbrause, Ginger Ale, Pernod, Campari, Whisky, Mayonnaise'
            ],
            [
                'additive_nr' => 2,
                'additive_art' => 'Konservierungsstoffe E200-E219, E230-E235, E239, E249-E252, E280-E285, E1105',
                'additive_title' => 'mit Konservierungsstoffen',
                'additive_description' => 'Kassler, Brühwürste, Mayonnaise, Ketchup, Essiggurken, Käse, Anchovis'
            ],
            [
                'additive_nr' => 3,
                'additive_art' => 'Antioxidationsmittel E310-E321',
                'additive_title' => 'mit Antioxidationsmitteln',
                'additive_description' => 'Würzmittel, Fleischerzeugnisse, Fanta'
            ],
            [
                'additive_nr' => 4,
                'additive_art' => 'Geschmacksverstärker E620-E635',
                'additive_title' => 'mit Geschmacksverstärker',
                'additive_description' => 'sehr viele Produkte, z.B. Würzmittel, Fleischerzeugnisse'
            ],
            [
                'additive_nr' => 5,
                'additive_art' => 'Schwefeldioxid/Sulfide E220-E228',
                'additive_title' => 'geschwefelt',
                'additive_description' => 'Essig, Trockenobst, Meerrettich, Kartoffelerzeugnisse'
            ],
            [
                'additive_nr' => 6,
                'additive_art' => 'Eisensalze E579, E585',
                'additive_title' => 'geschwärzt',
                'additive_description' => 'schwarze Oliven'
            ],

            [
                'additive_nr' => 7,
                'additive_art' => 'Stoffe zur Oberflächenbehandlung E901-E904, E912, E914',
                'additive_title' => 'gewachst',
                'additive_description' => 'Zitrusfrüchte, Melonen, Äpfel, Birnen'
            ],
            [
                'additive_nr' => 8,
                'additive_art' => 'Süßstoffe E950-E952, E954, E957, E959',
                'additive_title' => 'mit Süßstoff',
                'additive_description' => 'CocaCola light und andere Light-Produkte, Senf, Mayonnaise, Ketchup, süß-saure Konserven'
            ],
            [
                'additive_nr' => '8a',
                'additive_art' => 'Andere Süßungsmittel E420, E421, E953,E965, E967',
                'additive_title' => 'mit Süßstoff / bei Aspartam zudem: enthält eine Phenylalaninquelle',
                'additive_description' => ''
            ],
            [
                'additive_nr' => 9,
                'additive_art' => 'Stabilisator E338, E341, E450, E452',
                'additive_title' => 'mit Phosphat',
                'additive_description' => 'Fleischerzeugnisse (z.B. Brühwürste), Käse'
            ],

            [
                'additive_nr' => 10,
                'additive_art' => 'für Fleischerzeugnisse: Nitritpökelsalz',
                'additive_title' => 'mit Nitritpökelsalz',
                'additive_description' => 'Kassler, Schinken'
            ],

            [
                'additive_nr' => '10a',
                'additive_art' => 'für Fleischerzeugnisse: Milcheiweiß',
                'additive_title' => 'mit Milcheiweiß',
                'additive_description' => 'Brühwürste, Corned Beef'
            ],

            [
                'additive_nr' => '10b',
                'additive_art' => 'für Fleischerzeugnisse: Eiklar',
                'additive_title' => 'mit Eiklar',
                'additive_description' => 'Brühwürste, Pasteten'
            ],

            [
                'additive_nr' => '10c',
                'additive_art' => 'für Fleischerzeugnisse: Sahne',
                'additive_title' => 'mit Sahne',
                'additive_description' => 'Leberwurst, Leberpasteten'
            ],
            [
                'additive_nr' => '11',
                'additive_art' => 'für Getränke: Koffein',
                'additive_title' => 'koffeinhaltig',
                'additive_description' => 'CocaCola, CocaCola light'
            ],
            [
                'additive_nr' => '11a',
                'additive_art' => 'für Getränke: Chinin',
                'additive_title' => 'chininhaltig',
                'additive_description' => 'Tonic Water, Bitter Lemon'
            ],
            [
                'additive_nr' => '11b',
                'additive_art' => 'für Getränke: Taurin',
                'additive_title' => 'mit Taurin',
                'additive_description' => 'Red Bull'
            ],

        ];

        foreach ($additives as $additive) {
            ModAdditives::create([
                'parent' => 0,
                'additive_nr' => $additive['additive_nr'],
                'additive_art' => $additive['additive_art'],
                'additive_title' => $additive['additive_title'],
                'additive_description' => $additive['additive_description'],
                'lang' => 'en', // Standardwert 'en' (Englisch), Sie können dies entsprechend Ihrer Anforderung ändern
                'ordering' => 0, // Sie können dies entsprechend Ihrer Anforderung ändern
                'published' => true, // Standardmäßig veröffentlicht, Sie können dies ändern, wenn erforderlich
                'additive_date' => now(), // Aktuelles Datum und Uhrzeit
            ]);
        }

    }
}
