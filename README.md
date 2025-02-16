# 🎬 Laravel Cinema Reservation System

## 🛠️ Project Overview

The **Laravel Cinema Reservation System** is a ticket reservation platform built with **Laravel** and backed by a **PostgreSQL** database. It facilitates seamless ticket booking for cinema-goers and efficient management of films, screenings, and reservations for administrators.

The application distinguishes between three user roles:

1. **Anonymous User (Unauthenticated)**
2. **Authenticated User (Logged-in)**
3. **Administrator (Admin)**

---

## 👤 User Roles & Permissions

### 1️⃣ **Anonymous User (Unauthenticated)**
- 🎞️ Browse available films.
- 💲 View film prices.
- 🌟 See the latest cinema offers.

### 2️⃣ **Authenticated User (Logged-in)**
- ✅ All permissions of an Anonymous User.
- 🎟️ Reserve tickets for films.
- 🔄 Update personal information.
- 📜 Access reservation history.

### 3️⃣ **Administrator (Admin)**
- ✅ All permissions of both Anonymous and Authenticated Users.
- 🎬 Add, edit, or delete films.
- 🕒 Schedule screenings (assign halls, times, and dates).
- 📑 View all reservations.
- 🗑️ Delete any reservation as needed.

---

## 🖥️ Technologies Used

- **Laravel** (PHP Framework)
- **PostgreSQL** (Database)
- **Blade Templates** (Frontend Views)
- **JavaScript** (Interactive Frontend)
- **Composer** (Dependency Manager)

---

## 🏗️ Project Structure

```
.
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── FilmController.php
│   │   │   ├── ReservationController.php
│   │   │   ├── ScreeningController.php
│   │   │   └── UserController.php
│   ├── Models
│   │   ├── User.php
│   │   ├── Film.php
│   │   ├── Reservation.php
│   │   └── Screening.php
├── database
│   └── migrations
├── resources
│   └── views
│       ├── films
│       ├── reservations
│       ├── screenings
│       ├── users
│       └── layouts
├── routes
│   └── web.php
└── .env
```

---

## 🚀 Getting Started

### ⚙️ Prerequisites
- **PHP 8.x**
- **Laravel Installer**
- **Composer**
- **PostgreSQL**

### 📦 Installation Steps

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/Cinema_reservation_laravel.git
   cd Cinema_reservation_laravel
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   ```

3. **Environment Configuration**:
   - Duplicate `.env.example` and rename it to `.env`.
   - Update database configuration:
     ```env
     DB_CONNECTION=pgsql
     DB_HOST=127.0.0.1
     DB_PORT=5432
     DB_DATABASE=cinema_reservation
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

4. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

5. **Start the Application**:
   ```bash
   php artisan serve
   ```

6. **Access the Application**:
   - Open `http://localhost:8000` in your browser.

---

## 🖼️ Application Features

### 🎬 Film Management
- View available films, including titles, descriptions, categories, durations, and prices.
- Administrators can add, edit, or delete films.

### 🎟️ Ticket Reservations
- Users can select a film, choose a screening, and reserve tickets.
- Users can view a list of their reservations.
- Administrators can delete reservations when necessary.

### 🕒 Screening Scheduling
- Administrators can define screening details, including the hall, date, and time.

### 🔒 Authentication & Authorization
- User registration and login functionality.
- Admin panel access restricted to users with administrative roles.

## 🔐 Security Considerations

- **CSRF protection** enabled.
- **Form validation** implemented across user inputs.
- **Role-based access control** to secure admin functionalities.

---

## 🔧 Sample Code Snippets

### **Route Definition**
```php
Route::middleware('auth')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::post('/reservations', [ReservationController::class, 'store']);
});
```

### **Reservation Controller Snippet**
```php
public function store(Request $request)
{
    $request->validate([
        'screening_id' => 'required|exists:screenings,id',
        'number_of_tickets' => 'required|integer|min:1',
    ]);

    Reservation::create([
        'user_id' => auth()->id(),
        'screening_id' => $request->screening_id,
        'number_of_tickets' => $request->number_of_tickets,
    ]);

    return redirect('/reservations')->with('success', 'Reservation created successfully!');
}
```

### **Blade Template Snippet**
```html
@if(auth()->check())
    <a href="{{ route('reservations.create') }}" class="btn btn-primary">Reserve Tickets</a>
@endif
```

---

## 📈 Future Improvements

- 🎟️ **Seat Selection**: Allow users to choose seats when booking.
- 📲 **Responsive Design**: Improve mobile compatibility.
- 🔐 **Enhanced Security**: Implement multi-factor authentication.
- 📊 **Analytics Dashboard**: Show reservation and revenue statistics.

---

**🎬 Enjoy the Movie! 🍿**

