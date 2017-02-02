<?php

namespace Users;

class Controller_Access_Modules extends \Helper\Dashboard
{

    public function action_index()
    {
        \Breadcrumb::set('مدیریت کاربران', \Uri::create('dashboard/users/index.html'), '2');
        \Breadcrumb::set('مدیریت ماژول ها', '', '3');
        $data ["address"] = 'dashboard/users/access/modules';
        $data['icon']     = array('' => 'No Icon', "fa-glass" => 'fa-glass &#xf000; ', "fa-music" => 'fa-music &#xf001; ', "fa-search" => 'fa-search &#xf002; ', "fa-envelope-o" => 'fa-envelope-o &#xf003; ', "fa-heart" => 'fa-heart &#xf004; ', "fa-star" => 'fa-star &#xf006; ', "fa-user" => 'fa-user &#xf007; ', "fa-film" => 'fa-film &#xf008; ', "fa-th-large" => 'fa-th-large &#xf009; ', "fa-th" => 'fa-th &#xf00a; ', "fa-th-list" => 'fa-th-list &#xf00b; ', "fa-check" => 'fa-check &#xf00c; ', "fa-times" => 'fa-times &#xf00d; ', "fa-search-plus" => 'fa-search-plus &#xf00e; ', "fa-search-minus" => 'fa-search-minus &#xf010; ', "fa-power-off" => 'fa-power-off &#xf011; ', "fa-signal" => 'fa-signal &#xf012; ', "fa-cog" => 'fa-cog &#xf013; ', "fa-trash-o" => 'fa-trash-o &#xf014; ', "fa-home" => 'fa-home &#xf015; ', "fa-file-o" => 'fa-file-o &#xf016; ', "fa-clock-o" => 'fa-clock-o &#xf017; ', "fa-road" => 'fa-road &#xf018; ', "fa-download" => 'fa-download &#xf019; ', "fa-arrow-circle-o-down" => 'fa-arrow-circle-o-down &#xf01a; ', "fa-arrow-circle-o-up" => 'fa-arrow-circle-o-up &#xf01b; ', "fa-inbox" => 'fa-inbox &#xf01c; ', "fa-play-circle-o" => 'fa-play-circle-o &#xf01d; ', "fa-repeat" => 'fa-repeat &#xf01e; ', "fa-refresh" => 'fa-refresh &#xf021; ', "fa-list-alt" => 'fa-list-alt &#xf022; ', "fa-lock" => 'fa-lock &#xf023; ', "fa-flag" => 'fa-flag &#xf024; ', "fa-headphones" => 'fa-headphones &#xf025; ', "fa-volume-off" => 'fa-volume-off &#xf026; ', "fa-volume-down" => 'fa-volume-down &#xf027; ', "fa-volume-up" => 'fa-volume-up &#xf028; ', "fa-qrcode" => 'fa-qrcode &#xf029; ', "fa-barcode" => 'fa-barcode &#xf02a; ', "fa-tag" => 'fa-tag &#xf02b; ', "fa-tags" => 'fa-tags &#xf02c; ', "fa-book" => 'fa-book &#xf02d; ', "fa-bookmark" => 'fa-bookmark &#xf02e; ', "fa-print" => 'fa-print &#xf02f; ', "fa-camera" => 'fa-camera &#xf030; ', "fa-font" => 'fa-font &#xf031; ', "fa-bold" => 'fa-bold &#xf032; ', "fa-italic" => 'fa-italic &#xf033; ', "fa-text-height" => 'fa-text-height &#xf034; ', "fa-text-width" => 'fa-text-width &#xf035; ', "fa-align-left" => 'fa-align-left &#xf036; ', "fa-align-center" => 'fa-align-center &#xf037; ', "fa-align-right" => 'fa-align-right &#xf038; ', "fa-align-justify" => 'fa-align-justify &#xf039; ', "fa-list" => 'fa-list &#xf03a; ', "fa-outdent" => 'fa-outdent &#xf03b; ', "fa-indent" => 'fa-indent &#xf03c; ', "fa-video-camera" => 'fa-video-camera &#xf03d; ', "fa-picture-o" => 'fa-picture-o &#xf03e; ', "fa-pencil" => 'fa-pencil &#xf040; ', "fa-map-marker" => 'fa-map-marker &#xf041; ', "fa-adjust" => 'fa-adjust &#xf042; ', "fa-tint" => 'fa-tint &#xf043; ', "fa-pencil-square-o" => 'fa-pencil-square-o &#xf044; ', "fa-share-square-o" => 'fa-share-square-o &#xf045; ', "fa-check-square-o" => 'fa-check-square-o &#xf046; ', "fa-arrows" => 'fa-arrows &#xf047; ', "fa-step-backward" => 'fa-step-backward &#xf048; ', "fa-fast-backward" => 'fa-fast-backward &#xf049; ', "fa-backward" => 'fa-backward &#xf04a; ', "fa-play" => 'fa-play &#xf04b; ', "fa-pause" => 'fa-pause &#xf04c; ', "fa-stop" => 'fa-stop &#xf04d; ', "fa-forward" => 'fa-forward &#xf04e; ', "fa-fast-forward" => 'fa-fast-forward &#xf050; ', "fa-step-forward" => 'fa-step-forward &#xf051; ', "fa-eject" => 'fa-eject &#xf052; ', "fa-chevron-left" => 'fa-chevron-left &#xf053; ', "fa-chevron-right" => 'fa-chevron-right &#xf054; ', "fa-plus-circle" => 'fa-plus-circle &#xf055; ', "fa-minus-circle" => 'fa-minus-circle &#xf056; ', "fa-times-circle" => 'fa-times-circle &#xf057; ', "fa-check-circle" => 'fa-check-circle &#xf058; ', "fa-question-circle" => 'fa-question-circle &#xf059; ', "fa-info-circle" => 'fa-info-circle &#xf05a; ', "fa-crosshairs" => 'fa-crosshairs &#xf05b; ', "fa-times-circle-o" => 'fa-times-circle-o &#xf05c; ', "fa-check-circle-o" => 'fa-check-circle-o &#xf05d; ', "fa-ban" => 'fa-ban &#xf05e; ', "fa-arrow-left" => 'fa-arrow-left &#xf060; ', "fa-arrow-right" => 'fa-arrow-right &#xf061; ', "fa-arrow-up" => 'fa-arrow-up &#xf062; ', "fa-arrow-down" => 'fa-arrow-down &#xf063; ', "fa-share" => 'fa-share &#xf064; ', "fa-expand" => 'fa-expand &#xf065; ', "fa-compress" => 'fa-compress &#xf066; ', "fa-plus" => 'fa-plus &#xf067; ', "fa-minus" => 'fa-minus &#xf068; ', "fa-asterisk" => 'fa-asterisk &#xf069; ', "fa-exclamation-circle" => 'fa-exclamation-circle &#xf06a; ', "fa-gift" => 'fa-gift &#xf06b; ', "fa-leaf" => 'fa-leaf &#xf06c;', "fa-fire" => 'fa-fire &#xf06d; ', "fa-eye" => 'fa-eye &#xf06e; ', "fa-eye-slash" => 'fa-eye-slash &#xf070; ', "fa-exclamation-triangle" => 'fa-exclamation-triangle &#xf071; ', "fa-plane" => 'fa-plane &#xf072; ', "fa-calendar" => 'fa-calendar &#xf073; ', "fa-random" => 'fa-random &#xf074; ', "fa-comment" => 'fa-comment &#xf075;', "fa-magnet" => 'fa-magnet &#xf076; ', "fa-chevron-up" => 'fa-chevron-up &#xf077; ', "fa-chevron-down" => 'fa-chevron-down &#xf078; ', "fa-retweet" => 'fa-retweet &#xf079; ', "fa-shopping-cart" => 'fa-shopping-cart &#xf07a; ', "fa-folder" => 'fa-folder &#xf07b;', "fa-folder-open" => 'fa-folder-open &#xf07c; ', "fa-arrows-v" => 'fa-arrows-v &#xf07d; ', "fa-arrows-h" => 'fa-arrows-h &#xf07e; ', "fa-bar-chart-o" => 'fa-bar-chart-o &#xf080; ', "fa-twitter-square" => 'fa-twitter-square &#xf081; ', "fa-facebook-square" => 'fa-facebook-square &#xf082; ', "fa-camera-retro" => 'fa-camera-retro &#xf083;', "fa-key" => 'fa-key &#xf084; ', "fa-cogs" => 'fa-cogs &#xf085; ', "fa-comments" => 'fa-comments &#xf086; ', "fa-thumbs-o-up" => 'fa-thumbs-o-up &#xf087; ', "fa-thumbs-o-down" => 'fa-thumbs-o-down &#xf088; ', "fa-star-half" => 'fa-star-half &#xf089; ', "fa-heart-o" => 'fa-heart-o &#xf08a; ', "fa-sign-out" => 'fa-sign-out &#xf08b;', "fa-linkedin-square" => 'fa-linkedin-square &#xf08c; ', "fa-thumb-tack" => 'fa-thumb-tack &#xf08d; ', "fa-external-link" => 'fa-external-link &#xf08e; ', "fa-sign-in" => 'fa-sign-in &#xf090; ', "fa-trophy" => 'fa-trophy &#xf091; ', "fa-github-square" => 'fa-github-square &#xf092; ', "fa-upload" => 'fa-upload &#xf093; ', "fa-lemon-o" => 'fa-lemon-o &#xf094; ', "fa-phone" => 'fa-phone &#xf095; ', "fa-square-o" => 'fa-square-o &#xf096; ', "fa-bookmark-o" => 'fa-bookmark-o &#xf097; ', "a-phone-square" => 'a-phone-square &#xf098; ', "fa-twitter" => 'fa-twitter &#xf099; ', "fa-facebook" => 'fa-facebook &#xf09a; ', "fa-github" => 'fa-github &#xf09b; ', "fa-unlock" => 'fa-unlock &#xf09c; ', "fa-credit-card" => 'fa-credit-card &#xf09d; ', "fa-rss" => 'fa-rss &#xf09e; ', "fa-hdd-o" => 'fa-hdd-o &#xf0a0; ', "fa-bullhorn" => 'fa-bullhorn &#xf0a1; ', "fa-bell" => 'fa-bell &#xf0f3; ', "fa-certificate" => 'fa-certificate &#xf0a3; ', "fa-hand-o-right" => 'fa-hand-o-right &#xf0a4; ', "fa-hand-o-left" => 'fa-hand-o-left &#xf0a5; ', "fa-hand-o-up" => 'fa-hand-o-up &#xf0a6; ', "fa-hand-o-down" => 'fa-hand-o-down &#xf0a7; ', "fa-arrow-circle-left" => 'fa-arrow-circle-left &#xf0a8; ', "fa-arrow-circle-right" => 'fa-arrow-circle-right &#xf0a9; ', "fa-arrow-circle-up" => 'fa-arrow-circle-up &#xf0aa; ', "fa-arrow-circle-down" => 'fa-arrow-circle-down &#xf0ab; ', "fa-globe" => 'fa-globe &#xf0ac; ', "fa-wrench" => 'fa-wrench &#xf0ad; ', "fa-tasks" => 'fa-tasks &#xf0ae;', "fa-filter" => 'fa-filter#xf0b0; ', "fa-briefcase" => 'fa-briefcase#xf0b1; ', "fa-arrows-alt" => 'fa-arrows-alt &#xf0b2; ', "fa-users" => 'fa-users &#xf0c0; ', "fa-link" => 'fa-link &#xf0c1; ', "fa-cloud" => 'fa-cloud &#xf0c2; ', "fa-flask" => 'fa-flask &#xf0c3; ', "fa-scissors" => 'fa-scissors &#xf0c4; ', "fa-files-o" => 'fa-files-o#xf0c5; ', "fa-paperclip" => 'fa-paperclip &#xf0c6; ', "fa-floppy-o" => 'fa-floppy-o &#xf0c7; ', "fa-square" => 'fa-square &#xf0c8; ', "fa-bars" => 'fa-bars &#xf0c9; ', "fa-list-ul" => 'fa-list-ul &#xf0ca; ', "fa-list-ol" => 'fa-list-ol &#xf0cb; ', "fa-strikethrough" => 'fa-strikethrough &#xf0cc; ', "fa-underline" => 'fa-underline &#xf0cd; ', "fa-table" => 'fa-table &#xf0ce; ', "fa-magic" => 'fa-magic &#xf0d0; ', "fa-truck" => 'fa-truck &#xf0d1; ', "fa-pinterest" => 'fa-pinterest &#xf0d2; ', "fa-pinterest-square" => 'fa-pinterest-square#xf0d3; ', "fa-google-plus-square" => 'fa-google-plus-square &#xf0d4; ', "fa-google-plus" => 'fa-google-plus &#xf0d5; ', "fa-money" => 'fa-money &#xf0d6; ', "fa-caret-down" => 'fa-caret-down &#xf0d7; ', "fa-caret-up" => 'fa-caret-up &#xf0d8; ', "fa-caret-left" => 'fa-caret-left &#xf0d9; ', "fa-caret-right" => 'fa-caret-right &#xf0da; ', "fa-columns" => 'fa-columns &#xf0db; ', "fa-sort" => 'fa-sort &#xf0dc; ', "fa-sort-asc" => 'fa-sort-asc &#xf0dd; ', "fa-sort-desc" => 'fa-sort-desc &#xf0de; ', "fa-envelope" => 'fa-envelope &#xf0e0; ', "fa-linkedin" => 'fa-linkedin &#xf0e1; ', "fa-undo" => 'fa-undo &#xf0e2; ', "fa-gavel" => 'fa-gavel &#xf0e3; ', "fa-tachometer" => 'fa-tachometer &#xf0e4; ', "fa-comment-o" => 'fa-comment-o &#xf0e5; ', "fa-comments-o" => 'fa-comments-o &#xf0e6; ', "fa-bolt" => 'fa-bolt &#xf0e7; ', "fa-sitemap" => 'fa-sitemap &#xf0e8; ', "fa-umbrella" => 'fa-umbrella &#xf0e9; ', "fa-clipboard" => 'fa-clipboard &#xf0ea; ', "fa-lightbulb-o" => 'fa-lightbulb-o &#xf0eb; ', "fa-exchange" => 'fa-exchange &#xf0ec; ', "fa-cloud-download" => 'fa-cloud-download &#xf0ed; ', "fa-cloud-upload" => 'fa-cloud-upload &#xf0ee; ', "fa-user-md" => 'fa-user-md &#xf0f0; ', "fa-stethoscope" => 'fa-stethoscope &#xf0f1; ', "fa-suitcase" => 'fa-suitcase &#xf0f2; ', "fa-bell-o" => 'fa-bell-o &#xf0a2; ', "fa-coffee" => 'fa-coffee &#xf0f4; ', "fa-cutlery" => 'fa-cutlery &#xf0f5; ', "fa-file-text-o" => 'fa-file-text-o &#xf0f6; ', "fa-building-o" => 'fa-building-o &#xf0f7; ', "fa-hospital-o" => 'fa-hospital-o &#xf0f8; ', "fa-ambulance" => 'fa-ambulance &#xf0f9; ', "fa-medkit" => 'fa-medkit &#xf0fa; ', "fa-fighter-jet" => 'fa-fighter-jet &#xf0fb; ', "fa-beer" => 'fa-beer &#xf0fc; ', "fa-h-square" => 'fa-h-square &#xf0fd; ', "fa-plus-square" => 'fa-plus-square &#xf0fe; ', "fa-angle-double-left" => 'fa-angle-double-left &#xf100; ', "fa-angle-double-right" => 'fa-angle-double-right &#xf101; ', "fa-angle-double-up" => 'fa-angle-double-up &#xf102; ', "fa-angle-double-down" => 'fa-angle-double-down &#xf103; ', "fa-angle-left" => 'fa-angle-left &#xf104; ', "fa-angle-right" => 'fa-angle-right &#xf105; ', "fa-angle-up" => 'fa-angle-up &#xf106; ', "fa-angle-down" => 'fa-angle-down &#xf107; ', "fa-desktop" => 'fa-desktop &#xf08; ', "fa-laptop" => 'fa-laptop &#xf109; ', "fa-tablet" => 'fa-tablet &#xf10a; ', "fa-mobile" => 'fa-mobile &#xf10b; ', "fa-circle-o" => 'fa-circle-o &#xf10c; ', "fa-quote-left" => 'fa-quote-left &#xf10d;', "fa-quote-right" => 'fa-quote-right &#xf10e; ', "fa-spinner" => 'fa-spinner &#xf110; ', "fa-circle" => 'fa-circle &#xf111; ', "fa-reply" => 'fa-reply &#xf112; ', "fa-github-alt" => 'fa-github-alt &#xf113; ', "fa-folder-o" => 'fa-folder-o &#xf114; ', "fa-folder-open-o" => 'fa-folder-open-o &#xf115; ', "fa-smile-o" => 'fa-smile-o &#xf118; ', "fa-frown-o" => 'fa-frown-o &#xf119; ', "fa-meh-o" => 'fa-meh-o &#xf11a; ', "fa-gamepad" => 'fa-gamepad &#xf11b; ', "fa-keyboard-o" => 'fa-keyboard-o &#xf11c; ', "fa-flag-o" => 'fa-flag-o &#xf11d; ', "fa-flag-checkered" => 'fa-flag-checkered &#xf11e; ', "fa-terminal" => 'fa-terminal &#xf120; ', "fa-code" => 'fa-code &#xf121; ', "fa-reply-all" => 'fa-reply-all &#xf122; ', "fa-mail-reply-all" => 'fa-mail-reply-all &#xf122; ', "fa-star-half-o" => 'fa-star-half-o &#xf123; ', "fa-location-arrow" => ' fa-location-arrow &#xf124;', "fa-crop" => 'fa-crop &#xf125; ', "fa-code-fork" => 'fa-code-fork &#xf126; ', "fa-chain-broken" => 'fa-chain-broken &#xf127; ', "fa-question" => 'fa-question &#xf128; ', "fa-info" => 'fa-info &#xf129; ', "fa-exclamation" => 'fa-exclamation &#xf12a; ', "fa-superscript" => 'fa-superscript &#xf12b; ', "fa-subscript" => 'fa-subscrip &#xf12c; t', "fa-eraser" => 'fa-eraser &#xf12d; ', "fa-puzzle-piece" => 'fa-puzzle-piece &#xf12e; ', "fa-microphone" => 'fa-microphone &#xf130; ', "fa-microphone-slash" => 'fa-microphone-slash &#xf131; ', "fa-shield" => 'fa-shield &#xf132; ', "fa-calendar-o" => 'fa-calendar-o &#xf133; ', "fa-fire-extinguisher" => 'fa-fire-extinguisher &#xf134; ', "fa-rocket" => 'fa-rocket &#xf135; ', "fa-maxcdn" => 'fa-maxcdn &#xf136; ', "fa-chevron-circle-left" => 'fa-chevron-circle-left &#xf137; ', "fa-chevron-circle-right" => 'fa-chevron-circle-right &#xf138; ', "fa-chevron-circle-up" => 'fa-chevron-circle-up &#xf139; ', "fa-chevron-circle-down" => 'fa-chevron-circle-down &#xf13a; ', "fa-html5" => 'fa-html5 &#xf13b; ', "fa-css3" => 'fa-css3 &#xf13c; ', "fa-anchor" => 'fa-anchor &#xf13d; ', "fa-unlock-alt" => 'fa-unlock-alt &#xf13e; ', "fa-bullseye" => 'fa-bullseye &#xf140; ', "fa-ellipsis-h" => 'fa-ellipsis-h &#xf141; ', "fa-ellipsis-v" => 'fa-ellipsis-v &#xf142; ', "fa-rss-square" => 'fa-rss-square &#xf143; ', "fa-play-circle" => 'fa-play-circle &#xf144; ', "fa-ticket" => 'fa-ticket &#xf145; ', "fa-minus-square" => 'fa-minus-square &#xf146; ', "fa-minus-square-o" => 'fa-minus-square-o &#xf147; ', "fa-level-up" => 'fa-level-up &#xf148; ', "fa-level-down" => 'fa-level-down &#xf149; ', "fa-check-square" => 'fa-check-square &#xf14a; ', "fa-pencil-square" => 'fa-pencil-square &#xf14b; ', "fa-external-link-square" => 'fa-external-link-square &#xf14c; ', "fa-share-square" => 'fa-share-square &#xf14d; ', "fa-compass" => 'fa-compass &#xf14e; ', "fa-caret-square-o-down" => 'fa-caret-square-o-down &#xf150; ', "fa-caret-square-o-up" => 'fa-caret-square-o-up &#xf151; ', "fa-caret-square-o-right" => 'fa-caret-square-o-right &#xf152; ', "fa-eur" => 'fa-eur &#xf153; ', "fa-gbp" => 'fa-gbp &#xf154; ', "fa-usd" => 'fa-usd &#xf155; ', "fa-inr" => 'fa-inr &#xf156; ', "fa-jpy" => 'fa-jpy &#xf157; ', "fa-rub" => 'fa-rub &#xf158; ', "fa-krw" => 'fa-krw &#xf159; ', "fa-btc" => 'fa-btc &#xf15a; ', "fa-file" => 'fa-file &#xf15b; ', "fa-file-text" => 'fa-file-text &#xf15c; ', "fa-sort-alpha-asc" => 'fa-sort-alpha-asc &#xf15d; ', "fa-sort-alpha-desc" => 'fa-sort-alpha-desc &#xf15e; ', "fa-sort-amount-asc" => 'fa-sort-amount-asc &#xf160; ', "fa-sort-amount-desc" => ' fa-sort-amount-desc &#xf161;', "fa-sort-numeric-asc" => 'fa-sort-numeric-asc &#xf162; ', "fa-sort-numeric-desc" => 'fa-sort-numeric-desc &#xf163; ', "fa-thumbs-up" => 'fa-thumbs-up &#xf164; ', "fa-thumbs-down" => 'fa-thumbs-down &#xf165; ', "fa-youtube-square" => 'fa-youtube-square &#xf166; ', "fa-youtube" => 'fa-youtube &#xf167; ', "fa-xing" => 'fa-xing &#xf168; ', "fa-xing-square" => 'fa-xing-square &#xf169; ', "fa-youtube-play" => 'fa-youtube-play &#xf16a; ', "fa-dropbox" => 'fa-dropbox &#xf16b; ', "fa-stack-overflow" => 'fa-stack-overflow &#xf16c; ', "fa-instagram" => 'fa-instagram &#xf16d; ', "fa-flickr" => 'fa-flickr &#xf16e; ', "fa-adn" => 'fa-adn &#xf170; ', "fa-bitbucket" => 'fa-bitbucket &#xf171; ', "fa-bitbucket-square" => 'fa-bitbucket-square &#xf172; ', "fa-tumblr" => 'fa-tumblr#xf173; ', "fa-tumblr-square" => 'fa-tumblr-square &#xf174; ', "fa-long-arrow-down" => 'fa-long-arrow-down &#xf175; ', "fa-long-arrow-up" => 'fa-long-arrow-up176; ', "fa-long-arrow-left" => 'fa-long-arrow-left &#xf177; ', "fa-long-arrow-right" => 'fa-long-arrow-right &#xf178; ', "fa-apple" => 'fa-apple &#xf179; ', "fa-windows" => 'fa-windows &#xf17a; ', "fa-android" => 'fa-android &#xf17b; ', "fa-linux" => 'fa-linux &#xf17c; ', "fa-dribbble" => 'fa-dribbb &#xf17d; le', "fa-skype" => 'fa-skype &#xf17e; ', "fa-foursquare" => 'fa-foursquare &#xf180; ', "fa-trello" => 'fa-trello &#xf181; ', "fa-female" => 'fa-female &#xf182; ', "fa-male" => 'fa-male &#xf183; ', "fa-gittip" => 'fa-gittip &#xf184; ', "fa-sun-o" => 'fa-sun-o &#xf185; ', "fa-moon-o" => 'fa-moon-o &#xf186; ', "fa-archive" => 'fa-archive &#xf187; ', "fa-bug" => 'fa-bug &#xf188; ', "fa-vk" => 'fa-vk &#xf189; ', "fa-weibo" => 'fa-weibo &#xf18a; ', "fa-renren" => 'fa-renren &#xf18b; ', "fa-pagelines" => 'fa-pagelines &#xf18c; ', "fa-stack-exchange" => 'fa-stack-exchange &#xf18d; ', "fa-arrow-circle-o-right" => 'fa-arrow-circle-o-right &#xf18e; ', "fa-arrow-circle-o-left" => 'fa-arrow-circle-o-left &#xf190; ', "fa-caret-square-o-left" => 'fa-caret-square-o-left &#xf191; ', "fa-dot-circle-o" => 'fa-dot-circle- &#xf192; ', "fa-wheelchair" => 'fa-wheelchair &#xf193; ', "fa-vimeo-square" => 'fa-vimeo-square &#xf194; ', "fa-try" => 'fa-try &#xf195; ', "fa-plus-square-o" => 'fa-plus-square-o &#xf196;');
        $data['color']    = array('3c8dbc' => 'Primary', '00c0ef' => 'Info', '00a65a' => 'Success', 'f39c12' => 'Warning', 'f56954' => 'Danger', 'd2d6de' => 'Gray', '001F3F' => 'Navy', '39CCCC' => 'Teal', '605ca8' => 'Purple', 'ff851b' => 'Orange', 'D81B60' => 'Maroon', '111111' => 'Black',);
        return \Theme::instance()
                        ->get_template()
                        ->set('title', 'مدیریت ماژول ها')
                        ->set('menu', array('users', 'access', 'modules'))
                        ->set('content', \Theme::instance()->view('access/modules', $data));
    }

