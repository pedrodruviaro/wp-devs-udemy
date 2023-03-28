<?php get_header(); ?>

<div id="primary">
    <div id="main">
        <div class="container">

            <h1>Search results for: <?php echo get_search_query(); ?></h1>

            <?php

                get_search_form();

                while( have_posts() ):
                    the_post();
                    
                    get_template_part('parts/content', 'search');

                     
                    if(comments_open() || get_comments_number() ){
                        comments_template();
                    }
                endwhile;

                $args = array(
                    'prev_text'          => _x( '<<', 'previous set of posts' ),
                    'next_text'          => _x( '>>', 'next set of posts' ),
                    'screen_reader_text' => __( 'Search navigation' ),
                );
                the_posts_pagination( $args );

            ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>