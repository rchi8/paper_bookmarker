<x-page-base>
<x-slot name="title"></x-slot>
<x-slot name="css">
    <style>
        .card {
            margin-bottom: 20px;
        }
    </style>
</x-slot>

<x-slot name="main">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3 mt-3">
                <p class="text-end">
                    <a href="./" class="btn btn-secondary">メニューに戻る</a>
                </p>
            </div>
            <div class="col-12">
                <h1 class="text-center text-info">新着論文</h1>
            </div>
        </div>
        <div class="row">
            @foreach ($array as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['title'] }}</h5>
                            <p class="card-text">
                                @if (count($item['author']) == 1)
                                    <strong>Author: </strong><a href="https://zbmath.org/?q={{ $item['author']['name'] }}" style="color: black;">{{ $item['author']['name'] }}</a>
                                @else
                                    <strong>Authors: </strong>
                                    @foreach ($item['author'] as $author)
                                        <a href="https://zbmath.org/?q={{ $author['name'] }}" style="color: black;">{{ $author['name'] }},</a>
                                    @endforeach
                                @endif
                            </p>
                            <p class="card-text summary" style="display: none;">{{ $item['summary'] }}</p>
                                <p class="card-subtitle mb-2 text-muted">{{ substr($item['published'], 0, 10) }}</p>
                            <div class="btn-group">
                                <button class="btn btn-outline-info btn-show-summary">表示</button>
                                <a href="{{ $item['id'] }}" class="btn btn-outline-danger btn-show-link">リンク</a>
                                <button class="btn btn-outline-primary btn-favorite" data-item="{{ json_encode($item) }}">登録</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-slot>

<x-slot name="script">
    <script>
        $(document).ready(function() {
        	$(".btn-show-summary").on("click", function() {
                var summaryElement = $(this).closest(".card-body").find(".summary");
                summaryElement.slideToggle();
            });
            
            // Add CSRF token to the global AJAX setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $(".btn-favorite").on("click", function() {
                var item = $(this).data("item");

                // Perform AJAX request to add the item to favorites
                $.ajax({
                    method: "POST",
                    url: "./bookmark", // Replace with the actual route for adding to favorites
                    data: {
                        item: item
                    },
                    success: function(response) {
                        // Handle success (optional)
                        console.log("Item added to favorites successfully.", item);
                        // You can update UI or show a message here
                    },
                    error: function(xhr, status, error) {
                        // Handle error (optional)
                        console.log("Error adding item to favorites:", error);
                        // You can show an error message here
                    }
                });
            });
        });
	</script>
</x-slot>
</x-page-base>
