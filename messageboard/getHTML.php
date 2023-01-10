<?php

$posts = json_decode(file_get_contents("posts.json"), true);
$out = "";

foreach ($posts['messages'] as $post)
{
    $out .= "<div class='post' id='".$post['id']."'><details open>"
        ."<summary><a href='#".$post['id']."' style='color: palevioletred;'>".$post['id']."</a> <span style='color: mediumorchid;'>".$post['nickname']."</span> <span style='color: darkgrey;'>".$post['time']."</span></summary>";
    if ($post['image_url'] !== "") $out .= "<img src='".$post['image_url']."' alt='image'><br>";
    $out .= "<span class='body'>".str_replace("\n", "<br>", $post['body'])."</span>"
        ."</details></div>";
}

echo($out);
?>
