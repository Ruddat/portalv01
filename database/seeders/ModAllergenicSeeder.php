<?php

namespace Database\Seeders;

use App\Models\ModAllergenic;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModAllergenicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $allergens = [
            [
                'short_title' => 'Glutenhaltiges Getreide',
                'title' => 'Glutenhaltiges Getreide: Dazu gehören Weizen, Roggen, Gerste, Hafer und deren Abwandlungen. Glutenintoleranz oder Zöliakie betrifft zahlreiche Menschen, die auf glutenhaltige Lebensmittel mit Verdauungsproblemen reagieren.',
            ],
            [
                'short_title' => 'Krebstiere',
                'title' => 'Krebstiere: Garnelen, Krabben, Hummer und andere Schalentiere können schwere allergische Reaktionen auslösen, einschließlich Atemnot.',
            ],
            [
                'short_title' => 'Eier',
                'title' => 'Ein Allergen, das oft in Kuchen, Pasta und vielen anderen Gerichten vorkommt. Symptome variieren von leichtem Hautausschlag bis zu schweren allergischen Reaktionen.',
            ],
            [
                'short_title' => 'Fische',
                'title' => 'Nicht zu verwechseln mit Schalentieren. Einige Menschen können spezifisch auf Fischprotein reagieren, während sie gegen Schalentiere tolerant sind.',
            ],
            [
                'short_title' => 'Erdnüsse',
                'title' => 'Eine der bekanntesten und gefährlichsten Allergien. Selbst geringste Spuren können bei Betroffenen zu einem anaphylaktischen Schock führen.',
            ],
            [
                'short_title' => 'Sojabohnen',
                'title' => 'In vielen asiatischen Gerichten und als Fleischersatz verwendet. Allergische Reaktionen sind weniger häufig, können aber schwerwiegend sein.',
            ],
            [
                'short_title' => 'Milch (einschließlich Laktose)',
                'title' => 'Laktoseintoleranz und Milchallergie sind unterschiedliche Konzepte, beide erfordern jedoch besondere Aufmerksamkeit in der Gastronomie.',
            ],
            [
                'short_title' => 'Schalenfrüchte',
                'title' => 'Dazu gehören Mandeln, Haselnüsse, Walnüsse, Cashewnüsse, Pekannüsse, Paranüsse, Pistazien und Macadamianüsse. Allergien gegen Schalenfrüchte können besonders schwerwiegend sein.',
            ],
            [
                'short_title' => 'Sellerie',
                'title' => 'Wird oft in Suppen und Eintöpfen verwendet und kann bei einigen Menschen allergische Reaktionen hervorrufen.',
            ],
            [
                'short_title' => 'Senf',
                'title' => 'Abgesehen von seiner Verwendung als Gewürz, findet Senf auch in vielen Saucen und Marinaden Verwendung.',
            ],
            [
                'short_title' => 'Sesamsamen',
                'title' => 'In Gebäck und orientalischen Gerichten oft verwendet, kann er bei Allergikern Reaktionen von Juckreiz bis Atemnot auslösen.',
            ],
            [
                'short_title' => 'Schwefeldioxid und Sulfide',
                'title' => 'Hauptsächlich in getrockneten Früchten und Wein gefunden. Sie können Asthmasymptome bei den Betroffenen auslösen.',
            ],
            [
                'short_title' => 'Lupinen',
                'title' => 'Eine häufige Zutat in glutenfreien Produkten und kann Reaktionen bei Personen mit Erdnussallergie auslösen.',
            ],
            [
                'short_title' => 'Weichtiere',
                'title' => 'Hierzu gehören Schnecken, Tintenfische und Muscheln. Allergien gegen diese Gruppe sind seltener, können aber ernsthaft sein.',
            ],
        ];

        foreach ($allergens as $allergen) {
            ModAllergenic::create([
                'parent' => 0,
                'short_title' => $allergen['short_title'],
                'title' => $allergen['title'],
                'lang' => 'lt', // Standardwert lt (Litauisch), Sie können dies entsprechend Ihrer Anforderung ändern
                'ordering' => 0, // Sie können dies entsprechend Ihrer Anforderung ändern
                'published' => true, // Standardmäßig veröffentlicht, Sie können dies ändern, wenn erforderlich
                'date' => now(), // Aktuelles Datum und Uhrzeit
            ]);
        }
    }
}
