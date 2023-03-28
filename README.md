# Criação de Temas Responsivos com WordPress - Udemy

## Estrutura básica de um tema wordpress

---

### Desenvolvimento

-   Local

    -   extensão instant reload
    -   permite mudar a versão do php de forma fácil
    -   Go to side folder > app > public (abrir no vscode)

-   VS Code

    -   extensão do php intelisence

-   Wordpress - sempre usar o modo debug ON dentro do ambiente de desenvolvimento. Para ativar, setar _true_ ou adicionar o código no **wp_config**

    ```
    if ( ! defined( 'WP_DEBUG' ) ) {
        define( 'WP_DEBUG', true );
    }
    ```

---

### Hierarquia de um tema wordpress

-   o tema mora em wp_content > themes
-   _style.css_ -> estilo e informações sobre o tema
-   _screenshot.png_ -> imagem do tema que aparece no painel
-   _index.php_ -> ponto de entrada do tema
-   _single.php_ -> visualização de um posto único
-   _page.php_ -> exibição de uma página estática

-   Hierarquia

    -   https://developer.wordpress.org/themes/basics/template-hierarchy/
    -   _index.php_ -> fallback file (genérico)
    -   _page-\*.php_ -> página específica
    -   _404.php_ -> página inexistente (se o arquivo existir, se não, entra no index.php)
    -   _single.php_ -> **post** abre sempre no single.php

    ```
    Template:

    header.php
    *loop*
    footer.php
    ```

---

### Criando e ativando um tema

-   wp_content > themes > **wp-devs**
-   screenshot.png -> 1200x900px

```
<html <?php language_attributes(); ?>>
<meta charset="<?php bloginfo('charset'); ?>">
tag title -> incluída via functions.php
```

-   <?php body_class(); ?> retorna a classe referente à página atual, facilitando a estilização

-   Os três blocos básicos para se construir um tema:

    -   header
    -   content
    -   footer

-   Adicionando o **functions.php**

    -   criado dentro da pasta do tema
    -   caso o arquivo css não seja o _style.css_, utilizar a função **get_template_directory_uri** para difinir o caminho ao arquivo
    -   add_action adiciona uma ação que aciona os ganchos do wordpress
    -   filemtime para puxar o css => APENAS EM AMBIENTE DE DESENVOLVIMENTO

    -   incluindo google fonts

        ```
        wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap', array(), null);
        ```

    -   incluindo scripts => último argumento se refere à adição do script no header ou footer (true = footer, false = header)

-   Criando o menu

    -   Registrar os menus no functions.php -> **register_nav_menus**
    -   Adicionar no painel os menus e links
    -   Adicionar no código (local desejado)
        -   **<?php wp_nav_menu( array( 'theme_location' => 'wp_devs_main_menu' ) ) ?>**
        -   argumento 'depth' restringe a aparição de submenus (ex.: 1)
        -   temos acesso à página atual com a classe **current_page_item**

---

### Funções avançadas para criação de temas

-   O Loop Wordpress

    -   Processar posts / páginas estáticas
    -   Tags HTML + php

-   Configurações > Leitura > Your homepage displays > Static Page

    -   Homepage => Home
    -   Posts Page => Blog

-   Template de páginas (ou modelos)

    -   novos arquivos php com o nome da página
        -   page-about.php
        -   não reutilizável

-   Criando templates reutilizáveis

    -   arquivo general-template.php
    -   selecionar modelo no painel (General Template)
    -   o conteúdo do arquivo que importa
    -   conteúdo varia mas a disposição na página é a mesma
    -   hierarquia de template -> https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
        -   o último arquivo buscado é o index.php
    -   criando o page.php

