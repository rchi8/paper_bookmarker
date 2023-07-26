<x-page-base>
<x-slot name="title"></x-slot>
<x-slot name="css"></x-slot>
<x-slot name="main">
<div class="container">
    <div class="row">
        <div class="col-12 mb-5 pt-5">
        	<h1 class="text-center text-primary">Paper Bookmarker</h1>
        </div>
        <div class="col-md-4 mb-3 d-grid">
        	<a href="./new" class="btn btn-outline-info">新着表示</a>
        </div>
        <div class="col-md-4 mb-3 d-grid">
        	<a href="./search" class="btn btn-outline-info">論文検索</a>
        </div>
        <div class="col-md-4 mb-3 d-grid">
        	<a href="./favorite" class="btn btn-outline-info">お気に入り</a>
        </div>
    </div>
</div>
</x-slot>
<x-slot name="script"></x-slot>
</x-page-base>
