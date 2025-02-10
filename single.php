<?php
/**
 * Template para exibição de posts individuais (Single Post)
 *
 * @package Olivas
 */
?>

<?php get_header(); ?>

<main id="ts-content" class="content-int single-cont">
    <div class="container">
        <h3>Projetos</h3>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <section class="single-post-content">

                <!-- Título do post -->
                <h1 class="single-post-title"><?php the_title(); ?></h1>

                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <?php the_category(' > '); ?> > <span><?php the_author(); ?></span> > <span><?php echo get_the_date('d/m/Y'); ?></span>
                </div>

                <!-- Imagem principal -->
                <?php if (has_post_thumbnail()) : ?>
                    <figure class="imagem-principal-blog">
                        <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                    </figure>
                <?php endif; ?>

                <!-- Conteúdo do post -->
                <div class="conteudo-blog">
                    <?php the_content(); ?>
					
							<?php 
       $link = get_field('link'); // Nome do campo no ACF

        if ($link) {
			echo '<div class="link-externo">';
            echo '<a class="link-externo" href="' . esc_html($link) . '" aria-label="Link externo">Link externo</p>';
			echo  '</div>';
        }
			?>	
				</div>
            
				
				
            </section>

            <!-- Seção de TODOS os posts da mesma categoria principal -->
            <section class="projetos-relacionados">
                <?php
                // Obtendo a categoria principal do post atual
                $categories = get_the_category();
                $main_category_id = null;
                $main_category_name = '';

                if (!empty($categories)) {
                    $category = $categories[0]; // Pegamos a primeira categoria

                    // Verifica se a categoria tem um "pai", se sim, pega o pai, senão, pega ela mesma
                    if ($category->parent != 0) {
                        $main_category = get_category($category->parent);
                        $main_category_id = $main_category->term_id;
                        $main_category_name = esc_html($main_category->name);
                    } else {
                        $main_category_id = $category->term_id;
                        $main_category_name = esc_html($category->name);
                    }
                }

                if (!empty($main_category_id)) :
                ?>
                    <h2>Posts de <span class="categoria-relacionada"><?php echo $main_category_name; ?></span></h2>

                    <div class="lista-projetos">
                        <?php
                        $category_posts_args = array(
                            'post_type'      => 'projects', // Post type correto
                            'post_status'    => 'publish', // Apenas posts publicados
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field'    => 'term_id',
                                    'terms'    => $main_category_id, // Filtra pela categoria principal
                                ),
                            ),
                            'posts_per_page' => -1, // Pega TODOS os posts da categoria
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                            'suppress_filters' => false
                        );

                        $category_posts = new WP_Query($category_posts_args);

                        if ($category_posts->have_posts()) :
                            while ($category_posts->have_posts()) : $category_posts->the_post();
                        ?>
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
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p>❌ Nenhum post encontrado nesta categoria.</p>';
                        endif;
                        ?>
                    </div>
                <?php else : ?>
                    <p>❌ O post atual não tem uma categoria principal definida.</p>
                <?php endif; ?>
            </section>
						    <div class="ver-mais-box">
    <a class="veja-mais" href="<?php echo get_home_url()?>/?page_id=14">Veja mais</a>
	</div>

        <?php endwhile;
        endif; ?>
    </div>
</main>

<?php get_footer(); ?>
