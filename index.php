<?php get_header(); ?>

<div class="min-h-screen bg-white">
    <!-- メインコンテンツ -->
    <div class="pt-16">
        <div id="mobile-search-margin" class="md:hidden h-0"></div>

        <div class="mx-auto max-w-6xl px-4 py-8">
            <!-- メインビジュアル -->
            <section class="relative h-96 rounded-lg overflow-hidden mb-12">
                <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/main-visual.jpg');"></div>
                <div class="absolute inset-0 bg-black/30 z-10"></div>
                <div class="relative z-20 flex h-full items-center justify-center text-center text-white">
                    <div class="max-w-2xl px-4">
                        <h1 class="mb-4 text-4xl font-bold">ソサイチLABO</h1>
                        <p class="mb-6 text-lg">
                            ソサイチって何？から戦術・トレーニングの深掘りまで、すべてをわかりやすく解説します。
                        </p>
                        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded">
                            記事一覧を見る
                        </a>
                    </div>
                </div>
            </section>
        </div>

        <div class="mx-auto max-w-6xl px-4">
            <div class="mx-auto max-w-6xl px-4 py-12">
                <!-- Latest Articles -->
                <section class="mb-16">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-2xl font-bold">最新記事</h2>
                        <a href="<?php echo add_query_arg('sort', 'newest', get_permalink(get_option('page_for_posts'))); ?>" class="inline-block border border-gray-300 px-4 py-2 rounded text-sm hover:bg-gray-50">
                            最新記事一覧
                        </a>
                    </div>
                    <div class="grid gap-6 md:grid-cols-3">
                        <?php
                        $latest_posts = get_posts(array(
                            'numberposts' => 3,
                            'post_status' => 'publish'
                        ));
                        foreach ($latest_posts as $post) :
                            setup_postdata($post);
                        ?>
                            <a href="<?php the_permalink(); ?>">
                                <div class="group cursor-pointer">
                                    <!-- デスクトップ表示 -->
                                    <div class="hidden md:block">
                                        <div class="aspect-video relative mb-3 overflow-hidden rounded-lg">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover transition-transform group-hover:scale-105')); ?>
                                            <?php else : ?>
                                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-400">No Image</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <h3 class="mb-2 font-semibold line-clamp-2"><?php the_title(); ?></h3>
                                        <p class="text-sm text-gray-600 line-clamp-3"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                    </div>
                                    <!-- スマホ表示 -->
                                    <div class="md:hidden flex space-x-3">
                                        <div class="w-20 h-20 relative flex-shrink-0 overflow-hidden rounded-lg">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('thumbnail', array('class' => 'w-full h-full object-cover')); ?>
                                            <?php else : ?>
                                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-400">No Image</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-semibold line-clamp-2 text-sm mb-1"><?php the_title(); ?></h3>
                                            <p class="text-xs text-gray-600 line-clamp-2"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </section>

                <!-- Popular Articles -->
                <section class="mb-16">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-2xl font-bold">人気記事</h2>
                        <a href="<?php echo add_query_arg('sort', 'popular', get_permalink(get_option('page_for_posts'))); ?>" class="inline-block border border-gray-300 px-4 py-2 rounded text-sm hover:bg-gray-50">
                            人気記事一覧
                        </a>
                    </div>
                    <div class="grid gap-6 md:grid-cols-3">
                        <?php
                        $popular_posts = get_popular_posts(3);
                        foreach ($popular_posts as $post) :
                            setup_postdata($post);
                        ?>
                            <a href="<?php the_permalink(); ?>">
                                <div class="group cursor-pointer">
                                    <!-- デスクトップ表示 -->
                                    <div class="hidden md:block">
                                        <div class="aspect-video relative mb-3 overflow-hidden rounded-lg">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover transition-transform group-hover:scale-105')); ?>
                                            <?php else : ?>
                                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-400">No Image</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <h3 class="mb-2 font-semibold line-clamp-2"><?php the_title(); ?></h3>
                                        <p class="text-sm text-gray-600 line-clamp-3"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                        <div class="mt-2 text-xs text-gray-500"><?php echo number_format(get_post_views(get_the_ID())); ?> 回閲覧</div>
                                    </div>
                                    <!-- スマホ表示 -->
                                    <div class="md:hidden flex space-x-3">
                                        <div class="w-20 h-20 relative flex-shrink-0 overflow-hidden rounded-lg">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('thumbnail', array('class' => 'w-full h-full object-cover')); ?>
                                            <?php else : ?>
                                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-400">No Image</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-semibold line-clamp-2 text-sm mb-1"><?php the_title(); ?></h3>
                                            <p class="text-xs text-gray-600 line-clamp-2"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                            <div class="mt-1 text-xs text-gray-500"><?php echo number_format(get_post_views(get_the_ID())); ?> 回閲覧</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </section>

                <!-- Categories -->
                <section class="mb-16">
                    <h2 class="mb-8 text-2xl font-bold">カテゴリ</h2>
                    <div class="grid gap-4 grid-cols-3 md:grid-cols-5">
                        <?php
                        $custom_categories = get_custom_categories();
                        foreach ($custom_categories as $slug => $category) :
                            $cat_obj = get_category_by_slug($slug);
                            if ($cat_obj) :
                        ?>
                            <a href="<?php echo get_category_link($cat_obj->term_id); ?>" class="text-center transition-transform hover:scale-105">
                                <div class="bg-gradient-to-br <?php echo $category['color']; ?> relative rounded-lg h-32 mb-3 overflow-hidden">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="text-4xl opacity-80"><?php echo $category['icon']; ?></div>
                                    </div>
                                </div>
                                <div class="font-medium text-black text-sm text-left"><?php echo $category['name']; ?></div>
                            </a>
                        <?php endif; endforeach; ?>
                    </div>
                </section>

                <!-- 検索バー -->
                <section class="mb-8 text-center">
                    <div class="mx-auto max-w-md">
                        <form role="search" method="get" action="<?php echo home_url('/'); ?>" class="relative flex">
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
                </section>

                <!-- 人気の検索キーワード -->
                <section class="text-center">
                    <h3 class="mb-4 text-lg font-semibold">人気の検索キーワード</h3>
                    <div class="flex flex-wrap justify-center gap-2">
                        <?php
                        $popular_keywords = array('ソサイチ とは', 'ソサイチ ルール', 'ソサイチ W杯', 'ソサイチ 戦術', 'ソサイチ 関東リーグ');
                        foreach ($popular_keywords as $keyword) :
                        ?>
                            <a href="<?php echo home_url('/?s=' . urlencode($keyword)); ?>" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-full text-sm transition-colors">
                                <?php echo $keyword; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
