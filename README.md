# 🎨 Art Gallery - Online Art Marketplace

[![Live Demo](https://img.shields.io/badge/Live-Demo-brightgreen)](https://artist.phoenixtechs.net/)
[![Laravel](https://img.shields.io/badge/Laravel-10.x-red)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue)](https://php.net)
[![Filament](https://img.shields.io/badge/Filament-3.3-orange)](https://filamentphp.com)

A modern, full-featured online art gallery and marketplace built with Laravel and Filament. Artists can showcase their work, and collectors can discover and purchase unique artworks from around the world.

**Live Site:** [https://artist.phoenixtechs.net/](https://artist.phoenixtechs.net/)

---

## 📋 Table of Contents

- [Features](#-features)
- [Technologies](#-technologies)
- [System Requirements](#-system-requirements)
- [Installation](#-installation)
- [Database Schema](#-database-schema)
- [Project Structure](#-project-structure)
- [Admin Panel](#-admin-panel)
- [Configuration](#-configuration)
- [Deployment](#-deployment)
- [Contributing](#-contributing)
- [License](#-license)

---

## ✨ Features

### 🎨 For Collectors

- **Browse Artworks**: Explore a curated collection of paintings, sculptures, photography, and more
- **Advanced Filtering**: Filter by category, medium, style, price range, and more
- **Search Functionality**: Live search with instant results
- **Artist Profiles**: View artist portfolios, bios, and featured videos
- **Product Details**: High-resolution images, detailed descriptions, and specifications
- **Responsive Design**: Seamless experience across desktop, tablet, and mobile devices

### 🖼️ For Artists

- **Artist Profiles**: Showcase your work with a personalized profile page
- **Portfolio Management**: Upload and manage your artwork collection
- **Video Integration**: Feature videos of your creative process
- **Bio & Location**: Share your story and connect with collectors

### 🛠️ For Administrators

- **Filament Admin Panel**: Modern, intuitive admin interface
- **Content Management**: Manage artworks, categories, users, and banners
- **User Management**: Role-based access control (Admin/Artist/Collector)
- **Banner Management**: Control homepage carousel and promotional content
- **Video Management**: Manage artist videos and featured content
- **Statistics Dashboard**: Track artworks, users, and categories

### 🎯 Key Features

- **Anniversary Sale**: Promotional banner system with discount codes
- **Free Shipping**: Configurable shipping promotions
- **New Artists Section**: Highlight emerging talent
- **Category System**: Organized by Abstract, Realism, Impressionism, Contemporary, Landscape, Portrait
- **Responsive Navigation**: Mobile-friendly menu with smooth animations
- **SEO Optimized**: Clean URLs, meta tags, and structured data

---

## 🚀 Technologies

### Backend

- **[Laravel 10.x](https://laravel.com)** - PHP web application framework
- **[PHP 8.1+](https://php.net)** - Server-side scripting language
- **[MySQL](https://mysql.com)** - Relational database management system
- **[Filament 3.3](https://filamentphp.com)** - Admin panel and form builder
- **[Laravel Sanctum](https://laravel.com/docs/sanctum)** - API authentication
- **[Laravel Tinker](https://github.com/laravel/tinker)** - REPL for Laravel

### Frontend

- **[Blade Templates](https://laravel.com/docs/blade)** - Laravel's templating engine
- **[Vite](https://vitejs.dev)** - Modern frontend build tool
- **[Axios](https://axios-http.com)** - Promise-based HTTP client
- **Custom CSS** - Responsive, modern design system
- **JavaScript (ES6+)** - Interactive UI components

### Development Tools

- **[Composer](https://getcomposer.org)** - PHP dependency manager
- **[NPM](https://npmjs.com)** - JavaScript package manager
- **[Laravel Pint](https://laravel.com/docs/pint)** - PHP code style fixer
- **[PHPUnit](https://phpunit.de)** - PHP testing framework
- **[Laravel Sail](https://laravel.com/docs/sail)** - Docker development environment

### Additional Packages

- **[Guzzle HTTP](https://docs.guzzlephp.org)** - HTTP client for API requests
- **[Faker](https://fakerphp.github.io)** - Generate fake data for testing
- **[Spatie Laravel Ignition](https://github.com/spatie/laravel-ignition)** - Beautiful error page

---

## 💻 System Requirements

- **PHP**: 8.1 or higher
- **Composer**: 2.x
- **Node.js**: 16.x or higher
- **NPM**: 8.x or higher
- **MySQL**: 5.7+ or MariaDB 10.3+
- **Web Server**: Apache or Nginx
- **PHP Extensions**:
  - BCMath
  - Ctype
  - Fileinfo
  - JSON
  - Mbstring
  - OpenSSL
  - PDO
  - Tokenizer
  - XML
  - GD or Imagick (for image processing)

---

## 📦 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/artwork.git
cd artwork
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
cp .env.example .env
```

Edit `.env` file with your configuration:

```env
APP_NAME="Art Gallery"
APP_ENV=production
APP_URL=https://artist.phoenixtechs.net

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

### 7. Seed Database (Optional)

```bash
php artisan db:seed
```

This will create:
- Admin user
- Sample categories (Abstract, Realism, Impressionism, Contemporary, Landscape, Portrait)
- Sample artworks
- Sample artists
- Sample videos
- Homepage banners

### 8. Create Storage Symlink

```bash
php artisan storage:link
```

### 9. Build Frontend Assets

**For Development:**
```bash
npm run dev
```

**For Production:**
```bash
npm run build
```

### 10. Start Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

---

## 🗄️ Database Schema

### Users Table
- **id**: Primary key
- **name**: User's full name
- **email**: Email address (unique)
- **password**: Hashed password
- **role**: User role (admin, artist, collector)
- **bio**: Artist biography
- **location**: Artist location
- **avatar**: Profile picture path
- **main_video_id**: Featured main video
- **featured_video_id**: Secondary featured video
- **timestamps**: Created/updated timestamps

### Artworks Table
- **id**: Primary key
- **title**: Artwork title
- **artist_name**: Artist name (fallback)
- **medium**: Art medium (Oil, Acrylic, Watercolor, etc.)
- **dimensions**: Physical dimensions
- **price**: Price in USD
- **image_file**: Image file path
- **description**: Detailed description
- **category_id**: Foreign key to categories
- **user_id**: Foreign key to users (artist)
- **is_ready_to_hang**: Boolean flag
- **year_created**: Year of creation
- **style**: Art style
- **condition**: Condition status
- **location**: Current location
- **timestamps**: Created/updated timestamps

### Categories Table
- **id**: Primary key
- **name**: Category name
- **slug**: URL-friendly slug
- **description**: Category description
- **image_url**: Category image
- **artworks_count**: Cached count of artworks
- **timestamps**: Created/updated timestamps

### Videos Table
- **id**: Primary key
- **title**: Video title
- **description**: Video description
- **video_file**: Video file path
- **thumbnail_file**: Thumbnail image path
- **category_id**: Foreign key to categories
- **user_id**: Foreign key to users (artist)
- **timestamps**: Created/updated timestamps

### Banners Table
- **id**: Primary key
- **title**: Banner title
- **subtitle**: Banner subtitle
- **button_text**: CTA button text
- **button_link**: CTA button URL
- **image**: Banner image path
- **order**: Display order
- **is_active**: Active status
- **timestamps**: Created/updated timestamps

---

## 📁 Project Structure

```
artwork/
├── app/
│   ├── Console/              # Artisan commands
│   ├── Exceptions/           # Exception handlers
│   ├── Filament/            # Filament admin resources
│   │   ├── Pages/           # Custom admin pages
│   │   ├── Resources/       # CRUD resources
│   │   │   ├── ArtworkResource.php
│   │   │   ├── CategoryResource.php
│   │   │   ├── UserResource.php
│   │   │   ├── VideoResource.php
│   │   │   └── BannerResource.php
│   │   └── Widgets/         # Dashboard widgets
│   ├── Http/
│   │   ├── Controllers/     # Application controllers
│   │   │   ├── HomeController.php
│   │   │   ├── ArtworkController.php
│   │   │   ├── AuthController.php
│   │   │   ├── ProfileController.php
│   │   │   └── SearchController.php
│   │   └── Middleware/      # HTTP middleware
│   ├── Models/              # Eloquent models
│   │   ├── User.php
│   │   ├── Artwork.php
│   │   ├── Category.php
│   │   ├── Video.php
│   │   └── Banner.php
│   └── Providers/           # Service providers
├── bootstrap/               # Framework bootstrap
├── config/                  # Configuration files
├── database/
│   ├── factories/          # Model factories
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
│       ├── AdminUserSeeder.php
│       ├── CategorySeeder.php
│       ├── ArtworkSeeder.php
│       ├── ArtistSeeder.php
│       ├── VideoSeeder.php
│       └── BannerSeeder.php
├── public/                  # Public assets
│   ├── assets/
│   │   └── css/
│   │       └── style.css   # Custom styles
│   └── storage/            # Symlinked storage
├── resources/
│   ├── js/                 # JavaScript files
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/              # Blade templates
│       ├── auth/           # Authentication views
│       ├── components/     # Reusable components
│       │   ├── hero-carousel.blade.php
│       │   ├── category-pills.blade.php
│       │   ├── navigation.blade.php
│       │   └── promo-banner.blade.php
│       ├── layouts/        # Layout templates
│       │   ├── app.blade.php
│       │   ├── header.blade.php
│       │   └── footer.blade.php
│       └── pages/          # Page templates
│           ├── home.blade.php
│           ├── paintings.blade.php
│           ├── product-detail.blade.php
│           ├── profile.blade.php
│           └── search-results.blade.php
├── routes/
│   ├── web.php             # Web routes
│   ├── api.php             # API routes
│   └── console.php         # Console routes
├── storage/                # Storage directory
├── tests/                  # Test files
├── .env.example            # Environment example
├── composer.json           # PHP dependencies
├── package.json            # JavaScript dependencies
├── phpunit.xml             # PHPUnit configuration
├── vite.config.js          # Vite configuration
└── README.md               # This file
```

---

## 🔐 Admin Panel

### Accessing the Admin Panel

Navigate to: `https://artist.phoenixtechs.net/admin`

### Default Admin Credentials

After running `php artisan db:seed`:

- **Email**: `admin@artgallery.com`
- **Password**: `password`

**⚠️ Important**: Change the default password immediately in production!

### Admin Features

#### Dashboard
- Overview statistics (total artworks, users, categories)
- Quick access to all resources
- Recent activity feed

#### Artwork Management
- Create, read, update, delete artworks
- Image upload with preview
- Category assignment
- Price management
- Artist assignment
- Bulk actions

#### Category Management
- Manage art categories
- Automatic artwork count
- Slug generation
- Category images

#### User Management
- User roles (Admin, Artist, Collector)
- Artist profiles
- Avatar management
- Video assignments

#### Video Management
- Upload artist videos
- Thumbnail management
- Category assignment
- Featured video selection

#### Banner Management
- Homepage carousel management
- Promotional banners
- Order management
- Active/inactive status

---

## ⚙️ Configuration

### File Storage

Configure storage in `config/filesystems.php`:

```php
'default' => env('FILESYSTEM_DISK', 'public'),
```

### Image Upload

Artworks and videos are stored in:
- `storage/app/public/artworks/`
- `storage/app/public/videos/`
- `storage/app/public/avatars/`
- `storage/app/public/banners/`

### Mail Configuration

Configure mail settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@artgallery.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Cache Configuration

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Clear all caches
php artisan optimize:clear
```

---

## 🚀 Deployment

### Production Checklist

1. **Environment**
   ```bash
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **Optimize Application**
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Build Assets**
   ```bash
   npm run build
   ```

4. **Set Permissions**
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

5. **Configure Web Server**
   - Point document root to `/public`
   - Enable `mod_rewrite` (Apache) or configure Nginx

### Apache Configuration

```apache
<VirtualHost *:80>
    ServerName artist.phoenixtechs.net
    DocumentRoot /path/to/artwork/public

    <Directory /path/to/artwork/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### Nginx Configuration

```nginx
server {
    listen 80;
    server_name artist.phoenixtechs.net;
    root /path/to/artwork/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## 🧪 Testing

### Run Tests

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=ExampleTest

# Run with coverage
php artisan test --coverage
```

### Code Style

```bash
# Fix code style
./vendor/bin/pint

# Check code style
./vendor/bin/pint --test
```

---

## 🎨 Customization

### Adding New Categories

1. Via Admin Panel: `/admin/categories/create`
2. Via Seeder: Edit `database/seeders/CategorySeeder.php`
3. Via Tinker:
   ```bash
   php artisan tinker
   >>> Category::create(['name' => 'New Category', 'slug' => 'new-category'])
   ```

### Customizing Styles

Edit `public/assets/css/style.css` for custom styles.

### Adding New Pages

1. Create controller method
2. Create Blade template in `resources/views/pages/`
3. Add route in `routes/web.php`

---

## 📝 API Endpoints

### Public Endpoints

- `GET /` - Homepage
- `GET /paintings` - Browse artworks
- `GET /artwork/{id}` - Artwork details
- `GET /artist/{id}` - Artist profile
- `GET /search` - Search artworks
- `GET /api/live-search` - Live search API

### Authentication Endpoints

- `GET /login` - Login page
- `POST /login` - Login action
- `GET /register` - Registration page
- `POST /register` - Registration action
- `POST /logout` - Logout action

### Protected Endpoints

- `GET /profile` - User profile (requires authentication)

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Coding Standards

- Follow PSR-12 coding standards
- Write descriptive commit messages
- Add tests for new features
- Update documentation as needed

---

## 🐛 Known Issues

- None currently reported

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👥 Team

**Phoenix Technologies**

- Website: [https://phoenixtechs.net](https://phoenixtechs.net)
- Email: support@phoenixtechs.net

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Filament](https://filamentphp.com) - Admin Panel
- [Unsplash](https://unsplash.com) - Sample images
- All contributors and artists who make this platform possible

---

## 📞 Support

For support, email support@phoenixtechs.net or visit our [support page](https://phoenixtechs.net/support).

---

## 🔗 Links

- **Live Demo**: [https://artist.phoenixtechs.net/](https://artist.phoenixtechs.net/)
- **Documentation**: [Coming Soon]
- **API Documentation**: [Coming Soon]
- **Changelog**: [CHANGELOG.md](CHANGELOG.md)

---

<p align="center">Made with ❤️ by Phoenix Technologies</p>
