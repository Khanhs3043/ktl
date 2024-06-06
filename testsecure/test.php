<?php 
function sanitizeInput($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

$inputs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy các đầu vào đã gửi trước đó từ các trường ẩn
    if (isset($_POST['previous_inputs'])) {
        $previous_inputs = json_decode($_POST['previous_inputs'], true);
        // Làm sạch các đầu vào đã gửi trước đó
        if (is_array($previous_inputs)) {
            foreach ($previous_inputs as $prev_input) {
                $inputs[] = sanitizeInput($prev_input);
            }
        }
    }
    // Lấy đầu vào mới, làm sạch và thêm vào danh sách
    if (isset($_POST['user_input'])) {
        // $safe_input = sanitizeInput($_POST['user_input']);
        // $inputs[] = $safe_input;
        $inputs[] = $_POST['user_input'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>secure</title>
</head>
<body>
    <style>
        p{
            font-family: 'Courier New', Courier, monospace;
            text-align: center;
        }
        .title{
            font-size: 30px;
            font-weight: 600;
            color:brown
        }
        .yourtext{
            width: fit-content;
            margin-top: 10px;
            font-size: 20px;
            padding: 5px 10px;
            border-radius: 10px;
            background-color: pink;
            color: brown
        }
        .ur{
            width: fit-content;
            margin: auto;
        }
        form{
            
            width: fit-content;
            margin: auto;
            padding-top: 30px;
        }
        input{
            width: 300px;
            height: 40px;
        }
        button{
            border-radius: 10px;
            background-color: blueviolet;
            color: white;
            font-size: 20px;
            padding: 10px 20px;
        }
    </style>
    <p class="title">Your text</p>
    <div class="ur">
        <?php
        foreach ($inputs as $input) {
            echo '<p class = "yourtext">' . $input . '</p>';
        }
        ?>
    </div>
    <form action="" method="post">
        <input type="text" name="user_input" required>
        
        <input type="hidden" name="previous_inputs" value='<?php echo json_encode($inputs, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>'>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
