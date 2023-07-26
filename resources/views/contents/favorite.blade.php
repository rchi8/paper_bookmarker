<x-page-base>
    <x-slot name="title"></x-slot>
    <x-slot name="css">
        <style>
            .card {
                margin-bottom: 20px;
                border: none; /* カードの枠線を削除 */
            }
            .card-header {
                background-color: #f8f9fa;
                border: none; /* カードヘッダーの枠線を削除 */
            }
            .btn-delete, .btn-show-summary, .btn-show-link, .btn-show-comment {
                font-size: 12px; /* ボタンのフォントサイズを小さくする */
                opacity: 0.8; /* ボタンを目立たなくする */
                transition: opacity 0.3s; /* ホバー時のトランジション効果 */
            }
            .btn-group .btn:not(:last-child) {
                margin-right: 5px; /* ボタンの右マージンを追加 */
            }
            .btn-group .btn:hover {
                opacity: 1; /* ホバー時にボタンを表示 */
            }
        </style>
    </x-slot>

    <x-slot name="main">
        <div class="container">
        <div class="row">
        <div class="col-12 mt-3">
            <p class="text-end">
            <a href="./" class="btn btn-secondary">メニューに戻る</a>
            </p>
            <h1 class="text-center text-primary mt-4">お気に入り</h1>
        </div> 
          </div>
          
          <div class="row">
          <div class="card">
                <div class="card-body">
                    <form action="./search_bookmark" method="get">
                    @csrf
                        <div class="form-group">
                            <label for="keyword">キーワード</label>
                            <input type="text" name="keyword" id="keyword" class="form-control" placeholder="キーワードを入力してください">
                            <label for="sort">並べ替え</label>
                            <select class="form-select mb-1" aria-label="Default select example" name="sort">
                              <option selected>登録日降順</option>
                              <option value="1">登録日昇順</option>
                              <option value="2">出版日降順</option>
                              <option value="3">出版日昇順</option>
                            </select>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" id="memo" name="memo">
                              <label class="form-check-label" for="memo">
                                  メモ有のみ表示
                              </label>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary mt-3">GO</button>
                    </form>
                </div>
            </div>
          </div>
            @if (isset($keyword))
            <h3 class="text-center">キーワード: {{ $keyword}} で検索</h3>
            @endif
            <div class="row mt-3">
            {{ $articles->links() }}
                @foreach ($articles->reverse() as $a)
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">
                                    @if ($a->author1)
                                        <strong>Author:</strong>
                                        <a href="https://zbmath.org/?q={{ $a->author1 }}" style="color: black;">{{ $a->author1 }}</a>
                                    @endif
                                    @if ($a->author2)
                                        , <a href="https://zbmath.org/?q={{ $a->author2 }}" style="color: black;">{{ $a->author2 }}</a>
                                    @endif
                                    @if ($a->author3)
                                        , <a href="https://zbmath.org/?q={{ $a->author3 }}" style="color: black;">{{ $a->author3 }}</a>
                                    @endif
                                </p>
                                <p class="card-text">
                                <strong>Published: {{ $a->published}}</strong>
                                </p>
                                <h5 class="card-title">{{ $a->title }}</h5>
                                <p class="card-text memo">{{ $a->memo }}</p>
                                <p class="card-text summary" style="display: none;">{{ $a->summary }}</p>
                                <div class="btn-group">
                                    <button class="btn btn-outline-primary btn-show-summary">表示</button>
                                    <a href="{{ $a->url }}" class="btn btn-outline-danger btn-show-link">リンク</a>
                                    <button class="btn btn-outline-info btn-show-comment" data-memo="{{ $a->memo }}" data-article-id="{{ $a->id }}">メモ</button>
                                    <form method="post" action="{{ route('delete') }}" onsubmit="return confirm('本当に削除しますか？');">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $a->id }}">
                                        <button type="submit" class="btn btn-outline-danger btn-delete">削除</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Memo Modal -->
<div class="modal fade" id="memoModal" tabindex="-1" aria-labelledby="memoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="memoModalLabel">メモを編集</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="memoForm">
            @csrf
                <div class="modal-body">
                    <textarea class="form-control" id="memoTextArea" rows="5"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </x-slot>

    <x-slot name="script">
        <script>
     // Add CSRF token to the global AJAX setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
   

    $(document).ready(function() {
        
        $(".btn-show-summary").on("click", function() {
            var summaryElement = $(this).closest(".card-body").find(".summary");
            summaryElement.slideToggle();
        });
        

        // Memo Modal handling
        $(".btn-show-comment").on("click", function(e) {
            e.stopPropagation();
            var memoContent = $(this).data("memo");
            var articleId = $(this).data("article-id");
            $("#memoTextArea").val(memoContent);
            $("#memoForm").data("article-id", articleId); // Store article ID in the form data
            $("#memoModal").modal("show");
        });

        $("#memoForm").on("submit", function(e) {
            e.preventDefault();
            var newMemo = $("#memoTextArea").val();
            var articleId = $(this).data("article-id"); // Retrieve article ID from the form data

            // Perform AJAX request to update the memo
            $.ajax({
                method: "POST",
                url: "./update_memo", // Replace with the actual route for updating the memo
                data: {
                    id: articleId,
                    memo: newMemo
                },
                success: function(response) {
                    // Handle success (optional)
                    console.log("Memo updated successfully.");
                    $(".btn-show-comment[data-article-id='" + articleId + "']").data("memo", newMemo);
                    $("#memoModal").modal("hide");
                },
                error: function(xhr, status, error) {
                    // Handle error (optional)
                    console.log("Error updating memo:", error);
                }
            });
        });
    });
</script>

    </x-slot>
</x-page-base>
