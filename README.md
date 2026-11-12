
# DieselGo – Fuel Delivery & Booking Application

DieselGo is a mobile-based fuel delivery and booking application designed to simplify the process of ordering fuel and managing delivery requests. Customers can register, log in, browse available fuel types, and place fuel delivery bookings through a mobile application.

The project consists of a React Native mobile application and a Laravel REST API backend.

## Features

### Customer Mobile Application
- User registration and login
- Secure authentication using Laravel Sanctum
- User profile management
- Browse available fuel types
- View fuel prices
- Select fuel type and enter required quantity
- Place fuel delivery bookings
- Booking confirmation and status tracking
- API-based communication with the backend

### Backend & API
- RESTful API architecture
- Laravel Sanctum authentication
- User management
- Fuel type management
- Booking management
- Request validation and error handling
- Database-driven fuel pricing
- Protected API endpoints

### Admin Dashboard
- Admin dashboard
- Manage fuel types
- View and manage customer bookings
- Monitor booking information

## Technology Stack

| Component | Technology |
|---|---|
| Mobile Application | React Native |
| Mobile Framework | Expo |
| Backend | PHP, Laravel |
| API Authentication | Laravel Sanctum |
| Database | MySQL |
| API Architecture | REST API |
| Development Tools | VS Code, Android Studio |
| API Testing | Postman |
| Version Control | Git & GitHub |

## Application Architecture

```text
DieselGo/
│
├── backend/
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── routes/
│   │   └── api.php
│   ├── resources/
│   ├── storage/
│   ├── tests/
│   ├── .env.example
│   └── composer.json
│
└── mobile/
    ├── app/
    ├── assets/
    ├── components/
    ├── constants/
    ├── package.json
    └── app.json
```

*Note: Update this directory structure to match your actual repository.*

## Prerequisites

Install the following before running the application:

- PHP 8.2 or later
- Composer
- MySQL
- Node.js
- npm
- Expo CLI / Expo tooling
- Expo Go (Android device) or Android Emulator

## Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/YOUR_USERNAME/DieselGo.git

cd DieselGo
```

### 2. Backend Setup

Navigate to the Laravel backend directory:

```bash
cd backend
```

Install dependencies:

```bash
composer install
```

Create the environment configuration:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure your database credentials in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dieselgo
DB_USERNAME=root
DB_PASSWORD=
```

Run database migrations:

```bash
php artisan migrate
```

Start the Laravel development server:

```bash
php artisan serve
```

Backend API base URL:

```text
http://127.0.0.1:8000/api
```

### 3. Mobile Application Setup

Open another terminal and navigate to the mobile application:

```bash
cd mobile
```

Install dependencies:

```bash
npm install
```

Configure the backend API base URL in the mobile application.

For Android Emulator:

```text
http://10.0.2.2:8000/api
```

For a physical Android device, use your computer's local network IP:

```text
http://YOUR_LOCAL_IP:8000/api
```

Start Expo:

```bash
npx expo start
```

Scan the QR code using Expo Go to launch the application.

## API Modules

| Module | Description |
|---|---|
| Authentication | Register, login and logout |
| User Profile | Retrieve and manage user details |
| Fuel Types | Retrieve available fuel types |
| Bookings | Create and manage fuel bookings |

### Authentication

The application uses Laravel Sanctum token-based authentication to protect customer-specific API endpoints.

### Fuel Management

Fuel information is retrieved dynamically from the backend, including fuel type and pricing.

### Booking Management

Customers can submit fuel booking requests through the mobile application. Booking information is validated and stored in the backend database.

## Sample Application Workflow

1. Customer opens the DieselGo mobile application.
2. Registers or logs into an account.
3. Browses available fuel types.
4. Selects the required fuel.
5. Enters the booking details.
6. Submits the booking request.
7. Backend validates and stores the booking.
8. Customer receives booking confirmation.

## Security

- Token-based API authentication.
- Protected backend routes.
- Server-side request validation.
- Environment-based configuration.
- Sensitive credentials excluded from version control.

## Future Enhancements

- Real-time delivery tracking.
- Payment gateway integration.
- Google Maps integration.
- Push notifications.
- Delivery partner application.
- Booking history and invoices.
- Advanced admin analytics.
- Automated booking status updates.

## Developer

**Praveen Kumar Mandula**

Software Engineer | PHP Laravel Full Stack Developer | Python & AI Enthusiast

- GitHub: https://github.com/praveenkumarmandula

## License

This project is developed for learning, demonstration and portfolio purposes.
