<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## About The Project

Perpustakaan (Library) is backend application for library management system. It can manage data in libraries such as books, borrows, publishers, employees, and members.

<p align="right">
    <a href="#top">
    <img src="https://img.shields.io/badge/back%20to%20top-%E2%86%A9-blue" />
    </a>
</p>

### Built With

- [Laravel](https://adonisjs.com/)

<p align="right">
    <a href="#top">
    <img src="https://img.shields.io/badge/back%20to%20top-%E2%86%A9-blue" />
    </a>
</p>

<!-- GETTING STARTED -->

## Getting Started

### Installation

1. Clone the repo.

   ```sh
   git clone https://github.com/fahri-r/news-api.git
   ```

2. Install Composer packages.

   ```sh
   composer install
   ```

3. Rename `.env.example` into `.env`.

4. Set the database value in `.env`.

   ```sh
   ...
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=root
   DB_PASSWORD=
   ...
   ```

5. Set the cloudinary url value in `.env`.

   ```sh
   ...
   CLOUDINARY_URL=cloudinary://...@....
   ...
   ```

6. Set the redis value and queue connection in `.env`.

   ```sh
   ...
   QUEUE_CONNECTION=redis
   REDIS_HOST=127.0.0.1
   REDIS_PASSWORD=null
   REDIS_PORT=6379
   ...
   ```

7. Create database according to **DB_DATABASE**. in this case I have to create a database named `laravel`.

8. Execute database migration.
   ```sh
   php artisan migrate:fresh
   ```

9. Create Encryption keys using this command.
   ```sh
   php artisan passport:keys
   ```

10. Create personal access client.
   ```sh
   php artisan passport:install
   ```

<p align="right">
    <a href="#top">
    <img src="https://img.shields.io/badge/back%20to%20top-%E2%86%A9-blue" />
    </a>
</p>

<!-- USAGE EXAMPLES -->

## Usage

Once you have done the installation, let's start the local server.

```sh
php artisan serve
```

Now, Visit http://localhost:8000/api and you will see a message saying "Hello World". Also if you want to see the queue, you have to run.

```sh
php artisan queue:work
```

<p align="right">
    <a href="#top">
    <img src="https://img.shields.io/badge/back%20to%20top-%E2%86%A9-blue" />
    </a>
</p>

<!-- CONTRIBUTING -->

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project.
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`).
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`).
4. Push to the Branch (`git push origin feature/AmazingFeature`).
5. Open a Pull Request.

<p align="right">
    <a href="#top">
    <img src="https://img.shields.io/badge/back%20to%20top-%E2%86%A9-blue" />
    </a>
</p>

<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE` for more information.

<p align="right">
    <a href="#top">
    <img src="https://img.shields.io/badge/back%20to%20top-%E2%86%A9-blue" />
    </a>
</p>

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[contributors-shield]: https://img.shields.io/github/contributors/fahri-r/main-bersama-api?style=for-the-badge
[contributors-url]: https://github.com/fahri-r/news-api/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/fahri-r/main-bersama-api?style=for-the-badge
[forks-url]: https://github.com/fahri-r/news-api/network/members
[stars-shield]: https://img.shields.io/github/stars/fahri-r/main-bersama-api?style=for-the-badge
[stars-url]: https://github.com/fahri-r/news-api/stargazers
[issues-shield]: https://img.shields.io/github/issues/fahri-r/main-bersama-api?style=for-the-badge
[issues-url]: https://github.com/fahri-r/news-api/issues
[license-shield]: https://img.shields.io/github/license/fahri-r/main-bersama-api?style=for-the-badge
[license-url]: https://github.com/fahri-r/news-api/blob/main/LICENSE
[size-shield]: https://img.shields.io/github/repo-size/fahri-r/main-bersama-api?style=for-the-badge
