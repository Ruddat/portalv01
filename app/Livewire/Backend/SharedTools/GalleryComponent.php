<?php

namespace App\Livewire\Backend\SharedTools;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ModSharedToolsGallery;
use App\Models\ModSharedToolsGalleryCategory;
use App\Models\ModSharedToolsGallerySubcategory;
use Intervention\Image\ImageManagerStatic as Image;


class GalleryComponent extends Component
{
    use WithFileUploads;

    public $images = [];
    public $newImage; // Für Einzel-Upload (optional, wenn nur multiple nötig ist, kann entfernt werden)
    public $newImages = []; // Für Multiple-Upload

    public $categories;
    public $subcategories = [];
    public $selectedCategory = null;
    public $selectedSubcategory = null;
    public $overlayImageUrl;
    public $overlayImageTitle;

    public $newCategoryName;
    public $newSubcategoryName;
    public $showOverlay;  // Property to control the overlay display
    public $showUploadOverlay = false;
    public $showEditOverlay = false;
    public $uploadMessage = '';
    public $uploadSuccess = false;
    public $uploadError = false;
    public $editImageId;
    public $editImageTitle;
    public $selectedImage;



    public function mount()
    {
        $this->categories = ModSharedToolsGalleryCategory::all();
    }

    public function rightClick($imageId)
    {
        // Deine Logik für das Rechtsklick-Ereignis
        // Zum Beispiel: Zeige ein benutzerdefiniertes Kontextmenü oder führe eine spezielle Aktion aus
        // imageId ist der Wert, der vom JavaScript-Event übergeben wird
        // Du kannst diesen Wert verwenden, um ein Bild zu identifizieren oder eine spezielle Aktion auszuführen
        $this->dispatchBrowserEvent('alert', ['message' => 'Rechtsklick auf Bild mit ID: ' . $imageId]);
    }
    public function updatedSelectedCategory($categoryId)
    {
        $this->subcategories = ModSharedToolsGallerySubcategory::where('category_id', $categoryId)->get();
    }

    public function uploadImages()
    {

        try {

        // Überprüfen, ob es sich um einen Einzelbild- oder Mehrfach-Upload handelt
        if (is_array($this->newImages)) {
            $this->validate([
                'newImages.*' => 'image|max:1024', // 1MB Max pro Bild
                'selectedCategory' => 'required',
            ]);

            foreach ($this->newImages as $newImage) {
                $this->processImageUpload($newImage);
            }
        } else {
            $this->validate([
                'newImages' => 'image|max:1024', // 1MB Max pro Bild
                'selectedCategory' => 'required',
            ]);

            $this->processImageUpload($this->newImages);
        }

        // Nach dem Hochladen der Bilder Eingabefeld leeren
        $this->newImages = [];

        // Wenn Upload erfolgreich
        $this->uploadMessage = 'Bilder erfolgreich hochgeladen!';
        $this->uploadSuccess = true;
        $this->uploadError = false;
        $this->newImages = null;
    } catch (\Exception $e) {
        // Bei einem Fehler
        $this->uploadMessage = 'Beim Hochladen der Bilder ist ein Fehler aufgetreten: ' . $e->getMessage();
        $this->uploadError = true;
        $this->uploadSuccess = false;
    }

    $this->dispatch('refreshGallery'); // Falls du das Galerie-Array aktualisieren möchtest
}

