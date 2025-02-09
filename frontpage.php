<?php 
/* Template Name: Front-page */
?>

<?php  get_header(); ?>

<div class="container">

<section class="banners">
	<div class="banner">
		<div class="textos">
			<h1>
				Teste de desenvolvimento <span>Wordpress</span>
			</h1>
			<p>
				Bem-vindo ao nosso desafio de codificação React! Este teste avalia suas habilidades em desenvolver aplicações web interativas com React. Sua tarefa é construir uma aplicação que interaja com APIs externas e exiba dados de forma clara e eficiente. Estamos ansiosos para ver sua criatividade e qualidade de código em prática.
			</p>
			<button>
				<a href="#contato"> Entrar em contato</a>
			</button>
		</div>
	<img src="<?php echo get_home_url()?>/wp-content/uploads/2025/02/image-1.jpg ">
	</div>
		<div class="banner">
		<div class="textos">
			<h1>
				Teste de desenvolvimento <span>Wordpress</span>
			</h1>
			<p>
				Bem-vindo ao nosso desafio de codificação React! Este teste avalia suas habilidades em desenvolver aplicações web interativas com React. Sua tarefa é construir uma aplicação que interaja com APIs externas e exiba dados de forma clara e eficiente. Estamos ansiosos para ver sua criatividade e qualidade de código em prática.
			</p>
			<button>
				<a href="#contato"> Entrar em contato</a>
			</button>
		</div>
	<img src="<?php echo get_home_url()?>/wp-content/uploads/2025/02/image-1.jpg ">
	</div>
		<div class="banner">
		<div class="textos">
			<h1>
				Teste de desenvolvimento <span>Wordpress</span>
			</h1>
			<p>
				Bem-vindo ao nosso desafio de codificação React! Este teste avalia suas habilidades em desenvolver aplicações web interativas com React. Sua tarefa é construir uma aplicação que interaja com APIs externas e exiba dados de forma clara e eficiente. Estamos ansiosos para ver sua criatividade e qualidade de código em prática.
			</p>
			<button>
				<a href="#contato"> Entrar em contato</a>
			</button>
		</div>
	<img src="<?php echo get_home_url()?>/wp-content/uploads/2025/02/image-1.jpg ">
	</div>
</section>
<section class="projetos-home">
	<h2>Projetos</h2>
	<div class="lista-projetos">
        <?php
        $args = array(
            'post_type'      => 'projects',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
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
        else :
            echo '<p>Nenhum projeto encontrado.</p>';
        endif;

        wp_reset_postdata();
        ?>
    </div>
    <div class="ver-mais-box">
    <a class="veja-mais" href="<?php echo get_home_url()?>/?page_id=14">Veja mais</a>
	</div>
</section>
	<section id="contato">
		<h1>
			Entre em contato e <span>receba atendimento</span>
		</h1>
		
		<P>
			Por favor, preencha o formulário abaixo com suas informações e a sua mensagem. Nossa equipe entrará em contato com você o mais breve possível.
		</P>
		<?php echo do_shortcode('[contact-form-7 id="06b1684" title="Formulário de contato 1]'); ?>
	</section>

	
</div>


<?php  get_footer(); ?>