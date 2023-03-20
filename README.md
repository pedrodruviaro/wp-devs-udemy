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
