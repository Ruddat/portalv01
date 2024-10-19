<!-- livewire/backend/admin/blog/blog-component.blade.php -->
<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-xl-9 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Input Style</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form wire:submit.prevent="savePost">
                            <div class="mb-3">
                                <input type="text" wire:model="title" class="form-control input-default" placeholder="Blog Title">
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4" wire:ignore>
                                <label for="content">Content</label>
                                <textarea wire:model="content" class="form-control required" name="content" id="content"></textarea>
                                @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="formFileLg" class="form-label">Large file input example</label>
                                <input class="form-control form-control-lg" id="image" type="file" wire:model="image">
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Start Date</label>
                                    <input class="form-control" type="date" id="start_date" wire:model="start_date">
                                    @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Category</label>
                                    <select id="inputState" wire:model="category_id" class="default-select form-control ms-0 wide">
                                        <option selected>Select Category...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Tag</label>
                                    <select id="tags" wire:model="tags" class="form-control ms-0 wide custom-select-height" multiple>
                                        @foreach($tagsAll as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tags') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@autotranslate('Categories & Tags', app()->getLocale())</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="row">
                            <form wire:submit.prevent="saveCategory">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">@autotranslate('New Category', app()->getLocale())</label>
                                    <input type="text" class="form-control" id="newCategoryName" wire:model="newCategoryName">
                                    @error('newCategoryName') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">@autotranslate('Add Category', app()->getLocale())</button>
                            </form>
                            <div class="mb-3 col-md-12"></div>

                            <form wire:submit.prevent="saveTag">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">@autotranslate('New Tag', app()->getLocale())</label>
                                    <input type="text" class="form-control" id="newTagName" wire:model="newTagName">
                                    @error('newTagName') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">@autotranslate('Add Tag', app()->getLocale())</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@autotranslate('Latest Posts', app()->getLocale())</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th style="width:50px;">
                                    <div class="form-check custom-checkbox checkbox-success check-lg me-3">
                                        <input type="checkbox" class="form-check-input" id="checkAll" required="">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th><strong>ROLL NO.</strong></th>
                                <th><strong>Thumbnail</strong></th>
                                <th><strong>Title</strong></th>
                                <th><strong>Content</strong></th>
                                <th><strong>Date</strong></th>
                                <th><strong>Status</strong></th>
                                <th><strong></strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestPosts as $post)
                                <tr>
                                    <td>
                                        <div class="form-check custom-checkbox checkbox-success check-lg me-3">
                                            <input type="checkbox" class="form-check-input" id="customCheckBox{{ $post->id }}" required="">
                                            <label class="form-check-label" for="customCheckBox{{ $post->id }}"></label>
                                        </div>
                                    </td>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($post->image_thumbnail) }}" class="rounded-lg me-2" width="80" alt="">
                                        </div>
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{!! Str::limit($post->content, 50) !!}</td>
                                    <td>{{ \Carbon\Carbon::parse($post->start_date)->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-circle text-success me-1"></i> Published
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp" wire:click="confirmDelete({{ $post->id }})"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Delete Confirmation Overlay -->
    <div x-data="{ show: @entangle('showDeleteOverlay') }" x-show="show" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75 backdrop-blur-sm"></div>
        <div class="bg-white p-6 rounded shadow-md text-center relative z-10">
            <h2 class="text-xl mb-4">Confirm Delete</h2>
            <p class="mb-4">Are you sure you want to delete the post: <strong>{{ $postTitle }}</strong>?</p>
            <button class="btn btn-secondary" @click="show = false">Cancel</button>
            <button class="btn btn-danger" @click="show = false; @this.call('deletePost')">Delete</button>
        </div>
    </div>

    <style>
        .backdrop-blur-sm {
            backdrop-filter: blur(5px);
        }

        .fixed.inset-0 {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .custom-select-height {
            height: 200px;
        }
    </style>
</div>

@push('specific-scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
    let editor;

    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(newEditor => {
                editor = newEditor;
                editor.model.document.on('change:data', () => {
                    @this.set('content', editor.getData());
                });
            })
            .catch(error => {
                console.error(error);
            });
    });

    function resetForm() {
        // Reset CKEditor content
        if (editor) {
            editor.setData('');
        }

        // Reset Livewire state
        Livewire.dispatch('resetForm');
    }

    document.addEventListener('livewire:load', function () {
        Livewire.on('resetForm', () => {
            if (editor) {
                editor.setData('');
                console.log('CKEditor content has been reset');
            }
        });
    });
</script>


@endpush