    public function action_search($page = 1)
    {
        $count_search = \Acl\Model_Module::query();
        $result       = \Acl\Model_Module::query();
        if (\Input::post("search"))
        {
            $count_search->or_where("name", "LIKE", "%".\Input::post("search")."%");
            $count_search->or_where("url", "LIKE", "%".\Input::post("search")."%");
            $result->or_where("name", "LIKE", "%".\Input::post("search")."%");
            $result->or_where("url", "LIKE", "%".\Input::post("search")."%");
        }
        $count      = $count_search->count();
        $config     = array("pagination_url" => "", "total_items" => $count, "per_page" => 20, "uri_segment" => 1, "show_first" => true, "show_last" => true, "current_page" => $page);
        $pagination = \Pagination::forge("Model_Modules_pagination", $config);
        $result->rows_limit($pagination->per_page)
                ->rows_offset($pagination->offset)
                ->order_by('order');
        $records    = $result->get();
        $pages      = $pagination->render(true);
        $return     = '<table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" width="50">ردیف</th>
                                <th class="text-center">نام ماژول</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>';
        $counter    = $pagination->offset + 1;
        if ($records)
        {
            foreach ($records as $record)
            {
                $return .= '<tr>
                            <td>'.\Myclasses\FNC::pen($counter++).'</td>
                            <td class="text-center">'.$record->name.'</td>
                            <td class="text-center" width="160">
                                <span class="btn btn-xs btn-success btn-flat" onclick="editRec('.$record->id.')">ویرایش</span>
                                <span class="btn btn-xs btn-danger btn-flat" onclick="cdec('.$record->id.')">حذف</span>
                            </td>
                        </tr>';
            }
        }
        else
        {
            $return .= '<tr class="text-center"><td colspan="8">جستجوی شما نتیجه ای نداشت</td></tr>';
        } $return .= "<tbody></table>";
        if ($count > 20)
        {
            $return .= '<div class="text-center">'.\Myclasses\FNC::ajaxPaginationLink($pages, "goTopage").'</div><input type="hidden" value="'.$page.'" id="currentPage">';
        }
        return $return;
    }

