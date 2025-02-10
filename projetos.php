<?php
/* Template Name: Projetos */
?>

<?php get_header(); ?>

<div class="lista-projetos-container">
    <div class="container">
		<h1>
			Projetos
		</h1>
        <!-- FILTRO DE CATEGORIAS -->
        <div class="filtro-categorias">
			<h3>
				FILTRAR:
			</h3>
            <button class="filter-btn active" data-category="all">Todos</button>
            <?php 
            $categories = get_categories();
            foreach ($categories as $category) {
                echo '<button class="filter-btn" data-category="' . $category->term_id . '">' . $category->name . '</button>';
            }
            ?>
        </div>

        <!-- LISTA DE PROJETOS -->
        <div class="lista-projetos"></div>

        <!-- BOTÃO "VER MAIS" -->
        <div class="ver-mais-box">
            <button id="load-more" class="veja-mais" data-page="1" style="display:none;" aria-label="Ver mais">Veja mais</button>        
        </div>
    </div>
</div>


<?php get_footer(); ?>
