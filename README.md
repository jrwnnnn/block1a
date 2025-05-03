# Block1A <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1067px-PHP-logo.svg.png?" style="height:30px;">

<!-- PROGRAMMING LANGUAGE ICONS
HTML: https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/HTML5_logo_and_wordmark.svg/512px-HTML5_logo_and_wordmark.svg.png
JAVA: https://upload.wikimedia.org/wikipedia/en/thumb/3/30/Java_programming_language_logo.svg/1200px-Java_programming_language_logo.svg.png
Python: https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1869px-Python-logo-notext.svg.png
PHP : https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1067px-PHP-logo.svg.png?20180502235434
mySQL: https://upload.wikimedia.org/wikipedia/labs/8/8e/Mysql_logo.png

--->

**Programmed and published on GitHub by Group 8 members:** <br>
<ul>
<li>Baldestamon, Mark Jerwin M.
<li>Estopia, Debbie Anne O.
<li>Pinera, Roxane B.
<li>Nm3
<li>Reyes, Jieben A.
</ul>

# Block1A <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1067px-PHP-logo.svg.png?" style="height:30px;">

**Programmed and published on GitHub by Group 8 members:**  
- Baldestamon, Mark Jerwin M.  
- Estopia, Debbie Anne O.  
- Pinera, Roxane B.  
- Nm3  
- Reyes, Jieben A.  

---

## How to Use

Click [here](https://block1a.onrender.com) to use the web app online, or run it locally:

### Run It Locally

1. **Clone the repository**
   ```sh
   git clone https://github.com/jrwnnnn/block1a.git
   cd block1a
   ```

2. **Install Composer** (Skip if already installed)  
   - [Download Composer](https://getcomposer.org/download/)  
   - Or install via terminal (Linux/macOS):
     ```sh
     curl -sS https://getcomposer.org/installer | php
     sudo mv composer.phar /usr/local/bin/composer
     ```

3. **Install dependencies**
   ```sh
   composer install
   ```

4. **Set up environment variables**
   - Create a `.env` file:
     ```sh
     cp .env.example .env
     ```
   - Edit `.env` and set your local DB config:
     ```
     DB_HOST=localhost
     DB_NAME=block1a
     DB_USER=root
     DB_PASS=
     ```

5. **Link `.env` in PHP**
   - In your PHP file (like `index.php`), make sure you include:
     ```php
     require_once __DIR__ . '/vendor/autoload.php';

     $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
     $dotenv->load();
     ```

6. **Run the project**
   ```sh
   php -S localhost:8000
   ```
   - Open `http://localhost:8000/index.php` in your browser.

## Contribute

This repository is maintained by a select group of contributors. Only the said members are authorized to submit pull requests and merge changes. But you are still welcome to **experiment** by forking the repository.

### How to Fork and Experiment

1. **Fork the Repository**
   - Click the **Fork** button at the top-right of this repository.  
   - This will create a copy under your GitHub account.

2. **Clone Your Fork**
   ```sh
   git clone https://github.com/YOUR_USERNAME/block1a.git
   cd block1a
   ```

3. **Create a New Branch**
   ```sh
   git checkout -b my-experiment
   ```

4. **Make Changes and Commit**
   ```sh
   git add .
   git commit -m "My experimental changes"
   ```

5. **Push to Your Fork**
   ```sh
   git push origin my-experiment
   ```

Now you can experiment freely without affecting the main project.

