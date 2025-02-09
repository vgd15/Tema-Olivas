<?php get_header(); ?>

<div class="lista-projetos-container">
    <div class="container">
        <h1>Resultados da busca para: "<?php echo get_search_query(); ?>"</h1>

        <!-- LISTA DE PROJETOS -->
        <div class="lista-projetos">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
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
                <?php endwhile; ?>
            <?php else : ?>
                <h2 class="nenhum-resultado">Nenhum resultado encontrado.</h2>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
