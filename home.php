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
                    <span class="text-gray-900">記事一覧</span>
                </div>
            </nav>

            <!-- ページタイトルとフィルタ -->
            <div class="mb-8">
                <h1 class="mb-6 text-3xl font-bold">記事一覧</h1>

                <!-- フィルタとソート -->
                <div class="flex flex-col sm:flex-row gap-4 mb-4">
                    <!-- カテゴリフィルタ -->
                    <div class="flex flex-wrap gap-2" id="category-filters">
                        <button class="category-filter active px-4 py-2 text-sm rounded border" data-category="all">すべて</button>
                        <?php
                        $custom_categories = get_custom_categories();
                        foreach ($custom_categories as $slug => $category) :
                            $cat_obj = get_category_by_slug($slug);
                            if ($cat_obj) :
                        ?>
                            <button class="category-filter px-4 py-2 text-sm rounded border border-gray-300 hover:bg-gray-50" data-category="<?php echo $slug; ?>">
                                <?php echo $category['name']; ?>
                            </button>
                        <?php endif; endforeach; ?>
                    </div>

                    <!-- ソート -->
                    <div class="sm:ml-auto">
                        <select id="sort-select" class="px-3 py-2 border border-gray-300 rounded">
                            <option value="newest">新しい順</option>
                            <option value="oldest">古い順</option>
                            <option value="popular">人気順</option>
                        </select>
                    </div>
                </div>

                <!-- 検索結果表示 -->
                <div id="search-results-info" class="text-sm text-gray-600 mb-4"></div>
            </div>

            <!-- 記事一覧 -->
            <div id="articles-container" class="grid gap-6 md:grid-cols-3 lg:grid-cols-4">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php include(get_template_directory() . '/template-parts/article-card.php'); ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 mb-4">記事が見つかりませんでした。</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- ページネーション -->
            <div class="mt-12">
                <?php
                the_posts_pagination(array(
                    'prev_text' => '前のページ',
                    'next_text' => '次のページ',
                    'class' => 'flex justify-center space-x-2'
                ));
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    window.initialSort = "<?php echo isset($_POST['sort']) ? esc_js($_POST['sort']) : 'newest'; ?>";
    window.initialCategory = "<?php echo isset($_POST['category']) ? esc_js($_POST['category']) : 'all'; ?>";
</script>

<?php get_footer(); ?>
