<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Comments Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header-border table-responsive-sm">
                    <thead>
                        <tr>
                            <th>Author</th>
                            <th>Email</th>
                            <th>Content</th>
                            <th>Approved</th>
                            <th>Moderate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr class="{{ $comment->moderate ? 'table-warning' : '' }}">
                                <td>{{ $comment->author }}</td>
                                <td>{{ $comment->email }}</td>
                                <td>
                                    @if($editingCommentId == $comment->id)
                                        <textarea wire:model="editingContent" rows="3" class="form-control"></textarea>
                                        <button wire:click="saveComment" class="btn btn-primary btn-sm mt-2">Save</button>
                                    @else
                                        {{ $comment->content }}
                                    @endif
                                </td>
                                <td>
                                    @if($comment->approved)
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-danger">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click="toggleModerate({{ $comment->id }})" class="btn btn-sm {{ $comment->moderate ? 'btn-warning' : 'btn-secondary' }}">
                                        {{ $comment->moderate ? 'Unmoderate' : 'Moderate' }}
                                    </button>
                                </td>
                                <td>
                                    @if(!$comment->approved)
                                        <button wire:click="approveComment({{ $comment->id }})" class="btn btn-success btn-sm">Approve</button>
                                    @endif
                                    <button wire:click="editComment({{ $comment->id }})" class="btn btn-info btn-sm">Edit</button>
                                    <button wire:click="deleteComment({{ $comment->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
