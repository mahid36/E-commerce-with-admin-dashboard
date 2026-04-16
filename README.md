# 🛒 E-Commerce with Admin Dashboard

![GitHub repo size](https://img.shields.io/github/repo-size/mahid36/E-commerce-with-admin-dashboard?style=for-the-badge)
![GitHub stars](https://img.shields.io/github/stars/mahid36/E-commerce-with-admin-dashboard?style=for-the-badge)
![GitHub forks](https://img.shields.io/github/forks/mahid36/E-commerce-with-admin-dashboard?style=for-the-badge)
![GitHub issues](https://img.shields.io/github/issues/mahid36/E-commerce-with-admin-dashboard?style=for-the-badge)

<br/>

> A full-featured E-Commerce platform with a powerful Admin Dashboard built with Laravel & Bootstrap.

---

## 📸 Screenshots

### 🏠 Homepage
![Homepage](screenshots/home.png)

### 🖥️ Admin Dashboard
![Dashboard](screenshots/dashboard.png)

### 🛍️ Product Page
![Products](screenshots/products.png)

### 💳 Checkout Page
![Checkout](screenshots/checkout.png)

---

## ✨ Features

### 🛠️ Admin Dashboard
- ✅ Manage Products, Categories, and Inventory
- ✅ Order Management System
- ✅ Role & Permission (Admin/User)
- ✅ Dynamic Banner & Content Management

### 🛍️ Customer Experience
- ✅ Product Browsing & Filtering
- ✅ Add to Cart & Wishlist
- ✅ Review & Rating System
- ✅ Secure Checkout Process

### 💳 Payment Integration
- ✅ SSLCommerz Payment Gateway
- ✅ Stripe Payment Gateway
- ✅ Cash on Delivery
- ✅ Order Success / Failed / Cancel Handling

### 📦 Order Flow
```
Cart → Checkout → Payment → Order Confirmation
```
- ✅ Real-time Order Status Handling

---

## 🛠️ Tech Stack

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

---

## ⚙️ Installation

```bash
# Repository clone করুন
git clone https://github.com/mahid36/E-commerce-with-admin-dashboard.git

# Project folder এ যান
cd E-commerce-with-admin-dashboard

# Dependencies install করুন
composer install
npm install

# .env file setup করুন
cp .env.example .env
php artisan key:generate

# Database migrate করুন
php artisan migrate --seed

# Server run করুন
php artisan serve
```

---

## 🔐 Admin Access

```
URL      : http://127.0.0.1:8000/admin
Email    : admin@example.com
Password : password
```

---

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/
│   ├── Models/
├── resources/
│   ├── views/
│   │   ├── frontend/
│   │   ├── admin/
├── routes/
│   ├── web.php
├── screenshots/
├── database/
│   ├── migrations/
└── README.md
```

---

## 🤝 Contributing

Pull requests are welcome! For major changes, please open an issue first.

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

## 👨‍💻 Author

**Mahid**
[![GitHub](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)](https://github.com/mahid36)
