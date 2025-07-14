<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
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
                    <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="hover:text-gray-900">記事一覧</a>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-900"><?php echo wp_trim_words(get_the_title(), 10, '...'); ?></span>
                </div>
            </nav>

            <!-- メインコンテンツエリア -->
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                <!-- 記事コンテンツ -->
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    <!-- 記事本文エリア -->
                    <div class="bg-white rounded-lg p-6 mb-8">
                        <!-- 記事ヘッダー -->
                        <header class="mb-8">
                            <h1 class="mb-4 text-3xl font-bold lg:text-4xl"><?php the_title(); ?></h1>
                            <div class="flex items-center space-x-4 text-sm text-gray-600">
                                <span>著者: <?php the_author(); ?></span>
                                <span>公開日: <?php echo get_the_date('Y年m月d日'); ?></span>
                            </div>
                        </header>

                        <!-- メイン画像 -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="mb-8 aspect-video relative rounded-lg overflow-hidden">
                                <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
                            </div>
                        <?php endif; ?>

                        <!-- 記事本文 -->
                        <article class="prose prose-lg max-w-none mb-8">
                            <div class="space-y-4 text-gray-700 leading-relaxed">
                                <?php the_content(); ?>
                            </div>
                        </article>

                        <!-- カテゴリバッジとシェアボタン -->
                        <div class="mb-8">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-wrap gap-2">
                                    <?php foreach (get_the_category() as $category) : ?>
                                        <a href="<?php echo get_category_link($category->term_id); ?>" class="inline-block bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-full text-sm">
                                            <?php echo $category->name; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                                <button onclick="shareArticle()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center ml-4 flex-shrink-0">
                                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                    </svg>
                                    シェア
                                </button>
                            </div>
                        </div>

                        <!-- 問い合わせフォーム -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold mb-4">記事の感想やリクエストをお聞かせください</h3>
                            <form id="contact-form" class="space-y-4">
                                <textarea id="contact-message" placeholder="記事の感想や、今後書いてほしい記事のテーマなどをお気軽にお書きください..." rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md resize-none"></textarea>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">送信</button>
                            </form>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <!-- 関連記事 -->
                        <?php
                        $related_posts = get_related_posts(get_the_ID(), 5);
                        if (!empty($related_posts)) : ?>
                            <div class="bg-white rounded-lg p-6">
                                <h3 class="text-xl font-semibold mb-4">関連記事</h3>
                                <div class="space-y-8">
                                    <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <div class="flex space-x-3 group cursor-pointer">
                                                <div class="w-16 h-16 relative flex-shrink-0 overflow-hidden rounded-lg">
                                                    <?php if (has_post_thumbnail()) : ?>
                                                        <?php the_post_thumbnail('thumbnail', array('class' => 'w-full h-full object-cover')); ?>
                                                    <?php else : ?>
                                                        <div class="w-full h-full bg-gray-200"></div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="font-medium line-clamp-2 text-sm group-hover:text-blue-600 mb-1">
                                                        <?php the_title(); ?>
                                                    </h4>
                                                    <div class="text-xs text-gray-500"><?php echo number_format(get_post_views(get_the_ID())); ?> 回閲覧</div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; wp_reset_postdata(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- 人気記事 -->
                        <div class="bg-white rounded-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold">人気記事</h3>
                                <a href="<?php echo add_query_arg('sort', 'popular', get_permalink(get_option('page_for_posts'))); ?>"
                                class="inline-block border border-gray-300 px-3 py-1 rounded text-sm hover:bg-gray-50">
                                    人気記事一覧
                                </a>
                            </div>
                            <div class="space-y-8">
                                <?php
                                $popular_posts = get_popular_posts(5); // ★5件のみ
                                foreach ($popular_posts as $index => $post) : setup_postdata($post); ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="flex space-x-3 group cursor-pointer">
                                            <div class="w-6 flex-shrink-0 text-sm text-gray-500 font-medium"><?php echo $index + 1; ?></div>
                                            <div class="w-16 h-16 relative flex-shrink-0 overflow-hidden rounded-lg">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php the_post_thumbnail('thumbnail', array('class' => 'w-full h-full object-cover')); ?>
                                                <?php else : ?>
                                                    <div class="w-full h-full bg-gray-200"></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-medium line-clamp-2 text-sm group-hover:text-blue-600">
                                                    <?php the_title(); ?>
                                                </h4>
                                                <div class="mt-1 text-xs text-gray-500">
                                                    <?php echo number_format(get_post_views(get_the_ID())); ?> 回閲覧
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </div>
                        </div>

                        <!-- カテゴリ -->
                        <div class="bg-white rounded-lg p-6">
                            <h3 class="text-lg font-semibold mb-4">カテゴリ</h3>
                            <div class="flex flex-wrap gap-2" id="category-filters">
                                <?php
                                $custom_categories = get_custom_categories();
                                foreach ($custom_categories as $slug => $category) :
                                    $cat_obj = get_category_by_slug($slug);
                                    if ($cat_obj) :
                                ?>
                                    <form action="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" method="POST" style="display: inline;">
                                        <input type="hidden" name="category" value="<?php echo esc_attr($slug); ?>">
                                        <button type="submit" class="px-4 py-2 text-sm rounded border border-gray-300 hover:bg-gray-50 bg-white cursor-pointer">
                                            <?php echo esc_html($category['name']); ?>
                                        </button>
                                    </form>
                                <?php endif; endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PC用サイドバー -->
                <div class="hidden lg:block lg:col-span-1 space-y-6">
                    <!-- 最新記事 -->
                    <div class="bg-white rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">最新記事</h3>
                            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>"
                            class="inline-block border border-gray-300 px-3 py-1 rounded text-sm hover:bg-gray-50">
                                最新記事一覧
                            </a>
                        </div>
                        <div class="space-y-6">
                            <?php
                            $recent_posts = get_posts([
                                'numberposts' => 10,
                                'post_status' => 'publish'
                            ]);
                            foreach ($recent_posts as $post) : setup_postdata($post); ?>
                                <a href="<?php the_permalink(); ?>">
                                    <div class="flex space-x-3 group cursor-pointer">
                                        <div class="w-16 h-16 relative flex-shrink-0 overflow-hidden rounded-lg">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('thumbnail', array('class' => 'w-full h-full object-cover')); ?>
                                            <?php else : ?>
                                                <div class="w-full h-full bg-gray-200"></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-medium line-clamp-2 text-sm group-hover:text-blue-600">
                                                <?php the_title(); ?>
                                            </h4>
                                            <div class="mt-1 text-xs text-gray-500">
                                                <?php echo get_the_date('Y.m.d'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>

<?php get_footer(); ?>
