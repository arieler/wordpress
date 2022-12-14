### Wordpress

### `develop`

At the first time run the command:

```

docker-compose up -d

```

Then, to start Wordpress application: open Docker and start the container.

### Admin URL:

http://localhost:8080 - your site
http://localhost:8080/wp-admin - your site wp admin (once site is setup)
http://localhost:8025 - mailhog for viewing outgoing mail from site

### Site Folders:

```

./plugins/ -> plugins folder
./uploads/ -> file upload folder
./ -> Custom theme folder

```

### Command Line:

```


```

### WP Plugins

- WooCommerce
- Mercado Pago payments for WooCommerce
- Yoast SEO
- Site Kit by Google(Analytics, Search Console, AdSense, Speed)
- Contact Form 7
- WP-Optimize
- WPML(multilanguage)

### WP Documentation

[Best Practices](https://developer.wordpress.org/coding-standards/ "Best Practices")
[Block Editor Handbook](https://developer.wordpress.org/block-editor/ "Block Editor")
[Common APIs Handbook](https://developer.wordpress.org/apis/ "Common APIs")
[Theme Handbook](https://developer.wordpress.org/themes/ "Themes")
[Plugin Handbook](https://developer.wordpress.org/plugins/ "Plugin")
[REST API Handbook](https://developer.wordpress.org/rest-api/ "Rest API")
[Advanced Topics(plugins)](https://codex.wordpress.org/Advanced_Topics "Plugins")
[Codex development Guides](https://codex.wordpress.org/ "Codex Guides")
[Woocommerce Template dev](https://woocommerce.com/document/template-structure/ "Woocommerce Template Dev")
[WP Cli](https://wp-cli.org/ "Wp Cli")
[WP Info](https://www.wpbeginner.com/ "Wp Info")
[WP Genesis Framework](https://www.studiopress.com/themes/genesis/ "WP Starter Theme Framework")

### WP Commands

docker-compose run --rm wpcli command_name
docker-compose run --rm wpcli cli version
