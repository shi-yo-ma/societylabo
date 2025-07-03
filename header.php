<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- 固定ヘッダー -->
    <header class="fixed top-0 left-0 right-0 z-50 border-b bg-white px-4 py-3">
        <div class="mx-auto flex max-w-6xl items-center justify-between">
            <!-- 左側: ブログ名 + 記事一覧 -->
            <div class="flex items-center space-x-6">
                <a href="<?php echo home_url(); ?>" class="text-lg font-semibold">
                    ソサイチLABO
                </a>
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="hidden md:block text-sm hover:text-gray-600">
                    記事一覧
                </a>
            </div>

            <!-- 右側: 検索バー + 人マーク -->
            <div class="flex items-center space-x-4">
                <!-- デスクトップ用検索バー -->
                <div class="hidden md:flex">
                    <form role="search" method="get" action="<?php echo home_url('/'); ?>" class="relative flex w-64">
                        <input type="search" name="s" placeholder="記事を検索..." 
                               class="pr-12 bg-gray-50 border-gray-200 w-full px-3 py-2 border rounded-md"
                               value="<?php echo get_search_query(); ?>">
                        <button type="submit" class="absolute right-1 inset-y-0 my-auto h-8 px-3 bg-blue-600 text-white rounded text-sm">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- スマホ用記事一覧とサーチボタン -->
                <div class="md:hidden flex items-center space-x-2">
                    <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="px-3 py-1 text-sm hover:bg-gray-100 rounded">
                        記事一覧
                    </a>
                    <button id="mobile-search-toggle" class="p-2 hover:bg-gray-100 rounded">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>

                <!-- プロフィールボタン -->
                <button id="profile-toggle" class="p-2 hover:bg-gray-100 rounded-full">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- スマホ用検索バー（トグル表示） -->
    <div id="mobile-search" class="md:hidden fixed left-0 right-0 z-40 bg-white border-b px-4 py-3 hidden">
        <form role="search" method="get" action="<?php echo home_url('/'); ?>" class="relative flex">
            <input type="search" name="s" placeholder="検索" 
                   class="pr-12 bg-gray-50 border-gray-200 w-full px-3 py-2 border rounded-md"
                   value="<?php echo get_search_query(); ?>">
            <button type="submit" class="absolute right-1 inset-y-0 my-auto h-8 px-3 bg-blue-600 text-white rounded text-sm">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </form>
    </div>

    <!-- プロフィールモーダル -->
    <div id="profile-modal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" id="profile-backdrop"></div>
        <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold mb-4">編集長プロフィール</h3>
            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center">
                        <svg class="h-8 w-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg">田中 太郎</h4>
                        <p class="text-sm text-gray-600">編集長</p>
                    </div>
                </div>
                <p class="text-sm text-gray-700">
                    フットサル歴15年、元日本代表選手。現在はソサイチLABOの編集長として、
                    フットサルの普及と技術向上に貢献しています。
                </p>
                <div class="text-sm text-gray-600">
                    <p><strong>経歴:</strong> 日本フットサル連盟認定指導者</p>
                    <p><strong>専門:</strong> タクティクス、チーム戦術</p>
                </div>
            </div>
            <button id="profile-close" class="mt-4 px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">閉じる</button>
        </div>
    </div>
