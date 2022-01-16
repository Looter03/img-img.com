<?php
ini_set('memory_limit', '-1');

// ban cafe24 access
$myip = $_SERVER["REMOTE_ADDR"];
if($myip == "183.111.199.202") exit;

if(!defined('ROOT_PATH')) define("ROOT_PATH",$_SERVER['DOCUMENT_ROOT']);
require_once ROOT_PATH . '/wp-load.php';

$mode = trim($_POST["mode"]);

if($mode  == "LOAD_MORE_POST"){
    $item_cnt = trim($_POST["item_cnt"]);
    if($item_cnt == "") $item_cnt = 0;
    $more_item_amount = 3;
    $args = array(
        'posts_per_page' => $more_item_amount,
        'offset' => $item_cnt,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged'    => (get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1),
        'suppress_filters' => true
    );
    $recent_posts = wp_get_recent_posts($args);

    $html = '';
    foreach( $recent_posts as $recent ){
        $html .= '<article class="dimg-col-card" >';
        $html .= '<div class="dimg-card-thumb">';
        $html .= '<a href="'.get_permalink($recent["ID"]).'">';
        $html .= get_the_post_thumbnail($recent["ID"],'dimg-card-thumb-img');
        $html .= '</a>';
        $html .= '<div class="dimg-card-category">';
        $catID = get_the_category($recent["ID"]);
        foreach($catID as $v ){
            $html .= '<a href="/category/'.$v->slug.'">'.$v->name.'</a>';
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<h2 class="dimg-card-title">';
        $html .= '<a href="'.get_permalink($recent["ID"]).'">'.$recent["post_title"].'</a>';
        $html .= '</h2>';
        $html .= '<h4 class="dimg-card-desc">';
        $excerpt = get_the_excerpt($recent["ID"]);
        if(mb_strlen($excerpt)>70){
            $html .= iconv_substr($excerpt, 0, 70, "utf-8")."...";
        }
        $html .= '</h4>';
        $html .= '</div>';
        $html .= '</article>';
    }
    if(sizeof($recent_posts) != 0) {
        echo json_encode(array("result"=>"success","data"=>$html));
    } else {
        echo json_encode(array("result"=>"finished","data"=>$html));
    }
}

if($mode  == "LOAD_MORE_POST_CATEGORY"){
    $item_cnt = trim($_POST["item_cnt"]);
    $category = trim($_POST["category"]);
    if($item_cnt == "") $item_cnt = 0;
    $more_item_amount = 3;
    $args = array(
        'posts_per_page' => $more_item_amount,
        'offset' => $item_cnt,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged'    => (get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1),
        'suppress_filters' => true,
        'cat' => $category
    );
    $recent_posts = wp_get_recent_posts($args);

    $html = '';
    foreach( $recent_posts as $recent ){
        $html .= '<article class="dimg-col-card" >';
        $html .= '<div class="dimg-card-thumb">';
        $html .= '<a href="'.get_permalink($recent["ID"]).'">';
        $html .= get_the_post_thumbnail($recent["ID"],'dimg-card-thumb-img');
        $html .= '</a>';
        $html .= '<div class="dimg-card-category">';
        $catID = get_the_category($recent["ID"]);
        foreach($catID as $v ){
            $html .= '<a href="/category/'.$v->slug.'">'.$v->name.'</a>';
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<h2 class="dimg-card-title">';
        $html .= '<a href="'.get_permalink($recent["ID"]).'">'.$recent["post_title"].'</a>';
        $html .= '</h2>';
        $html .= '<h4 class="dimg-card-desc">';
        $excerpt = get_the_excerpt($recent["ID"]);
        if(mb_strlen($excerpt)>70){
            $html .= iconv_substr($excerpt, 0, 70, "utf-8")."...";
        }
        $html .= '</h4>';
        $html .= '</div>';
        $html .= '</article>';
    }

    if(sizeof($recent_posts) != 0) {
        echo json_encode(array("result"=>"success","data"=>$html));
    } else {
        echo json_encode(array("result"=>"finished","data"=>$html));
    }
}
?>