    public function action_create()
    {
        $validate = \Myclasses\Validate::forge();
        $validate->add("name", \Input::post("name"), "نام ماژول", array('req', 'uniq' => array('name', \Acl\Model_Module::table(), null)));
        $validate->add("url", \Input::post("url"), "آدرس", array('req', 'uniq' => array('url', \Acl\Model_Module::table(), null)));
        $validate->add("order", \Input::post("order"), "ترتیب", array());
        $validate->add("icon", \Input::post("icon"), "آیکون", array());
        $validate->add("color", \Input::post("color"), "رنگ", array());
        if ($validate->isValid())
        {
            $entry            = \Acl\Model_Module::forge();
            $entry->name      = \Input::post('name');
            $entry->url       = \Input::post('url');
            $entry->order     = \Myclasses\FNC::str2num(\Myclasses\FNC::pen(\Input::post('order'), false));
            $entry->icon      = \Input::post('icon');
            $entry->color     = \Input::post('color');
            $entry->is_active = \Input::post('is_active');
            if ($entry->save())
            {
                return 'ok';
            }
            else
            {
                return 'no';
            }
        }
        else
        {
            return $validate->getError(false);
        }
    }

    public function action_edit($id)
    {
        $icon   = array('' => 'No Icon', "fa-glass" => 'fa-glass &#xf000; ', "fa-music" => 'fa-music &#xf001; ', "fa-search" => 'fa-search &#xf002; ', "fa-envelope-o" => 'fa-envelope-o &#xf003; ', "fa-heart" => 'fa-heart &#xf004; ', "fa-star" => 'fa-star &#xf006; ', "fa-user" => 'fa-user &#xf007; ', "fa-film" => 'fa-film &#xf008; ', "fa-th-large" => 'fa-th-large &#xf009; ', "fa-th" => 'fa-th &#xf00a; ', "fa-th-list" => 'fa-th-list &#xf00b; ', "fa-check" => 'fa-check &#xf00c; ', "fa-times" => 'fa-times &#xf00d; ', "fa-search-plus" => 'fa-search-plus &#xf00e; ', "fa-search-minus" => 'fa-search-minus &#xf010; ', "fa-power-off" => 'fa-power-off &#xf011; ', "fa-signal" => 'fa-signal &#xf012; ', "fa-cog" => 'fa-cog &#xf013; ', "fa-trash-o" => 'fa-trash-o &#xf014; ', "fa-home" => 'fa-home &#xf015; ', "fa-file-o" => 'fa-file-o &#xf016; ', "fa-clock-o" => 'fa-clock-o &#xf017; ', "fa-road" => 'fa-road &#xf018; ', "fa-download" => 'fa-download &#xf019; ', "fa-arrow-circle-o-down" => 'fa-arrow-circle-o-down &#xf01a; ', "fa-arrow-circle-o-up" => 'fa-arrow-circle-o-up &#xf01b; ', "fa-inbox" => 'fa-inbox &#xf01c; ', "fa-play-circle-o" => 'fa-play-circle-o &#xf01d; ', "fa-repeat" => 'fa-repeat &#xf01e; ', "fa-refresh" => 'fa-refresh &#xf021; ', "fa-list-alt" => 'fa-list-alt &#xf022; ', "fa-lock" => 'fa-lock &#xf023; ', "fa-flag" => 'fa-flag &#xf024; ', "fa-headphones" => 'fa-headphones &#xf025; ', "fa-volume-off" => 'fa-volume-off &#xf026; ', "fa-volume-down" => 'fa-volume-down &#xf027; ', "fa-volume-up" => 'fa-volume-up &#xf028; ', "fa-qrcode" => 'fa-qrcode &#xf029; ', "fa-barcode" => 'fa-barcode &#xf02a; ', "fa-tag" => 'fa-tag &#xf02b; ', "fa-tags" => 'fa-tags &#xf02c; ', "fa-book" => 'fa-book &#xf02d; ', "fa-bookmark" => 'fa-bookmark &#xf02e; ', "fa-print" => 'fa-print &#xf02f; ', "fa-camera" => 'fa-camera &#xf030; ', "fa-font" => 'fa-font &#xf031; ', "fa-bold" => 'fa-bold &#xf032; ', "fa-italic" => 'fa-italic &#xf033; ', "fa-text-height" => 'fa-text-height &#xf034; ', "fa-text-width" => 'fa-text-width &#xf035; ', "fa-align-left" => 'fa-align-left &#xf036; ', "fa-align-center" => 'fa-align-center &#xf037; ', "fa-align-right" => 'fa-align-right &#xf038; ', "fa-align-justify" => 'fa-align-justify &#xf039; ', "fa-list" => 'fa-list &#xf03a; ', "fa-outdent" => 'fa-outdent &#xf03b; ', "fa-indent" => 'fa-indent &#xf03c; ', "fa-video-camera" => 'fa-video-camera &#xf03d; ', "fa-picture-o" => 'fa-picture-o &#xf03e; ', "fa-pencil" => 'fa-pencil &#xf040; ', "fa-map-marker" => 'fa-map-marker &#xf041; ', "fa-adjust" => 'fa-adjust &#xf042; ', "fa-tint" => 'fa-tint &#xf043; ', "fa-pencil-square-o" => 'fa-pencil-square-o &#xf044; ', "fa-share-square-o" => 'fa-share-square-o &#xf045; ', "fa-check-square-o" => 'fa-check-square-o &#xf046; ', "fa-arrows" => 'fa-arrows &#xf047; ', "fa-step-backward" => 'fa-step-backward &#xf048; ', "fa-fast-backward" => 'fa-fast-backward &#xf049; ', "fa-backward" => 'fa-backward &#xf04a; ', "fa-play" => 'fa-play &#xf04b; ', "fa-pause" => 'fa-pause &#xf04c; ', "fa-stop" => 'fa-stop &#xf04d; ', "fa-forward" => 'fa-forward &#xf04e; ', "fa-fast-forward" => 'fa-fast-forward &#xf050; ', "fa-step-forward" => 'fa-step-forward &#xf051; ', "fa-eject" => 'fa-eject &#xf052; ', "fa-chevron-left" => 'fa-chevron-left &#xf053; ', "fa-chevron-right" => 'fa-chevron-right &#xf054; ', "fa-plus-circle" => 'fa-plus-circle &#xf055; ', "fa-minus-circle" => 'fa-minus-circle &#xf056; ', "fa-times-circle" => 'fa-times-circle &#xf057; ', "fa-check-circle" => 'fa-check-circle &#xf058; ', "fa-question-circle" => 'fa-question-circle &#xf059; ', "fa-info-circle" => 'fa-info-circle &#xf05a; ', "fa-crosshairs" => 'fa-crosshairs &#xf05b; ', "fa-times-circle-o" => 'fa-times-circle-o &#xf05c; ', "fa-check-circle-o" => 'fa-check-circle-o &#xf05d; ', "fa-ban" => 'fa-ban &#xf05e; ', "fa-arrow-left" => 'fa-arrow-left &#xf060; ', "fa-arrow-right" => 'fa-arrow-right &#xf061; ', "fa-arrow-up" => 'fa-arrow-up &#xf062; ', "fa-arrow-down" => 'fa-arrow-down &#xf063; ', "fa-share" => 'fa-share &#xf064; ', "fa-expand" => 'fa-expand &#xf065; ', "fa-compress" => 'fa-compress &#xf066; ', "fa-plus" => 'fa-plus &#xf067; ', "fa-minus" => 'fa-minus &#xf068; ', "fa-asterisk" => 'fa-asterisk &#xf069; ', "fa-exclamation-circle" => 'fa-exclamation-circle &#xf06a; ', "fa-gift" => 'fa-gift &#xf06b; ', "fa-leaf" => 'fa-leaf &#xf06c;', "fa-fire" => 'fa-fire &#xf06d; ', "fa-eye" => 'fa-eye &#xf06e; ', "fa-eye-slash" => 'fa-eye-slash &#xf070; ', "fa-exclamation-triangle" => 'fa-exclamation-triangle &#xf071; ', "fa-plane" => 'fa-plane &#xf072; ', "fa-calendar" => 'fa-calendar &#xf073; ', "fa-random" => 'fa-random &#xf074; ', "fa-comment" => 'fa-comment &#xf075;', "fa-magnet" => 'fa-magnet &#xf076; ', "fa-chevron-up" => 'fa-chevron-up &#xf077; ', "fa-chevron-down" => 'fa-chevron-down &#xf078; ', "fa-retweet" => 'fa-retweet &#xf079; ', "fa-shopping-cart" => 'fa-shopping-cart &#xf07a; ', "fa-folder" => 'fa-folder &#xf07b;', "fa-folder-open" => 'fa-folder-open &#xf07c; ', "fa-arrows-v" => 'fa-arrows-v &#xf07d; ', "fa-arrows-h" => 'fa-arrows-h &#xf07e; ', "fa-bar-chart-o" => 'fa-bar-chart-o &#xf080; ', "fa-twitter-square" => 'fa-twitter-square &#xf081; ', "fa-facebook-square" => 'fa-facebook-square &#xf082; ', "fa-camera-retro" => 'fa-camera-retro &#xf083;', "fa-key" => 'fa-key &#xf084; ', "fa-cogs" => 'fa-cogs &#xf085; ', "fa-comments" => 'fa-comments &#xf086; ', "fa-thumbs-o-up" => 'fa-thumbs-o-up &#xf087; ', "fa-thumbs-o-down" => 'fa-thumbs-o-down &#xf088; ', "fa-star-half" => 'fa-star-half &#xf089; ', "fa-heart-o" => 'fa-heart-o &#xf08a; ', "fa-sign-out" => 'fa-sign-out &#xf08b;', "fa-linkedin-square" => 'fa-linkedin-square &#xf08c; ', "fa-thumb-tack" => 'fa-thumb-tack &#xf08d; ', "fa-external-link" => 'fa-external-link &#xf08e; ', "fa-sign-in" => 'fa-sign-in &#xf090; ', "fa-trophy" => 'fa-trophy &#xf091; ', "fa-github-square" => 'fa-github-square &#xf092; ', "fa-upload" => 'fa-upload &#xf093; ', "fa-lemon-o" => 'fa-lemon-o &#xf094; ', "fa-phone" => 'fa-phone &#xf095; ', "fa-square-o" => 'fa-square-o &#xf096; ', "fa-bookmark-o" => 'fa-bookmark-o &#xf097; ', "a-phone-square" => 'a-phone-square &#xf098; ', "fa-twitter" => 'fa-twitter &#xf099; ', "fa-facebook" => 'fa-facebook &#xf09a; ', "fa-github" => 'fa-github &#xf09b; ', "fa-unlock" => 'fa-unlock &#xf09c; ', "fa-credit-card" => 'fa-credit-card &#xf09d; ', "fa-rss" => 'fa-rss &#xf09e; ', "fa-hdd-o" => 'fa-hdd-o &#xf0a0; ', "fa-bullhorn" => 'fa-bullhorn &#xf0a1; ', "fa-bell" => 'fa-bell &#xf0f3; ', "fa-certificate" => 'fa-certificate &#xf0a3; ', "fa-hand-o-right" => 'fa-hand-o-right &#xf0a4; ', "fa-hand-o-left" => 'fa-hand-o-left &#xf0a5; ', "fa-hand-o-up" => 'fa-hand-o-up &#xf0a6; ', "fa-hand-o-down" => 'fa-hand-o-down &#xf0a7; ', "fa-arrow-circle-left" => 'fa-arrow-circle-left &#xf0a8; ', "fa-arrow-circle-right" => 'fa-arrow-circle-right &#xf0a9; ', "fa-arrow-circle-up" => 'fa-arrow-circle-up &#xf0aa; ', "fa-arrow-circle-down" => 'fa-arrow-circle-down &#xf0ab; ', "fa-globe" => 'fa-globe &#xf0ac; ', "fa-wrench" => 'fa-wrench &#xf0ad; ', "fa-tasks" => 'fa-tasks &#xf0ae;', "fa-filter" => 'fa-filter#xf0b0; ', "fa-briefcase" => 'fa-briefcase#xf0b1; ', "fa-arrows-alt" => 'fa-arrows-alt &#xf0b2; ', "fa-users" => 'fa-users &#xf0c0; ', "fa-link" => 'fa-link &#xf0c1; ', "fa-cloud" => 'fa-cloud &#xf0c2; ', "fa-flask" => 'fa-flask &#xf0c3; ', "fa-scissors" => 'fa-scissors &#xf0c4; ', "fa-files-o" => 'fa-files-o#xf0c5; ', "fa-paperclip" => 'fa-paperclip &#xf0c6; ', "fa-floppy-o" => 'fa-floppy-o &#xf0c7; ', "fa-square" => 'fa-square &#xf0c8; ', "fa-bars" => 'fa-bars &#xf0c9; ', "fa-list-ul" => 'fa-list-ul &#xf0ca; ', "fa-list-ol" => 'fa-list-ol &#xf0cb; ', "fa-strikethrough" => 'fa-strikethrough &#xf0cc; ', "fa-underline" => 'fa-underline &#xf0cd; ', "fa-table" => 'fa-table &#xf0ce; ', "fa-magic" => 'fa-magic &#xf0d0; ', "fa-truck" => 'fa-truck &#xf0d1; ', "fa-pinterest" => 'fa-pinterest &#xf0d2; ', "fa-pinterest-square" => 'fa-pinterest-square#xf0d3; ', "fa-google-plus-square" => 'fa-google-plus-square &#xf0d4; ', "fa-google-plus" => 'fa-google-plus &#xf0d5; ', "fa-money" => 'fa-money &#xf0d6; ', "fa-caret-down" => 'fa-caret-down &#xf0d7; ', "fa-caret-up" => 'fa-caret-up &#xf0d8; ', "fa-caret-left" => 'fa-caret-left &#xf0d9; ', "fa-caret-right" => 'fa-caret-right &#xf0da; ', "fa-columns" => 'fa-columns &#xf0db; ', "fa-sort" => 'fa-sort &#xf0dc; ', "fa-sort-asc" => 'fa-sort-asc &#xf0dd; ', "fa-sort-desc" => 'fa-sort-desc &#xf0de; ', "fa-envelope" => 'fa-envelope &#xf0e0; ', "fa-linkedin" => 'fa-linkedin &#xf0e1; ', "fa-undo" => 'fa-undo &#xf0e2; ', "fa-gavel" => 'fa-gavel &#xf0e3; ', "fa-tachometer" => 'fa-tachometer &#xf0e4; ', "fa-comment-o" => 'fa-comment-o &#xf0e5; ', "fa-comments-o" => 'fa-comments-o &#xf0e6; ', "fa-bolt" => 'fa-bolt &#xf0e7; ', "fa-sitemap" => 'fa-sitemap &#xf0e8; ', "fa-umbrella" => 'fa-umbrella &#xf0e9; ', "fa-clipboard" => 'fa-clipboard &#xf0ea; ', "fa-lightbulb-o" => 'fa-lightbulb-o &#xf0eb; ', "fa-exchange" => 'fa-exchange &#xf0ec; ', "fa-cloud-download" => 'fa-cloud-download &#xf0ed; ', "fa-cloud-upload" => 'fa-cloud-upload &#xf0ee; ', "fa-user-md" => 'fa-user-md &#xf0f0; ', "fa-stethoscope" => 'fa-stethoscope &#xf0f1; ', "fa-suitcase" => 'fa-suitcase &#xf0f2; ', "fa-bell-o" => 'fa-bell-o &#xf0a2; ', "fa-coffee" => 'fa-coffee &#xf0f4; ', "fa-cutlery" => 'fa-cutlery &#xf0f5; ', "fa-file-text-o" => 'fa-file-text-o &#xf0f6; ', "fa-building-o" => 'fa-building-o &#xf0f7; ', "fa-hospital-o" => 'fa-hospital-o &#xf0f8; ', "fa-ambulance" => 'fa-ambulance &#xf0f9; ', "fa-medkit" => 'fa-medkit &#xf0fa; ', "fa-fighter-jet" => 'fa-fighter-jet &#xf0fb; ', "fa-beer" => 'fa-beer &#xf0fc; ', "fa-h-square" => 'fa-h-square &#xf0fd; ', "fa-plus-square" => 'fa-plus-square &#xf0fe; ', "fa-angle-double-left" => 'fa-angle-double-left &#xf100; ', "fa-angle-double-right" => 'fa-angle-double-right &#xf101; ', "fa-angle-double-up" => 'fa-angle-double-up &#xf102; ', "fa-angle-double-down" => 'fa-angle-double-down &#xf103; ', "fa-angle-left" => 'fa-angle-left &#xf104; ', "fa-angle-right" => 'fa-angle-right &#xf105; ', "fa-angle-up" => 'fa-angle-up &#xf106; ', "fa-angle-down" => 'fa-angle-down &#xf107; ', "fa-desktop" => 'fa-desktop &#xf08; ', "fa-laptop" => 'fa-laptop &#xf109; ', "fa-tablet" => 'fa-tablet &#xf10a; ', "fa-mobile" => 'fa-mobile &#xf10b; ', "fa-circle-o" => 'fa-circle-o &#xf10c; ', "fa-quote-left" => 'fa-quote-left &#xf10d;', "fa-quote-right" => 'fa-quote-right &#xf10e; ', "fa-spinner" => 'fa-spinner &#xf110; ', "fa-circle" => 'fa-circle &#xf111; ', "fa-reply" => 'fa-reply &#xf112; ', "fa-github-alt" => 'fa-github-alt &#xf113; ', "fa-folder-o" => 'fa-folder-o &#xf114; ', "fa-folder-open-o" => 'fa-folder-open-o &#xf115; ', "fa-smile-o" => 'fa-smile-o &#xf118; ', "fa-frown-o" => 'fa-frown-o &#xf119; ', "fa-meh-o" => 'fa-meh-o &#xf11a; ', "fa-gamepad" => 'fa-gamepad &#xf11b; ', "fa-keyboard-o" => 'fa-keyboard-o &#xf11c; ', "fa-flag-o" => 'fa-flag-o &#xf11d; ', "fa-flag-checkered" => 'fa-flag-checkered &#xf11e; ', "fa-terminal" => 'fa-terminal &#xf120; ', "fa-code" => 'fa-code &#xf121; ', "fa-reply-all" => 'fa-reply-all &#xf122; ', "fa-mail-reply-all" => 'fa-mail-reply-all &#xf122; ', "fa-star-half-o" => 'fa-star-half-o &#xf123; ', "fa-location-arrow" => ' fa-location-arrow &#xf124;', "fa-crop" => 'fa-crop &#xf125; ', "fa-code-fork" => 'fa-code-fork &#xf126; ', "fa-chain-broken" => 'fa-chain-broken &#xf127; ', "fa-question" => 'fa-question &#xf128; ', "fa-info" => 'fa-info &#xf129; ', "fa-exclamation" => 'fa-exclamation &#xf12a; ', "fa-superscript" => 'fa-superscript &#xf12b; ', "fa-subscript" => 'fa-subscrip &#xf12c; t', "fa-eraser" => 'fa-eraser &#xf12d; ', "fa-puzzle-piece" => 'fa-puzzle-piece &#xf12e; ', "fa-microphone" => 'fa-microphone &#xf130; ', "fa-microphone-slash" => 'fa-microphone-slash &#xf131; ', "fa-shield" => 'fa-shield &#xf132; ', "fa-calendar-o" => 'fa-calendar-o &#xf133; ', "fa-fire-extinguisher" => 'fa-fire-extinguisher &#xf134; ', "fa-rocket" => 'fa-rocket &#xf135; ', "fa-maxcdn" => 'fa-maxcdn &#xf136; ', "fa-chevron-circle-left" => 'fa-chevron-circle-left &#xf137; ', "fa-chevron-circle-right" => 'fa-chevron-circle-right &#xf138; ', "fa-chevron-circle-up" => 'fa-chevron-circle-up &#xf139; ', "fa-chevron-circle-down" => 'fa-chevron-circle-down &#xf13a; ', "fa-html5" => 'fa-html5 &#xf13b; ', "fa-css3" => 'fa-css3 &#xf13c; ', "fa-anchor" => 'fa-anchor &#xf13d; ', "fa-unlock-alt" => 'fa-unlock-alt &#xf13e; ', "fa-bullseye" => 'fa-bullseye &#xf140; ', "fa-ellipsis-h" => 'fa-ellipsis-h &#xf141; ', "fa-ellipsis-v" => 'fa-ellipsis-v &#xf142; ', "fa-rss-square" => 'fa-rss-square &#xf143; ', "fa-play-circle" => 'fa-play-circle &#xf144; ', "fa-ticket" => 'fa-ticket &#xf145; ', "fa-minus-square" => 'fa-minus-square &#xf146; ', "fa-minus-square-o" => 'fa-minus-square-o &#xf147; ', "fa-level-up" => 'fa-level-up &#xf148; ', "fa-level-down" => 'fa-level-down &#xf149; ', "fa-check-square" => 'fa-check-square &#xf14a; ', "fa-pencil-square" => 'fa-pencil-square &#xf14b; ', "fa-external-link-square" => 'fa-external-link-square &#xf14c; ', "fa-share-square" => 'fa-share-square &#xf14d; ', "fa-compass" => 'fa-compass &#xf14e; ', "fa-caret-square-o-down" => 'fa-caret-square-o-down &#xf150; ', "fa-caret-square-o-up" => 'fa-caret-square-o-up &#xf151; ', "fa-caret-square-o-right" => 'fa-caret-square-o-right &#xf152; ', "fa-eur" => 'fa-eur &#xf153; ', "fa-gbp" => 'fa-gbp &#xf154; ', "fa-usd" => 'fa-usd &#xf155; ', "fa-inr" => 'fa-inr &#xf156; ', "fa-jpy" => 'fa-jpy &#xf157; ', "fa-rub" => 'fa-rub &#xf158; ', "fa-krw" => 'fa-krw &#xf159; ', "fa-btc" => 'fa-btc &#xf15a; ', "fa-file" => 'fa-file &#xf15b; ', "fa-file-text" => 'fa-file-text &#xf15c; ', "fa-sort-alpha-asc" => 'fa-sort-alpha-asc &#xf15d; ', "fa-sort-alpha-desc" => 'fa-sort-alpha-desc &#xf15e; ', "fa-sort-amount-asc" => 'fa-sort-amount-asc &#xf160; ', "fa-sort-amount-desc" => ' fa-sort-amount-desc &#xf161;', "fa-sort-numeric-asc" => 'fa-sort-numeric-asc &#xf162; ', "fa-sort-numeric-desc" => 'fa-sort-numeric-desc &#xf163; ', "fa-thumbs-up" => 'fa-thumbs-up &#xf164; ', "fa-thumbs-down" => 'fa-thumbs-down &#xf165; ', "fa-youtube-square" => 'fa-youtube-square &#xf166; ', "fa-youtube" => 'fa-youtube &#xf167; ', "fa-xing" => 'fa-xing &#xf168; ', "fa-xing-square" => 'fa-xing-square &#xf169; ', "fa-youtube-play" => 'fa-youtube-play &#xf16a; ', "fa-dropbox" => 'fa-dropbox &#xf16b; ', "fa-stack-overflow" => 'fa-stack-overflow &#xf16c; ', "fa-instagram" => 'fa-instagram &#xf16d; ', "fa-flickr" => 'fa-flickr &#xf16e; ', "fa-adn" => 'fa-adn &#xf170; ', "fa-bitbucket" => 'fa-bitbucket &#xf171; ', "fa-bitbucket-square" => 'fa-bitbucket-square &#xf172; ', "fa-tumblr" => 'fa-tumblr#xf173; ', "fa-tumblr-square" => 'fa-tumblr-square &#xf174; ', "fa-long-arrow-down" => 'fa-long-arrow-down &#xf175; ', "fa-long-arrow-up" => 'fa-long-arrow-up176; ', "fa-long-arrow-left" => 'fa-long-arrow-left &#xf177; ', "fa-long-arrow-right" => 'fa-long-arrow-right &#xf178; ', "fa-apple" => 'fa-apple &#xf179; ', "fa-windows" => 'fa-windows &#xf17a; ', "fa-android" => 'fa-android &#xf17b; ', "fa-linux" => 'fa-linux &#xf17c; ', "fa-dribbble" => 'fa-dribbb &#xf17d; le', "fa-skype" => 'fa-skype &#xf17e; ', "fa-foursquare" => 'fa-foursquare &#xf180; ', "fa-trello" => 'fa-trello &#xf181; ', "fa-female" => 'fa-female &#xf182; ', "fa-male" => 'fa-male &#xf183; ', "fa-gittip" => 'fa-gittip &#xf184; ', "fa-sun-o" => 'fa-sun-o &#xf185; ', "fa-moon-o" => 'fa-moon-o &#xf186; ', "fa-archive" => 'fa-archive &#xf187; ', "fa-bug" => 'fa-bug &#xf188; ', "fa-vk" => 'fa-vk &#xf189; ', "fa-weibo" => 'fa-weibo &#xf18a; ', "fa-renren" => 'fa-renren &#xf18b; ', "fa-pagelines" => 'fa-pagelines &#xf18c; ', "fa-stack-exchange" => 'fa-stack-exchange &#xf18d; ', "fa-arrow-circle-o-right" => 'fa-arrow-circle-o-right &#xf18e; ', "fa-arrow-circle-o-left" => 'fa-arrow-circle-o-left &#xf190; ', "fa-caret-square-o-left" => 'fa-caret-square-o-left &#xf191; ', "fa-dot-circle-o" => 'fa-dot-circle- &#xf192; ', "fa-wheelchair" => 'fa-wheelchair &#xf193; ', "fa-vimeo-square" => 'fa-vimeo-square &#xf194; ', "fa-try" => 'fa-try &#xf195; ', "fa-plus-square-o" => 'fa-plus-square-o &#xf196;');
        $color  = array('3c8dbc' => 'Primary', '00c0ef' => 'Info', '00a65a' => 'Success', 'f39c12' => 'Warning', 'f56954' => 'Danger', 'd2d6de' => 'Gray', '001F3F' => 'Navy', '39CCCC' => 'Teal', '605ca8' => 'Purple', 'ff851b' => 'Orange', 'D81B60' => 'Maroon', '111111' => 'Black',);
        $edit   = \Acl\Model_Module::find($id);
        $return = '<form id="editForm" class="col-md-12">
                    <div class="col-md-6">
                        <div class="control-group">
                            '.\Form::label("نام ماژول", "name", array("class" => "control-label")).'
                            <div class="controls">
                                '.\Form::input("name", $edit->name, array("class" => "form-control")).'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="control-group">
                            '.\Form::label("آدرس", "url", array("class" => "control-label")).'
                            <div class="controls">
                                '.\Form::input("url", $edit->url, array("class" => "form-control ltr")).'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="control-group">
                            '.\Form::label("ترتیب", "order", array("class" => "control-label")).'
                            <div class="controls">
                                '.\Form::input("order", $edit->order, array("class" => "form-control")).'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="control-group">
                            '.\Form::label("آیکون", "icon", array("class" => "control-label")).'
                            <div class="controls">
                                '.\Form::select('icon', $edit->icon, $icon, array('class' => 'form-control ltr', 'style' => 'font-family:FontAwesome')).'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="control-group">
                            '.\Form::label("رنگ", "color", array("class" => "control-label")).'
                            <div class="controls">
                                '.\Form::select('color', $edit->color, $color, array('class' => 'form-control ltr')).'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="control-group">
                            '.\Form::label("وضعیت", "is_active", array("class" => "control-label")).'
                            <div class="controls">
                                '.\Form::select('is_active', $edit->is_active, array('1' => 'فعال', '0' => 'غیر فعال'), array("class" => "form-control")).'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="control-group" >'.\Form::label("&nbsp;", "btn", array("class" => "control-label")).'
                            <div class="controls">
                                <span class="btn btn-primary btn-block" onclick="updateRec('.$edit->id.')">ویرایش</span>
                            </div>
                        </div>
                    </div>
                </form>';
        return $return;
    }

