<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

try {
    require '../config.php';
    
    // التحقق من وجود البيانات المطلوبة
    if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['phone']) || 
        !isset($_POST['dates']) || !isset($_POST['travelers'])) {
        throw new Exception('البيانات المطلوبة غير مكتملة');
    }
    
    // تنظيف البيانات
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $dates = trim($_POST['dates']);
    $travelers = intval($_POST['travelers']);
    $interests = isset($_POST['interests']) ? implode(',', $_POST['interests']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    
    // التحقق من صحة البيانات
    if (empty($name) || empty($email) || empty($phone) || empty($dates) || $travelers < 1) {
        throw new Exception('يرجى ملء جميع الحقول المطلوبة');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('البريد الإلكتروني غير صحيح');
    }
    
    $stmt = $pdo->prepare("INSERT INTO trip_inquiries
            (full_name, email, phone, trip_dates, travelers, interests, message)
            VALUES (?,?,?,?,?,?,?)");
    
    $result = $stmt->execute([
        $name,
        $email,
        $phone,
        $dates,
        $travelers,
        $interests,
        $message
    ]);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'تم إرسال استفسارك بنجاح']);
    } else {
        throw new Exception('فشل في حفظ البيانات');
    }
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}