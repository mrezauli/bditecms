# BDITEC

## Steps for Local Development of a BDITEC Git Repository

### 1. Prerequisites

Ensure the following software is installed on your local machine:

* PHP (version as required by the project, e.g., 8.1+)
* Composer
* Git
* Laragon (preferred) **or** Web server (Apache / Nginx) **or** PHP built-in server
* Database server (MySQL / SQLite {preferred})
* Node.js and npm

Verify installations:

```bash
php -v
composer -V
git --version
node -v
npm -v
```

---

### 2. Clone the Git Repository

```bash
git clone https://github.com/mrezauli/bditec.git
cd bditec
```

For better DX use GitHub Desktop.

---

### 3. Install PHP Dependencies

Run Composer to install backend dependencies:

```bash
composer install
```

---

### 4. Create Environment Configuration

Copy the example environment file:

```bash
cp .env.example .env
```

Then update `.env` with local settings:

* App name (BDITEC)
* App URL (localhost)
* Database credentials (primarily use sqlite)
* Mail, cache, and queue drivers (primarily no usage)

---

### 5. Generate Application Key

```bash
php artisan key:generate
```

This sets the `APP_KEY` in the `.env` file.

---

### 6. Configure the Database

Create a local database and update `.env`:

```env
DB_CONNECTION=mysql

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bditec
DB_USERNAME=root
DB_PASSWORD=
```

---

### 7. Run Database Migrations and Seeders

```bash
php artisan migrate
```

Optional (if seeders exist):

```bash
php artisan db:seed
```

Or combined:

```bash
php artisan migrate --seed
```

Occasionally, use this command to fresh project vibe:

```bash
php artisan migrate:fresh --seed
```

---

### 8. Install Frontend Dependencies

Run this command:

```bash
npm install
```

Build frontend assets:

```bash
npm run build
```

Run the development server:

```bash
npm run dev
```

---

### 9. Run the Laravel Development Server

```bash
php artisan serve
```

Default URL:

```
http://127.0.0.1:8000
```

If using Apache or Nginx, configure the virtual host and point the document root to `/public`.

---

### 10. Verify Application Functionality

* Check homepage loads correctly
* Test authentication (if applicable)
* Confirm database connectivity
* Review logs in `storage/logs/laravel.log`

---

### 11. Common Useful Commands (Optional)

```bash
php artisan optimize:clear
php artisan route:list
php artisan config:clear
php artisan cache:clear
php artisan queue:work
```

---

### 12. Git Workflow for Local Development

Create a feature branch:

```bash
git checkout -b feature/feature-name
```

Pull latest changes:

```bash
git pull origin main
```

Commit changes:

```bash
git add .
git commit -m "Describe change"
git push origin feature/feature-name
```

---
---

### 13. Admin Credential

```bash
admin@admin.admin as email
Pa$$w0rd! as password

```

Now we are only seeding application data. So every user must be created interaction with application. After connected to server via SSH...

```bash
php artisan tinker

User::firstOrCreate(
            [
                'email' => 'admin@admin.admin' //new email
            ],
            [
                'name' => 'Administrator', //new name
                'password' => 'Pa$$w0rd!', //default password
                'email_verified_at' => now(),
                'role' => RoleEnum::Admin
            ]
        );

        User::firstOrCreate(
            [
                'email' => 'super@admin.superadmin' //new email
            ],
            [
                'name' => 'Super Administrator', //new name
                'password' => 'Pa$$w0rd!', //default password
                'email_verified_at' => now(),
                'role' => RoleEnum::SuperAdmin
            ]
        );
```
