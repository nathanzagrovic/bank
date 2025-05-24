## 🏦 Laramint | Laravel Banking App

A simple Laravel-based banking application that provides core banking functionalities, including user & pin authentication, deposits, withdrawals, and transfers between user accounts.

![Alt text](https://i.ibb.co/CptHNWXR/SCR-20250524-sxqt.png)

## 🚀 Getting Started

Follow the steps below to set up the project locally:

### 1. Install Dependencies

```bash
composer install
```

```bash
php artisan migrate --seed
```

```bash
npm install
```

```bash
npm run dev
```
<br>
After seeding, the following user accounts will be available:

### 🧪 Test User

E: bill@microsoft.com<br>
P: password

PIN: 1234

👥 Second User
Account Number: 1234


### 🚀 Features
- User Authentication
- Register, login, logout using Laravel Breeze
- Secure password hashing and session handling
- Banking Operations
- Secure pin authentication and hashing
- Deposit: Add funds to your account
- Withdraw: Remove funds from your account (with balance checks)
- Transfer: Send money to another user's account (with validations)
- Transaction History
- Balance Management

### 🛠 Tech Stack
- Laravel 12
- MySQL
- Vue.js for dynamic frontend interactions
- Breeze for auth scaffolding

### 📚 Code Overview / Methodologies
- OOP approach  
- SOLID principles  
- Traits  
- Service classes  
- Service container binding  
- Dependency injection  
- Events / Listeners  
- Unit & Feature testing  
- Form Requests / validation classes  
- View composers  
- Database seeding  
- Basic exception handling  
- Model relationships  
- Tinker helper classes
- AJAX requests
