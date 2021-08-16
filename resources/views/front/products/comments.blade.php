@foreach ($comments as $comment)

    <div @if ($comment->parent_id != 0) style="margin-right:50px" @endif>
            
        <img src="{{ asset('storage/uploads/images/'.'origAvatar.png') }}" alt="user_profile_pic" class="rounded-circle mt-4" style="max-height: 50px;max-width: 50px">
 
        <div class="col d-inline">
            <strong>{{ $comment->user->name }}</strong>
            <p class="mr-5 pr-3">{{ $comment->comment_text }}</p>
        </div>


        <button type="button" class="btn btn-primary mr-5 btn-reply" data-toggle="modal" data-target="#commentModal"
            data-id="{{ $comment->id }}">پاسخ</button>

        @if (count($comment->replies))
            @include('front.products.comments', ['comments' => $comment->replies])
        @endif

    </div>

@endforeach


<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="commentModalLabel">پاسخ به نظر {{ $comment->user->name }}</h5>
            <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form method="post" action="{{ route('commentStore') }}">
                @csrf
                <div class="form-group">
                    <textarea name="comment_text" class="form-control"></textarea>
                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    <input type="hidden" name="parent_id" id="parentId" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="ثبت" />
                </div>
            </form>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن این پنجره</button>
        </div>
    </div>
</div>
</div>