-   Adicionando theme support

        -   função do wordpress para customizar vários aspectos do tema
        -   alterações pontuais sem conhecer código
        -   adiciona itens adicionais
        -   https://developer.wordpress.org/reference/functions/add_theme_support/

        -   adicionando imagem do header

            ```
            $args = array(
                'height' => 225,
                'width' => 1920
            );

            add_theme_support( 'custom-header', $args );
            ```

            -   No painel -> Aparência -> Header -> Adicionar a imagem
            -   Adicionando no tema

                -   general-template
                -   page.php
                -   index.php

                ```
                <img
                src="<?php header_image(); ?>"
                height="<?php echo get_custom_header()->height; ?>"
                width="<?php echo get_custom_header()->width; ?>"
                alt=""
                >
                ```

        -   Adicionando miniaturas -> imagem que representa um post

            -   add_theme_support('post-thumbnails');
            -   Feature Image disponível no painel de edição de posts
            -   no painel em Settings -> Media há um local reservado para o tamanho de imagens, neste caso, **Thumbnail size**
            -   Modificando os tamanhos de imagem

            -   adicionando no tema
                -   <?php the_post_thumbnail( 'thumb' ); ?>
                -   Pode ser adicionado tamanhos específicos na imagem
                -   https://havecamerawilltravel.com/wordpress-thumbnail-crop/

        -   Adicionando logo personalizado - no functions.php

            ```
            add_theme_support('custom-logo', array(
            'width' => 200,
            'height' => 110,
            'flex-height' => true,
            'flex-width' => true,
            ));
            ```

            -   Appearance => Customize => Site Identity
                -   header.php

    -   Adicionando sidebar

        -   registrando no functions.php
        -   Adicionando sidebar.php
        -   Adicionando no index.php
        -   Appearance => Widgets

    -   Criando a área de serviços

        -   Registrando os 3 serviços no functions
        -   Appearance -> Widgets -> Registrar estrutura de cada um
        -   Chamando cada widget no page-home.php

    -   Explorando WP_Query
        -   loop customizado
        -   feito na pagina page-home.php
        -   ID das categorias: Posts => Categories => hover do mouse mostra o ID abaixo
        -   Quando usamos a classe WP_Query para modificarmos a consulta padrão do WordPress, temos que antes criar um objeto dessa classe para usarmos passando os argumentos para o objeto
        -   A classe WP_Query não modifica diretamente o loop padrão. Ela faz uma cópia do loop padrão para ser usada da forma que desejar. Ao final do loop, temos que usar wp_reset_postdata();

### Criando as Páginas Internas do tema

-   Permalinks

    -   passar no href da tag 'a' a função the_permalink();

-   O arquivo single.php

    -   arquivo específico para exibir um post
    -   article id="post-<?php the_ID(); ?>" <?php post_class(); ?>

-   Adicionando comentários

    -   Podemos permitir ou não comentários em posts específicos pelo painel do post
    -   adicionamos o arquivo comments.php vindo de outro tema
    -   loop na página de post para exibir o esquema de comentários

-   Páginas de pesquisa

    -   nem todo site precisa de uma caixa de pesquisa
    -   <?php get_search_form(); ?> no header.php
    -   criando um novo arquivo de template para exibir os resultados -> search.php
        -   mesma estrutura do page.php
    -   formulário de pesquisa -> searchform.php
    -   filtrando post e páginas na busca
        -   regra if('post' == get_post_type()): no loop sem search.php
    -   excluindo todas as páginas do resultado de pesquisa
        -   input hidden no searchform.php
            -   input type="hidden" value="post" name="post_type" id="post_type"
            -   ou
            -   input type="hidden" value="page" name="post_type" id="post_type"

-   Paginação (página blog)

    -   Podemos mudar a quantidade de resultados em Settings -> Reading
    -   chamar os pontos antigos

        -   <?php previous_posts_link('<< Newer posts'); ?>

    -   no single.php, podemos adicionar links chamando os posts anterior/posterior com uma função semelhante (singular)
        -   <?php next_post_link( $args ); ?>

-   Paginação (busca)

    -   numérica
    -   the_posts_pagination( $args );

-   Criando páginas de arquivo, categoria, autor e tags

    -   archive.php -> exibição de categorias, author, datas...
    -   será substituido caso houver os arquivos específicos, ex. category.php, author.php, date.php

-   O arquivo 404.php

-   Entendendo template parts

    -   pedaços do tema desacoplados
        -   get_template_part( 'parts/content' ); -> content
        -   get_template_part( 'parts/content', 'single' ); -> content-single

-   Tags condicionais

    -   resolve problemas de exibição
    -   https://developer.wordpress.org/themes/basics/conditional-tags/
    -   blocos if/else
    -   ex.: removendo a tag image caso não haja thumbnail no blogpost

-   Configurações adicionais
    -   abaixo da tag body <?php wp_body_open(); ?>
        -   tag obrigatória
        -   ex.: caso de uso para GTM
    -   no functions.php -> adicionando condicional para wp_body_open caso não exista
    -   no functions.php -> automatic-feed-links como theme_support
    -   no functions.php -> suporte para HTML5 => html5
    -   adicionar as classes do WP no arquivo final css (https://wordpress.org/documentation/article/css/)

### Funções Avançadas, Bibliotecas e APIs nativas

-   **Theme Customizer**
    -   Appearance -> Customize
