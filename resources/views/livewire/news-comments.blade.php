<div>
    @if(Gate::check('isUser') || Gate::check('isAdmin'))

            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-8 col-12">
                    <input type="text" style="width: 100%;" wire:model="comment_text">
                </div>
            </div>
            <div class="row">
                <div class="col d-flex d-sm-flex d-xl-flex justify-content-end" style="margin: 10px 0 15px 0;">
                    <button class="btn btn-dark text-white d-xl-flex" wire:click="addComment" type="submit">Добавить комментарий</button>
                </div>
            </div>

    @endif
        @foreach($comments as $c)
            <div class="row">
                <div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
                    @if($c->id<>Auth::id())
                    <a href="/profile/{{ $c->id }}">
                        <img class="rounded" style="width: 80px;height: 80px;" src="../assets/img/{{ $c->img }}">
                    </a>
                    @else
                    <a href="/profile">
                        <img class="rounded" style="width: 80px;height: 80px;" src="../assets/img/{{ $c->img }}">
                    </a>
                    @endif
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col" style="padding: 0 20px;">
                            <blockquote class="blockquote" style="margin: 0;">
                                @if($c->user_id<>Auth::id())
                                    <a href="/profile/{{ $c->user_id }}" class="mb-0 comments-name">{{ $c->name }}</a>
                                @else
                                    <a href="/profile" class="mb-0 comments-name">{{ $c->name }}</a>
                                @endif
                                <footer class="blockquote-footer" style="font-size: 12px;">{{ $c->created_at }}</footer>
                            </blockquote>
                        </div>
                        <div class="col">
                            <button type="submit" onclick="edit()">edit</button>
                        </div>
                        <div class="col">
                            <button type="submit" wire:click="deleteCom({{ $c->id }})">delete</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" id="text_com">
                            <p style="padding: 10px 15px;">{{ $c->txt }}</p>
                        </div>
                        <div class="col" id="edit_com" style="padding: 10px 15px; display: none;">
                            <input type="text" style="width: 100%;" wire:model="edited_com_text" value="{{ $c->txt }}">
                            <button type="submit" wire:click="editCom({{ $c->id }})" onclick="save()">save</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center">
        	{{ $comments->links() }}
		</div>
</div>
<script type="text/javascript">
    function edit(){
        document.getElementById('text_com').style.display = 'none';
        document.getElementById('edit_com').style.display = 'block';
    }
    function save(){
        document.getElementById('text_com').style.display = 'block';
        document.getElementById('edit_com').style.display = 'none';
    }
</script>