    private function processImageUpload($newImage)
    {
        // Pfad für das Hauptbild
        $imagePath = $newImage->store('images', 'public');

        // Dateiname ohne Erweiterung für den Titel extrahieren
        $fileName = pathinfo($newImage->getClientOriginalName(), PATHINFO_FILENAME);

        // Pfad für das Thumbnail
        $thumbnailDir = public_path('storage/thumbnails');
        if (!file_exists($thumbnailDir)) {
            mkdir($thumbnailDir, 0777, true); // Erstelle den Ordner, falls er nicht existiert
        }

        $thumbnailPath = 'thumbnails/' . basename($imagePath);
        $thumbnail = Image::make(public_path("storage/{$imagePath}"))->fit(200, 200);
        $thumbnail->save(public_path("storage/{$thumbnailPath}"));

        // Pfad für das Kategorie-Bild
        $categoryImageDir = public_path('storage/category_images');
        if (!file_exists($categoryImageDir)) {
            mkdir($categoryImageDir, 0777, true); // Erstelle den Ordner, falls er nicht existiert
        }

        $categoryImagePath = 'category_images/' . basename($imagePath);
        $categoryImage = Image::make(public_path("storage/{$imagePath}"))->fit(940, 180);
        $categoryImage->save(public_path("storage/{$categoryImagePath}"));

        // Eintrag in der Datenbank speichern
        ModSharedToolsGallery::create([
            'image_path' => $imagePath,
            'thumbnail_path' => $thumbnailPath,
            'category_image_path' => $categoryImagePath,
            'category_id' => $this->selectedCategory,
            'subcategory_id' => $this->selectedSubcategory, // Kann null sein, falls keine Subkategorie ausgewählt ist
            'title' => $fileName, // Titel aus dem Dateinamen
        ]);

        // Pfade zur Galerie hinzufügen
        $this->images[] = [
            'original' => asset("storage/{$imagePath}"),
            'thumbnail' => asset("storage/{$thumbnailPath}"),
            'category_image' => asset("storage/{$categoryImagePath}"),
            'title' => $fileName, // Titel zum Bild hinzufügen
        ];
    }

public function openEditModal($imageId)
{
    $image = ModSharedToolsGallery::find($imageId);
   // dd($image);
    $this->editImageId = $imageId;
    $this->editImageTitle = $image->title;
    $this->overlayImageUrl = asset('storage/' . $image->image_path);
    $this->showEditOverlay = true;
}

public function updateImage()
{
    // Finde das Bild anhand der gespeicherten editImageId
    $image = ModSharedToolsGallery::find($this->editImageId);

    // Wenn das Bild existiert, aktualisiere den Titel
    if ($image) {
        $image->title = $this->editImageTitle;
        $image->save();  // Speichere die Änderung in der Datenbank
    }

    // Schließe das Overlay
    $this->closeEditOverlay();
}

public function deleteImage($imageId)
{

    // Bild anhand der ID finden
    $image = ModSharedToolsGallery::find($this->editImageId);

    // Dateien von der Platte löschen
    \Storage::delete('public/' . $image->image_path);
    \Storage::delete('public/' . $image->thumbnail_path);
    \Storage::delete('public/' . $image->category_image_path);

    // Bild aus der Datenbank löschen
    $image->delete();

    $this->dispatch('alert', ['message' => 'Bild erfolgreich gelöscht']);
    $this->closeEditOverlay();
    $this->mount(); // Gallerie neu laden

}



public function saveImageTitle()
{
    $image = ModSharedToolsGallery::find($this->editImageId);
    $image->title = $this->editImageTitle;
    $image->save();

    $this->dispatchBrowserEvent('alert', ['message' => 'Titel erfolgreich aktualisiert']);
    $this->closeOverlay();
}


    public function showImage($imagePath, $title)
    {
        $this->overlayImageUrl = $imagePath;
        $this->overlayImageTitle = $title;
        $this->showOverlay = true;  // Show the overlay
    }


    public function showUploadOverlay()
    {
        $this->showUploadOverlay = true;
    }

    public function closeEditOverlay()
    {
        $this->showEditOverlay = false;
        $this->editImageId = null;
        $this->editImageTitle = '';
    }

    public function closeUploadOverlay()
    {
        $this->showUploadOverlay = false;
        $this->uploadMessage = '';
        $this->uploadSuccess = false;
        $this->uploadError = false;
    }

    public function showOverlay()
    {
        $this->overlayImageUrl = $imageUrl;
        $this->showOverlay = true;  // Show the overlay
    }

    public function closeOverlay()
    {
        $this->showOverlay = false;  // Hide the overlay
    }

    public function createCategory()
    {
        $this->validate([
            'newCategoryName' => 'required|string|max:255',
        ]);

        $category = ModSharedToolsGalleryCategory::create([
            'name' => $this->newCategoryName,
        ]);

        $this->categories[] = $category;
        $this->newCategoryName = '';
    }

    public function createSubcategory()
    {
        $this->validate([
            'newSubcategoryName' => 'required|string|max:255',
            'selectedCategory' => 'required',
        ]);

        $subcategory = ModSharedToolsGallerySubcategory::create([
            'name' => $this->newSubcategoryName,
            'category_id' => $this->selectedCategory,
        ]);

        $this->subcategories[] = $subcategory;
        $this->newSubcategoryName = '';
    }



    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function resetFilter()
    {
        $this->selectedCategory = null;
        $this->filterByCategory($this->selectedCategory); // Dies wird alle Bilder ohne Filter anzeigen
    }

    public function render()
    {
        $query = ModSharedToolsGallery::query();

        // Filtere nach Kategorie, falls eine ausgewählt ist
        if ($this->selectedCategory) {
            $query->where(function ($query) {
                $query->where('category_id', $this->selectedCategory)
                      ->orWhereHas('subcategory', function ($subQuery) {
                          $subQuery->where('category_id', $this->selectedCategory);
                      });
            });
        }

        // Hole die Bilder basierend auf der Abfrage
        $this->images = $query->get()->map(function ($image) {
            return [
                'id' => $image->id, // Hier die ID hinzufügen
                'original' => asset('storage/' . $image->image_path),
                'thumbnail' => asset('storage/' . $image->thumbnail_path),
                'category_image' => asset('storage/' . $image->category_image_path),
                'uploaded_at' => $image->uploaded_at,
                'title' => $image->title,
            ];
        })->toArray();

        return view('livewire.backend.shared-tools.gallery-component', [
            'categories' => $this->categories,
            'subcategories' => $this->subcategories,
        ]);
    }

}
