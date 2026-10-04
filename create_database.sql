-- إنشاء قاعدة البيانات
CREATE DATABASE IF NOT EXISTS u741730784_alualsys CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE u741730784_alualsys;

-- جدول الاستفسارات
CREATE TABLE IF NOT EXISTS trip_inquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    trip_dates VARCHAR(100) NOT NULL,
    travelers INT NOT NULL,
    interests TEXT,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- جدول المراجعات
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    feedback TEXT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- جدول حجوزات الأحداث
CREATE TABLE IF NOT EXISTS event_bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_title VARCHAR(255) NOT NULL,
    user_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    tickets INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- إدراج بعض البيانات التجريبية للمراجعات
INSERT INTO reviews (name, feedback, rating) VALUES 
('أحمد محمد', 'تجربة رائعة في العلا! المناظر خلابة والتنظيم ممتاز', 5),
('فاطمة العلي', 'مكان تاريخي مذهل، أنصح بزيارته بشدة', 5),
('خالد السعد', 'رحلة لا تُنسى، خاصة زيارة مدائن صالح', 4);

