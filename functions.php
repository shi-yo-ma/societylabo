<?php
// テーマサポート
function socyeti_theme_setup() {
    // 投稿サムネイル有効化
    add_theme_support('post-thumbnails');
    
    // メニュー有効化
    add_theme_support('menus');
    
    // HTML5サポート
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // タイトルタグサポート
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'socyeti_theme_setup');

// スタイルとスクリプトの読み込み
function socyeti_enqueue_scripts() {
    // Tailwind CSS
    wp_enqueue_style('tailwind-css', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    
    // テーマスタイル
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    
    // jQuery
    wp_enqueue_script('jquery');
    
    // カスタムスクリプト
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
    
    // Ajax用
    wp_localize_script('theme-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'socyeti_enqueue_scripts');

// カスタムフィールド（閲覧数）
function get_post_views($post_id) {
    $views = get_post_meta($post_id, 'post_views', true);
    return $views ? $views : 0;
}

function set_post_views($post_id) {
    $views = get_post_views($post_id);
    $views++;
    update_post_meta($post_id, 'post_views', $views);
}

// 記事閲覧時に閲覧数を増加
function track_post_views($post_id) {
    if (!is_single()) return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    set_post_views($post_id);
}
add_action('wp_head', 'track_post_views');

// 人気記事取得
function get_popular_posts($limit = 10) {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'meta_key' => 'post_views',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'post_status' => 'publish'
    );
    return get_posts($args);
}

// 関連記事取得
function get_related_posts($post_id, $limit = 5) {
    $categories = wp_get_post_categories($post_id);
    if (empty($categories)) return array();
    
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'post__not_in' => array($post_id),
        'category__in' => $categories,
        'post_status' => 'publish'
    );
    return get_posts($args);
}

// Ajax検索
function ajax_search_posts() {
    check_ajax_referer('ajax_nonce', 'nonce');
    
    $search_term = sanitize_text_field($_POST['search_term']);
    $category = sanitize_text_field($_POST['category']);
    $sort = sanitize_text_field($_POST['sort']);
    
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );
    
    if (!empty($search_term)) {
        $args['s'] = $search_term;
    }
    
    if (!empty($category) && $category !== 'all') {
        $args['category_name'] = $category;
    }
    
    switch ($sort) {
        case 'popular':
            $args['meta_key'] = 'post_views';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'oldest':
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
            break;
        default:
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
    }
    
    $posts = get_posts($args);
    
    ob_start();
    foreach ($posts as $post) {
        setup_postdata($post);
        include(get_template_directory() . '/template-parts/article-card.php');
    }
    wp_reset_postdata();
    
    $html = ob_get_clean();
    
    wp_send_json_success($html);
}
add_action('wp_ajax_search_posts', 'ajax_search_posts');
add_action('wp_ajax_nopriv_search_posts', 'ajax_search_posts');

// カテゴリ記事数取得
function get_category_post_count($category_slug) {
    $category = get_category_by_slug($category_slug);
    return $category ? $category->count : 0;
}

// カスタムカテゴリ設定
function get_custom_categories() {
    return array(
        'tactics' => array('name' => 'タクティクス', 'icon' => '🌿', 'color' => 'from-green-400 to-green-600'),
        'training' => array('name' => 'トレーニング', 'icon' => '🌱', 'color' => 'from-teal-400 to-teal-600'),
        'team-building' => array('name' => 'チームビルディング', 'icon' => '👥', 'color' => 'from-blue-400 to-blue-600'),
        'equipment' => array('name' => '用具', 'icon' => '⚽', 'color' => 'from-orange-400 to-orange-600'),
        'news' => array('name' => 'ニュース', 'icon' => '📰', 'color' => 'from-purple-400 to-purple-600'),
    );
}
?>
