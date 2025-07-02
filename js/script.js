const $ = jQuery // Declare the jQuery variable
const ajax_object = window.ajax_object // Declare the ajax_object variable

jQuery(document).ready(($) => {
  // Ajax検索とフィルタリング
  function performSearch() {
    var searchTerm = $("#search-input").val()
    var category = $(".category-filter.active").data("category") || "all"
    var sort = $("#sort-select").val() || "newest"

    $.ajax({
      url: ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "search_posts",
        search_term: searchTerm,
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
          updateSearchInfo(searchTerm, category, sort)
        }
      },
      error: () => {
        $("#articles-container").html(
          '<div class="col-span-full text-center py-12"><p class="text-red-500">エラーが発生しました。</p></div>',
        )
      },
    })
  }

  function updateSearchInfo(searchTerm, category, sort) {
    var info = ""
    if (searchTerm) {
      info += "「" + searchTerm + "」の検索結果: "
    }
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

  // 検索実行
  $(document).on("keypress", "#search-input", (e) => {
    if (e.which === 13) {
      performSearch()
    }
  })

  // 人気キーワードクリック
  $(document).on("click", ".keyword-link", function (e) {
    e.preventDefault()
    var keyword = $(this).text()
    $("#search-input").val(keyword)
    performSearch()
  })
})
