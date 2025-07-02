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
            <div class="mb-2 flex flex-wrap gap-1">
                <?php
                $categories = get_the_category();
                foreach ($categories as $category) :
                ?>
                    <span class="bg-gray-200 px-2 py-1 rounded text-xs">
                        <?php echo $category->name; ?>
                    </span>
                <?php endforeach; ?>
            </div>
            <h3 class="mb-2 font-semibold line-clamp-2"><?php the_title(); ?></h3>
            <p class="text-sm text-gray-600 line-clamp-3 mb-3"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
            <div class="flex justify-between items-center text-xs text-gray-500">
                <span><?php echo get_the_date('Y年m月d日'); ?></span>
                <span><?php echo number_format(get_post_views(get_the_ID())); ?> 回閲覧</span>
            </div>
        </div>
        <!-- スマホ表示 -->
        <div class="md:hidden flex space-x-3">
            <div class="w-20 h-20 relative flex-shrink-0 overflow-hidden rounded-lg">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('thumbnail', array('class' => 'w-full h-full object-cover')); ?>
                <?php else : ?>
                    <div class="w-full h-full bg-gray-200"></div>
                <?php endif; ?>
            </div>
            <div class="flex-1 min-w-0">
                <div class="mb-1 flex flex-wrap gap-1">
                    <?php
                    $categories = get_the_category();
                    foreach ($categories as $category) :
                    ?>
                        <span class="bg-gray-200 px-2 py-1 rounded text-xs">
                            <?php echo $category->name; ?>
                        </span>
                    <?php endforeach; ?>
                </div>
                <h3 class="font-semibold line-clamp-2 text-sm mb-1"><?php the_title(); ?></h3>
                <p class="text-xs text-gray-600 line-clamp-2 mb-1"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                <div class="flex justify-between items-center text-xs text-gray-500">
                    <span><?php echo get_the_date('Y年m月d日'); ?></span>
                    <span><?php echo number_format(get_post_views(get_the_ID())); ?> 回閲覧</span>
                </div>
            </div>
        </div>
    </div>
</a>
