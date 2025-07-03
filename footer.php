<script>
        // ヘッダーの高さに合わせて検索バーのtop位置をセット
        function adjustMobileSearchTop() {
            var header = document.querySelector('header');
            var search = document.getElementById('mobile-search');
            if (header && search) {
                var headerHeight = header.offsetHeight; // パディング・ボーダー含む高さ
                console.log('headerHeight:', headerHeight);
                search.style.top = headerHeight + 'px';
            }
        }

        // ウィンドウサイズ変更時にも高さ調整
        window.addEventListener('resize', adjustMobileSearchTop);
        // ページ読み込み時にも高さ調整
        window.addEventListener('DOMContentLoaded', adjustMobileSearchTop);
        
        // モバイル検索トグル
        document.getElementById('mobile-search-toggle').addEventListener('click', function() {
            const searchBar = document.getElementById('mobile-search');
            const margin = document.getElementById('mobile-search-margin');
            
            if (searchBar.classList.contains('hidden')) {
                searchBar.classList.remove('hidden');
                margin.classList.add('h-16');
            } else {
                searchBar.classList.add('hidden');
                margin.classList.remove('h-16');
            }
        });

        // プロフィールモーダル
        const profileToggle = document.getElementById('profile-toggle');
        const profileModal = document.getElementById('profile-modal');
        const profileBackdrop = document.getElementById('profile-backdrop');
        const profileClose = document.getElementById('profile-close');

        profileToggle.addEventListener('click', function() {
            profileModal.classList.remove('hidden');
        });

        profileBackdrop.addEventListener('click', function() {
            profileModal.classList.add('hidden');
        });

        profileClose.addEventListener('click', function() {
            profileModal.classList.add('hidden');
        });

        // シェア機能
        function shareArticle() {
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    url: window.location.href
                });
            } else {
                navigator.clipboard.writeText(window.location.href);
                alert('URLをクリップボードにコピーしました');
            }
        }

        // お問い合わせフォーム
        const contactForm = document.getElementById('contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const message = document.getElementById('contact-message').value;
                if (message.trim()) {
                    alert('お問い合わせありがとうございます。内容を確認後、ご連絡いたします。');
                    document.getElementById('contact-message').value = '';
                }
            });
        }

        // カテゴリフィルタ（記事一覧ページ）
        const categoryFilters = document.querySelectorAll('.category-filter');
        const sortSelect = document.getElementById('sort-select');
        
        if (categoryFilters.length > 0) {
            categoryFilters.forEach(filter => {
                filter.addEventListener('click', function() {
                    // アクティブ状態の切り替え
                    categoryFilters.forEach(f => {
                        f.classList.remove('active', 'bg-blue-600', 'text-white');
                        f.classList.add('border-gray-300', 'hover:bg-gray-50');
                    });
                    
                    this.classList.add('active', 'bg-blue-600', 'text-white');
                    this.classList.remove('border-gray-300', 'hover:bg-gray-50');
                    
                    // フィルタリング実行
                    filterArticles();
                });
            });
        }

        if (sortSelect) {
            sortSelect.addEventListener('change', filterArticles);
        }

        function filterArticles() {
            const activeCategory = document.querySelector('.category-filter.active')?.dataset.category || 'all';
            const sortBy = sortSelect?.value || 'newest';
            
            // Ajax リクエストでフィルタリング
            const formData = new FormData();
            formData.append('action', 'search_posts');
            formData.append('category', activeCategory);
            formData.append('sort', sortBy);
            formData.append('nonce', '<?php echo wp_create_nonce("ajax_nonce"); ?>');
            
            fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('articles-container').innerHTML = data.data;
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

    <?php wp_footer(); ?>
</body>
</html>
