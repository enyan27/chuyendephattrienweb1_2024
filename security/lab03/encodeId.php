<?php 
define('SECRET_KEY', 'abc123');
// Hàm mã hóa ID
function encodeId($id) {
    // Base64 encode ID và tạo một HMAC để đảm bảo tính toàn vẹn
    $data = base64_encode($id);
    $hash = hash_hmac('sha256', $data, SECRET_KEY);
    return rtrim(strtr($data . '.' . $hash, '+/', '-_'), '=');
}

// Hàm giải mã ID
function decodeId($encoded) {
    // Tách phần mã hóa và hash để xác thực
    $parts = explode('.', strtr($encoded, '-_', '+/'));
    if (count($parts) !== 2) {
        return false; // Dữ liệu không đúng định dạng
    }

    $data = $parts[0];
    $hash = $parts[1];

    // Xác minh tính toàn vẹn của dữ liệu bằng cách tạo lại hash và so sánh
    $validHash = hash_hmac('sha256', $data, SECRET_KEY);
    if (hash_equals($validHash, $hash)) {
        return base64_decode($data);
    }

    return false; // Dữ liệu không hợp lệ
}


// Câu 2: Sử dụng base64 và hash để mã hóa tham số $id trong url.