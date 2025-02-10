<?php
/**
 * The template part contains the header part
 *
 *
 * @package Twenty
 */
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!--> 

<html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    
    <meta name="description" content="Uma agência digital com tudo que sua empresa precisa gerar resultados: planejamento, criação, desenvolvimento e marketing digital">
    <meta name="author" content="Twenty">

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style-olivas2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
   
    <?php wp_head(); ?>
</head>

<header>
            <section id="wrapper-menu">
               <div class="container">
                  <div class="menu-header">
                     <div class="logo">
                        <a href="<?php echo home_url() ?>"><img src="<?php echo home_url() ?>/wp-content/uploads/2025/02/olivasdigital-cor-530x130-1.png" alt="Logo Olivas" /></a>
                     </div>
                     <div class="menu">
                        <?php
                           if (has_nav_menu('main-menu')) {
                           	wp_nav_menu(array(
                           		'theme_location' => 'main-menu',
                           		'container' => 'false',
                           		'menu_class' => ' mb-0 text-initial',
                           		'add_li_class'  => 'nav-item nav-link ts-scroll'
                           	));
                           }
                           ?>
				<form role="search" method="get" action="<?php echo home_url('/'); ?>">
					<label class="search-label">
						<input type="search" class="search-field" value="<?php echo get_search_query(); ?>" name="s" title="Buscar">
						<button type="submit" class="search-submit">
							<img src="<?php echo home_url('/wp-content/uploads/2025/02/ic_round-search-1.svg'); ?>" alt="Ícone de pesquisa">
						</button>
					</label>
				</form>

                        <div id="contato-header">
                           <button class="abrirModal btn btn-primary"  type="button"> Contato
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- MOBILE -->
            <section id="wrapper-mobile">
               <div class="container p-0">
                  <div class="menu">
                     <div class="logo-mobile">
                        <div class="logo-mobile">
                           <a href="<?php echo home_url() ?>"><img src="<?php echo home_url() ?>/wp-content/uploads/2025/02/olivasdigital-cor-530x130-1.png" alt="Logo Olivas" /></a>
                        </div>
                     </div>
                     <div class="wrapper--menu">
                        <button><img src="<?php echo home_url() ?>/wp-content/uploads/2025/02/cardapio.png" alt="menu mobile" /></button>
                        <!-- SIDEBAR MENU -->
                        <div class="sidebar--menu">
                           <div class="sidebar--head d-flex justify-content-between align-items-baseline">
                              <div class="title-sidebar--menu">
                                 <div class="logo-mobile">
                                    <a href="<?php echo get_home_url(); ?>">
                                    <img src="<?php echo get_home_url(); ?>/wp-content/uploads/2025/02/olivasdigital-cor-530x130-1.png" alt="Logo Olivas" />
                                    </a>
                                 </div>
                              </div>
                              <button class="fechar-sidebar">
                                 <svg width="15" height="14" viewBox="0 0 15 14" fill="#000" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.78311 12.7324L12.8438 1.6444" stroke="#000" stroke-width="2.5" stroke-linecap="round"/>
                                    <path d="M12.8632 12.7324L1.80247 1.6444" stroke="#000" stroke-width="2.5" stroke-linecap="round"/>
                                 </svg>
                              </button>
                           </div>
                           <div class="conteudo-sidebar">
                              <div class="sidebar--body">
                                 <?php
                                    if (has_nav_menu('main-menu')) {
                                        wp_nav_menu(array(
                                            'theme_location' => 'main-menu',
                                            'container' => 'false',
                                            'menu_class' => ' mb-0 text-initial',
                                            'add_li_class'  => 'nav-item nav-link ts-scroll'
                                        ));
                                    }
                                    ?>
                              </div>
                              <div class="sidebar--footer d-flex flex-column">
                              <div id="contato-header">
							   <button class="abrirModal btn btn-primary" type="button"> Contato
							   </button>
							</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="bg-transparent" style="display: none;"></div>
            </section>
         </header>

<!-- Estrutura do Modal -->
<div id="meuModal" class="modal">
    <div class="modal-conteudo">
        <span class="fechar">&times;</span>
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
</div>


<body data-spy="scroll" data-target=".navbar" data-bg-parallax="scroll" data-bg-parallax-speed="3" <?php body_class(); ?>>