<?php
/**
 * Template para exibição de posts de uma categoria
 *
 * @package Olivas
 */

get_header(); ?>

<main id="ts-content" class="content-int single-cont">
    <div class="container">
        <h1>Todos os Posts da</h1>
        <?php
        // Obtém a categoria via parâmetro da URL (?cat=ID)
        $category_id = get_query_var('cat');

        if ($category_id) {
            $category_name = get_cat_name($category_id);
            echo "<h2>Categoria: $category_name</h2>";

            // Query para buscar TODOS os posts da categoria
            $args = array(
                'post_type'      => 'projects', // ⚠️ ALTERADO: Certifique-se que seu post_type é "projects"
                'post_status'    => 'publish',
                'cat'            => $category_id,
                'posts_per_page' => -1,
                'orderby'        => 'date',
                'order'          => 'DESC'
            );

            $query = new WP_Query($args);


            if ($query->have_posts()) :
                echo '<div class="lista-projetos">';
                while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="projeto">
                     <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" alt="Sem imagem">
                        <?php endif; ?>
                    </a>
                        
                   					<div class="textos">
 					<p class="projeto-categorias">
                        <?php 
                        $categories = get_the_terms(get_the_ID(), 'category');
                        if ($categories && !is_wp_error($categories)) {
                            $category_names = wp_list_pluck($categories, 'name');
                            echo implode(', ', $category_names);
                        } else {
                            echo 'Sem categoria';
                        }
                        ?>
                    </p>

                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                    <!-- Limitar o resumo a 100 caracteres -->
                    <p>
                        <?php 
                        $excerpt = get_the_excerpt();
                        echo mb_strimwidth($excerpt, 0, 50, '...'); 
                        ?>
                    </p>
						<div class="ver-mais-box">
                    		<a class="ver-mais" href="<?php the_permalink(); ?>">Leia mais</a>
						</div>

                </div>
                    </div>
                <?php endwhile;
                echo '</div>';
                wp_reset_postdata();
            else :
                echo '<p class="erro">❌ Nenhum post encontrado nesta categoria.</p>';
            endif;
        } else {
            echo '<p>❌ Nenhuma categoria foi passada na URL.</p>';
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>
