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