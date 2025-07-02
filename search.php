<?php get_header(); ?>

<div class="min-h-screen bg-white">
    <!-- メインコンテンツ -->
    <div class="pt-16">
        <div id="mobile-search-margin" class="md:hidden h-0"></div>

        <div class="mx-auto max-w-6xl px-4 py-8">
            <!-- パンくずナビ -->
            <nav class="mb-6 text-sm text-gray-600">
                <div class="flex items-center space-x-2">
                    <a href="<?php echo home_url(); ?>" class="hover:text-gray-900">ホーム</a>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-900">検索結果</span>
                </div>
            </nav>

            <!-- 検索結果ヘッダー -->
            <div class="mb-8">
                <h1 class="mb-4 text-3xl font-bold">検索結果</h1>
                <?php if (have_posts()) : ?>
                    <p class="text-gray-600">「<?php echo get_search_query(); ?>」の検索結果: <?php echo $wp_query->found_posts; ?>件</p>
                <?php else : ?>
                    <p class="text-gray-600">「<?php echo get_search_query(); ?>」に一致する記事が見つかりませんでした。</p>
                <?php endif; ?>
            </div>

            <!-- 検索結果一覧 -->
            <div class="grid gap-6 md:grid-cols-3 lg:grid-cols-4">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php include(get_template_directory() . '/template-parts/article-card.php'); ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 mb-4">検索条件を変更して再度お試しください。</p>
                        <a href="<?php echo home_url(); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded">
                            ホームに戻る
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- ページネーション -->
            <?php if (have_posts()) : ?>
                <div class="mt-12">
                    <?php
                    the_posts_pagination(array(
                        'prev_text' => '前のページ',
                        'next_text' => '次のページ',
                        'class' => 'flex justify-center space-x-2'
                    ));
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
