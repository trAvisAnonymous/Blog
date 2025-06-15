# Game Website Project

## Project Overview
This is a comprehensive game website project that includes multiple templates, game content management, and various features for game hosting and display.

## Directory Structure
```
├── assets/                  # Core assets and configuration
│   ├── api/                # API related files
│   ├── classes/            # PHP classes
│   ├── includes/           # Include files
│   ├── index/             # Index related files
│   ├── language/          # Language files
│   ├── requests/          # Request handlers
│   ├── sources/           # Source files
│   ├── conf.php           # Configuration file
│   ├── install.php        # Installation script
│   └── setup-config.php   # Setup configuration
├── cat/                    # Category related files
├── gm-content/            # Game content directory
├── images/                # Image assets
├── logins/               # Login related files
├── static/               # Static files
├── templates/            # Website templates
│   ├── blue/            # Blue theme
│   ├── friv/            # Friv theme
│   ├── girls/           # Girls theme
│   ├── kizi/            # Kizi theme
│   ├── modern/          # Modern theme
│   ├── red/             # Red theme
│   └── sports/          # Sports theme
├── web/                  # Web specific files
├── .htaccess            # Apache configuration
├── ads.txt              # AdSense configuration
├── ajax_loadmoregames.php # AJAX game loading
├── categories.xml       # Categories data
├── favicon.ico          # Website favicon
├── feed.php             # RSS feed
├── gm-api.php           # Game API
├── gm-load.php          # Game loading
├── gm-request.php       # Game requests
├── index.php            # Main entry point
├── robots.txt           # Search engine configuration
├── search.php           # Search functionality
└── sitemap.xml          # Sitemap for SEO
```

## Key Features
- Multiple theme templates (Blue, Friv, Girls, Kizi, Modern, Red, Sports)
- Game content management system
- AJAX-based game loading
- Search functionality
- RSS feed support
- SEO optimization (sitemap.xml, robots.txt)
- AdSense integration
- Category management
- Multi-language support

## Important Files
1. **Configuration Files**
   - `assets/conf.php`: Main configuration file
   - `assets/setup-config.php`: Setup configuration
   - `.htaccess`: Apache server configuration

2. **Core Files**
   - `index.php`: Main entry point
   - `gm-api.php`: Game API implementation
   - `gm-load.php`: Game loading functionality
   - `gm-request.php`: Game request handling

3. **Content Management**
   - `categories.xml`: Game categories
   - `ajax_loadmoregames.php`: Dynamic game loading
   - `search.php`: Search functionality

4. **SEO and Analytics**
   - `sitemap.xml`: Search engine sitemap
   - `robots.txt`: Search engine directives
   - `ads.txt`: AdSense configuration

## Installation
1. Upload all files to your web server
2. Navigate to `assets/install.php` to run the installation script
3. Follow the setup wizard to configure your website
4. Update `assets/conf.php` with your specific settings

## Requirements
- PHP 7.0 or higher
- Apache web server with mod_rewrite enabled
- MySQL database
- GD library for image processing
- cURL extension for API requests

## Security
- All sensitive configuration is stored in `assets/conf.php`
- API keys and credentials should be properly configured
- Regular security updates are recommended

## Maintenance
- Regularly update game content in `gm-content/`
- Monitor and update categories in `categories.xml`
- Keep templates updated in `templates/` directory
- Regular backup of database and files recommended

## Support
For support and updates, please refer to the documentation in the project files or contact the development team.

## License
This project is proprietary software. All rights reserved. 