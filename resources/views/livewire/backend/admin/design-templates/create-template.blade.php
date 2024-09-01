<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-md">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Create New Template</h2>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Template Creation Form -->
    <form wire:submit.prevent="saveTemplate" class="space-y-6">

        <!-- Template Name -->
        <div>
            <label for="templateName" class="block text-sm font-medium text-gray-700">Template Name</label>
            <input type="text" wire:model="templateName" id="templateName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter template name">
            @error('templateName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea wire:model="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter template description"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Preview Image -->
        <div>
            <label for="previewImage" class="block text-sm font-medium text-gray-700">Preview Image</label>
            <input type="file" wire:model="previewImage" id="previewImage" class="mt-1 block w-full text-gray-500">
            @error('previewImage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <!-- Image Preview -->
            <div class="mt-2">
                @if ($previewImage)
                    <img src="{{ $previewImage->temporaryUrl() }}" alt="Preview" class="h-20 w-20 object-cover rounded">
                @endif
            </div>
        </div>

        <!-- HTML Skeleton -->
        <div>
            <label for="htmlSkeleton" class="block text-sm font-medium text-gray-700">HTML Skeleton</label>
            <textarea wire:model="htmlSkeleton" id="htmlSkeleton" rows="10" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter HTML structure"></textarea>
            @error('htmlSkeleton') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- CSS Files -->
        <div>
            <label for="cssFiles" class="block text-sm font-medium text-gray-700">CSS Files</label>
            <input type="file" wire:model="cssFiles" multiple id="cssFiles" class="mt-1 block w-full text-gray-500">
            @error('cssFiles.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <!-- Display Selected CSS Files -->
            @if($cssFiles)
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach($cssFiles as $cssFile)
                        <li>{{ $cssFile->getClientOriginalName() }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- JS Files -->
        <div>
            <label for="jsFiles" class="block text-sm font-medium text-gray-700">JS Files</label>
            <input type="file" wire:model="jsFiles" multiple id="jsFiles" class="mt-1 block w-full text-gray-500">
            @error('jsFiles.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <!-- Display Selected JS Files -->
            @if($jsFiles)
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach($jsFiles as $jsFile)
                        <li>{{ $jsFile->getClientOriginalName() }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Image Files -->
        <div>
            <label for="imageFiles" class="block text-sm font-medium text-gray-700">Image Files</label>
            <input type="file" wire:model="imageFiles" multiple id="imageFiles" class="mt-1 block w-full text-gray-500">
            @error('imageFiles.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <!-- Display Selected Image Files -->
            @if($imageFiles)
                <div class="mt-2 grid grid-cols-4 gap-4">
                    @foreach($imageFiles as $imageFile)
                        <div class="col-span-1">
                            <img src="{{ $imageFile->temporaryUrl() }}" alt="Image" class="h-20 w-20 object-cover rounded">
                            <p class="text-xs text-gray-500 mt-1 truncate">{{ $imageFile->getClientOriginalName() }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-5">
            <div class="flex justify-end">
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Template
                </button>
            </div>
        </div>
    </form>
</div>
