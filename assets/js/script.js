jQuery(document).ready(function ($) {

    $(".banners").addClass("owl-carousel").owlCarousel({
        loop: true, // Faz os banners rodarem em loop
        nav: false, // Botões de navegação
        dots: false, // Exibe os pontos de navegação
        autoplay: true, // Faz a rotação automática
        autoplayTimeout: 4000, // Tempo entre as trocas
        autoplayHoverPause: true, // Pausa no hover
        responsive: {
            0: {
                items: 1 // Mostra 1 item por vez em telas pequenas
            },
            600: {
                items: 1 // Mostra 2 itens em telas médias
            },
            1000: {
                items: 1 // Mostra 3 itens em telas grandes
            }
        }
    });
	
	 $(".home .lista-projetos").addClass("owl-carousel").owlCarousel({
        loop: true, // Faz os banners rodarem em loop
        nav: false, // Botões de navegação
        dots: true, // Exibe os pontos de navegação
        autoplay: true, // Faz a rotação automática
        autoplayTimeout: 4000, // Tempo entre as trocas
        autoplayHoverPause: true, // Pausa no hover
        responsive: {
            0: {
                items: 1 // Mostra 1 item por vez em telas pequenas
            },
            600: {
                items: 2 // Mostra 2 itens em telas médias
            },
            1000: {
                items: 3 // Mostra 3 itens em telas grandes
            }
        }
    });
	
	$(".single .lista-projetos").addClass("owl-carousel").owlCarousel({
        loop: true, // Faz os banners rodarem em loop
        nav: false, // Botões de navegação
        dots: true, // Exibe os pontos de navegação
        autoplay: true, // Faz a rotação automática
        autoplayTimeout: 4000, // Tempo entre as trocas
        autoplayHoverPause: true, // Pausa no hover
        responsive: {
            0: {
                items: 1 // Mostra 1 item por vez em telas pequenas
            },
            600: {
                items: 2 // Mostra 2 itens em telas médias
            },
            1000: {
                items: 3 // Mostra 3 itens em telas grandes
            }
        }
    });
	
});

//posts dinâmicos
document.addEventListener("DOMContentLoaded", function () {

    if (!document.body.classList.contains("page-template-projetos")) {
        return; // Sai da execução se não estiver na página correta
    }

    let page = 1;
    let currentCategory = 'all';
    let maxPages = 1;

    function carregarProjetos(page, category, append = false) {
        let data = new FormData();
        data.append('action', 'carregar_projetos');
        data.append('page', page);
        data.append('category', category);

        fetch(ajax_obj.ajaxurl, {
            method: 'POST',
            body: data
        })
        .then(response => response.text())
        .then(html => {
            let listaProjetos = document.querySelector('.lista-projetos');
            let botaoLoadMore = document.getElementById('load-more');

            if (!listaProjetos) {
                console.error("Elemento .lista-projetos não encontrado");
                return;
            }

            if (!append) {
                listaProjetos.innerHTML = html; // Substitui os posts
            } else {
                listaProjetos.insertAdjacentHTML('beforeend', html); // Adiciona mais posts
            }

            let totalProjetos = document.querySelectorAll('.projeto').length;

            // Se a página atual for maior ou igual ao total de páginas, escondemos o botão
            let hasMorePosts = page < maxPages;

            console.log(`Total de Projetos na Tela: ${totalProjetos}, MaxPages: ${maxPages}, hasMorePosts: ${hasMorePosts}`);

            if (botaoLoadMore) {
                botaoLoadMore.style.display = hasMorePosts ? "block" : "none";
            }
        })
        .catch(error => console.error("Erro ao carregar projetos:", error));
    }

    // Obtendo a quantidade total de páginas na primeira requisição
    fetch(ajax_obj.ajaxurl + "?action=obter_total_paginas")
        .then(response => response.json())
        .then(data => {
            maxPages = data.max_pages;
            carregarProjetos(page, currentCategory);
        });

    // Filtrar por categoria ao clicar nos botões
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentCategory = this.dataset.category;
            page = 1;
            carregarProjetos(page, currentCategory);
        });
    });

    // Carregar mais projetos ao clicar no botão "Ver Mais"
    let botaoLoadMore = document.getElementById('load-more');
    if (botaoLoadMore) {
        botaoLoadMore.addEventListener('click', function () {
            if (page < maxPages) {
                page++;
                carregarProjetos(page, currentCategory, true);
            }
        });
    }
});

/*modal contato*/
document.addEventListener("DOMContentLoaded", function () {
    let modal = document.getElementById("meuModal");
    let buttons = document.querySelectorAll(".abrirModal"); // Seleciona TODOS os botões
    let span = document.querySelector(".fechar"); // Seleciona o botão de fechar

    // Garante que o modal permaneça escondido ao carregar a página
    modal.style.display = "none";

    // Adiciona evento de clique para cada botão com a classe "abrirModal"
    buttons.forEach(function (btn) {
        btn.addEventListener("click", function () {
            modal.style.display = "flex";
        });
    });

    // Quando o usuário clica no "x", fecha o modal
    if (span) {
        span.onclick = function () {
            modal.style.display = "none";
        };
    }

    // Quando o usuário clica fora do modal, fecha ele
    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };
});


//MENU MOBILE
jQuery(".wrapper--menu button img").click(function(){
	jQuery(".wrapper--menu").addClass('active');
 	jQuery(".sidebar--menu").addClass('open');
	jQuery("#bg-transparent").css('display', 'block');
});

jQuery(".fechar-sidebar svg").click(function(){
 	jQuery(".sidebar--menu").removeClass('open');
	jQuery(".wrapper--menu").removeClass('active');
	jQuery("#bg-transparent").css('display', 'none');
});

jQuery(".sidebar--head li button").click(function(){
 	jQuery(".sidebar--menu").removeClass('open');
	jQuery(".wrapper--menu").removeClass('active');
	jQuery("#bg-transparent").css('display', 'none');
});

jQuery("#bg-transparent").click(function(){
 	jQuery(".sidebar--menu").removeClass('open');
	jQuery(".wrapper--menu").removeClass('active');
	jQuery("#bg-transparent").css('display', 'none');
});