    public function action_update($id)
    {
        $validate = \Myclasses\Validate::forge();
        $validate->add("name", \Input::post("name"), "نام ماژول", array('req', 'uniq' => array('name', \Acl\Model_Module::table(), array("id", $id))));
        $validate->add("url", \Input::post("url"), "آدرس", array('req', 'uniq' => array('url', \Acl\Model_Module::table(), array("id", $id))));
        $validate->add("order", \Input::post("order"), "ترتیب", array());
        $validate->add("icon", \Input::post("icon"), "آیکون", array());
        $validate->add("color", \Input::post("color"), "رنگ", array());
        $validate->add("is_active", \Input::post("is_active"), "وضعیت", array('req'));
        if ($validate->isValid())
        {
            $entry            = \Acl\Model_Module::find($id);
            $entry->name      = \Input::post('name');
            $entry->url       = \Input::post('url');
            $entry->order     = \Myclasses\FNC::str2num(\Myclasses\FNC::pen(\Input::post('order'), false));
            $entry->icon      = \Input::post('icon');
            $entry->color     = \Input::post('color');
            $entry->is_active = \Input::post('is_active');
            return $entry->save() ? 'ok' : 'no';
        }
        else
        {
            return $validate->getError(false);
        }
    }

    public function action_delete($id)
    {
        $delete = \Acl\Model_Module::find($id);
        if ($delete)
        {
            if ($delete->delete())
            {
                return 'ok';
            }
            return 'no';
        }
        return 'no';
    }

    public function action_currentorder()
    {
        return \Acl\Model_Module::current_order();
    }

}

?>