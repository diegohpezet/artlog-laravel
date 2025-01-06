# Artlog

Artlog is a social web application built with [Laravel](https://laravel.com) that serves as a platform for artists to showcase their work and for users to discover and connect with new art and artists.

## Features

- **User Authentication and Registration**: Secure login and signup functionality.
- **Search Functionality**: Discover artworks and artists easily with a powerful search feature.
- **Profile Page**: Personalized profiles for artists and users to showcase their collections and favorites.
- **Artwork Upload and Management**: Effortlessly upload and manage your art pieces.
- **Like/Dislike Functionality**: Engage with the community by liking or disliking artworks.
- **Follow Functionality**: Follow your favorite artists and stay updated with their latest creations.

## Installation

Follow these steps to set up the project locally:

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd artlog
   ```

2. **Set Up Environment Variables**
   Copy the example environment file and update it with your database credentials and provider settings:
   ```bash
   cp .env.example .env
   ```
   Edit the `.env` file to configure your database connection and any third-party API keys as needed.

3. **Install Backend Dependencies**
   Install PHP dependencies using Composer:
   ```bash
   composer install
   ```

4. **Install Frontend Dependencies**
   Install Node.js dependencies:
   ```bash
   npm install
   ```

5. **Set Up the Database**
   Run migrations and seed the database with sample data:
   ```bash
   php artisan migrate --seed
   ```

6. **Start the Development Server**
   Start the backend server:
   ```bash
   php artisan serve
   ```
   Start the frontend development server:
   ```bash
   npm run dev
   ```

7. **Access the Application**
   Open your browser and go to [http://localhost:8000](http://localhost:8000) to access Artlog.

## Contribution Guidelines

We welcome contributions! To contribute to Artlog, please follow these steps:

1. Fork the repository and create a new branch for your feature or bugfix.
2. Commit your changes with clear, descriptive messages.
3. Push your branch and open a pull request.

## License

Artlog is open-source software licensed under the [MIT License](https://opensource.org/licenses/MIT).

