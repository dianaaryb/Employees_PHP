<?php

include_once 'Post.php';

const DATA_FILE = 'posts.txt';

//savePost(new Post("100", "title", "text 2"));
//print postsToString(getAllPosts());

function getAllPosts() : array {
    $lines = file(DATA_FILE); //reads entire file into array of lines at once//small files
    $posts = []; //list
    foreach ($lines as $line){
        [$id, $title, $text] = explode(';', trim($line)); //split.. trim-eemaldab reavahetust
        $posts[] = new Post(urldecode($id), urldecode($title), urldecode($text));
    }
    return $posts;
//    $result = array();
//    $myFile = fopen(DATA_FILE, "r"); //opens the file //big files and lines
//    while (!feof($myFile)) {
//        $lines = fgets($myFile); //reads file line by line
    //      if($line !== false){}
}

function savePost(Post $post): string {
    if($post->id){
        deletePostById($post->id);
    }
    $post->id = $post->id ?? getNewId();
    file_put_contents(DATA_FILE, postToTextLine($post), FILE_APPEND);
    return $post->id;
}

function postToTextLine(Post $post): string {
    return urlencode($post->id) . ';' //dostaju polja objekta
        . urlencode($post->title) . ';'
        . urlencode($post->text) . PHP_EOL; //dobavljajetsja na novuju strochku
}

function deletePostById(string $id): void {
    $posts = getAllPosts();
    $lines = [];
    foreach ($posts as $post){
        if($post->id !== $id){
            $lines[] = postToTextLine($post);
        }
    }
    file_put_contents(DATA_FILE, implode('', $lines)); //join stringiks
}

function getNewId(): string {
    $id = file_get_contents('next-id.txt');
    file_put_contents('next-id.txt', intval($id) + 1);
    return $id;
}

function postsToString(array $posts): string {
    $result = '';
    foreach ($posts as $post) {
        $result .= $post . PHP_EOL;
    }
    return $result;
}
