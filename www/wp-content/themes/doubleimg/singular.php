<?php get_header(); ?>
<?php $cp = get_post();//current post?>
<?php
$catID = get_the_category($cp->ID);
if ($catID) {
	$cat_ids = array();
	foreach($catID as $v) $cat_ids[] = $v->cat_ID;
	$args = array(
		'category__in' => $cat_ids,
		'post__not_in' => array($cp->ID),
		'posts_per_page'=>3, // 3으로 수정함
		// 'caller_get_posts'=>1,
		'orderby'=>'rand' // 추가됨
	);
	
	$rel_posts = new wp_query( $args );
}
$author_info = get_user_by('ID',$cp->post_author);
$post_author_display_name = $author_info->data->display_name;
?>
<script>
	jQuery("body").addClass("single-post-page");
</script>
<div class="dimg-post-wrapper">
	<div class="dimg-post-wrapper-inner">
		<!-- 글 머리 -->
		<section class="dimg-post-header">
			<div class="dimg-post-header-wrapper borders">
				<!-- <div class="dimg-post-header-thumb-area">
					<div class="dimg-post-header-thumb borders">
						<?=get_the_post_thumbnail($recent["ID"],'dimg-post-header-thumb');?>
					</div>
					<div class="dimg-post-header-thumb-line"></div>
				</div> -->
				<div class="dimg-post-header-desc-area">
					<div class="dimg-post-header-title"><h1><?=$cp->post_title?></h1></div>
					<div class="dimg-post-header-author-time">
						<span><?=$post_author_display_name?></span>
						<span><?=$cp->post_date?></span>
					</div>
					<div class="dimg-post-header-cate-area">
						<?php
						$catID = get_the_category($recent["ID"]);
						foreach($catID as $v ){
							echo "<a href='/category/$v->slug'>$v->name</a>";
							// echo "<a href='/category/$v->slug' style='background-color:$v->description !important;'>$v->name</a>";
						}
						?>
					</div>
				</div>
			</div>
		</section>

		<!-- 본문 -->
		<section class="dimg-post-contents">
			<div class="dimg-post-contents-wrapper borders">
				<?=$cp->post_content?>
			</div>
		</section>

		<!-- 로고 -->
		<div class="dimg-space-40"></div>

		<!-- 관련글 -->
		<section class="dimg-relative-posts">
			<div class="dimg-relative-posts-header">
				<div>Relative Posts</div>
				<div class="dimg-relative-post-line"></div>
			</div>

			<div class="dimg-relative-posts-wrapper">
				<?php for($i=0;$i<$rel_posts->post_count;$i++){?>
					<article class="dimg-col-card">
						<div class="dimg-card-thumb">
							<a href="<?=get_permalink($rel_posts->posts[$i]->ID)?>">
								<?=get_the_post_thumbnail($rel_posts->posts[$i]->ID,'dimg-card-thumb-img');?>
							</a>

							<div class="dimg-card-category">
								<?php
								$breaker = 0;
								foreach(get_the_category($rel_posts->posts[$i]->ID) as $v ){
									if($breaker != 0) break;
									echo "<a href='/category/$v->slug'>$v->name</a>";
									$breaker++;
								}
								?>
							</div>
						</div>
						<div>
							<h2 class="dimg-card-title">
								<a href="<?=get_permalink($rel_posts->posts[$i]->ID)?>"><?=$rel_posts->posts[$i]->post_title?></a>
							</h2>
						</div>
					</article>
				<?php }?>
			</div>
		</section>
	</div>
</div>
<?php get_footer(); ?>