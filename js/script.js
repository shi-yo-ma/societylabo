const $ = jQuery // Declare the jQuery variable

jQuery(document).ready(($) => {
  // Ajax検索とフィルタリング
  function performSearch() {
    var category = $(".category-filter.active").data("category") || "all"
    var sort = $("#sort-select").val() || "newest"

    $.ajax({
      url: ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "search_posts",
        category: category,
        sort: sort,
        nonce: ajax_object.nonce,
      },
      beforeSend: () => {
        $("#articles-container").html('<div class="col-span-full text-center py-12"><p>読み込み中...</p></div>')
      },
      success: (response) => {
        if (response.success) {
          $("#articles-container").html(response.data)
          updateSearchInfo(category, sort)
        }
      },
      error: () => {
        $("#articles-container").html(
          '<div class="col-span-full text-center py-12"><p class="text-red-500">エラーが発生しました。</p></div>',
        )
      },
    })
  }

  if (window.location.pathname === "/wordpress/list/") {
    const sortParam = typeof window.initialSort !== 'undefined' ? window.initialSort : 'newest';
    const categoryParam = typeof window.initialCategory !== 'undefined' ? window.initialCategory : 'all';

    // セレクトボックスとカテゴリボタンの初期状態設定
    $("#sort-select").val(sortParam)
    $(".category-filter").removeClass("active bg-blue-600 text-white").addClass("border-gray-300")
    $('.category-filter[data-category="' + categoryParam + '"]').addClass("active bg-blue-600 text-white").removeClass("border-gray-300")

    // 初期表示のためにAjax実行
    performSearch()
  }

  function updateSearchInfo(category, sort) {
    var info = ""
    if (category !== "all") {
      var categoryName = $('.category-filter[data-category="' + category + '"]').text()
      info += "カテゴリ「" + categoryName + "」: "
    }

    var articleCount = $("#articles-container .group").length
    info += articleCount + "件の記事が見つかりました"

    $("#search-results-info").text(info)
  }

  // カテゴリフィルタクリック
  $(document).on("click", ".category-filter", function () {
    $(".category-filter").removeClass("active bg-blue-600 text-white").addClass("border-gray-300")
    $(this).addClass("active bg-blue-600 text-white").removeClass("border-gray-300")
    performSearch()
  })

  // ソート変更
  $(document).on("change", "#sort-select", () => {
    performSearch()
  })
})
