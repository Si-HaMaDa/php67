<?php

require './admin/includes/config.php';

$per_page = 4;

$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;

$total_blogs_count = $conn->query("SELECT COUNT(id) FROM blogs");
$total_blogs_count = (int)$total_blogs_count->fetchColumn();

$total_pages = ceil($total_blogs_count / $per_page);

$current_page = $start / $per_page + 1;

// End Pagination Variables

$blogs = $conn->query("SELECT id, title, content, image FROM blogs ORDER BY id DESC LIMIT $per_page OFFSET $start");
$blogs = $blogs->fetchAll();

$blogs = json_encode($blogs);

header('Content-Type: application/json; charset=utf-8');
print_r($blogs);


// $json = '{"name": "Mohamed"}';
// $json = json_decode($json);

// $json = ['name' => 'Mohamed'];
// $json = json_encode($json);

// var_dump($json);
