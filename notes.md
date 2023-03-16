# Criação de Temas Responsivos com WordPress - Udemy

## Estrutura básica de um tema wordpress

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

### Criando e ativando um tema

-   wp_content > themes > **wp-devs**
-   screenshot.png -> 1200x900px
