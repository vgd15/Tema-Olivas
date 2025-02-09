<?php
// Criar um Custom Post Type chamado "Projetos" com suporte a Imagens Destacadas e Tags
function criar_cpt_projects() {
    $labels = array(
        'name'               => 'Projetos',
        'singular_name'      => 'Projeto',
        'menu_name'          => 'Projetos',
        'name_admin_bar'     => 'Projeto',
        'add_new'            => 'Adicionar Novo',
        'add_new_item'       => 'Adicionar Novo Projeto',
        'new_item'           => 'Novo Projeto',
        'edit_item'          => 'Editar Projeto',
        'view_item'          => 'Ver Projeto',
        'all_items'          => 'Todos os Projetos',
        'search_items'       => 'Pesquisar Projetos',
        'not_found'          => 'Nenhum projeto encontrado',
        'not_found_in_trash' => 'Nenhum projeto encontrado na lixeira'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'projetos'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio', // Ícone no admin
        'supports'           => array('title', 'editor', 'thumbnail', 'revisions'), // Adiciona suporte a Imagem Destacada
        'taxonomies'         => array('category') // Adiciona suporte a Tags
    );

    register_post_type('projects', $args);
}
add_action('init', 'criar_cpt_projects');
add_theme_support('post-thumbnails');



// Registrar menus no WordPress
function register_my_menus() {
    register_nav_menus(array(
        'main-menu' => 'Main Menu'
    ));
}
add_action('init', 'register_my_menus');

//ajax
function carregar_ajax_scripts() {
    wp_enqueue_script('ajax-scripts', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), null, true);

	wp_localize_script('ajax-scripts', 'ajax_obj', array(
		'ajaxurl' => esc_url(admin_url('admin-ajax.php')) // Garante que a URL esteja segura e correta
	));

}
add_action('wp_enqueue_scripts', 'carregar_ajax_scripts');



//posts dinâmico
function carregar_projetos_ajax() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? intval($_POST['category']) : '';

    $args = array(
        'post_type'      => 'projects',
        'posts_per_page' => 9,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'paged'          => $page,
    );

    if ($category && $category != 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $category,
            ),
        );
    }

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
                    <p><?php echo mb_strimwidth(get_the_excerpt(), 0, 100, '...'); ?></p>
						<div class="ver-mais-box">
                    		<a class="ver-mais" href="<?php the_permalink(); ?>">Leia mais</a>
						</div>
                </div>
            </div>

        <?php endwhile;
    endif;

    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_carregar_projetos', 'carregar_projetos_ajax');
add_action('wp_ajax_nopriv_carregar_projetos', 'carregar_projetos_ajax');


// Criar um endpoint AJAX para obter o número total de páginas
function obter_total_paginas() {
    $args = array(
        'post_type'      => 'projects',
        'posts_per_page' => 9,
    );

    $query = new WP_Query($args);

    wp_send_json(array('max_pages' => $query->max_num_pages));
    wp_die();
}

add_action('wp_ajax_obter_total_paginas', 'obter_total_paginas');
add_action('wp_ajax_nopriv_obter_total_paginas', 'obter_total_paginas');


?>