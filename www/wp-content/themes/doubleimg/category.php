<?php get_header(); ?>
<?php
$ppp = 9;//post per page
$category = get_category_by_slug(get_queried_object()->slug)->term_taxonomy_id;
$args = array(
    'posts_per_page' => $ppp,
    'offset' => 0,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'paged'    => (get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1),
    'suppress_filters' => true,
    'cat' => $category
);
$recent_posts = wp_get_recent_posts($args);
?>
<script>const category = "<?=$category?>";</script>
<div class="dimg-contents-wrapper">
    <div class="dimg-contents">
        <div class="dimg-contents-sizer"></div>
        <?php foreach( $recent_posts as $recent ){?>
        <article class="dimg-col-card">
            <div class="dimg-card-thumb">
                <a href="<?=get_permalink($recent["ID"])?>">
                    <?=get_the_post_thumbnail($recent["ID"],'dimg-card-thumb-img');?>
                </a>

                <div class="dimg-card-category">
                    <?php
                    $catID = get_the_category($recent["ID"]);
                    foreach($catID as $v ){
                        echo "<a href='/category/$v->slug'>$v->name</a>";
                    }
                    ?>
                </div>
            </div>
            <div>
                <h2 class="dimg-card-title">
                    <a href="<?=get_permalink($recent["ID"])?>">
                        <?=$recent["post_title"]?>
                    </a>
                </h2>
                <h4 class="dimg-card-desc">
                    <?php
                    $excerpt = get_the_excerpt($recent["ID"]);
                    if(mb_strlen($excerpt)>70){
                        echo $short_excerpt = iconv_substr($excerpt, 0, 70, "utf-8")."...";
                    }
                    ?>
                </h4>
            </div>
        </article>
        <?php }?>
    </div>

    <div class="dimg-loading-btn-area">
        <button class="dimg-loading-btn-cate">Load more posts</button>
    </div>
</div>

<?php get_footer(); ?>