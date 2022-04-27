# Contributing to Snow Monkey

🎉👍 Snow Monkey にコントリビュートしようとしてくれてありがとうございます！ 👍🎉

ここでは GitHub を使った Snow Monkey へのコントリビュートの注意点について記述します。

## issues について

Snow Monkey の不具合を見つけた、こういうふうにしたら良いのではないか、などなど何かコメントしたいことがある場合は [issues](https://github.com/inc2734/snow-monkey/issues) に投稿してください。投稿する場合は既に同じ issue が投稿されていないか確認してください。

もしコードを伴った提案の場合は、後述するプルリクエストを行うことが推奨されます！

## プルリクエストについて

コードを伴った提案の場合は [Pull Requests](https://github.com/inc2734/snow-monkey/pulls) からプルリクエストしてください。

### プルリクエストの手順

プルリクエストは新規 faetures ブランチ（feature/{issue番号}）、もしくは、課題に対応した feature ブランチが既にある場合はそちらに送るようにしてください。

* まず、既に同じ課題の issue が立っていないか、立っている場合は作業（コミット）されていないかを確認してください。
* 「issue が立っていない・立っているけどコミットされていない場合」は、フォークして feature/{issue番号} ブランチに切り替えて作業をし、feature/{issue番号} ブランチにプルリクエストしてください。「issue が立っていて既に作業（コミット）されている場合」は、そのコミットのブランチを確認し、そのブランチにプルリクエストしてください。
* Snow Monkey は、コード（PHP）が WordPress のコーディングスタンダードに沿っている状態でリリースさせるために、各種チェックを行っています。作業後、プルリクエストする前に `composer install && npm install && npm run build` と `npm run test` を行い、エラーが出ないことを確認してからプルリクエストしてください。
* WordPress コーディングスタンダードでは空白/タブなども定義されているため、`.editorconfig` を用意しています。`.editorconfig` に対応したエディタを使用されることを推奨します。
