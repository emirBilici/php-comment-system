<?php

    $details = $data['details'];
    $comments = $data['comments'];

    $details->doc_name =
        strlen($details->title) > 45
        ? $details->doc_name = doc_name(substr($details->title, 0, 45) . '..')
        : $details->doc_name = doc_name($details->title);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$details->doc_name?></title>
    <link rel="stylesheet" href="<?=site_url('public/css/style.css')?>">
</head>
<body>

<header id="header">
    <div class="container">
        <div class="logo">
            <h3>Awesome Blog</h3>
        </div>
        <nav class="head-links">
            <ul role="listbox">
                <li role="listitem">
                    <a href="#" role="button">Link 1</a>
                </li>
                <li role="listitem">
                    <a href="#" role="button">Link 2</a>
                </li>
                <li role="listitem">
                    <a href="#" role="button">Link 3</a>
                </li>
                <li role="listitem" class="active-btn">
                    <a href="#" role="button">Link 4</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<div id="root">
    <div class="container">
        <!--  Details      -->
        <div class="post-head">
            <span id="first-look__date">Published <?=$details->created_post?></span>
            <h2 id="post-title"><?=$details->title?></h2>
            <div class="desc">
                <?=substr($details->content, 0, 50) . '..'?>
            </div>
            <div class="category">
                <a href="#"><?=$details->category_name?></a>
            </div>
        </div>
        <!--  Image      -->
        <div id="post-big-image">
            <img src="<?=$details->post_Main_image?>" alt="post_img">
        </div>
        <!--  Author      -->
        <a href="#" class="post-author">
            <div class="author-image">
                <img src="<?=site_url('public/img/user.png')?>" width="48" height="48" alt="">
            </div>
            <div class="author_details" title="@<?=$details->username?>">
                <span class="author-name">
                    <?=$details->first_name?> <br> <?=$details->last_name?> <br>
                </span>
                <span class="author-email"><?=$details->email?></span>
            </div>
        </a>
        <!--  Content      -->
        <div class="post-content">
            <?=$details->content?>
        </div>
        <!--  Comments      -->
        <div class="comments">
            <h1 class="comments-title">Comments</h1>
            <?php if (count($comments) > 0): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <span class="created__At"><?=$comment->created_comment?></span>
                        <a href="#" class="comment--username" title="<?=$comment->first_name . ' ' .  $comment->last_name?>">@<?=$comment->username?></a>
                        <p class="comment--content"><?=$comment->comment_Content?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
            <div class="no_Comment">
                No Comment
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer class="_footer">
    <div class="container">
        <ul>
            <li>
                <a href="#">Link 1</a>
            </li>
            <li>
                <a href="#">Link 2</a>
            </li>
            <li>
                <a href="#">Link 3</a>
            </li>
            <li>
                <a href="#">Link 4</a>
            </li>
        </ul>
    </div>
</footer>

</body>
</html>