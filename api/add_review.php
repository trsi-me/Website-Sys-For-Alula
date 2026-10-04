<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

try {
    require '../config.php';
    
    // التحقق من وجود البيانات المطلوبة
    if (!isset($_POST['name']) || !isset($_POST['feedback']) || !isset($_POST['rating'])) {
        throw new Exception('البيانات المطلوبة غير مكتملة');
    }
    
    // تنظيف البيانات
    $name = trim($_POST['name']);
    $feedback = trim($_POST['feedback']);
    $rating = intval($_POST['rating']);
    
    // التحقق من صحة البيانات
    if (empty($name) || empty($feedback)) {
        throw new Exception('يرجى ملء جميع الحقول المطلوبة');
    }
    
    if ($rating < 1 || $rating > 5) {
        throw new Exception('التقييم يجب أن يكون بين 1 و 5');
    }
    
    $stmt = $pdo->prepare("INSERT INTO reviews (name, feedback, rating) VALUES (?,?,?)");
    $result = $stmt->execute([$name, $feedback, $rating]);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'تم إرسال مراجعتك بنجاح']);
    } else {
        throw new Exception('فشل في حفظ المراجعة');
    }
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}