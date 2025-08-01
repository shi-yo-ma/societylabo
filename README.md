# ソサイチLABO WordPressテーマ

フットサル専門ブログのWordPressテーマです。

## セットアップ手順

1. WordPressの管理画面から「外観」→「テーマ」→「新規追加」→「テーマのアップロード」でテーマファイルをアップロード

2. テーマを有効化

3. 必要なカテゴリを作成:
   - tactics (タクティクス)
   - training (トレーニング)
   - team-building (チームビルディング)
   - equipment (用具)
   - news (ニュース)

4. 投稿にアイキャッチ画像を設定

5. 閲覧数を表示するため、投稿を表示すると自動的にカスタムフィールド「post_views」が作成されます

## 機能

- レスポンシブデザイン
- 記事閲覧数カウント
- 人気記事表示
- 関連記事表示
- カテゴリフィルタリング
- Ajax検索
- ソーシャルシェア機能

## カスタマイズ

- `functions.php`でカテゴリ設定やその他機能をカスタマイズ可能
- `style.css`でデザインの調整が可能
- Tailwind CSSを使用しているため、クラス名でスタイリング

## 必要な画像

- ヒーロー画像: `images/hero-bg.jpg`
- 各投稿のアイキャッチ画像

## 注意事項

- Tailwind CSSのCDNを使用しています
- jQueryを使用しています
- 閲覧数機能はカスタムフィールドを使用
\`\`\`

WordPressテーマへの変換が完了しました！

## 🎯 **主な変更点**

### **📁 ファイル構成**
- **style.css**: テーマ情報とTailwind CSS
- **functions.php**: WordPress機能とカスタム関数
- **front-page.php**: ホームページ
- **home.php**: 記事一覧ページ  
- **single.php**: 記事詳細ページ
- **search.php**: 検索結果ページ
- **header.php/footer.php**: 共通部分
- **template-parts/article-card.php**: 記事カード部品

### **🔧 WordPress機能**
- **投稿管理**: WordPress管理画面から記事投稿
- **カテゴリ管理**: 標準のカテゴリ機能を活用
- **閲覧数**: カスタムフィールドで自動カウント
- **アイキャッチ画像**: 標準機能を使用
- **検索機能**: WordPress標準検索

### **⚡ 動的機能**
- **Ajax検索**: リアルタイムフィルタリング
- **人気記事**: 閲覧数ベースで自動生成
- **関連記事**: カテゴリベースで自動表示
- **レスポンシブ**: 全デバイス対応

### **🎨 デザイン維持**
- **完全同一**: Next.js版と全く同じデザイン
- **Tailwind CSS**: CDN経由で読み込み
- **JavaScript**: jQuery使用で動的機能実装

これでWordPress管理画面から記事投稿・編集ができ、デザインと機能は全く変わらないブログサイトが完成します！
