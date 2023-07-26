<x-page-base>
<x-slot name="title"></x-slot>
<x-slot name="css"></x-slot>

<x-slot name="main">
<div class="container">
<div class="row">
<div class="col-12 mb-3 mt-3">
            <p class="text-end">
            <a href="./" class="btn btn-secondary">メニューに戻る</a>
            </p>
        </div> 
<h1 class="text-center text-primary">論文検索</h1>
<form method="post" action="./search_paper">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">タイトル</label>
      <input type="text" class="form-control" id="title" name="title" value="">
    </div>
    <div class="mb-3">
      <label for="author" class="form-label">著者</label>
      <input type="text" class="form-control" id="author" name="author" value="">
    </div>
    <div class="mb-3">
      <label for="abstract" class="form-label">概要</label>
      <input type="text" class="form-control" id="abstract" name="abstract" value="">
    </div>
    <div class="mb-3">
      <label for="comment" class="form-label">コメント</label>
      <input type="text" class="form-control" id="comment" name="comment" value="">
    </div>
    <div class="mb-3">
      <label for="journal_ref" class="form-label">出版雑誌</label>
      <input type="text" class="form-control" id="journal_ref" name="journal_ref" value="">
    </div>
    <div class="mb-3">
      <label for="subject_cat" class="form-label">カテゴリー</label>
      <input type="text" class="form-control" id="subject_cat" name="subject_cat" value="">
    </div>
    <div class="mb-3">
      <label for="report_number" class="form-label">レポート番号</label>
      <input type="text" class="form-control" id="report_number" name="report_number" value="">
    </div>
    <div class="mb-3">
      <label for="id_list" class="form-label">ID</label>
      <input type="text" class="form-control" id="id_list" name="id_list" value="">
    </div>
    <div class="mb-3">
      <label for="all" class="form-label">キーワード</label>
      <input type="text" class="form-control" id="all" name="all" value="">
    </div>
    <div class="mb-3">
      <label for="max_results" class="form-label">最大件数</label>
      <input type="text" class="form-control" id="max_results" name="max_results" value="10">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</x-slot>

<x-slot name="script">

</x-slot>
</x-page-base>