<?php get_header(); ?>
<main class="ndj">
    <section class="hero inner-page" style="background-image: url('<?php the_field('hero_image', 298); ?>'); background-position: center center;">
    </section>
    <section class="wrapper">
      <div class="main body">
          <div class="row align-center">
            <div class="small-12 medium-8 columns text-center">
                <span class="section-title"></span>
              <?php $page = get_page_by_title( 'New Deal Journal' ); ?>
              <?=$page->post_content;?>
              <div class="tag-list">
                  <?php
                    $tags = get_tags();
                    $html = '<div class="post_tags">Sort By <select onChange="window.location.href=this.value">';
                    $html .= "<option>All Issues</option>";
                    foreach ( $tags as $tag ) {
                      $tag_link = get_tag_link( $tag->term_id );
                      $html .= "<option value='{$tag_link}'><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
                      $html .= "{$tag->name}</a></option>";
                    }
                    $html .= '</select></div>';
                    echo $html;
                   ?>
              </div>
            </div>
          </div>
			<div class="row align-center">
                <div class="press-release small-12 medium-12 large-12 columns">
                    <div class="row">
        				<?php if ( have_posts() ) : ?>
        					<?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php if(has_post_thumbnail()): ?>
                                <aside class="feature-image" style="background-image: url('<?php the_post_thumbnail_url(); ?>'); background-size: cover; background-position: center center;" >
                                </aside>
                                <?php endif ?>
                                <div class="article-inner">
                                    <?php the_category(); ?>
                                    <header class="entry-header">
                                        <?php
                                        if ( is_single() ) :
                                            the_title( '<h2 class="post-title">', '</h2>' );
                                        else :
                                            the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                        endif;

                                        if ( 'post' === get_post_type() ) : ?>

                                        <?php
                                        endif; ?>
                                    </header><!-- .entry-header -->
                                    <div class="entry-content">
                                        <?php the_excerpt(); ?>
                                    </div><!-- .entry-content -->
                                    <div class="tags">
                                        <?php the_tags($before = '', $sep = ' ', $after = ''); ?>
                                    </div>
                                </div>
                            </article><!-- #post-## -->
        				<?php endwhile; ?>
        				<?php endif; ?>
                        <div class="paginate_links small-12 columns">
                            <?php
                            global $wp_query;

                            $big = 999999999; // need an unlikely integer

                            echo paginate_links( array(
                            	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            	'format' => '?paged=%#%',
                            	'current' => max( 1, get_query_var('paged') ),
                            	'total' => $wp_query->max_num_pages,
                                'type' => 'list'
                            ) );
                            ?>
                        </div>
                    </div>
			   </div>
            </div>
		</div>
	</section>
</main>
<?php
get_footer();
