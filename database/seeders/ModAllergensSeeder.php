<?php

namespace Database\Seeders;

use App\Models\ModAllergens;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModAllergensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $allergens = [
            [
                'allergenic_short_title' => 'Glutenhaltiges Getreide',
                'allergenic_title' => 'Glutenhaltiges Getreide: Dazu gehören Weizen, Roggen, Gerste, Hafer und deren Abwandlungen. Glutenintoleranz oder Zöliakie betrifft zahlreiche Menschen, die auf glutenhaltige Lebensmittel mit Verdauungsproblemen reagieren.',
            ],
            [
                'allergenic_short_title' => 'Krebstiere',
                'allergenic_title' => 'Krebstiere: Garnelen, Krabben, Hummer und andere Schalentiere können schwere allergische Reaktionen auslösen, einschließlich Atemnot.',
            ],
            [
                'allergenic_short_title' => 'Eier',
                'allergenic_title' => 'Ein Allergen, das oft in Kuchen, Pasta und vielen anderen Gerichten vorkommt. Symptome variieren von leichtem Hautausschlag bis zu schweren allergischen Reaktionen.',
            ],
            [
                'allergenic_short_title' => 'Fische',
                'allergenic_title' => 'Nicht zu verwechseln mit Schalentieren. Einige Menschen können spezifisch auf Fischprotein reagieren, während sie gegen Schalentiere tolerant sind.',
            ],
            [
                'allergenic_short_title' => 'Erdnüsse',
                'allergenic_title' => 'Eine der bekanntesten und gefährlichsten Allergien. Selbst geringste Spuren können bei Betroffenen zu einem anaphylaktischen Schock führen.',
            ],
            [
                'allergenic_short_title' => 'Sojabohnen',
                'allergenic_title' => 'In vielen asiatischen Gerichten und als Fleischersatz verwendet. Allergische Reaktionen sind weniger häufig, können aber schwerwiegend sein.',
            ],
            [
                'allergenic_short_title' => 'Milch (einschließlich Laktose)',
                'allergenic_title' => 'Laktoseintoleranz und Milchallergie sind unterschiedliche Konzepte, beide erfordern jedoch besondere Aufmerksamkeit in der Gastronomie.',
            ],
            [
                'allergenic_short_title' => 'Schalenfrüchte',
                'allergenic_title' => 'Dazu gehören Mandeln, Haselnüsse, Walnüsse, Cashewnüsse, Pekannüsse, Paranüsse, Pistazien und Macadamianüsse. Allergien gegen Schalenfrüchte können besonders schwerwiegend sein.',
            ],
            [
                'allergenic_short_title' => 'Sellerie',
                'allergenic_title' => 'Wird oft in Suppen und Eintöpfen verwendet und kann bei einigen Menschen allergische Reaktionen hervorrufen.',
            ],
            [
                'allergenic_short_title' => 'Senf',
                'allergenic_title' => 'Abgesehen von seiner Verwendung als Gewürz, findet Senf auch in vielen Saucen und Marinaden Verwendung.',
            ],
            [
                'allergenic_short_title' => 'Sesamsamen',
                'allergenic_title' => 'In Gebäck und orientalischen Gerichten oft verwendet, kann er bei Allergikern Reaktionen von Juckreiz bis Atemnot auslösen.',
            ],
            [
                'allergenic_short_title' => 'Schwefeldioxid und Sulfide',
                'allergenic_title' => 'Hauptsächlich in getrockneten Früchten und Wein gefunden. Sie können Asthmasymptome bei den Betroffenen auslösen.',
            ],
            [
                'allergenic_short_title' => 'Lupinen',
                'allergenic_title' => 'Eine häufige Zutat in glutenfreien Produkten und kann Reaktionen bei Personen mit Erdnussallergie auslösen.',
            ],
            [
                'allergenic_short_title' => 'Weichtiere',
                'allergenic_title' => 'Hierzu gehören Schnecken, Tintenfische und Muscheln. Allergien gegen diese Gruppe sind seltener, können aber ernsthaft sein.',
            ],
        ];

        foreach ($allergens as $allergen) {
            ModAllergens::create([
                'parent' => 0,
                'allergenic_short_title' => $allergen['allergenic_short_title'],
                'allergenic_title' => $allergen['allergenic_title'],
                'lang' => 'en', // Standardwert lt (Englisch), Sie können dies entsprechend Ihrer Anforderung ändern
                'ordering' => 0, // Sie können dies entsprechend Ihrer Anforderung ändern
                'published' => true, // Standardmäßig veröffentlicht, Sie können dies ändern, wenn erforderlich
                'date' => now(), // Aktuelles Datum und Uhrzeit
            ]);
        }
    }
}
