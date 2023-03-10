## 概要
このリポジトリでは GitHub Actions が有効になっているため、マージを許可する前に各プルリクエストがチェックされます。
このシステムは、新しい PR がマスターに到達するたびにマスターブランチから構築される `fiware/orion-ci:deb` に基づいており、
すべてのビルド依存関係がオンボードにあるクリーンな環境を提供します。この Docker のビルドに使用される Dockerfile は、
`ci/deb` ディレクトリにあります。

テスト対象の PR ブランチが変更されたため、`fiware/orion-ci:deb` は再構築されないことに注意してください。したがって、
新しいライブラリまたはベースシステムを必要とする機能を開発している場合は、そのようなライブラリまたはベースシステムを
`ci/deb/build-dep.sh` および/または `Dockerfile` に追加する PR を*最初に*実行する必要があります。その PR がマスターに
マージされ、`fiware/orion-ci:deb` が再構築されると (Docker Hub の https://hub.docker.com/r/fiware/orion-ci/builds
で進行状況を確認)、新しい機能は、GitHub アクションでテストする準備ができています。

GitHub Actions チェックは段階に分かれており、 "サポートされているテスト" セクションで説明されています。

## サポートされているテスト
CI の現在のバージョンは以下をサポートします:

* ファイル・コンプライアンス・チェック
* ペイロード・チェック
* スタイル・チェック
* 単体テスト
* 機能テスト

ファイル・コンプライアンス、ペイロード、およびスタイル・チェックは、1つの 'compliance' テストにまとめられています。
