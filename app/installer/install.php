<?php

use Atomcms\Application as App;

App::config()->set('system/site', App::config('system/site')->merge([
    'frontpage' => 1, 'view' => ['logo' => 'storage/atom.png']
]));

App::db()->insert('@system_config', ['name' => 'theme-one', 'value' => '{"logo_contrast":"storage\\/atom.png","_menus":{"main":"main","offcanvas":"main"},"_positions":{"hero":[1],"footer":[2]},"_widgets":{"1":{"title_hide":true,"title_size":"at-panel-title","alignment":true,"html_class":"","panel":""},"2":{"title_hide":true,"title_size":"at-panel-title","alignment":"true","html_class":"","panel":""}},"_nodes":{"1":{"title_hide":true,"title_large":false,"alignment":true,"html_class":"","sidebar_first":false,"hero_image":"storage\\/home-hero.jpg","hero_viewport":true,"hero_contrast":true,"navbar_transparent":true}}}']);

App::db()->insert('@system_node', ['priority' => 1, 'status' => 1, 'title' => 'Home', 'slug' => 'home', 'path' => '/home', 'link' => '@page/1', 'type' => 'page', 'menu' => 'main', 'data' => "{\"defaults\":{\"id\":1}}"]);

App::db()->insert('@system_node', ['priority' => 2, 'status' => 1, 'title' => 'Blog', 'slug' => 'blog', 'path' => '/blog', 'link' => '@blog', 'type' => 'blog', 'menu' => 'main']);

App::db()->insert('@system_widget', ['title' => 'Hello, I\'m Atomcms', 'type' => 'system/text', 'status' => 1, 'nodes' => 1, 'data' => '{"content":"<h1 class=\"at-heading-large at-margin-large-bottom\">Hello, I\'m Atomcms,<br class=\"at-hidden-small\"> your new favorite CMS.<\/h1>\n\n<a class=\"at-button at-button-large\" href=\"http:\/\/atomcms.altervista.org\">Get started<\/a>"}']);

App::db()->insert('@system_widget', ['title' => 'Powered by Atomcms', 'type' => 'system/text', 'status' => 1, 'data' => '{"content":"<ul class=\"at-grid at-grid-medium at-flex at-flex-center\">\n    <li><a href=\"https:\/\/github.com\/xdev31\/\atomcms" class=\"at-icon-hover at-icon-small at-icon-github\"><\/a><\/li>\n    <\/a><\/li>\n    <li><a href=\"https:\/\/gitter.im\/" class=\"at-icon-hover at-icon-small at-icon-comment-o\"><\/a><\/li>\n    <li><a href=\"" class=\"at-icon-hover at-icon-small at-icon-google-plus\"><\/a><\/li>\n<\/ul>\n\n<p>Powered by <a href=\"https:\/\/atomcms.altervista.org\">Atomcms<\/a><\/p>"}']);

App::db()->insert('@system_page', [
    'title' => 'Home',
    'content' => "<div class=\"at-width-medium-3-4 at-container-center\">\n    \n<h3 class=\"at-h1 at-margin-large-bottom\">Uniting fresh design and clean code<br class=\"at-hidden-small\"> to create beautiful websites.</h3>\n\n<p class=\"at-width-medium-4-6 at-container-center\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\n\n</div>",
    'data' => '{"title":true}'
]);

if (App::db()->getUtility()->tableExists('@blog_post')) {
    App::db()->insert('@blog_post', [
        'user_id' => 1,
        'slug' => 'hello-pagekit',
        'title' => 'Hello Atomcms',
        'status' => 2,
        'date' => date('Y-m-d H:i:s'),
        'modified' => date('Y-m-d H:i:s'),
        'content' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        'excerpt' => '',
        'comment_status' => 1,
        'data' => '{"title":null,"markdown":true}'
    ]);
}
