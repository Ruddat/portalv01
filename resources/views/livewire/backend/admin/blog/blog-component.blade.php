<!-- livewire/backend/admin/blog/blog-component.blade.php -->
<div>
    <form wire:submit.prevent="savePost">
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" wire:model="title">
        </div>

        <div wire:ignore>
            <label for="content">Content</label>
            <textarea wire:model="content" class="form-control required" name="content" id="content"></textarea>
        </div>



        <div>
            <label for="image">Image</label>
            <input type="file" id="image" wire:model="image">
        </div>

        <div>
            <label for="category">Category</label>
            <select id="category" wire:model="category_id">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tags">Tags</label>
            <select id="tags" wire:model="tags" multiple>
                @foreach($tagsAll as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="start_date">Start Date</label>
            <input type="date" id="start_date" wire:model="start_date">
        </div>

        <button type="submit">Save Post</button>
    </form>

    <form wire:submit.prevent="saveCategory">
        <div>
            <label for="newCategoryName">New Category</label>
            <input type="text" id="newCategoryName" wire:model="newCategoryName">
        </div>
        <button type="submit">Add Category</button>
    </form>

    <form wire:submit.prevent="saveTag">
        <div>
            <label for="newTagName">New Tag</label>
            <input type="text" id="newTagName" wire:model="newTagName">
        </div>
        <button type="submit">Add Tag</button>
    </form>

    <div>
        <h3>Latest Posts</h3>
        <ul>
            @foreach($latestPosts as $post)
                <li>{{ $post->title }}</li>
            @endforeach
        </ul>
    </div>
</div>


@push('specific-scripts')

<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
            ClassicEditor
                .create(document.querySelector('#content'))
                .then(editor => {
                    editor.model.document.on('change:data', () => {
					@this.set('content', editor.getData());
                    })
               })
                .catch(error => {
                    console.error(error);
                });
        </script>
@endpush
