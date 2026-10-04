<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

try {
    require '../config.php';
    
    // التحقق من وجود البيانات المطلوبة
    if (!isset($_POST['event_title']) || !isset($_POST['user_name']) || 
        !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_POST['tickets'])) {
        throw new Exception('البيانات المطلوبة غير مكتملة');
    }
    
    // تنظيف البيانات
    $event_title = trim($_POST['event_title']);
    $user_name = trim($_POST['user_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $tickets = intval($_POST['tickets']);
    
    // التحقق من صحة البيانات
    if (empty($event_title) || empty($user_name) || empty($email) || empty($phone) || $tickets < 1) {
        throw new Exception('يرجى ملء جميع الحقول المطلوبة');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('البريد الإلكتروني غير صحيح');
    }
    
    $stmt = $pdo->prepare("INSERT INTO event_bookings (event_title, user_name, email, phone, tickets)
                           VALUES (?,?,?,?,?)");
    
    $result = $stmt->execute([$event_title, $user_name, $email, $phone, $tickets]);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'تم حجز الحدث بنجاح']);
    } else {
        throw new Exception('فشل في حجز الحدث');
    }
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}